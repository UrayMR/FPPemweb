<div class="modal fade" id="viewProjectModal<?= $project['id'] ?>" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="/admin/projects/comment/<?= $project['id'] ?>" class="comment-form">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Detail Proyek: <?= htmlspecialchars($project['project_name']) ?></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Customer:</strong> <?= htmlspecialchars($project['customer_name']) ?></p>
          <p><strong>Status:</strong> <?= ucfirst(htmlspecialchars($project['status'])) ?></p>
          <p><strong>Waktu:</strong> <?= $project['start_date'] ?> s/d <?= $project['end_date'] ?></p>
          <p><strong>Deskripsi:</strong> <?= nl2br(htmlspecialchars($project['description'])) ?></p>

          <hr>
          <label for="comment">Komentar dari Admin:</label>
          <textarea id="comment" name="comment" class="form-control comment-field" rows="3" <?= !empty($project['last_comment']) ? 'disabled' : '' ?> required><?= htmlspecialchars($project['last_comment']) ?></textarea>
          <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

          <?php if (!empty($project['last_comment']) && isset($project['notif_is_read']) && $project['notif_is_read']): ?>
            <div class="alert alert-success py-2 px-3 mt-3 mb-1 alert-isread">
              Komentar ini sudah dibaca oleh Mandor.
            </div>
          <?php endif; ?>

        </div>
        <div class="modal-footer">
          <?php if (!empty($project['last_comment'])): ?>
            <button type="button" class="btn btn-warning edit-btn">Edit</button>
          <?php endif; ?>
          <button type="submit" class="btn btn-primary save-btn" style="<?= empty($project['last_comment']) ? 'display: inline-block;' : 'display: none;' ?>">Konfirmasi</button>
          <button type="button" class="btn btn-secondary cancel-btn" style="display: none;">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.addEventListener('click', function(event) {
    const modal = event.target.closest('.modal');
    if (!modal) return; // Tambahkan pengecekan ini

    const commentField = modal.querySelector('.comment-field');
    const closeButton = modal.querySelector('.btn-close');
    const saveButton = modal.querySelector('.save-btn');
    const cancelButton = modal.querySelector('.cancel-btn');
    const editButton = modal.querySelector('.edit-btn');
    const alertIsRead = modal.querySelector('.alert-isread');

    if (event.target.classList.contains('edit-btn')) {
      commentField.disabled = false;
      commentField.focus();

      editButton.style.display = 'none';
      closeButton.style.display = 'none';
      alertIsRead.style.display = 'none';

      cancelButton.style.display = 'inline-block';
      saveButton.style.display = 'inline-block';
    }

    if (event.target.classList.contains('cancel-btn')) {
      commentField.disabled = true;
      commentField.value = commentField.defaultValue;

      editButton.style.display = 'inline-block';
      closeButton.style.display = 'inline-block';
      alertIsRead.style.display = 'block';

      cancelButton.style.display = 'none';
      saveButton.style.display = 'none';
    }
  });
</script>