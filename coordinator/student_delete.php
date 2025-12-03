<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$student_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$student_id) {
    header("Location: students_list.php");
    exit;
}

// Get student details
$stmt = $pdo->prepare("
    SELECT * FROM users 
    WHERE id = ? AND department_id = ? AND role = 'student'
");
$stmt->execute([$student_id, $dept_id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found or access denied.");
}

// Check if student has active records
$active_borrowings_stmt = $pdo->prepare("
    SELECT COUNT(*) as active_count FROM bookings 
    WHERE student_id = ? AND booking_status IN ('pending', 'collected')
");
$active_borrowings_stmt->execute([$student_id]);
$has_active_borrowings = $active_borrowings_stmt->fetch()['active_count'] > 0;

$active_topics_stmt = $pdo->prepare("
    SELECT COUNT(*) as topics_count FROM proposed_topics 
    WHERE student_id = ? AND status = 'pending'
");
$active_topics_stmt->execute([$student_id]);
$has_pending_topics = $active_topics_stmt->fetch()['topics_count'] > 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        try {
            // Start transaction
            $pdo->beginTransaction();
            
            // Delete student's bookings
            $delete_bookings_stmt = $pdo->prepare("DELETE FROM bookings WHERE student_id = ?");
            $delete_bookings_stmt->execute([$student_id]);
            
            // Delete student's topic proposals
            $delete_topics_stmt = $pdo->prepare("DELETE FROM proposed_topics WHERE student_id = ?");
            $delete_topics_stmt->execute([$student_id]);
            
            // Remove student from approved topics (set student_id to NULL or keep as is)
            // We'll keep approved topics but remove student association
            $update_approved_stmt = $pdo->prepare("UPDATE approved_topics SET student_id = NULL WHERE student_id = ?");
            $update_approved_stmt->execute([$student_id]);
            
            // Delete student
            $delete_student_stmt = $pdo->prepare("DELETE FROM users WHERE id = ? AND department_id = ?");
            $delete_student_stmt->execute([$student_id, $dept_id]);
            
            // Commit transaction
            $pdo->commit();
            
            header("Location: students_list.php?success=Student deleted successfully");
            exit;
            
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = "Failed to delete student: " . $e->getMessage();
        }
    } else {
        header("Location: students_list.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Student - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Delete Student</h1>
            <a href="students_list.php" class="btn btn-secondary">← Back to Students</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Student Deletion</h2>
            
            <div class="student-info">
                <h3>Student Information</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($student['full_name']) ?></p>
                <p><strong>Admission No:</strong> <?= htmlspecialchars($student['admission_no']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
                <p><strong>Department:</strong> <?= htmlspecialchars($_SESSION['department_name']) ?></p>
                <p><strong>Status:</strong> 
                    <span class="<?= $student['is_suspended'] ? 'status-suspended' : 'status-active' ?>">
                        <?= $student['is_suspended'] ? 'Suspended' : 'Active' ?>
                    </span>
                </p>
            </div>

            <?php if ($has_active_borrowings || $has_pending_topics): ?>
                <div class="alert alert-warning">
                    <h4>⚠ Active Records Found</h4>
                    <ul>
                        <?php if ($has_active_borrowings): ?>
                            <li>This student has active project borrowings</li>
                        <?php endif; ?>
                        <?php if ($has_pending_topics): ?>
                            <li>This student has pending topic proposals</li>
                        <?php endif; ?>
                    </ul>
                    <p><strong>All associated records will be deleted along with the student.</strong></p>
                </div>
            <?php endif; ?>
            
            <div class="alert alert-error">
                <strong>⚠ Critical Warning:</strong> This action cannot be undone. The student and all their associated records will be permanently deleted from the system.
            </div>
            
            <form method="POST">
                <div class="form-group">
                    <label for="confirm_text">Type "DELETE" to confirm:</label>
                    <input type="text" id="confirm_text" name="confirm_text" required 
                           placeholder="Type DELETE here" style="text-transform: uppercase;">
                </div>
                
                <div class="form-actions">
                    <button type="submit" name="confirm" value="1" class="btn btn-danger" 
                            onclick="return validateDelete()">Confirm Delete</button>
                    <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
    function validateDelete() {
        const confirmText = document.getElementById('confirm_text').value.toUpperCase();
        if (confirmText !== 'DELETE') {
            alert('Please type "DELETE" to confirm deletion.');
            return false;
        }
        return confirm('Are you absolutely sure you want to delete this student? This cannot be undone!');
    }
    </script>
</body>
</html>