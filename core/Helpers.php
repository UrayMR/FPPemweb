<?php

function view($view, $data = [])
{
  extract($data);
  require_once __DIR__ . '/../views/layouts/app.php';
}

function redirect($url)
{
  header("Location: $url");
  exit;
}
