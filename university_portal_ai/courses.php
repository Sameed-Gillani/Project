<?php
require_once 'classes/Course.php';
require_once 'classes/Department.php';

$courseModel = new Course();
$deptModel = new Department();

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_course'])) {
    $courseName = trim($_POST['course_name']);
    $instructor = trim($_POST['instructor']);
    $deptId = (int)$_POST['department_id'];

    if (!empty($courseName) && !empty($instructor) && $deptId > 0) {
        try {
            $courseModel->create($courseName, $instructor, $deptId);
            $message = "Course added successfully!";
        } catch (PDOException $e) {
            $error = ($e->getCode() == 23000) ? "Course already exists in this department!" : "Error: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_course'])) {
    try {
        $courseModel->delete((int)$_POST['course_id']);
        $message = "Course deleted successfully!";
    } catch (PDOException $e) {
        $error = "Failed to delete course: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_course'])) {
    $courseId = (int)$_POST['course_id'];
    $courseName = trim($_POST['course_name']);
    $instructor = trim($_POST['instructor']);
    $deptId = (int)$_POST['department_id'];

    if (!empty($courseName) && !empty($instructor) && $deptId > 0) {
        try {
            $courseModel->update($courseId, $courseName, $instructor, $deptId);
            $message = "Course updated successfully!";
        } catch (PDOException $e) {
            $error = "Error updating course: " . $e->getMessage();
        }
    }
}

$courses = $courseModel->getAll();
$departments = $deptModel->getAll();

$pageTitle = "Courses - University Portal";
$activePage = "courses";
require_once 'includes/header.php';
?>

<h2 class="mb-4">Course Management</h2>

<?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Add Course</h5></div>
            <div class="card-body">
                <form method="POST" action="courses.php">
                    <div class="mb-3">
                        <label class="form-label">Course Title</label>
                        <input type="text" name="course_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Instructor</label>
                        <input type="text" name="instructor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department</label>
                        <select name="department_id" class="form-select" required>
                            <option value="">Select Department</option>
                            <?php foreach ($departments as $dept): ?>
                                <option value="<?= $dept['id'] ?>"><?= htmlspecialchars($dept['department_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="add_course" class="btn btn-primary w-100">Add Course</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">All Courses</h5></div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr><th>ID</th><th>Course Title</th><th>Instructor</th><th>Department</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($courses as $course): ?>
                            <tr>
                                <td><?= $course['id'] ?></td>
                                <td><?= htmlspecialchars($course['course_name']) ?></td>
                                <td><?= htmlspecialchars($course['instructor']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($course['department_name']) ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $course['id'] ?>">Edit</button>
                                    <form method="POST" action="courses.php" style="display:inline;" onsubmit="return confirm('Delete this course?');">
                                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                        <button type="submit" name="delete_course" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal<?= $course['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="courses.php">
                                            <div class="modal-header"><h5 class="modal-title">Edit Course #<?= $course['id'] ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                            <div class="modal-body">
                                                <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Course Title</label>
                                                    <input type="text" name="course_name" class="form-control" value="<?= htmlspecialchars($course['course_name']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Instructor</label>
                                                    <input type="text" name="instructor" class="form-control" value="<?= htmlspecialchars($course['instructor']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select name="department_id" class="form-select" required>
                                                        <?php foreach ($departments as $dept): ?>
                                                            <option value="<?= $dept['id'] ?>" <?= ($dept['id'] == $course['department_id']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($dept['department_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer"><button type="submit" name="update_course" class="btn btn-primary">Save Changes</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
