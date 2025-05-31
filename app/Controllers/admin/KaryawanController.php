<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

require_once __DIR__ . '/../../Models/User.php';

class KaryawanController
{
  public static function index()
  {
    try {
      $limit = 5;
      $page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
      $offset = ($page - 1) * $limit;

      // Ambil filter dari query string
      $filters = [
        'search' => $_GET['search'] ?? '',
        'role' => $_GET['role'] ?? ''
      ];

      $user = new User();

      // Kirim filters ke model
      $totalUser = $user->total($filters);
      $karyawanList = $user->allPaginated($limit, $offset, $filters);

      $totalPages = max(ceil($totalUser / $limit), 1); // supaya tidak 0 halaman

      view('pages/admin/karyawan/index', [
        'karyawanList' => $karyawanList,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'search' => $filters['search'],
        'role' => $filters['role'],
        'offset' => $offset,
      ]);
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan saat memuat data karyawan.'];
      redirect('/admin/dashboard');
    }
  }

  public static function store()
  {
    try {
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

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Karyawan berhasil ditambahkan.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/admin/karyawan');
  }

  public static function update($id)
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $rules = [
        'username' => 'required|string',
        'phone_number' => 'required|numeric',
        'role' => 'required|string',
      ];

      validate($_POST, $rules);

      $user = new User();
      $authUser = $_SESSION['user']['id'];
      $karyawan = $user->find($id);

      if (!$karyawan) {
        throw new Exception('Karyawan tidak ditemukan.');
      }

      if ($id == $authUser && isset($_POST['role']) && $_POST['role'] !== $karyawan['role']) {
        throw new Exception('Anda tidak dapat mengubah role akun Anda sendiri.');
      }

      $data = [
        'username' => $_POST['username'],
        'phone_number' => $_POST['phone_number'],
        'role' => $_POST['role'],
      ];

      $user->update($id, $data);

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Karyawan berhasil diperbarui.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/admin/karyawan');
  }

  public static function destroy($id)
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $user = new User();
      $authUser = $_SESSION['user']['id'];
      $karyawan = $user->find($id);

      if (!$karyawan) {
        throw new Exception('Karyawan tidak ditemukan.');
      }

      if ($id == $authUser) {
        throw new Exception('Anda tidak dapat menghapus akun Anda sendiri.');
      }

      $user->delete($id);

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Karyawan berhasil dihapus.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/admin/karyawan');
  }

  public static function export()
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $user = new User();
      $karyawanList = $user->all();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Set header 
      $sheet->fromArray(['ID', 'Username', 'Phone Number', 'Role', 'Created At'], NULL, 'A1');

      // Set data
      $row = 2;
      foreach ($karyawanList as $karyawan) {
        $sheet->fromArray([
          $karyawan['id'],
          $karyawan['username'],
          $karyawan['phone_number'],
          $karyawan['role'],
          !empty($karyawan['created_at']) ? $karyawan['created_at'] : date('Y-m-d H:i:s')
        ], NULL, 'A' . $row++);
      }

      // Output
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="karyawan.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
      exit;
    } catch (\Throwable $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal mengekspor data: ' . $e->getMessage()];
      redirect('/admin/karyawan');
    }
  }

  public static function import()
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      if (!isset($_FILES['excel_file']) || $_FILES['excel_file']['error'] !== UPLOAD_ERR_OK) {
        throw new Exception('File tidak valid.');
      }

      $filePath = $_FILES['excel_file']['tmp_name'];
      $ext = strtolower(pathinfo($_FILES['excel_file']['name'], PATHINFO_EXTENSION));
      if ($ext === 'csv') {
        $reader = IOFactory::createReader('Csv');
        $spreadsheet = $reader->load($filePath);
      } else {
        $spreadsheet = IOFactory::load($filePath);
      }
      $sheet = $spreadsheet->getActiveSheet();
      $rows = $sheet->toArray();

      $user = new User();
      $count = 0;
      foreach ($rows as $i => $row) {
        if ($i == 0) continue; // Skip header

        if (empty($row[1]) || empty($row[2])) continue;

        $role = !empty($row[3]) ? $row[3] : 'mandor';

        if ($user->findByPhone($row[2])) continue;

        $user->create([
          'username' => $row[1],
          'phone_number' => $row[2],
          'role' => $role,
        ]);
        $count++;
      }

      $_SESSION['alert'] = ['type' => 'success', 'message' => "$count karyawan berhasil diimpor."];
    } catch (\Throwable $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal mengimpor data: ' . $e->getMessage()];
    }
    redirect('/admin/karyawan');
  }
}
