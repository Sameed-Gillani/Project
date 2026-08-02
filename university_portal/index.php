<?php
require_once 'db.php';

$deptCount = $pdo->query("SELECT COUNT(*) FROM departments")->fetchColumn();
$courseCount = $pdo->query("SELECT COUNT(*) FROM courses")->fetchColumn();
$studentCount = $pdo->query("SELECT COUNT(*) FROM students")->fetchColumn();

$stmt = $pdo->query("
    SELECT students.id, students.name, students.email, students.created_at, departments.department_name 
    FROM students 
    JOIN departments ON students.department_id = departments.id 
    ORDER BY students.created_at DESC 
    LIMIT 5
");
$recentStudents = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>University Management Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">University Portal</a>
        <div class="navbar-nav">
            <a class="nav-link active" href="index.php">Dashboard</a>
            <a class="nav-link" href="students.php">Students</a>
            <a class="nav-link" href="departments.php">Departments</a>
            <a class="nav-link" href="courses.php">Courses</a>
            <a class="nav-link" href="enrollments.php">Enrollments</a>
        </div>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4">Dashboard Overview</h2>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary p-3">
                <h5>Departments</h5>
                <h3><?= $deptCount ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success p-3">
                <h5>Courses</h5>
                <h3><?= $courseCount ?></h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info p-3">
                <h5>Registered Students</h5>
                <h3><?= $studentCount ?></h3>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">Recent Registered Students (Last 5)</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Registered At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($recentStudents) > 0): ?>
                        <?php foreach ($recentStudents as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['id']) ?></td>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($student['department_name']) ?></span></td>
                                <td><?= htmlspecialchars($student['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="text-center">No students found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>