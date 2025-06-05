<?php

require_once __DIR__ . '/../Models/Project.php';
require_once __DIR__ . '/../Models/User.php';

class AdminController
{
  public static function dashboard()
  {
    $userRole = $_SESSION['user']['role'] ?? null;
    $projectModel = new Project();
    $userModel = new User();

    $totalProjects = $projectModel->total();

    $totalActiveWorkers = $userModel->total(['role' => 'mandor']);

    // Chart proyek per bulan/tahun
    $chartData = $projectModel->chartByMonthYear();
    $labels = array_map(function ($row) {
      // Format: 2024-06 => Jun 2024
      return date('M Y', strtotime($row['month'] . '-01'));
    }, $chartData);

    $data = array_column($chartData, 'total');

    // Chart: Persentase Proyek per Mandor (Pie Chart)
    $mandorData = $projectModel->projectPercentageByMandor();
    $totalMandorProjects = array_sum(array_column($mandorData, 'total'));
    $customerLabels = [];
    $customerPercentages = [];
    if ($totalMandorProjects > 0) {
      foreach ($mandorData as $row) {
        $customerLabels[] = $row['username'];
        $customerPercentages[] = round(($row['total'] / $totalMandorProjects) * 100, 2);
      }
    }

    view('pages/admin/dashboard', compact('labels', 'data', 'customerLabels', 'customerPercentages', 'totalProjects', 'totalActiveWorkers'));
  }
}
