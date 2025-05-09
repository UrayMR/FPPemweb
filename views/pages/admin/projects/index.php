<?php
$modalCreate = [
  'title' => 'Tambah Proyek',
  'actionUrl' => '/admin/projects/create',
  'fields' => [
    ['name' => 'user_id', 'type' => 'hidden', 'value' => $_SESSION['user']['id'] ?? ''], // User ID sebagai hidden field
    ['name' => 'project_name', 'label' => 'Nama Proyek', 'required' => true],
    ['name' => 'customer_name', 'label' => 'Nama Pelanggan'],
    [
      'name' => 'status',
      'label' => 'Status',
      'type' => 'select',
      'required' => true,
      'options' => [
        ['value' => 'install', 'label' => 'Install'],
        ['value' => 'non-install', 'label' => 'Non-Install'],
      ]
    ],
    ['name' => 'start_date', 'label' => 'Tanggal Mulai', 'type' => 'date', 'required' => true],
    ['name' => 'end_date', 'label' => 'Tanggal Selesai', 'type' => 'date'],
    ['name' => 'description', 'label' => 'Catatan', 'type' => 'textarea'],
  ]
];

function generateModalEdit($project)
{
  return [
    'title' => 'Edit Proyek',
    'actionUrl' => '/admin/projects/update/' . $project['id'],
    'fields' => [
      ['name' => 'user_id', 'type' => 'hidden', 'value' => $project['user_id']],
      ['name' => 'project_name', 'label' => 'Nama Proyek', 'required' => true],
      ['name' => 'customer_name', 'label' => 'Nama Pelanggan'],
      [
        'name' => 'status',
        'label' => 'Status',
        'type' => 'select',
        'required' => true,
        'options' => [
          ['value' => 'install', 'label' => 'Install'],
          ['value' => 'non-install', 'label' => 'Non-Install'],
        ]
      ],
      ['name' => 'start_date', 'label' => 'Tanggal Mulai', 'type' => 'date', 'required' => true],
      ['name' => 'end_date', 'label' => 'Tanggal Selesai', 'type' => 'date'],
      ['name' => 'description', 'label' => 'Catatan', 'type' => 'textarea'],
    ],
    'data' => $project
  ];
}
?>

<div class="container">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <p class="h4 mb-3">List Proyek</p>

    <button
      class="btn btn-primary"
      data-bs-toggle="modal"
      data-bs-target="#formModal"
      onclick="openDynamicFormModal(<?= htmlspecialchars(json_encode($modalCreate), ENT_QUOTES, 'UTF-8') ?>)">
      + Tambah Proyek
    </button>
  </div>

  <?php include __DIR__ . "/../../../components/alert.php" ?>

  <table class="table table-bordered mt-2">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama Proyek</th>
        <th>Nama Pelanggan</th>
        <th>Status</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($projectList)): ?>
        <tr>
          <td colspan="7" class="text-center">Belum ada data proyek</td>
        </tr>
      <?php else: ?>
        <?php foreach ($projectList as $index => $project): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($project['project_name']) ?></td>
            <td><?= htmlspecialchars($project['customer_name']) ?></td>
            <td><?= htmlspecialchars($project['status']) ?></td>
            <td><?= htmlspecialchars($project['start_date']) ?></td>
            <td><?= htmlspecialchars($project['end_date']) ?></td>
            <td>
              <a href="#"
                class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#formModal"
                onclick="openDynamicFormModal(<?= htmlspecialchars(json_encode(generateModalEdit($project)), ENT_QUOTES, 'UTF-8') ?>)">Edit</a>
              <a
                href="#"
                class="btn btn-sm btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                data-action-url="/admin/projects/delete/<?= $project['id'] ?>"
                data-custom-message="Yakin ingin menghapus proyek <?= htmlspecialchars($project['project_name'], ENT_QUOTES, 'UTF-8') ?>?">
                Hapus
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= $i === $currentPage ? 'active' : '' ?>">
          <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>

<?php include __DIR__ . "/../../../components/modalForm.php" ?>
<?php include __DIR__ . "/../../../components/modalDelete.php" ?>