<?php

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/MandorController.php';
require_once __DIR__ . '/../app/Controllers/admin/KaryawanController.php';
require_once __DIR__ . '/../core/Middleware.php';

// Route untuk login dan logout
Router::get('/login', function () {
  Middleware::guest(); // hanya guest yang bisa akses login
  AuthController::showLogin();
});

Router::post('/login', function () {
  Middleware::guest(); // hanya guest yang bisa akses login
  AuthController::login();
});

Router::get('/logout', function () {
  Middleware::auth(); // hanya user yang sudah login yang bisa logout
  AuthController::logout();
});

// Route untuk Admin dan Mandor dengan pemeriksaan role
Router::get('/', function () {
  // Redirect user ke dashboard berdasarkan role
  Middleware::auth(); // hanya user yang sudah login
  $role = $_SESSION['user']['role'];
  if ($role === 'admin') {
    header('Location: /admin/dashboard');
  } elseif ($role === 'mandor') {
    header('Location: /mandor/dashboard');
  }
});

Router::get('/admin/dashboard', function () {
  Middleware::role('admin'); // hanya admin yang bisa akses
  AdminController::dashboard();
});

Router::get('/admin/karyawan', function () {
  Middleware::role('admin'); // hanya admin yang bisa akses
  KaryawanController::index();
});

Router::get('/mandor/dashboard', function () {
  Middleware::role('mandor'); // hanya mandor yang bisa akses
  MandorController::dashboard();
});
