<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $student_name = trim($_POST['student_name']);
    $supervisor_name = trim($_POST['supervisor_name']);
    $year = $_POST['year_of_submission'];
    $dept_id = $_SESSION['department_id'];
    
    // Basic validation
    if (empty($title) || empty($student_name) || empty($supervisor_name) || empty($year)) {
        $error = "All fields are required!";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO projects (title, student_name, supervisor_name, year_of_submission, department_id) VALUES (?, ?, ?, ?, ?)");
            if ($stmt->execute([$title, $student_name, $supervisor_name, $year, $dept_id])) {
                $success = "Project added successfully!";
                // Clear form
                $_POST = array();
            } else {
                $error = "Failed to add project. Please try again.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Project - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Add New Project</h1>
            <a href="projects_list.php" class="btn btn-secondary">← Back to List</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="form-card">
            <div class="form-group">
                <label for="title">Project Title *</label>
                <input type="text" id="title" name="title" required 
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="student_name">Student Name *</label>
                <input type="text" id="student_name" name="student_name" required
                       value="<?= htmlspecialchars($_POST['student_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="supervisor_name">Supervisor Name *</label>
                <input type="text" id="supervisor_name" name="supervisor_name" required
                       value="<?= htmlspecialchars($_POST['supervisor_name'] ?? '') ?>">
            </div>
            
            <div class="form-group">
                <label for="year_of_submission">Year of Submission *</label>
                <input type="number" id="year_of_submission" name="year_of_submission" 
                       min="2000" max="<?= date('Y') ?>" value="<?= $_POST['year_of_submission'] ?? date('Y') ?>" required>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Project</button>
                <a href="projects_list.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>