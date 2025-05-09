<?php


require_once __DIR__ . '/../Models/User.php';

class AuthController
{
  public static function index()
  {
    view('pages/auth/login');
  }

  public static function login()
  {
    // Verifikasi CSRF token
    verifyCsrfToken($_POST['csrf_token']);

    // Aturan validasi
    $rules = [
      'username' => 'required|string',
      'phone_number' => 'required|numeric',
    ];

    // Validasi data
    validate($_POST, $rules);

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
        $_SESSION['alert'] = [
          'type' => 'danger',
          'message' => 'Role tidak valid.',
        ];
        redirect('/login');
      }

      exit;
    }

    // Jika user tidak ditemukan
    $_SESSION['alert'] = [
      'type' => 'danger',
      'message' => 'Login gagal. Username atau nomor telepon tidak valid.',
    ];
    redirect('/login');
    exit;
  }

  public static function logout()
  {
    // Verifikasi CSRF token
    verifyCsrfToken($_POST['csrf_token']);

    logout();
    redirect('/login');
  }
}
