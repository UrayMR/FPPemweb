<?php

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Middleware.php';

require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/MandorController.php';
require_once __DIR__ . '/../app/Controllers/admin/KaryawanController.php';
require_once __DIR__ . '/../app/Controllers/admin/AdminProyekController.php';

/**
 * -----------------------
 * AUTH ROUTES
 * -----------------------
 */

// Halaman login
Router::get('/login', function () {
  Middleware::guest();
  AuthController::index();
});

// Proses login
Router::post('/login', function () {
  Middleware::guest();
  AuthController::login();
});

// Logout
Router::get('/logout', function () {
  Middleware::auth();
  AuthController::logout();
});

/**
 * -----------------------
 * REDIRECT ROLE
 * -----------------------
 */
Router::get('/', function () {
  if (!isset($_SESSION['user'])) {
    header('Location: /login');
    exit;
  }

  $role = $_SESSION['user']['role'] ?? null;

  if ($role === 'admin') {
    header('Location: /admin/dashboard');
  } elseif ($role === 'mandor') {
    header('Location: /mandor/dashboard');
  } else {
    echo "Role tidak dikenali.";
  }
  exit;
});

/**
 * -----------------------
 * ADMIN ROUTES
 * -----------------------
 */
Router::get('/admin/dashboard', function () {
  Middleware::role('admin');
  AdminController::dashboard();
});

Router::get('/admin/karyawan', function () {
  Middleware::role('admin');
  KaryawanController::index();
});

Router::get('/admin/proyek', function () {
  Middleware::role('admin');
  AdminProyekController::index();
});

/**
 * -----------------------
 * MANDOR ROUTES
 * -----------------------
 */
Router::get('/mandor/dashboard', function () {
  Middleware::role('mandor');
  MandorController::dashboard();
});
