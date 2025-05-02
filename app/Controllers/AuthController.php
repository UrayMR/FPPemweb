<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
  public static function showLogin()
  {
    view('pages/auth/login');
  }

  public static function login()
  {
    $user = User::findByEmail($_POST['username']);
    if ($user && $_POST['phone_number'] === $user['phone_number']) { // NOTE: gunakan password_hash di produksi
      $_SESSION['user'] = [
        'id' => $user['id'],
        'username' => $user['username'],
        'role' => $user['role'],
      ];
      if ($user['role'] === 'admin') {
        redirect('/admin/dashboard');
      } else {
        redirect('/mandor/dashboard');
      }
    } else {
      redirect('/login?error=Invalid credentials');
    }
  }

  public static function logout()
  {
    session_destroy();
    redirect('/login');
  }
}
