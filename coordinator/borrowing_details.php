<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$borrowing_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$borrowing_id) {
    header("Location: borrowings_list.php");
    exit;
}

// Get borrowing details
$stmt = $pdo->prepare("
    SELECT b.*, p.title as project_title, p.student_name as project_student, 
           p.supervisor_name as project_supervisor, p.year_of_submission,
           u.full_name as student_name, u.admission_no, u.email as student_email,
           u.phone_number as student_phone
    FROM bookings b 
    JOIN projects p ON b.project_id = p.id 
    JOIN users u ON b.student_id = u.id 
    WHERE b.id = ? AND p.department_id = ?
");
$stmt->execute([$borrowing_id, $dept_id]);
$borrowing = $stmt->fetch();

if (!$borrowing) {
    die("Borrowing record not found or access denied.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Details - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Borrowing Details</h1>
            <div class="action-buttons">
                <a href="borrowings_list.php" class="btn btn-secondary">← Back to Borrowings</a>
                <?php if ($borrowing['booking_status'] == 'pending'): ?>
                    <a href="borrowing_collect.php?id=<?= $borrowing['id'] ?>" class="btn btn-success">Mark Collected</a>
                <?php elseif ($borrowing['booking_status'] == 'collected'): ?>
                    <a href="borrowing_return.php?id=<?= $borrowing['id'] ?>" class="btn btn-primary">Mark Returned</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="details-card">
            <h2>Project Information</h2>
            
            <div class="detail-group">
                <label>Project Title:</label>
                <span><?= htmlspecialchars($borrowing['project_title']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Original Student:</label>
                <span><?= htmlspecialchars($borrowing['project_student']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Supervisor:</label>
                <span><?= htmlspecialchars($borrowing['project_supervisor']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Year of Submission:</label>
                <span><?= htmlspecialchars($borrowing['year_of_submission']) ?></span>
            </div>
        </div>

        <div class="details-card">
            <h2>Student Information</h2>
            
            <div class="detail-group">
                <label>Student Name:</label>
                <span><?= htmlspecialchars($borrowing['student_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Admission Number:</label>
                <span><?= htmlspecialchars($borrowing['admission_no']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Email:</label>
                <span><?= htmlspecialchars($borrowing['student_email']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Phone:</label>
                <span><?= htmlspecialchars($borrowing['student_phone']) ?></span>
            </div>
        </div>

        <div class="details-card">
            <h2>Borrowing Information</h2>
            
            <div class="detail-group">
                <label>Booking Status:</label>
                <span class="status-<?= $borrowing['booking_status'] ?>">
                    <?= ucfirst($borrowing['booking_status']) ?>
                </span>
            </div>
            
            <div class="detail-group">
                <label>Booked At:</label>
                <span><?= date('F j, Y g:i A', strtotime($borrowing['booked_at'])) ?></span>
            </div>
            
            <?php if ($borrowing['booking_status'] == 'pending'): ?>
            <div class="detail-group">
                <label>Expires At:</label>
                <span class="<?= strtotime($borrowing['expires_at']) < time() ? 'text-danger' : '' ?>">
                    <?= date('F j, Y g:i A', strtotime($borrowing['expires_at'])) ?>
                    <?php if (strtotime($borrowing['expires_at']) < time()): ?>
                        (Expired)
                    <?php endif; ?>
                </span>
            </div>
            <?php elseif ($borrowing['booking_status'] == 'collected'): ?>
            <div class="detail-group">
                <label>Collected At:</label>
                <span><?= date('F j, Y g:i A', strtotime($borrowing['collected_at'])) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Due Date:</label>
                <span><?= date('F j, Y g:i A', strtotime($borrowing['due_date'])) ?></span>
            </div>
            <?php elseif ($borrowing['booking_status'] == 'returned'): ?>
            <div class="detail-group">
                <label>Returned At:</label>
                <span><?= date('F j, Y g:i A', strtotime($borrowing['returned_at'])) ?></span>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>