<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Admin Panel | CV Mentari Pagi Engineering</title>
  <link rel="icon" href="/images/mentari.png" type="image/png" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="/css/admin.css">

  <style>
    main {
      padding: 20px;
    }
  </style>
</head>

<body>
  <?php include __DIR__ . '/../components/navbar.php'; ?>

  <main>
    <?php include __DIR__ . '/../' . $view . '.php'; ?>
  </main>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>

</html>