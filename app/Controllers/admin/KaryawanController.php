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

  public static function create()
  {
    view('pages/admin/karyawan/create');
  }

  public static function store()
  {
    $user = new User();
    $data = [
      'username' => $_POST['username'],
      'phone_number' => $_POST['phone_number'],
      'role' => 'mandor',
    ];

    $user->create($data);
    redirect('/admin/karyawan?success=Karyawan berhasil ditambahkan');
  }

  public static function edit($id)
  {
    $user = new User();
    $mandor = $user->find($id);

    if (!$mandor || $mandor['role'] !== 'mandor') {
      redirect('/admin/karyawan?error=Karyawan tidak ditemukan');
    }

    view('pages/admin/karyawan/edit', ['mandor' => $mandor]);
  }

  public static function update($id)
  {
    $user = new User();
    $mandor = $user->find($id);

    if (!$mandor || $mandor['role'] !== 'mandor') {
      redirect('/admin/karyawan?error=Karyawan tidak ditemukan');
    }

    $data = [
      'username' => $_POST['username'],
      'phone_number' => $_POST['phone_number'],
      'role' => 'mandor',
    ];

    $user->update($id, $data);
    redirect('/admin/karyawan?success=Karyawan berhasil diperbarui');
  }

  public static function destroy($id)
  {
    $user = new User();
    $mandor = $user->find($id);

    if (!$mandor || $mandor['role'] !== 'mandor') {
      redirect('/admin/karyawan?error=Karyawan tidak ditemukan');
    }

    $user->delete($id);
    redirect('/admin/karyawan?success=Karyawan berhasil dihapus');
  }
}
