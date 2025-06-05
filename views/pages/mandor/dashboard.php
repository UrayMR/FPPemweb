<div class="p-2 container">
  <div class="row mb-4 g-4">
    <div class="col-md-6">
      <div class="card p-4 shadow-sm border-0 rounded-3 h-100 bg-white d-flex flex-row align-items-center justify-content-between">
        <div>
          <i class="bi bi-person-workspace display-4 text-info"></i>
        </div>
        <div class="text-end">
          <span class="text-secondary mb-1 d-block">Total Proyek</span>
          <h2 class="fw-bold text-primary mb-0" style="font-size:2.5rem;"><?= $totalProjects ?? 0 ?></h2>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="card p-4 shadow-sm border-0 rounded-3 h-100 bg-white d-flex flex-row align-items-center justify-content-between">
        <div>
          <i class="bi bi-archive-fill display-4 text-success"></i>
        </div>
        <div class="text-end">
          <span class="text-secondary mb-1 d-block">Proyek Selesai</span>
          <h2 class="fw-bold text-success mb-0" style="font-size:2.5rem;"><?= $totalFinishedProjects ?? 0 ?></h2>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-4">
    <div class="col-md-6">
      <div class="card p-3 shadow-sm border-0 rounded-3 bg-white">
        <h5 class="mb-3 text-primary text-center">Jumlah Proyek Berdasarkan Tanggal Mulai</h5>
        <div>
          <canvas id="projectChart"></canvas>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card p-3 shadow-sm border-0 rounded-3 bg-white align-items-center">
        <h5 class="mb-3 text-success text-center">Persentase Proyek per Pelanggan</h5>
        <div>
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
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 2,
        borderRadius: 8,
        maxBarThickness: 40
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: '#fff',
          titleColor: '#222',
          bodyColor: '#222',
          borderColor: '#36a2eb',
          borderWidth: 1
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1
          },
          grid: {
            color: '#e0e7ff'
          }
        },
        x: {
          grid: {
            color: '#f3f4f6'
          }
        }
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
          'rgba(255, 99, 132, 0.6)',
          'rgba(54, 162, 235, 0.6)',
          'rgba(255, 206, 86, 0.6)',
          'rgba(75, 192, 192, 0.6)',
          'rgba(153, 102, 255, 0.6)',
          'rgba(255, 159, 64, 0.6)',
          'rgba(199, 199, 199, 0.6)',
          'rgba(83, 102, 255, 0.6)',
          'rgba(255, 102, 153, 0.6)',
          'rgba(102, 255, 204, 0.6)'
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            color: '#222',
            font: {
              size: 14
            }
          }
        },
        tooltip: {
          backgroundColor: '#fff',
          titleColor: '#222',
          bodyColor: '#222',
          borderColor: '#22c55e',
          borderWidth: 1,
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