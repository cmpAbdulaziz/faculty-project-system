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
    SELECT b.*, p.title as project_title, u.full_name as student_name
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

if ($borrowing['booking_status'] !== 'pending') {
    header("Location: borrowings_list.php?error=This booking is not pending collection");
    exit;
}

// Process collection
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Calculate due date (1 week from now)
        $due_date = date('Y-m-d H:i:s', strtotime('+1 week'));
        
        // Start transaction
        $pdo->beginTransaction();
        
        // Update booking status
        $booking_stmt = $pdo->prepare("
            UPDATE bookings 
            SET booking_status = 'collected', collected_at = NOW(), due_date = ?
            WHERE id = ?
        ");
        $booking_stmt->execute([$due_date, $borrowing_id]);
        
        // Update project status
        $project_stmt = $pdo->prepare("
            UPDATE projects SET availability_status = 'borrowed' WHERE id = ?
        ");
        $project_stmt->execute([$borrowing['project_id']]);
        
        // Commit transaction
        $pdo->commit();
        
        header("Location: borrowings_list.php?success=Project marked as collected successfully!");
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Failed to mark project as collected: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Project Collected - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Mark Project Collected</h1>
            <a href="borrowings_list.php" class="btn btn-secondary">← Back to Borrowings</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Collection</h2>
            
            <div class="project-info">
                <h3>Project Details</h3>
                <p><strong>Project Title:</strong> <?= htmlspecialchars($borrowing['project_title']) ?></p>
                <p><strong>Student:</strong> <?= htmlspecialchars($borrowing['student_name']) ?></p>
                <p><strong>Booked At:</strong> <?= date('F j, Y g:i A', strtotime($borrowing['booked_at'])) ?></p>
            </div>
            
            <div class="collection-terms">
                <h3>Collection Information</h3>
                <ul>
                    <li>Student must present valid ID</li>
                    <li>Project will be marked as borrowed for 1 week</li>
                    <li>Student is responsible for the project's safety</li>
                    <li>Late returns may result in penalties</li>
                </ul>
            </div>
            
            <form method="POST">
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Confirm Collection</button>
                    <a href="borrowing_details.php?id=<?= $borrowing['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>