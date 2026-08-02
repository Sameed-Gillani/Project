<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle ?? 'University Portal') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">University Portal</a>
        <div class="navbar-nav">
            <a class="nav-link <?= ($activePage == 'dashboard') ? 'active' : '' ?>" href="index.php">Dashboard</a>
            <a class="nav-link <?= ($activePage == 'students') ? 'active' : '' ?>" href="students.php">Students</a>
            <a class="nav-link <?= ($activePage == 'departments') ? 'active' : '' ?>" href="departments.php">Departments</a>
            <a class="nav-link <?= ($activePage == 'courses') ? 'active' : '' ?>" href="courses.php">Courses</a>
            <a class="nav-link <?= ($activePage == 'enrollments') ? 'active' : '' ?>" href="enrollments.php">Enrollments</a>
        </div>
    </div>
</nav>

<div class="container">
