<?php

require_once __DIR__ . '/../../Models/User.php';

class KaryawanController
{
  public static function index()
  {
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $user = new User();
    $totalUser = $user->total();
    $karyawanList = $user->allPaginated($limit, $offset);

    $totalPages = ceil($totalUser / $limit);

    view('pages/admin/karyawan/index', [
      'karyawanList' => $karyawanList,
      'currentPage' => $page,
      'totalPages' => $totalPages
    ]);
  }

  public static function store()
  {
    verifyCsrfToken($_POST['csrf_token']);

    $rules = [
      'username' => 'required|string',
      'phone_number' => 'required|numeric',
    ];

    validate($_POST, $rules);

    $data = [
      'username' => $_POST['username'],
      'phone_number' => $_POST['phone_number'],
      'role' => $_POST['role'],
    ];

    $user = new User();
    $user->create($data);

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Karyawan ' . $data['username'] . ' berhasil ditambahkan.'
    ];

    redirect('/admin/karyawan');
  }

  public static function update($id)
  {
    verifyCsrfToken($_POST['csrf_token']);

    $rules = [
      'username' => 'required|string',
      'phone_number' => 'required|numeric',
      'role' => 'required|string',
    ];

    validate($_POST, $rules);

    $user = new User();
    $authUser = $_SESSION['user']['id']; // ID pengguna yang sedang login
    $karyawan = $user->find($id);

    if (!$karyawan) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Karyawan tidak ditemukan.'
      ];
      redirect('/admin/karyawan');
    }

    // Cek apakah pengguna mencoba mengubah role dirinya sendiri
    if ($id == $authUser && isset($_POST['role']) && $_POST['role'] !== $karyawan['role']) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Anda tidak dapat mengubah role akun Anda sendiri.'
      ];
      redirect('/admin/karyawan');
    }

    // cek apakah pengguna mencoba menggunakan nomor telefon pengguna lain
    // if ($user->isPhoneNumberExists($_POST['phone_number'], $id)) {
    //   $_SESSION['alert'] = [
    //     'type' => 'danger',
    //     'message' => 'Nomor telepon sudah digunakan oleh pengguna lain.'
    //   ];
    //   redirect('/admin/karyawan');
    // }

    $data = [
      'username' => $_POST['username'],
      'phone_number' => $_POST['phone_number'],
      'role' => $_POST['role'],
    ];

    $user->update($id, $data);

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Karyawan ' . $karyawan['username'] . ' berhasil diperbarui.'
    ];

    redirect('/admin/karyawan');
  }

  public static function destroy($id)
  {
    verifyCsrfToken($_POST['csrf_token']);

    $user = new User();
    $authUser = $_SESSION['user']['id'];
    $karyawan = $user->find($id);

    if (!$karyawan) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Karyawan tidak ditemukan.'
      ];
      redirect('/admin/karyawan');
    }

    if ($id == $authUser) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Anda tidak dapat menghapus akun Anda sendiri.'
      ];
      redirect('/admin/karyawan');
    }

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Karyawan ' . $karyawan['username'] . ' berhasil dihapus.'
    ];

    $user->delete($id);


    redirect('/admin/karyawan');
  }
}
