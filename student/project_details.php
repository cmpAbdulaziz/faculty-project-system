<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

$project_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];
$student_id = $_SESSION['user_id'];

if (!$project_id) {
    header("Location: project_library.php");
    exit;
}

// Get project details
$stmt = $pdo->prepare("SELECT * FROM projects WHERE id = ? AND department_id = ?");
$stmt->execute([$project_id, $dept_id]);
$project = $stmt->fetch();

if (!$project) {
    die("Project not found or access denied.");
}

// Check if student has already booked this project
$booking_stmt = $pdo->prepare("
    SELECT * FROM bookings 
    WHERE project_id = ? AND student_id = ? AND booking_status IN ('pending', 'collected')
");
$booking_stmt->execute([$project_id, $student_id]);
$existing_booking = $booking_stmt->fetch();

// Check if project is available for booking
$can_book = ($project['availability_status'] === 'available' && !$existing_booking);
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
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Project Details</h1>
            <div class="action-buttons">
                <a href="project_library.php" class="btn btn-secondary">← Back to Library</a>
                <?php if ($can_book): ?>
                    <a href="book_project.php?id=<?= $project['id'] ?>" class="btn btn-primary">Book This Project</a>
                <?php endif; ?>
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
                <span><?= date('F j, Y', strtotime($project['created_at'])) ?></span>
            </div>
        </div>

        <?php if ($existing_booking): ?>
        <div class="booking-info details-card">
            <h3>Your Booking Information</h3>
            <div class="detail-group">
                <label>Booking Status:</label>
                <span class="status-<?= $existing_booking['booking_status'] ?>">
                    <?= ucfirst($existing_booking['booking_status']) ?>
                </span>
            </div>
            <div class="detail-group">
                <label>Booked At:</label>
                <span><?= date('F j, Y g:i A', strtotime($existing_booking['booked_at'])) ?></span>
            </div>
            <?php if ($existing_booking['booking_status'] == 'pending'): ?>
            <div class="detail-group">
                <label>Expires At:</label>
                <span class="<?= strtotime($existing_booking['expires_at']) < time() ? 'text-danger' : '' ?>">
                    <?= date('F j, Y g:i A', strtotime($existing_booking['expires_at'])) ?>
                    <?php if (strtotime($existing_booking['expires_at']) < time()): ?>
                        (Expired)
                    <?php endif; ?>
                </span>
            </div>
            <div class="alert alert-info">
                <strong>Note:</strong> Please collect this project from the coordinator's office before the expiry time.
            </div>
            <?php elseif ($existing_booking['booking_status'] == 'collected'): ?>
            <div class="detail-group">
                <label>Collected At:</label>
                <span><?= date('F j, Y g:i A', strtotime($existing_booking['collected_at'])) ?></span>
            </div>
            <div class="detail-group">
                <label>Due Date:</label>
                <span><?= date('F j, Y g:i A', strtotime($existing_booking['due_date'])) ?></span>
            </div>
            <div class="alert alert-info">
                <strong>Note:</strong> Please return this project before the due date to avoid penalties.
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>