<div class="container">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <p class="h4 mb-3">List Proyek</p>
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
            <td> <span class="badge <?= $project['status'] === 'install' ? 'bg-success' : 'bg-secondary' ?>">
                <?= ucfirst(htmlspecialchars($project['status'])) ?>
              </span></td>
            <td><?= htmlspecialchars($project['start_date']) ?></td>
            <td><?= htmlspecialchars($project['end_date']) ?></td>
            <td>
              <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewProjectModal<?= $project['id'] ?>">Lihat</button>
            </td>
          </tr>
          <?php include __DIR__ . "/../../../components/modalProjectAdminForm.php" ?>

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

<?php include __DIR__ . "/../../../components/modalDelete.php" ?>