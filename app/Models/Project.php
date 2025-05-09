<?php

class Project
{
  private $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }

  /**
   * -----------------------
   * FIND METHODS
   * -----------------------
   */

  public function find($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function findByUserId($user_id)
  {
    $stmt = $this->db->prepare("SELECT * FROM projects WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * -----------------------
   * PAGINATION METHODS
   * -----------------------
   */

  public function total()
  {
    $stmt = $this->db->query("SELECT COUNT(*) FROM projects");
    return (int)$stmt->fetchColumn();
  }

  public function allPaginated($limit, $offset)
  {
    $limit = (int)$limit;
    $offset = (int)$offset;

    $query = "SELECT * FROM projects ORDER BY created_at DESC LIMIT $limit OFFSET $offset";
    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * -----------------------
   * CREATE, UPDATE, DELETE
   * -----------------------
   */

  public function create($data)
  {
    $stmt = $this->db->prepare("INSERT INTO projects (user_id, project_name, customer_name, status, start_date, end_date, description, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
    return $stmt->execute([
      $data['user_id'],
      $data['project_name'],
      $data['customer_name'],
      $data['status'],
      $data['start_date'],
      $data['end_date'],
      $data['description']
    ]);
  }

  public function update($id, $data)
  {
    $stmt = $this->db->prepare("UPDATE projects SET project_name = ?, customer_name = ?, status = ?, start_date = ?, end_date = ?, description = ?, updated_at = NOW() WHERE id = ?");
    return $stmt->execute([
      $data['project_name'],
      $data['customer_name'],
      $data['status'],
      $data['start_date'],
      $data['end_date'],
      $data['description'],
      $id
    ]);
  }

  public function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM projects WHERE id = ?");
    return $stmt->execute([$id]);
  }
}
