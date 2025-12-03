<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$project_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$project_id) {
    header("Location: projects_list.php");
    exit;
}

// Get project details
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND department_id = ?");
$stmt->execute([$project_id, $dept_id]);
$project = $stmt->fetch();

if (!$project) {
    die("Project not found or access denied.");
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $student_name = trim($_POST['student_name']);
    $supervisor_name = trim($_POST['supervisor_name']);
    $year = $_POST['year_of_submission'];
    $status = $_POST['availability_status'];
    
    // Basic validation
    if (empty($title) || empty($student_name) || empty($supervisor_name) || empty($year)) {
        $error = "All fields are required!";
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE projects SET title = ?, student_name = ?, supervisor_name = ?, year_of_submission = ?, availability_status = ? WHERE id = ? AND department_id = ?");
            if ($stmt->execute([$title, $student_name, $supervisor_name, $year, $status, $project_id, $dept_id])) {
                $success = "Project updated successfully!";
                // Refresh project data
                $stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND department_id = ?");
                $stmt->execute([$project_id, $dept_id]);
                $project = $stmt->fetch();
            } else {
                $error = "Failed to update project. Please try again.";
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
    <title>Edit Project - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Edit Project</h1>
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
                       value="<?= htmlspecialchars($project['title']) ?>">
            </div>
            
            <div class="form-group">
                <label for="student_name">Student Name *</label>
                <input type="text" id="student_name" name="student_name" required
                       value="<?= htmlspecialchars($project['student_name']) ?>">
            </div>
            
            <div class="form-group">
                <label for="supervisor_name">Supervisor Name *</label>
                <input type="text" id="supervisor_name" name="supervisor_name" required
                       value="<?= htmlspecialchars($project['supervisor_name']) ?>">
            </div>
            
            <div class="form-group">
                <label for="year_of_submission">Year of Submission *</label>
                <input type="number" id="year_of_submission" name="year_of_submission" 
                       min="2000" max="<?= date('Y') ?>" value="<?= $project['year_of_submission'] ?>" required>
            </div>
            
            <div class="form-group">
                <label for="availability_status">Availability Status *</label>
                <select id="availability_status" name="availability_status" required>
                    <option value="available" <?= $project['availability_status'] == 'available' ? 'selected' : '' ?>>Available</option>
                    <option value="borrowed" <?= $project['availability_status'] == 'borrowed' ? 'selected' : '' ?>>Borrowed</option>
                    <option value="booked" <?= $project['availability_status'] == 'booked' ? 'selected' : '' ?>>Booked</option>
                </select>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Project</button>
                <a href="project_details.php?id=<?= $project['id'] ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>