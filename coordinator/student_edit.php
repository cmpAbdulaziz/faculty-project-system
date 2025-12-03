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
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $admission_no = trim($_POST['admission_no']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($full_name) || empty($email) || empty($phone_number) || empty($admission_no)) {
        $error = "All fields except password are required!";
    } else {
        try {
            // Check if email or admission number already exists for other users
            $check_stmt = $pdo->prepare("SELECT id FROM users WHERE (email = ? OR admission_no = ?) AND id != ?");
            $check_stmt->execute([$email, $admission_no, $student_id]);
            $existing_user = $check_stmt->fetch();
            
            if ($existing_user) {
                $error = "Email or Admission Number already exists for another student!";
            } else {
                if (!empty($password)) {
                    // Update with password
                    $stmt = $pdo->prepare("
                        UPDATE users 
                        SET full_name = ?, email = ?, phone_number = ?, admission_no = ?, password = ?
                        WHERE id = ? AND department_id = ?
                    ");
                    $stmt->execute([$full_name, $email, $phone_number, $admission_no, $password, $student_id, $dept_id]);
                } else {
                    // Update without password
                    $stmt = $pdo->prepare("
                        UPDATE users 
                        SET full_name = ?, email = ?, phone_number = ?, admission_no = ?
                        WHERE id = ? AND department_id = ?
                    ");
                    $stmt->execute([$full_name, $email, $phone_number, $admission_no, $student_id, $dept_id]);
                }
                
                if ($stmt->rowCount() > 0) {
                    $success = "Student updated successfully!";
                    // Refresh student data
                    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ? AND department_id = ?");
                    $stmt->execute([$student_id, $dept_id]);
                    $student = $stmt->fetch();
                } else {
                    $error = "No changes made or failed to update student.";
                }
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
    <title>Edit Student - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Edit Student</h1>
            <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-secondary">← Back to Details</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="form-card">
            <div class="form-group">
                <label for="full_name">Full Name *</label>
                <input type="text" id="full_name" name="full_name" required 
                       value="<?= htmlspecialchars($student['full_name']) ?>">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($student['email']) ?>">
            </div>
            
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="text" id="phone_number" name="phone_number" required
                       value="<?= htmlspecialchars($student['phone_number']) ?>">
            </div>
            
            <div class="form-group">
                <label for="admission_no">Admission Number *</label>
                <input type="text" id="admission_no" name="admission_no" required
                       value="<?= htmlspecialchars($student['admission_no']) ?>">
            </div>
            
            <div class="form-group">
                <label for="password">New Password (Leave blank to keep current)</label>
                <input type="password" id="password" name="password"
                       placeholder="Enter new password only if you want to change it">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>