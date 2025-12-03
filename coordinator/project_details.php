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

// Get current booking for this project
$booking_stmt = $pdo->prepare("
    SELECT b.*, u.full_name, u.admission_no 
    FROM bookings b 
    JOIN users u ON b.student_id = u.id 
    WHERE b.project_id = ? AND b.booking_status IN ('pending', 'collected')
    ORDER BY b.booked_at DESC LIMIT 1
");
$booking_stmt->execute([$project_id]);
$current_booking = $booking_stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Project Details</h1>
            <div class="action-buttons">
                <a href="projects_list.php" class="btn btn-secondary">← Back to List</a>
                <a href="project_edit.php?id=<?= $project['id'] ?>" class="btn btn-primary">Edit Project</a>
            </div>
        </div>

        <div class="details-card">
            <h2><?= htmlspecialchars($project['title']) ?></h2>
            
            <div class="detail-group">
                <label>Project Title:</label>
                <span><?= htmlspecialchars($project['title']) ?></span>
            </div>
            <div class="detail-group">
                <label>Student Name:</label>
                <span><?= htmlspecialchars($project['student_name']) ?></span>
            </div>
            <div class="detail-group">
                <label>Supervisor:</label>
                <span><?= htmlspecialchars($project['supervisor_name']) ?></span>
            </div>
            <div class="detail-group">
                <label>Year of Submission:</label>
                <span><?= htmlspecialchars($project['year_of_submission']) ?></span>
            </div>
            <div class="detail-group">
                <label>Availability Status:</label>
                <span class="status-<?= $project['availability_status'] ?>">
                    <?= ucfirst($project['availability_status']) ?>
                </span>
            </div>
            <div class="detail-group">
                <label>Date Added:</label>
                <span><?= date('F j, Y g:i A', strtotime($project['created_at'])) ?></span>
            </div>
        </div>

        <?php if ($current_booking): ?>
        <div class="booking-info details-card">
            <h3>Current Booking Information</h3>
            <div class="detail-group">
                <label>Booked By:</label>
                <span><?= htmlspecialchars($current_booking['full_name']) ?> (<?= $current_booking['admission_no'] ?>)</span>
            </div>
            <div class="detail-group">
                <label>Booking Status:</label>
                <span class="status-<?= $current_booking['booking_status'] ?>">
                    <?= ucfirst($current_booking['booking_status']) ?>
                </span>
            </div>
            <div class="detail-group">
                <label>Booked At:</label>
                <span><?= date('F j, Y g:i A', strtotime($current_booking['booked_at'])) ?></span>
            </div>
            <?php if ($current_booking['booking_status'] == 'pending'): ?>
            <div class="detail-group">
                <label>Expires At:</label>
                <span class="<?= strtotime($current_booking['expires_at']) < time() ? 'text-danger' : '' ?>">
                    <?= date('F j, Y g:i A', strtotime($current_booking['expires_at'])) ?>
                    <?php if (strtotime($current_booking['expires_at']) < time()): ?>
                        (Expired)
                    <?php endif; ?>
                </span>
            </div>
            <?php elseif ($current_booking['booking_status'] == 'collected'): ?>
            <div class="detail-group">
                <label>Collected At:</label>
                <span><?= date('F j, Y g:i A', strtotime($current_booking['collected_at'])) ?></span>
            </div>
            <div class="detail-group">
                <label>Due Date:</label>
                <span><?= date('F j, Y g:i A', strtotime($current_booking['due_date'])) ?></span>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>