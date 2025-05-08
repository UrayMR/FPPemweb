<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../core/auth.php';

class AuthController
{
  public static function index()
  {
    view('pages/auth/login');
  }

  public static function login()
  {
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];


    $userModel = new User();
    $user = $userModel->findByCredentials($username, $phone_number);

    if ($user) {
      login($user);

      // Arahkan langsung ke dashboard sesuai role
      if ($user['role'] === 'admin') {
        redirect('/admin/dashboard');
      } elseif ($user['role'] === 'mandor') {
        redirect('/mandor/dashboard');
      } else {
        redirect('/login');
      }

      exit;
    }

    $_SESSION['error'] = 'Login gagal. Periksa data Anda.';
    redirect('/login');
    exit;
  }

  public static function logout()
  {
    logout();
    redirect('/login');
  }
}
