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

  public function total($filters = [])
  {
    $sql = "SELECT COUNT(*) FROM projects";
    $conditions = [];
    $params = [];

    // Cek filter search untuk project_name atau customer_name
    if (!empty($filters['search'])) {
      $conditions[] = "(project_name LIKE :search OR customer_name LIKE :search)";
      $params[':search'] = '%' . $filters['search'] . '%';
    }

    // Cek status jika ada
    if (!empty($filters['status'])) {
      $conditions[] = "status = :status";
      $params[':status'] = $filters['status'];
    }

    if (!empty($conditions)) {
      $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);
    return (int) $stmt->fetchColumn();
  }

  public function all()
  {
    $stmt = $this->db->query("SELECT * FROM projects ORDER BY id ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function findByNameAndCustomer($project_name, $customer_name)
  {
    $stmt = $this->db->prepare("SELECT * FROM projects WHERE project_name = ? AND customer_name = ?");
    $stmt->execute([$project_name, $customer_name]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function allPaginated($limit, $offset, $filters = [])
  {
    $sql = "SELECT * FROM projects";
    $conditions = [];
    $params = [];

    // Cek filter search untuk project_name atau customer_name
    if (!empty($filters['search'])) {
      $conditions[] = "(project_name LIKE :search OR customer_name LIKE :search)";
      $params[':search'] = '%' . $filters['search'] . '%';
    }

    // Cek status jika ada
    if (!empty($filters['status'])) {
      $conditions[] = "status = :status";
      $params[':status'] = $filters['status'];
    }

    if (!empty($conditions)) {
      $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    // Binding parameters
    foreach ($params as $key => $value) {
      $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function allPaginatedUserId($userId, $limit, $offset, $filters = [])
  {
    $sql = "SELECT * FROM projects WHERE user_id = :user_id";
    $params = [':user_id' => $userId];

    if (!empty($filters['search'])) {
      $sql .= " AND project_name LIKE :search";
      $params[':search'] = "%" . $filters['search'] . "%";
    }

    if (!empty($filters['status'])) {
      $sql .= " AND status = :status";
      $params[':status'] = $filters['status'];
    }

    if (isset($filters['commented'])) {
      if ($filters['commented'] === '1') {
        // Projek yang memiliki komentar yang belum dibaca (is_read = 0)
        $sql .= " AND EXISTS (
                        SELECT 1 FROM project_notifications pn 
                        WHERE pn.project_id = projects.id 
                        AND pn.user_id = :user_id 
                        AND pn.is_read = 0
                    )";
      } elseif ($filters['commented'] === '0') {
        // Projek yang tidak memiliki komentar yang belum dibaca
        $sql .= " AND NOT EXISTS (
                        SELECT 1 FROM project_notifications pn 
                        WHERE pn.project_id = projects.id 
                        AND pn.user_id = :user_id 
                        AND pn.is_read = 0
                    )";
      }
    }

    // Pastikan nilai integer untuk limit dan offset
    $limit = (int) $limit;
    $offset = (int) $offset;

    // Tambahkan limit dan offset langsung
    $sql .= " ORDER BY created_at DESC LIMIT $limit OFFSET $offset";

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function countByUserIdWithFilters($userId, $filters)
  {
    $sql = "SELECT COUNT(*) as total FROM projects p WHERE p.user_id = :user_id";
    $params = [':user_id' => $userId];

    if (!empty($filters['search'])) {
      $sql .= " AND (p.project_name LIKE :search OR p.description LIKE :search)";
      $params[':search'] = "%" . $filters['search'] . "%";
    }

    if (!empty($filters['status'])) {
      $sql .= " AND p.status = :status";
      $params[':status'] = $filters['status'];
    }

    if (isset($filters['commented'])) {
      if ($filters['commented'] === '1') {
        // Menghitung proyek dengan komentar yang belum dibaca (is_read = 0)
        $sql .= " AND EXISTS (
                        SELECT 1 FROM project_notifications pn 
                        WHERE pn.project_id = p.id 
                        AND pn.user_id = :user_id 
                        AND pn.is_read = 0
                    )";
      } elseif ($filters['commented'] === '0') {
        // Menghitung proyek yang tidak memiliki komentar yang belum dibaca
        $sql .= " AND NOT EXISTS (
                        SELECT 1 FROM project_notifications pn 
                        WHERE pn.project_id = p.id 
                        AND pn.user_id = :user_id 
                        AND pn.is_read = 0
                    )";
      }
    }

    $stmt = $this->db->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetch()['total'] ?? 0;
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

  public function chartByMonthYear($userId = null)
  {
    if ($userId) {
      $stmt = $this->db->prepare("
        SELECT DATE_FORMAT(start_date, '%Y-%m') AS month, COUNT(*) AS total
        FROM projects
        WHERE start_date IS NOT NULL AND user_id = :user_id
        GROUP BY month
        ORDER BY month
      ");
      $stmt->execute(['user_id' => $userId]);
    } else {
      $stmt = $this->db->prepare("
        SELECT DATE_FORMAT(start_date, '%Y-%m') AS month, COUNT(*) AS total
        FROM projects
        WHERE start_date IS NOT NULL
        GROUP BY month
        ORDER BY month
      ");
      $stmt->execute();
    }
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function projectPercentageByMandor()
  {
    $stmt = $this->db->prepare("
      SELECT u.username, COUNT(*) AS total
      FROM projects p
      JOIN users u ON p.user_id = u.id
      WHERE p.user_id IS NOT NULL
      GROUP BY u.username
      ORDER BY total DESC
    ");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Chart proyek per tanggal mulai untuk mandor tertentu
  public function chartByDateForMandor($userId)
  {
    $stmt = $this->db->prepare("
      SELECT DATE(start_date) AS date, COUNT(*) AS total
      FROM projects
      WHERE start_date IS NOT NULL AND user_id = :user_id
      GROUP BY DATE(start_date)
      ORDER BY DATE(start_date)
    ");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Persentase proyek per pelanggan untuk mandor tertentu
  public function customerPercentageForMandor($userId)
  {
    $stmt = $this->db->prepare("
      SELECT customer_name, COUNT(*) AS total
      FROM projects
      WHERE customer_name IS NOT NULL AND customer_name != '' AND user_id = :user_id
      GROUP BY customer_name
      ORDER BY total DESC
    ");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Total semua proyek yang diinisiasi oleh user (mandor)
  public function totalByUser($userId)
  {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM projects WHERE user_id = :user_id");
    $stmt->execute(['user_id' => $userId]);
    return (int)$stmt->fetchColumn();
  }

  // Total proyek selesai (end_date < hari ini) milik user (mandor)
  public function totalFinishedByUser($userId)
  {
    $stmt = $this->db->prepare("SELECT COUNT(*) FROM projects WHERE user_id = :user_id AND end_date IS NOT NULL AND end_date < :today");
    $stmt->execute([
      'user_id' => $userId,
      'today' => date('Y-m-d')
    ]);
    return (int)$stmt->fetchColumn();
  }
}
