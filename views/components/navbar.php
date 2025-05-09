<nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CV Mentari Pagi Engineering</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/admin/dashboard') ? 'active' : '' ?>" href="/admin/dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/admin/karyawan') ? 'active' : '' ?>" href="/admin/karyawan">Karyawan</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($_SERVER['REQUEST_URI'] == '/admin/proyek') ? 'active' : '' ?>" href="/admin/projects">Proyek</a>
        </li>
      </ul>
      <div class="d-flex gap-3">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <?= $_SESSION['user']['username'] ?>
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Profile</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Change Password</a></li>
            </ul>
          </li>
        </ul>

        <form method="POST" action="/logout">
          <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">
          <button class="btn btn-outline-danger" type="submit">Logout</button>
        </form>
      </div>

    </div>
  </div>
</nav>