<style>
  .card {
    width: 30rem;
    margin: auto;
    ;
  }
</style>

<section>
  <div class="card">
    <div class="card-body">
      <h3 class="card-title text-center">Login</h3>
      <hr>
      <?php include __DIR__ . '/../../components/alert.php'; ?>

      <form action="/login" method="POST">
        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

        <div class="mb-3">
          <label class="form-label">Username</label>
          <div class="input-group">
            <span class="input-group-text><i class=" bi bi-person-fill"></i></span>
            <input type="text" name="username" class="form-control" required placeholder="Masukkan username">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Nomor HP</label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
            <input type="text" name="phone_number" class="form-control" required pattern="\d+" placeholder="Masukkan nomor telepon">
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </div>
      </form>
    </div>
  </div>
</section>