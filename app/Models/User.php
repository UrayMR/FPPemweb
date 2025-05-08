<?php

require_once __DIR__ . '/../../core/Connection.php';

class User
{
  private $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }

  public function findByCredentials($username, $phone_number)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ? AND phone_number = ?");
    $stmt->execute([$username, $phone_number]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function total()
  {
    $stmt = $this->db->query("SELECT COUNT(*) FROM users");
    return (int)$stmt->fetchColumn();
  }

  public function allPaginated($limit, $offset)
  {
    $limit = (int)$limit;
    $offset = (int)$offset;

    $query = "SELECT * FROM users ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function find($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findByPhone($phone)
  {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE phone_number = ?");
    $stmt->execute([$phone]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function create($data)
  {
    $stmt = $this->db->prepare("INSERT INTO users (username, phone_number, role) VALUES (?, ?, ?)");
    return $stmt->execute([
      $data['username'],
      $data['phone_number'],
      $data['role']
    ]);
  }

  public function update($id, $data)
  {
    $stmt = $this->db->prepare("UPDATE users SET username = ?, phone_number = ?, role = ?, updated_at = NOW() WHERE id = ?");
    return $stmt->execute([
      $data['username'],
      $data['phone_number'],
      $data['role'],
      $id
    ]);
  }

  public function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
    return $stmt->execute([$id]);
  }
}
