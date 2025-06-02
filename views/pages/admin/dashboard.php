<?php
require_once __DIR__ . '/../../../core/env.php';
require_once __DIR__ . '/../../../core/connection.php';

loadEnv();

$pdo = Connection::getInstance();
$userId = $_SESSION['user']['id'] ?? null;

// Chart proyek berdasarkan tanggal
$stmt = $pdo->prepare("
    SELECT DATE(start_date) AS date, COUNT(*) AS total 
    FROM projects 
    WHERE start_date IS NOT NULL AND user_id = :user_id
    GROUP BY DATE(start_date)
    ORDER BY DATE(start_date)
");
$stmt->execute(['user_id' => $userId]);
$chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$labels = [];
$data = [];

foreach ($chartData as $row) {
  $labels[] = date('d M', strtotime($row['date']));
  $data[] = (int)$row['total'];
}

// Query untuk chart pelanggan
$stmtCustomers = $pdo->prepare("
    SELECT customer_name, COUNT(*) AS total 
    FROM projects 
    WHERE customer_name IS NOT NULL AND customer_name != '' AND user_id = :user_id
    GROUP BY customer_name
    ORDER BY total DESC
");
$stmtCustomers->execute(['user_id' => $userId]);
$customerData = $stmtCustomers->fetchAll(PDO::FETCH_ASSOC);

$totalProjects = array_sum(array_column($customerData, 'total'));

$customerLabels = [];
$customerPercentages = [];

foreach ($customerData as $row) {
  $customerLabels[] = $row['customer_name'];
  $customerPercentages[] = round(($row['total'] / $totalProjects) * 100, 2);
}
?>

<div class="container mt-5">
  <h2 class="mb-4">Dashboard Proyek</h2>

  <!-- Chart Proyek per Tanggal -->
  <div class="row">
    <div class="col-md-12">
      <div class="card shadow-sm p-3">
        <h5 class="card-title">Jumlah Proyek Berdasarkan Tanggal Mulai</h5>
        <canvas id="projectChart" height="100"></canvas>
      </div>
    </div>
  </div>

  <!-- Chart Pelanggan -->
  <div class="row mt-4">
    <div class="col-md-12">
      <div class="card shadow-sm p-3">
        <h5 class="card-title">Persentase Proyek per Pelanggan</h5>
        <div style="max-width: 400px; margin: auto;">
        <canvas id="customerChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Chart proyek per tanggal
  const ctx = document.getElementById('projectChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode($labels) ?>,
      datasets: [{
        label: 'Jumlah Proyek',
        data: <?= json_encode($data) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.7)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, ticks: { stepSize: 1 } }
      }
    }
  });

  // Chart pelanggan
  const ctx2 = document.getElementById('customerChart').getContext('2d');
  new Chart(ctx2, {
    type: 'pie',
    data: {
      labels: <?= json_encode($customerLabels) ?>,
      datasets: [{
        data: <?= json_encode($customerPercentages) ?>,
        backgroundColor: [
          'rgba(255, 99, 132, 0.7)',
          'rgba(54, 162, 235, 0.7)',
          'rgba(255, 206, 86, 0.7)',
          'rgba(75, 192, 192, 0.7)',
          'rgba(153, 102, 255, 0.7)',
          'rgba(255, 159, 64, 0.7)',
          'rgba(199, 199, 199, 0.7)',
          'rgba(83, 102, 255, 0.7)',
          'rgba(255, 102, 153, 0.7)',
          'rgba(102, 255, 204, 0.7)'
        ]
      }]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: {
          callbacks: {
            label: function(context) {
              return context.label + ': ' + context.parsed + '%';
            }
          }
        }
      }
    }
  });
</script>

<?php include __DIR__ . "/../../components/alert.php"; ?>
