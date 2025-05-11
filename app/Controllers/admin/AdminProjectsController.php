<?php

require_once __DIR__ . '/../../Models/Project.php';
require_once __DIR__ . '/../../Models/ProjectDetail.php';

class AdminProjectsController
{
  public static function index()
  {
    try {
      $limit = 5;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($page - 1) * $limit;

      $project = new Project();
      $projectDetail = new ProjectDetail();

      $totalProjects = $project->total();
      $projectList = $project->allPaginated($limit, $offset);

      foreach ($projectList as &$projectItem) {
        $lastComment = $projectDetail->findByProject($projectItem['id']);
        $projectItem['last_comment'] = $lastComment ? $lastComment[0]['comment'] : '';
      }

      $totalPages = ceil($totalProjects / $limit);

      view('pages/admin/projects/index', [
        'projectList' => $projectList,
        'currentPage' => $page,
        'totalPages' => $totalPages
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

      // Perbarui komentar jika sudah ada, atau buat baru jika belum ada
      if ($projectDetail->findByProject($project_id)) {
        $projectDetail->updateComment($project_id, $admin_id, $comment);
      } else {
        $projectDetail->create([
          'project_id' => $project_id,
          'user_id' => $admin_id,
          'comment' => $comment,
        ]);
      }

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Komentar berhasil diperbarui.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/admin/projects');
  }
}
