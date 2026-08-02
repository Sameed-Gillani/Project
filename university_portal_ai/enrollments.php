<?php
require_once 'classes/Enrollment.php';
require_once 'classes/Student.php';
require_once 'classes/Course.php';

$enrollmentModel = new Enrollment();
$studentModel = new Student();
$courseModel = new Course();

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enroll_student'])) {
    $studentId = (int)$_POST['student_id'];
    $courseId = (int)$_POST['course_id'];

    if ($studentId > 0 && $courseId > 0) {
        try {
            $enrollmentModel->create($studentId, $courseId);
            $message = "Student enrolled in course successfully!";
        } catch (PDOException $e) {
            $error = ($e->getCode() == 23000) ? "This student is already enrolled in this course!" : "Error: " . $e->getMessage();
        }
    } else {
        $error = "Please select both student and course.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_enrollment'])) {
    try {
        $enrollmentModel->delete((int)$_POST['enrollment_id']);
        $message = "Enrollment record removed!";
    } catch (PDOException $e) {
        $error = "Failed to remove enrollment: " . $e->getMessage();
    }
}

$enrollments = $enrollmentModel->getAll();
$students = $studentModel->getAll();
$courses = $courseModel->getAll();

$pageTitle = "Enrollments - University Portal";
$activePage = "enrollments";
require_once 'includes/header.php';
?>

<h2 class="mb-4">Course Enrollments</h2>

<?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Enroll Student</h5></div>
            <div class="card-body">
                <form method="POST" action="enrollments.php">
                    <div class="mb-3">
                        <label class="form-label">Student</label>
                        <select name="student_id" class="form-select" required>
                            <option value="">Select Student</option>
                            <?php foreach ($students as $student): ?>
                                <option value="<?= $student['id'] ?>"><?= htmlspecialchars($student['name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <select name="course_id" class="form-select" required>
                            <option value="">Select Course</option>
                            <?php foreach ($courses as $course): ?>
                                <option value="<?= $course['id'] ?>"><?= htmlspecialchars($course['course_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="enroll_student" class="btn btn-primary w-100">Enroll Student</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Active Enrollments</h5></div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr><th>ID</th><th>Student</th><th>Course</th><th>Instructor</th><th>Enrolled Date</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php if (count($enrollments) > 0): ?>
                            <?php foreach ($enrollments as $enr): ?>
                                <tr>
                                    <td><?= $enr['id'] ?></td>
                                    <td><?= htmlspecialchars($enr['student_name']) ?></td>
                                    <td><?= htmlspecialchars($enr['course_name']) ?></td>
                                    <td><?= htmlspecialchars($enr['instructor']) ?></td>
                                    <td><?= $enr['enrolled_at'] ?></td>
                                    <td>
                                        <form method="POST" action="enrollments.php" style="display:inline;" onsubmit="return confirm('Remove enrollment?');">
                                            <input type="hidden" name="enrollment_id" value="<?= $enr['id'] ?>">
                                            <button type="submit" name="delete_enrollment" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="6" class="text-center">No enrollments recorded yet.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
