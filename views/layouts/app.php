<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login | CV Mentari Pagi Engineering</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.12.1/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="/css/login.css">

  <style>
    body {
      height: 100dvh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      gap: 1rem;
      ;
    }
  </style>
</head>

<body>
  <main>
    <?php include __DIR__ . '/../' . $view . '.php'; ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
  <button class="toggle-dark-mode" onclick="toggleDarkMode()">
  <i class="bi bi-moon-fill"></i>
</button>

<script>
  function toggleDarkMode() {
    const html = document.documentElement;
    html.classList.toggle("dark");

    const icon = document.querySelector(".toggle-dark-mode i");
    icon.classList.toggle("bi-moon-fill");
    icon.classList.toggle("bi-sun-fill");
  }
</script>

</body>

</html>