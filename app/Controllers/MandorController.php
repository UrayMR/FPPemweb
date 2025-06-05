<?php
require_once __DIR__ . '/../Models/Project.php';

class MandorController
{
  public static function dashboard()
  {
    $userId = $_SESSION['user']['id'] ?? null;
    $projectModel = new Project();

    // Total proyek dan proyek selesai
    $totalProjects = $projectModel->totalByUser($userId);
    $totalFinishedProjects = $projectModel->totalFinishedByUser($userId);

    // Chart proyek berdasarkan tanggal (pakai model)
    $chartData = $projectModel->chartByDateForMandor($userId);
    $labels = [];
    $data = [];
    foreach ($chartData as $row) {
      $labels[] = date('d M', strtotime($row['date']));
      $data[] = (int)$row['total'];
    }

    // Chart pelanggan (pakai model)
    $customerData = $projectModel->customerPercentageForMandor($userId);
    $totalCustomerProjects = array_sum(array_column($customerData, 'total'));
    $customerLabels = [];
    $customerPercentages = [];
    foreach ($customerData as $row) {
      $customerLabels[] = $row['customer_name'];
      $customerPercentages[] = $totalCustomerProjects > 0 ? round(($row['total'] / $totalCustomerProjects) * 100, 2) : 0;
    }

    view('pages/mandor/dashboard', compact('labels', 'data', 'customerLabels', 'customerPercentages', 'totalProjects', 'totalFinishedProjects'));
  }
}
