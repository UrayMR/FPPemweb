<?php

require_once __DIR__ . '/../../Models/Project.php';

class AdminProjectsController
{
  public static function index()
  {
    $limit = 5;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $project = new Project();
    $totalProjects = $project->total();
    $projectList = $project->allPaginated($limit, $offset);

    $totalPages = ceil($totalProjects / $limit);

    view('pages/admin/projects/index', [
      'projectList' => $projectList,
      'currentPage' => $page,
      'totalPages' => $totalPages
    ]);
  }

  public static function store()
  {
    verifyCsrfToken($_POST['csrf_token']);

    $rules = [
      'user_id' => 'required|numeric',
      'project_name' => 'required|string',
      'customer_name' => 'string',
      'status' => 'required|string',
      'start_date' => 'required|date',
      'end_date' => 'date',
    ];

    validate($_POST, $rules);

    $data = [
      'user_id' => $_POST['user_id'],
      'project_name' => $_POST['project_name'],
      'customer_name' => $_POST['customer_name'],
      'status' => $_POST['status'],
      'start_date' => $_POST['start_date'],
      'end_date' => $_POST['end_date'],
      'description' => $_POST['description'],
    ];

    $project = new Project();
    $project->create($data);

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Proyek ' . $data['project_name'] . ' berhasil ditambahkan.'
    ];

    redirect('/admin/projects');
  }

  public static function update($id)
  {
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

    if (!$existingProject) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Proyek tidak ditemukan.'
      ];
      redirect('/admin/projects');
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

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Proyek ' . $existingProject['project_name'] . ' berhasil diperbarui.'
    ];

    redirect('/admin/projects');
  }

  public static function destroy($id)
  {
    verifyCsrfToken($_POST['csrf_token']);

    $project = new Project();
    $existingProject = $project->find($id);

    if (!$existingProject) {
      $_SESSION['alert'] = [
        'type' => 'danger',
        'message' => 'Proyek tidak ditemukan.'
      ];
      redirect('/admin/projects');
    }

    $project->delete($id);

    $_SESSION['alert'] = [
      'type' => 'success',
      'message' => 'Proyek ' . $existingProject['project_name'] . ' berhasil dihapus.'
    ];

    redirect('/admin/projects');
  }
}
