<?php

require_once __DIR__ . '/../../Models/Project.php';
require_once __DIR__ . '/../../Models/ProjectDetail.php';
require_once __DIR__ . '/../../Models/ProjectNotification.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AdminProjectsController
{
  public static function index()
  {
    try {
      $limit = 5;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($page - 1) * $limit;

      // Ambil filter dari query string
      $filters = [
        'search' => $_GET['search'] ?? '',
        'status' => $_GET['status'] ?? '',
      ];

      $project = new Project();
      $projectDetail = new ProjectDetail();
      $projectNotification = new ProjectNotification();

      // Kirim filters ke model untuk total proyek
      $totalProjects = $project->total($filters);

      // Kirim filters ke model untuk mengambil proyek terpaginasikan
      $projectList = $project->allPaginated($limit, $offset, $filters);

      foreach ($projectList as &$projectItem) {
        $lastComment = $projectDetail->findByProject($projectItem['id']);
        $projectItem['last_comment'] = $lastComment ? $lastComment[0]['comment'] : '';

        // Tambahkan status sudah dibaca
        $notif = $projectNotification->findByProjectAndUser($projectItem['id'], $projectItem['user_id']);
        $projectItem['notif_is_read'] = $notif ? (bool)$notif['is_read'] : false;
      }

      $totalPages = ceil($totalProjects / $limit);

      view('pages/admin/projects/index', [
        'projectList' => $projectList,
        'currentPage' => $page,
        'totalPages' => $totalPages,
        'search' => $filters['search'],
        'status' => $filters['status'],
        'offset' => $offset,
      ]);
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan saat memuat data proyek.'];
      redirect('/admin/dashboard');
    }
  }
  public static function comment($project_id)
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $rules = [
        'comment' => 'required|string',
      ];

      validate($_POST, $rules);

      $comment = trim($_POST['comment']);
      $admin_id = $_SESSION['user']['id'];

      if ($comment === '') {
        throw new Exception('Komentar tidak boleh kosong.');
      }

      $projectDetail = new ProjectDetail();
      $projectNotification = new ProjectNotification();

      // Cek apakah komentar sebelumnya sudah ada
      if ($projectDetail->findByProject($project_id)) {
        $projectDetail->updateComment($project_id, $admin_id, $comment);
      } else {
        $projectDetail->create([
          'project_id' => $project_id,
          'user_id' => $admin_id,
          'comment' => $comment,
        ]);
      }

      // Cari user mandor pemilik proyek
      $projectModel = new Project();
      $project = $projectModel->find($project_id);

      if ($project) {
        $mandor_id = $project['user_id'];

        // Cek jika sudah ada notifikasi sebelumnya
        $existingNotif = $projectNotification->findByProjectAndUser($project_id, $mandor_id);
        if ($existingNotif) {
          // Update is_read = 0 supaya dianggap notif baru
          $projectNotification->updateUnread($existingNotif['id']);
        } else {
          // Buat notifikasi baru
          $projectNotification->create([
            'user_id' => $mandor_id,
            'project_id' => $project_id,
          ]);
        }
      }

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Komentar ' . $project['project_name'] . ' berhasil diperbarui.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/admin/projects');
  }

  public static function export()
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);
      $project = new Project();
      $projectList = $project->all();

      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();

      // Set header
      $sheet->fromArray([
        'ID',
        'Nama Proyek',
        'Nama Pelanggan',
        'Status',
        'Tanggal Mulai',
        'Tanggal Selesai',
        'Created At'
      ], NULL, 'A1');

      // Set data
      $row = 2;
      foreach ($projectList as $item) {
        $sheet->fromArray([
          $item['id'],
          $item['project_name'],
          $item['customer_name'],
          $item['status'],
          $item['start_date'],
          $item['end_date'],
          !empty($item['created_at']) ? $item['created_at'] : date('Y-m-d H:i:s')
        ], NULL, 'A' . $row++);
      }

      // Output
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="projects.xlsx"');
      header('Cache-Control: max-age=0');

      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');
      exit;
    } catch (\Throwable $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal mengekspor data: ' . $e->getMessage()];
      redirect('/admin/projects');
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

      $project = new Project();
      $count = 0;
      foreach ($rows as $i => $row) {
        if ($i == 0) continue; // Skip header
        if (empty($row[1]) || empty($row[2]) || empty($row[3])) continue;
        // Cek duplikasi berdasarkan nama proyek dan pelanggan
        if ($project->findByNameAndCustomer($row[1], $row[2])) continue;
        $project->create([
          'project_name' => $row[1],
          'customer_name' => $row[2],
          'status' => $row[3],
          'start_date' => !empty($row[4]) ? $row[4] : null,
          'end_date' => !empty($row[5]) ? $row[5] : null,
        ]);
        $count++;
      }
      $_SESSION['alert'] = ['type' => 'success', 'message' => "$count proyek berhasil diimpor."];
    } catch (\Throwable $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Gagal mengimpor data: ' . $e->getMessage()];
    }
    redirect('/admin/projects');
  }
}
