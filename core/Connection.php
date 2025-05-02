<?php

class Connection
{
  private static $instance = null;
  private $pdo;

  private function __construct()
  {
    $host = 'localhost';
    $dbname = 'crud_native';
    $user = 'root';
    $pass = '';

    try {
      $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Koneksi gagal: " . $e->getMessage());
    }
  }

  public static function getInstance()
  {
    if (!self::$instance) {
      self::$instance = new Connection();
    }

    return self::$instance->pdo;
  }
}
