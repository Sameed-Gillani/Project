<?php
require_once __DIR__ . '/../config/Database.php';

class Student {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll(): array {
        $sql = "SELECT students.*, departments.department_name 
                FROM students 
                JOIN departments ON students.department_id = departments.id 
                ORDER BY students.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function getRecent(int $limit = 5): array {
        $stmt = $this->db->prepare("
            SELECT students.*, departments.department_name 
            FROM students 
            JOIN departments ON students.department_id = departments.id 
            ORDER BY students.id DESC 
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create(string $name, string $email, int $deptId): bool {
        $stmt = $this->db->prepare("INSERT INTO students (name, email, department_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $deptId]);
    }

    public function update(int $id, string $name, string $email, int $deptId): bool {
        $stmt = $this->db->prepare("UPDATE students SET name = ?, email = ?, department_id = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $deptId, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM students WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM students")->fetchColumn();
    }
}
