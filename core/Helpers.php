<?php

function view($view, $data = [])
{
  extract($data);

  $role = $_SESSION['user']['role'] ?? 'guest';

  // Tentukan layout berdasarkan role
  switch ($role) {
    case 'admin':
      $layout = 'layouts/admin.php';
      break;
    case 'mandor':
      $layout = 'layouts/mandor.php';
      break;
    default:
      $layout = 'layouts/app.php'; // untuk guest atau default
      break;
  }

  include __DIR__ . '/../views/' . $layout;
}

function redirect($url)
{
  header("Location: $url");
  exit;
}


