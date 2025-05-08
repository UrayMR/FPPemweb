<div class="container">
  <p class="h4 mb-3">List Karyawan</p>

  <a href="/admin/karyawan/create" class="btn btn-primary mb-3">+ Tambah Karyawan</a>

  <table class="table table-bordered">
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
        <?php foreach ($karyawanList as $index => $karyawan): ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= htmlspecialchars($karyawan['username']) ?></td>
            <td><?= htmlspecialchars($karyawan['phone_number']) ?></td>
            <td><?= htmlspecialchars($karyawan['role']) ?></td>
            <td>
              <a href="/admin/karyawan/edit/<?= $karyawan['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
              <a href="/admin/karyawan/delete/<?= $karyawan['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
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