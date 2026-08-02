<?php
require_once 'classes/Department.php';
require_once 'classes/Student.php';
require_once 'classes/Course.php';
require_once 'classes/Enrollment.php';

$deptModel = new Department();
$studentModel = new Student();
$courseModel = new Course();
$enrollmentModel = new Enrollment();

$deptCount = $deptModel->getCount();
$studentCount = $studentModel->getCount();
$courseCount = $courseModel->getCount();
$enrollmentCount = $enrollmentModel->getCount();

$recentStudents = $studentModel->getRecent(5);

$pageTitle = "Dashboard - University Portal";
$activePage = "dashboard";
require_once 'includes/header.php';
?>

<h2 class="mb-4">University Overview Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body">
                <h5>Total Departments</h5>
                <h2 class="fw-bold mb-0"><?= $deptCount ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white shadow-sm">
            <div class="card-body">
                <h5>Total Students</h5>
                <h2 class="fw-bold mb-0"><?= $studentCount ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-dark shadow-sm">
            <div class="card-body">
                <h5>Total Courses</h5>
                <h2 class="fw-bold mb-0"><?= $courseCount ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white shadow-sm">
            <div class="card-body">
                <h5>Active Enrollments</h5>
                <h2 class="fw-bold mb-0"><?= $enrollmentCount ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white"><h5 class="mb-0">Recent Registered Students (LIMIT 5)</h5></div>
    <div class="card-body">
        <table class="table table-striped align-middle">
            <thead>
                <tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th></tr>
            </thead>
            <tbody>
                <?php foreach ($recentStudents as $student): ?>
                    <tr>
                        <td><?= $student['id'] ?></td>
                        <td><?= htmlspecialchars($student['name']) ?></td>
                        <td><?= htmlspecialchars($student['email']) ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($student['department_name']) ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
