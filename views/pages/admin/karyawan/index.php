<?php
$modalCreate = [
  'title' => 'Tambah Karyawan',
  'actionUrl' => '/admin/karyawan/create',
  'fields' => [
    ['name' => 'username', 'label' => 'Username', 'required' => true],
    ['name' => 'phone_number', 'label' => 'Nomor Telepon', 'required' => true],
    [
      'name' => 'role',
      'label' => 'Role',
      'type' => 'select',
      'required' => true,
      'options' => [
        ['value' => 'mandor', 'label' => 'Mandor'],
        ['value' => 'admin', 'label' => 'Admin'],
      ]
    ]
  ]
];

function generateModalEdit($karyawan)
{
  return [
    'title' => 'Edit Karyawan',
    'actionUrl' => '/admin/karyawan/update/' . $karyawan['id'],
    'fields' => [
      ['name' => 'username', 'label' => 'Username',  'required' => true],
      ['name' => 'phone_number', 'label' => 'Nomor Telepon',  'required' => true],
      [
        'name' => 'role',
        'label' => 'Role',
        'type' => 'select',
        'required' => true,
        'options' => [
          ['value' => 'mandor', 'label' => 'Mandor'],
          ['value' => 'admin', 'label' => 'Admin'],
        ]
      ]
    ],
    'data' => $karyawan
  ];
}
?>

<div class="p-4 container bg-light rounded-3 shadow-sm text-dark">
  <div class="d-flex justify-content-between align-items-center">
    <p class="h4 mb-3">List Karyawan</p>
  </div>

  <div class="row align-items-center mb-3 gx-2 gy-2">
    <div class="col-auto">
      <form method="GET" class="row gx-2 gy-2 align-items-center">
        <div class="col-auto">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari Karyawan"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </div>
        <div class="col-auto">
          <select name="role" class="form-select">
            <option value="">Semua Role</option>
            <option value="admin" <?= (($_GET['role'] ?? '') === 'admin') ? 'selected' : '' ?>>Admin</option>
            <option value="mandor" <?= (($_GET['role'] ?? '') === 'mandor') ? 'selected' : '' ?>>Mandor</option>
          </select>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-outline-primary">Filter</button>
        </div>
        <?php if (!empty($_GET['search']) || !empty($_GET['role'])): ?>
          <div class="col-auto">
            <a href="/admin/karyawan" class="btn btn-outline-secondary">Reset</a>
          </div>
        <?php endif; ?>
      </form>
    </div>

    <div class="col-auto ms-auto d-flex gap-3">
      <form method="POST" action="/admin/karyawan/export" class="d-inline">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
        <button type="submit" class="btn btn-success">Ekspor Excel</button>
      </form>
      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#importKaryawanModal">Impor Excel</button>
      <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#formModal"
        onclick="openDynamicFormModal(<?= htmlspecialchars(json_encode($modalCreate), ENT_QUOTES, 'UTF-8') ?>)">
        + Tambah User
      </button>
    </div>
  </div>

  <?php include __DIR__ . "/../../../components/alert.php" ?>

  <table class="table table-bordered mt-2">
    <thead>
      <tr>
        <th>#</th>
        <th>Nama</th>
        <th>Nomor Telepon</th>
        <th>Role</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($karyawanList)): ?>
        <tr>
          <td colspan="5" class="text-center">Belum ada data karyawan</td>
        </tr>
      <?php else: ?>
        <?php foreach (
          $karyawanList as $index =>
          $karyawan
        ): ?>
          <tr>
            <td><?= $offset + $index + 1 ?></td>
            <td><?= htmlspecialchars($karyawan['username']) ?></td>
            <td><?= htmlspecialchars($karyawan['phone_number']) ?></td>
            <td><?= ucfirst(htmlspecialchars($karyawan['role'])) ?></td>
            <td>
              <a href="#"
                class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#formModal"
                onclick="openDynamicFormModal(<?= htmlspecialchars(json_encode(generateModalEdit($karyawan)), ENT_QUOTES, 'UTF-8') ?>)">Edit</a>
              <a
                href="#"
                class="btn btn-sm btn-danger"
                data-bs-toggle="modal"
                data-bs-target="#deleteModal"
                data-action-url="/admin/karyawan/delete/<?= $karyawan['id'] ?>"
                data-custom-message="Yakin ingin menghapus karyawan <?= htmlspecialchars($karyawan['username'], ENT_QUOTES, 'UTF-8') ?>?">
                Hapus
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php include __DIR__ . "/../../../components/pagination.php" ?>
</div>

<?php include __DIR__ . "/../../../components/modalForm.php" ?>
<?php include __DIR__ . "/../../../components/modalDelete.php" ?>

<!-- Modal Impor -->
<div class="modal fade" id="importKaryawanModal" tabindex="-1" aria-labelledby="importKaryawanModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="/admin/karyawan/import" enctype="multipart/form-data" class="modal-content">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="importKaryawanModalLabel">Impor Karyawan dari Excel/CSV</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="file" name="excel_file" accept=".xls,.xlsx,.csv" class="form-control" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Impor</button>
      </div>
    </form>
  </div>
</div>