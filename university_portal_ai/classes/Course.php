<?php
require_once __DIR__ . '/../config/Database.php';

class Course {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll(): array {
        $sql = "SELECT courses.*, departments.department_name 
                FROM courses 
                JOIN departments ON courses.department_id = departments.id 
                ORDER BY courses.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function create(string $name, string $instructor, int $deptId): bool {
        $stmt = $this->db->prepare("INSERT INTO courses (course_name, instructor, department_id) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $instructor, $deptId]);
    }

    public function update(int $id, string $name, string $instructor, int $deptId): bool {
        $stmt = $this->db->prepare("UPDATE courses SET course_name = ?, instructor = ?, department_id = ? WHERE id = ?");
        return $stmt->execute([$name, $instructor, $deptId, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM courses WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM courses")->fetchColumn();
    }
}
