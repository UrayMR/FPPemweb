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

function validate($data, $rules)
{
  $errors = [];

  foreach ($rules as $field => $rule) {
    if (!isset($data[$field]) || empty(trim($data[$field]))) {
      $errors[$field] = ucfirst($field) . ' is required.';
    } elseif ($rule === 'string' && !is_string($data[$field])) {
      $errors[$field] = ucfirst($field) . ' must be a string.';
    } elseif ($rule === 'numeric' && !is_numeric($data[$field])) {
      $errors[$field] = ucfirst($field) . ' must be a number.';
    }
  }

  if (!empty($errors)) {
    // Periksa apakah permintaan berasal dari API (misalnya, JSON)
    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
      header('Content-Type: application/json');
      echo json_encode([
        'status' => 'error',
        'message' => 'Validation failed.',
        'errors' => $errors
      ]);
      exit;
    }

    // Jika bukan API, gunakan sesi dan redirect
    $_SESSION['alert'] = [
      'type' => 'danger',
      'message' => 'Validation failed.',
      'errors' => $errors
    ];
    redirect($_SERVER['HTTP_REFERER']);
    exit;
  }
}
