<?php
require_once __DIR__ . '/../../../core/env.php';
require_once __DIR__ . '/../../../core/connection.php';

loadEnv();

$pdo = Connection::getInstance();
$userId = $_SESSION['user']['id'] ?? null;

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

<style>
  body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', sans-serif;
  }

  .icon {
    margin-right: 8px;
  }

  .card {
    border-radius: 1rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
  }

  .card h3,
  .card h5,
  .card h4 {
    margin-bottom: 1rem;
  }

  .btn {
    margin-top: 1rem;
  }
</style>

<div class="card p-4">
  <h4 class="mb-4">Dashboard Proyek</h4>
  <div class="row">
    <div class="col-md-6">
      <h5>Jumlah Proyek Berdasarkan Tanggal Mulai</h5>
      <canvas id="projectChart"></canvas>
    </div>
    <div class="col-md-6">
      <h5>Persentase Proyek per Pelanggan</h5>
      <canvas id="customerChart"></canvas>
    </div>
  </div>
</div>

<div class="container mt-5">
  <h1 class="fw-bold">Selamat Datang di Panel Pekerjaan</h1>
  <h2 class="mb-4">Monitor aktivitas proyek dan tenaga kerja</h2>

  <div class="row mb-4">
    <div class="col-md-6">
      <div class="card p-4">
        <h3><i class="bi bi-briefcase icon"></i> Proyek Aktif</h3>
        <p>Anda sedang mengawasi proyek mandor.</p>
        <a href="/admin/projects" class="btn btn-primary">Lihat Detail</a>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-4">
        <h3><i class="bi bi-people icon"></i> Tenaga Kerja</h3>
        <p>3 pekerja aktif terdaftar di lapangan.</p>
      </div>
    </div>
  </div>
</div>

<script>
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
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          }
        }
      }
    }
  });

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