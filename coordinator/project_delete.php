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

// Get project details for confirmation
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND department_id = ?");
$stmt->execute([$project_id, $dept_id]);
$project = $stmt->fetch();

if (!$project) {
    die("Project not found or access denied.");
}

// Check if project has active bookings
$booking_stmt = $pdo->prepare("SELECT COUNT(*) as active_bookings FROM bookings WHERE project_id = ? AND booking_status IN ('pending', 'collected')");
$booking_stmt->execute([$project_id]);
$has_active_bookings = $booking_stmt->fetch()['active_bookings'] > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ? AND department_id = ?");
            if ($stmt->execute([$project_id, $dept_id])) {
                header("Location: projects_list.php?success=Project deleted successfully");
                exit;
            } else {
                $error = "Failed to delete project.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        header("Location: projects_list.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Project - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Delete Project</h1>
            <a href="projects_list.php" class="btn btn-secondary">← Back to List</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Deletion</h2>
            
            <?php if ($has_active_bookings): ?>
                <div class="alert alert-error">
                    <strong>Cannot Delete:</strong> This project has active bookings. Please wait until all bookings are completed or expired.
                </div>
                <div class="form-actions">
                    <a href="projects_list.php" class="btn btn-primary">Back to Projects</a>
                </div>
            <?php else: ?>
                <div class="project-info">
                    <p><strong>Project Title:</strong> <?= htmlspecialchars($project['title']) ?></p>
                    <p><strong>Student:</strong> <?= htmlspecialchars($project['student_name']) ?></p>
                    <p><strong>Supervisor:</strong> <?= htmlspecialchars($project['supervisor_name']) ?></p>
                    <p><strong>Year:</strong> <?= htmlspecialchars($project['year_of_submission']) ?></p>
                </div>
                
                <div class="alert alert-error">
                    <strong>Warning:</strong> This action cannot be undone. The project will be permanently deleted.
                </div>
                
                <form method="POST">
                    <div class="form-actions">
                        <button type="submit" name="confirm" value="1" class="btn btn-danger">Confirm Delete</button>
                        <a href="projects_list.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>