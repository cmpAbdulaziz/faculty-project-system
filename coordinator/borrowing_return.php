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

if ($borrowing['booking_status'] !== 'collected') {
    header("Location: borrowings_list.php?error=This project is not currently borrowed");
    exit;
}

// Process return
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start transaction
        $pdo->beginTransaction();
        
        // Update booking status
        $booking_stmt = $pdo->prepare("
            UPDATE bookings 
            SET booking_status = 'returned', returned_at = NOW()
            WHERE id = ?
        ");
        $booking_stmt->execute([$borrowing_id]);
        
        // Update project status
        $project_stmt = $pdo->prepare("
            UPDATE projects SET availability_status = 'available' WHERE id = ?
        ");
        $project_stmt->execute([$borrowing['project_id']]);
        
        // Commit transaction
        $pdo->commit();
        
        header("Location: borrowings_list.php?success=Project marked as returned successfully!");
        exit;
        
    } catch (Exception $e) {
        $pdo->rollBack();
        $error = "Failed to mark project as returned: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Project Returned - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Mark Project Returned</h1>
            <a href="borrowings_list.php" class="btn btn-secondary">← Back to Borrowings</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Return</h2>
            
            <div class="project-info">
                <h3>Project Details</h3>
                <p><strong>Project Title:</strong> <?= htmlspecialchars($borrowing['project_title']) ?></p>
                <p><strong>Student:</strong> <?= htmlspecialchars($borrowing['student_name']) ?></p>
                <p><strong>Collected At:</strong> <?= date('F j, Y g:i A', strtotime($borrowing['collected_at'])) ?></p>
                <p><strong>Due Date:</strong> <?= date('F j, Y g:i A', strtotime($borrowing['due_date'])) ?></p>
            </div>
            
            <form method="POST">
                <div class="form-group">
                    <label for="condition">Project Condition:</label>
                    <select id="condition" name="condition" required>
                        <option value="good">Good - No damage</option>
                        <option value="minor">Minor wear - Acceptable</option>
                        <option value="damaged">Damaged - Needs attention</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="notes">Return Notes (Optional):</label>
                    <textarea id="notes" name="notes" rows="3" placeholder="Any notes about the return condition..."></textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Confirm Return</button>
                    <a href="borrowing_details.php?id=<?= $borrowing['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>