<?php

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
  Middleware::guest(); // Pastikan hanya tamu yang bisa mengakses
  AuthController::index();
});

// Proses login
Router::post('/login', function () {
  Middleware::role('guest'); // Verifikasi CSRF dan pastikan hanya tamu yang bisa mengakses
  AuthController::login();
});

// Logout
Router::post('/logout', function () {
  Middleware::auth();
  AuthController::logout();
});

/**
 * -----------------------
 * ADMIN ROUTES
 * -----------------------
 */
Router::get('/admin/dashboard', function () {
  Middleware::role('admin'); // Pastikan hanya admin yang bisa mengakses
  AdminController::dashboard();
});

Router::get('/admin/karyawan', function () {
  Middleware::role('admin'); // Pastikan hanya admin yang bisa mengakses
  KaryawanController::index();
});

Router::post('/admin/karyawan/create', function () {
  Middleware::role('admin'); // Verifikasi CSRF dan pastikan hanya admin yang bisa mengakses
  KaryawanController::store();
});

Router::post('/admin/karyawan/delete/{id}', function ($id) {
  Middleware::role('admin'); // Verifikasi CSRF dan pastikan hanya admin yang bisa mengakses
  KaryawanController::destroy($id);
});

Router::post('/admin/karyawan/update/{id}', function ($id) {
  Middleware::role('admin'); // Verifikasi CSRF dan pastikan hanya admin yang bisa mengakses
  KaryawanController::update($id);
});

Router::get('/admin/proyek', function () {
  Middleware::role('admin'); // Pastikan hanya admin yang bisa mengakses
  AdminProyekController::index();
});

/**
 * -----------------------
 * MANDOR ROUTES
 * -----------------------
 */
Router::get('/mandor/dashboard', function () {
  Middleware::role('mandor'); // Pastikan hanya mandor yang bisa mengakses
  MandorController::dashboard();
});
