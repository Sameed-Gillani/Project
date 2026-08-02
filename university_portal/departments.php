<?php
require_once 'db.php';
$message = '';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_department'])) 
   {$deptName = trim($_POST['department_name']);
    if (!empty($deptName)) 
        {try 
           {$stmt = $pdo->prepare("INSERT INTO departments (department_name) VALUES (?)");
            $stmt->execute([$deptName]);
            $message = "Department added successfully!";} 
            catch (PDOException $e) 
           {$error = ($e->getCode() == 23000) ? "Department already exists!" : "Database error: " . $e->getMessage();}} 
        else 
           {$error = "Department name cannot be empty.";}}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_department'])) 
    {$deptId = $_POST['department_id'];
    try 
       {$stmt = $pdo->prepare("DELETE FROM departments WHERE id = ?");
        $stmt->execute([$deptId]);
        $message = "Department deleted successfully!";} 
        catch (PDOException $e) 
       {$error = "Cannot delete department attached to existing students or courses.";}}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_department'])) 
   {$deptId = $_POST['department_id'];
    $deptName = trim($_POST['department_name']);
    if (!empty($deptName)) 
       {try 
           {$stmt = $pdo->prepare("UPDATE departments SET department_name = ? WHERE id = ?");
            $stmt->execute([$deptName, $deptId]);
            $message = "Department updated successfully!";} 
            catch (PDOException $e) 
           {$error = "Error updating department: " . $e->getMessage();}}}
$departments = $pdo->query("SELECT * FROM departments ORDER BY id DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Departments - University Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">University Portal</a>
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Dashboard</a>
            <a class="nav-link" href="students.php">Students</a>
            <a class="nav-link active" href="departments.php">Departments</a>
            <a class="nav-link" href="courses.php">Courses</a>
            <a class="nav-link" href="enrollments.php">Enrollments</a>
        </div>
    </div>
</nav>
<div class="container">
    <h2 class="mb-4">Department Management</h2>
    <?php if ($message): ?><div class="alert alert-success"><?= $message ?></div><?php endif; ?>
    <?php if ($error): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">Add Department</h5></div>
                <div class="card-body">
                    <form method="POST" action="departments.php">
                        <div class="mb-3">
                            <label class="form-label">Department Name</label>
                            <input type="text" name="department_name" class="form-control" placeholder="e.g. Cyber Security" required>
                        </div>
                        <button type="submit" name="add_department" class="btn btn-primary w-100">Add Department</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white"><h5 class="mb-0">All Departments</h5></div>
                <div class="card-body">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr><th>ID</th><th>Department Name</th><th>Actions</th></tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departments as $dept): ?>
                                <tr>
                                    <td><?= $dept['id'] ?></td>
                                    <td><?= htmlspecialchars($dept['department_name']) ?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $dept['id'] ?>">Edit</button>
                                        <form method="POST" action="departments.php" style="display:inline;" onsubmit="return confirm('Delete this department?');">
                                            <input type="hidden" name="department_id" value="<?= $dept['id'] ?>">
                                            <button type="submit" name="delete_department" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editModal<?= $dept['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form method="POST" action="departments.php">
                                                <div class="modal-header"><h5 class="modal-title">Edit Department #<?= $dept['id'] ?></h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body">
                                                    <input type="hidden" name="department_id" value="<?= $dept['id'] ?>">
                                                    <div class="mb-3">
                                                        <label class="form-label">Department Name</label>
                                                        <input type="text" name="department_name" class="form-control" value="<?= htmlspecialchars($dept['department_name']) ?>" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" name="update_department" class="btn btn-primary">Save Changes</button></div>
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
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>