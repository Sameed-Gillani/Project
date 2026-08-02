<?php
require_once __DIR__ . '/../config/Database.php';

class Department {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll(): array {
        return $this->db->query("SELECT * FROM departments ORDER BY id DESC")->fetchAll();
    }

    public function create(string $name): bool {
        $stmt = $this->db->prepare("INSERT INTO departments (department_name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function update(int $id, string $name): bool {
        $stmt = $this->db->prepare("UPDATE departments SET department_name = ? WHERE id = ?");
        return $stmt->execute([$name, $id]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM departments WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM departments")->fetchColumn();
    }
}
