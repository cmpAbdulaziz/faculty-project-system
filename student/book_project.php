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

// Check if project is available
if ($project['availability_status'] !== 'available') {
    header("Location: project_library.php?error=This project is not available for booking");
    exit;
}

// Check if student has already booked this project
$booking_stmt = $pdo->prepare("
    SELECT * FROM bookings 
    WHERE project_id = ? AND student_id = ? AND booking_status IN ('pending', 'collected')
");
$booking_stmt->execute([$project_id, $student_id]);
$existing_booking = $booking_stmt->fetch();

if ($existing_booking) {
    header("Location: project_library.php?error=You have already booked this project");
    exit;
}

// Check if student has reached booking limit (e.g., max 3 pending bookings)
$pending_count_stmt = $pdo->prepare("
    SELECT COUNT(*) as pending_count FROM bookings 
    WHERE student_id = ? AND booking_status = 'pending'
");
$pending_count_stmt->execute([$student_id]);
$pending_count = $pending_count_stmt->fetch()['pending_count'];

if ($pending_count >= 3) {
    header("Location: project_library.php?error=You have reached the maximum number of pending bookings (3). Please collect or cancel existing bookings.");
    exit;
}

// Process booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Calculate expiry time (2 hours from now)
        $expires_at = date('Y-m-d H:i:s', strtotime('+2 hours'));
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Create booking
        $booking_stmt = $pdo->prepare("
            INSERT INTO bookings (project_id, student_id, expires_at) 
            VALUES (?, ?, ?)
        ");
        $booking_stmt->execute([$project_id, $student_id, $expires_at]);
        
        // Update project status
        $project_stmt = $pdo->prepare("
            UPDATE projects SET availability_status = 'booked' WHERE id = ?
        ");
        $project_stmt->execute([$project_id]);
        
        // Commit transaction
        $pdo->commit();
        
        header("Location: project_library.php?success=Project booked successfully! Please collect it within 2 hours.");
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Failed to book project: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Project - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Book Project</h1>
            <a href="project_library.php" class="btn btn-secondary">← Back to Library</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Booking</h2>
            
            <div class="project-info">
                <h3>Project Details</h3>
                <p><strong>Title:</strong> <?= htmlspecialchars($project['title']) ?></p>
                <p><strong>Student:</strong> <?= htmlspecialchars($project['student_name']) ?></p>
                <p><strong>Supervisor:</strong> <?= htmlspecialchars($project['supervisor_name']) ?></p>
                <p><strong>Year:</strong> <?= htmlspecialchars($project['year_of_submission']) ?></p>
            </div>
            
            <div class="booking-terms">
                <h3>Booking Terms</h3>
                <ul>
                    <li>You must collect the project within <strong>2 hours</strong> of booking</li>
                    <li>The booking will expire automatically if not collected</li>
                    <li>You can have maximum <strong>3 pending bookings</strong> at a time</li>
                    <li>You are responsible for the project while borrowed</li>
                </ul>
            </div>
            
            <form method="POST">
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Confirm Booking</button>
                    <a href="project_details.php?id=<?= $project['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>