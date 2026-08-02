<?php
require_once __DIR__ . '/../config/Database.php';

class Enrollment {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll(): array {
        $sql = "SELECT enrollments.id, students.name AS student_name, courses.course_name, courses.instructor, enrollments.enrolled_at 
                FROM enrollments 
                JOIN students ON enrollments.student_id = students.id 
                JOIN courses ON enrollments.course_id = courses.id 
                ORDER BY enrollments.id DESC";
        return $this->db->query($sql)->fetchAll();
    }

    public function create(int $studentId, int $courseId): bool {
        $stmt = $this->db->prepare("INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)");
        return $stmt->execute([$studentId, $courseId]);
    }

    public function delete(int $id): bool {
        $stmt = $this->db->prepare("DELETE FROM enrollments WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getCount(): int {
        return (int)$this->db->query("SELECT COUNT(*) FROM enrollments")->fetchColumn();
    }
}
