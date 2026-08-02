<?php
require_once 'classes/Student.php';
require_once 'classes/Department.php';

$studentModel = new Student();
$deptModel = new Department();

$message = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_student'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $deptId = (int)$_POST['department_id'];

    if (!empty($name) && !empty($email) && $deptId > 0) {
        try {
            $studentModel->create($name, $email, $deptId);
            $message = "Student registered successfully!";
        } catch (PDOException $e) {
            $error = ($e->getCode() == 23000) ? "Email address already registered!" : "Error: " . $e->getMessage();
        }
    } else {
        $error = "All fields are required.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_student'])) {
    try {
        $studentModel->delete((int)$_POST['student_id']);
        $message = "Student deleted successfully!";
    } catch (PDOException $e) {
        $error = "Failed to delete student: " . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_student'])) {
    $studentId = (int)$_POST['student_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $deptId = (int)$_POST['department_id'];

    if (!empty($name) && !empty($email) && $deptId > 0) {
        try {
            $studentModel->update($studentId, $name, $email, $deptId);
            $message = "Student updated successfully!";
        } catch (PDOException $e) {
            $error = "Error updating student: " . $e->getMessage();
        }
    }
}

$students = $studentModel->getAll();
$departments = $deptModel->getAll();

$pageTitle = "Students - University Portal";
$activePage = "students";
require_once 'includes/header.php';
?>

<h2 class="mb-4">Student Management</h2>

<?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
<?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Register Student</h5></div>
            <div class="card-body">
                <form method="POST" action="students.php">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" required>
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
                    <button type="submit" name="add_student" class="btn btn-primary w-100">Register Student</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white"><h5 class="mb-0">Registered Students</h5></div>
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead>
                        <tr><th>ID</th><th>Name</th><th>Email</th><th>Department</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= $student['id'] ?></td>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['email']) ?></td>
                                <td><span class="badge bg-secondary"><?= htmlspecialchars($student['department_name']) ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $student['id'] ?>">Edit</button>
                                    <form method="POST" action="students.php" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                        <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                        <button type="submit" name="delete_student" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal<?= $student['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="students.php">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Student #<?= $student['id'] ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-3">
                                                <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                                                <div class="mb-3">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($student['email']) ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select name="department_id" class="form-select" required>
                                                        <?php foreach ($departments as $dept): ?>
                                                            <option value="<?= $dept['id'] ?>" <?= ($dept['id'] == $student['department_id']) ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($dept['department_name']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" name="update_student" class="btn btn-primary">Save Changes</button>
                                            </div>
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
