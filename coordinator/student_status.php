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

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    try {
        $new_status = ($action === 'suspend') ? 1 : 0;
        $status_text = ($action === 'suspend') ? 'suspended' : 'activated';
        
        $stmt = $pdo->prepare("UPDATE users SET is_suspended = ? WHERE id = ? AND department_id = ?");
        $stmt->execute([$new_status, $student_id, $dept_id]);
        
        if ($stmt->rowCount() > 0) {
            header("Location: student_details.php?id=$student_id&success=Student $status_text successfully!");
            exit;
        } else {
            $error = "Failed to update student status.";
        }
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}

$action = $student['is_suspended'] ? 'activate' : 'suspend';
$action_text = $student['is_suspended'] ? 'Activate' : 'Suspend';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $action_text ?> Student - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1><?= $action_text ?> Student</h1>
            <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-secondary">← Back to Details</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm <?= $action_text ?></h2>
            
            <div class="student-info">
                <h3>Student Information</h3>
                <p><strong>Name:</strong> <?= htmlspecialchars($student['full_name']) ?></p>
                <p><strong>Admission No:</strong> <?= htmlspecialchars($student['admission_no']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
                <p><strong>Current Status:</strong> 
                    <span class="<?= $student['is_suspended'] ? 'status-suspended' : 'status-active' ?>">
                        <?= $student['is_suspended'] ? 'Suspended' : 'Active' ?>
                    </span>
                </p>
            </div>
            
            <div class="action-consequences">
                <h3>Consequences of this Action</h3>
                <?php if ($action === 'suspend'): ?>
                <ul>
                    <li>Student will not be able to login to the system</li>
                    <li>Student cannot book or borrow projects</li>
                    <li>Student cannot propose new topics</li>
                    <li>Existing pending bookings will remain but cannot be collected</li>
                    <li>Student can be reactivated later</li>
                </ul>
                <?php else: ?>
                <ul>
                    <li>Student will be able to login to the system</li>
                    <li>Student can book and borrow projects</li>
                    <li>Student can propose new topics</li>
                    <li>All previous permissions are restored</li>
                </ul>
                <?php endif; ?>
            </div>
            
            <form method="POST">
                <input type="hidden" name="action" value="<?= $action ?>">
                
                <div class="form-actions">
                    <button type="submit" class="btn <?= $action === 'suspend' ? 'btn-warning' : 'btn-success' ?>">
                        Confirm <?= $action_text ?>
                    </button>
                    <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>