<?php

class Middleware
{
  public static function auth()
  {
    if (!isset($_SESSION['user'])) {
      redirect('/login');
    }
  }

  public static function role($role)
  {
    self::auth();
    if ($_SESSION['user']['role'] !== $role) {
      http_response_code(403);
      echo "403 Forbidden - Access Denied";
      exit;
    }
  }

  public static function guest()
  {
    if (isset($_SESSION['user'])) {
      $role = $_SESSION['user']['role'];
      // Redirect berdasarkan role jika sudah login
      if ($role === 'admin') {
        header('Location: /admin/dashboard');
      } elseif ($role === 'mandor') {
        header('Location: /mandor/dashboard');
      }
      exit;
    }
  }
}
