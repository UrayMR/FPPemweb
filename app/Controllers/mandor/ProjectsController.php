<?php

require_once __DIR__ . '/../../Models/Project.php';

class ProjectsController
{
  public static function index()
  {
    try {
      $userId = $_SESSION['user']['id'];
      $limit = 5;
      $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
      $offset = ($page - 1) * $limit;

      $project = new Project();
      $totalProjects = count($project->findByUserId($userId));
      $projectList = $project->allPaginatedUserId($userId, $limit, $offset);

      $totalPages = ceil($totalProjects / $limit);

      view('pages/mandor/projects/index', [
        'projectList' => $projectList,
        'currentPage' => $page,
        'totalPages' => $totalPages
      ]);
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => 'Terjadi kesalahan saat memuat data proyek.'];
      redirect('/mandor/dashboard');
    }
  }

  public static function store()
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $rules = [
        'project_name' => 'required|string',
        'customer_name' => 'string',
        'status' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'date',
      ];

      validate($_POST, $rules);

      $data = [
        'user_id' => $_SESSION['user']['id'],
        'project_name' => $_POST['project_name'],
        'customer_name' => $_POST['customer_name'],
        'status' => $_POST['status'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'description' => $_POST['description'],
      ];

      $project = new Project();
      $project->create($data);

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Proyek ' . $data['project_name'] . ' berhasil ditambahkan.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/mandor/projects');
  }

  public static function update($id)
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $rules = [
        'project_name' => 'required|string',
        'customer_name' => 'string',
        'status' => 'required|string',
        'start_date' => 'required|date',
        'end_date' => 'date',
      ];

      validate($_POST, $rules);

      $project = new Project();
      $existingProject = $project->find($id);

      if (!$existingProject || $existingProject['user_id'] !== $_SESSION['user']['id']) {
        throw new Exception('Proyek tidak ditemukan atau Anda tidak memiliki akses.');
      }

      $data = [
        'project_name' => $_POST['project_name'],
        'customer_name' => $_POST['customer_name'],
        'status' => $_POST['status'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'description' => $_POST['description'],
      ];

      $project->update($id, $data);

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Proyek' . $data['project_name'] . ' diperbarui.'];
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/mandor/projects');
  }

  public static function destroy($id)
  {
    try {
      verifyCsrfToken($_POST['csrf_token']);

      $project = new Project();
      $existingProject = $project->find($id);

      if (!$existingProject || $existingProject['user_id'] !== $_SESSION['user']['id']) {
        throw new Exception('Proyek tidak ditemukan atau Anda tidak memiliki akses.');
      }

      $_SESSION['alert'] = ['type' => 'success', 'message' => 'Proyek ' . $existingProject['project_name'] . ' dihapus.'];

      $project->delete($id);
    } catch (Exception $e) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $e->getMessage()];
    }

    redirect('/mandor/projects');
  }
}
