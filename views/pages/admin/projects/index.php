<div class="container p-4 bg-light rounded shadow-sm text-dark">
  <div class="d-flex justify-content-between align-items-center">
    <p class="h4 mb-3">List Proyek</p>
  </div>

  <div class="row align-items-center mb-3 gx-2 gy-2">
    <div class="col-auto">
      <form method="GET" class="row gx-2 gy-2 align-items-center">
        <div class="col-auto">
          <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari Proyek atau Pelanggan"
            value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        </div>
        <div class="col-auto">
          <select name="status" class="form-select">
            <option value="">Semua Status</option>
            <option value="install" <?= (($_GET['status'] ?? '') === 'install') ? 'selected' : '' ?>>Install</option>
            <option value="non-install" <?= (($_GET['status'] ?? '') === 'non-install') ? 'selected' : '' ?>>Non-install</option>
          </select>
        </div>
        <div class="col-auto">
          <button type="submit" class="btn btn-outline-primary">Filter</button>
        </div>
        <?php if (!empty($_GET['search']) || !empty($_GET['status'])): ?>
          <div class="col-auto">
            <a href="/admin/projects" class="btn btn-outline-secondary">Reset</a>
          </div>
        <?php endif; ?>
      </form>
    </div>
    <div class="col-auto ms-auto d-flex gap-3">
      <form method="POST" action="/admin/projects/export" class="d-inline">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
        <button type="submit" class="btn btn-success">Ekspor Excel</button>
      </form>
      <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#importProjectModal">Impor Excel</button>
    </div>
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
            <td><?= $offset + $index + 1 ?></td>
            <td><?= htmlspecialchars($project['project_name']) ?></td>
            <td class="<?= empty($project['customer_name']) ? 'text-muted' : '' ?>">
              <?= !empty($project['customer_name']) ? htmlspecialchars($project['customer_name']) : 'Belum Diisi' ?>
            </td>
            <td>
              <span class="badge <?= $project['status'] === 'install' ? 'bg-success' : 'bg-secondary' ?>">
                <?= ucfirst(htmlspecialchars($project['status'])) ?>
              </span>
            </td>
            <td class="<?= empty($project['start_date']) ? 'text-muted' : '' ?>">
              <?= !empty($project['start_date']) ? htmlspecialchars($project['start_date']) : 'Belum Diisi' ?>
            </td>
            <td class="<?= empty($project['end_date']) ? 'text-muted' : '' ?>">
              <?= !empty($project['end_date']) ? htmlspecialchars($project['end_date']) : 'Belum Diisi' ?>
            </td>
            <td>
              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewProjectModal<?= $project['id'] ?>">Lihat</button>
            </td>
          </tr>
          <?php include __DIR__ . "/../../../components/modalProjectAdminForm.php" ?>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php include __DIR__ . "/../../../components/pagination.php" ?>
</div>

<!-- Modal Impor -->
<div class="modal fade" id="importProjectModal" tabindex="-1" aria-labelledby="importProjectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form method="POST" action="/admin/projects/import" enctype="multipart/form-data" class="modal-content">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(generateCsrfToken()) ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="importProjectModalLabel">Impor Proyek dari Excel/CSV</h5>
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

<?php include __DIR__ . "/../../../components/modalDelete.php" ?>