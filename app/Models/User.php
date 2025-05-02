<?php

require_once __DIR__ . '/../../core/Connection.php';

class User
{
  protected static function db()
  {
    return Connection::getInstance();
  }

  public static function findByEmail($email)
  {
    $stmt = self::db()->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function findByCredentials($username, $phone)
  {
    $stmt = self::db()->prepare("SELECT * FROM users WHERE username = ? AND phone_number = ?");
    $stmt->execute([$username, $phone]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
