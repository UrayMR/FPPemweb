<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../../core/auth.php';

class AuthController
{
  public static function showLogin()
  {
    view('pages/auth/login');
  }

  public static function login()
  {
    $username = $_POST['username'];
    $phone_number = $_POST['phone_number'];


    $user = User::findByCredentials($username, $phone_number);
    if ($user) {
      login($user);
      redirect('/');
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
