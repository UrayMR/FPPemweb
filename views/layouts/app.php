<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>App</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body class="container mt-4">
  <div class="mb-3 d-flex justify-content-between">
    <div>Logged in as: <?= $_SESSION['user']['role'] ?? 'Guest' ?></div>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="/logout" class="btn btn-sm btn-danger">Logout</a>
    <?php endif; ?>
  </div>

  <?php include __DIR__ . '/../components/alert.php'; ?>

  <main>
    <?php include __DIR__ . '/../' . $view . '.php'; ?>
  </main>
</body>

</html>