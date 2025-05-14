<?php

require_once __DIR__ . '/../../app/Models/ProjectNotification.php';

// Ambil notifikasi jika user adalah mandor
$notifList = [];
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'mandor') {
  $notifModel = new ProjectNotification();
  $notifList = $notifModel->getUnreadByUser($_SESSION['user']['id']);
}
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky" data-bs-theme="dark" style="position: sticky; top: 0; z-index: 999;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CV Mentari Pagi Engineering</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?php
        $uri = $_SERVER['REQUEST_URI'];
        function isActive($path)
        {
          return strpos($_SERVER['REQUEST_URI'], $path) === 0 ? 'active' : '';
        }
        ?>

        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/admin/dashboard') ?>" href="/admin/dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/admin/karyawan') ?>" href="/admin/karyawan">Karyawan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/admin/projects') ?>" href="/admin/projects">Proyek</a>
          </li>

        <?php elseif ($_SESSION['user']['role'] === 'mandor'): ?>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/mandor/dashboard') ?>" href="/mandor/dashboard">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= isActive('/mandor/projects') ?>" href="/mandor/projects">Proyek</a>
          </li>
        <?php endif; ?>
      </ul>

      <div class="d-flex gap-3 align-items-center">
        <?php if ($_SESSION['user']['role'] === 'mandor'): ?>
          <?php $unreadCount = count($notifList); ?>
          <div class="nav-item dropdown me-3">
            <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-bell fs-4" style="color: white;"></i>
              <?php if ($unreadCount > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                  <?= $unreadCount ?>
                </span>
              <?php endif; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end p-2" style="min-width: 500px;">
              <li class="fw-bold">Notifikasi Proyek</li>
              <hr class="dropdown-divider">
              <?php if ($unreadCount === 0): ?>
                <li><span class="dropdown-item text-muted">Tidak ada notifikasi baru</span></li>
              <?php else: ?>
                <?php foreach ($notifList as $notif): ?>
                  <li class="d-flex justify-content-between align-items-center mb-2 px-2">
                    <div>
                      <div class="fw-semibold"><?= htmlspecialchars($notif['project_name']) ?></div>
                      <small class="text-muted">Komentar baru dari admin</small>
                    </div>
                    <form method="POST" action="/mandor/projects/read/<?= $notif['project_id'] ?>">
                      <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
                      <button class="btn btn-sm btn-outline-success ms-2">Tandai telah dibaca</button>
                    </form>
                  </li>
                <?php endforeach; ?>
              <?php endif; ?>
            </ul>
          </div>
        <?php endif; ?>

        <form method="POST" action="/logout">
          <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
          <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
      </div>
    </div>
  </div>
</nav>