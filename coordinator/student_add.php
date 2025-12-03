<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$dept_id = $_SESSION['department_id'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone_number = trim($_POST['phone_number']);
    $admission_no = trim($_POST['admission_no']);
    $password = $_POST['password'];
    
    // Basic validation
    if (empty($full_name) || empty($email) || empty($phone_number) || empty($admission_no) || empty($password)) {
        $error = "All fields are required!";
    } else {
        try {
            // Check if email or admission number already exists
            $check_stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? OR admission_no = ?");
            $check_stmt->execute([$email, $admission_no]);
            $existing_user = $check_stmt->fetch();
            
            if ($existing_user) {
                $error = "Email or Admission Number already exists!";
            } else {
                $stmt = $pdo->prepare("
                    INSERT INTO users (full_name, email, phone_number, password, role, admission_no, department_id) 
                    VALUES (?, ?, ?, ?, 'student', ?, ?)
                ");
                
                if ($stmt->execute([$full_name, $email, $phone_number, $password, $admission_no, $dept_id])) {
                    $success = "Student added successfully!";
                    // Clear form
                    $_POST = array();
                } else {
                    $error = "Failed to add student. Please try again.";
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
    <title>Add New Student - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Add New Student</h1>
            <a href="students_list.php" class="btn btn-secondary">← Back to Students</a>
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
                       value="<?= htmlspecialchars($_POST['full_name'] ?? '') ?>"
                       placeholder="Enter student's full name">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address *</label>
                <input type="email" id="email" name="email" required
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       placeholder="student@cs.udusok.edu.ng">
            </div>
            
            <div class="form-group">
                <label for="phone_number">Phone Number *</label>
                <input type="text" id="phone_number" name="phone_number" required
                       value="<?= htmlspecialchars($_POST['phone_number'] ?? '') ?>"
                       placeholder="08012345678">
            </div>
            
            <div class="form-group">
                <label for="admission_no">Admission Number *</label>
                <input type="text" id="admission_no" name="admission_no" required
                       value="<?= htmlspecialchars($_POST['admission_no'] ?? '') ?>"
                       placeholder="UGP/CS/2020/001">
            </div>
            
            <div class="form-group">
                <label for="password">Password *</label>
                <input type="password" id="password" name="password" required
                       placeholder="Set initial password for student">
                <small style="color: #666;">Students can use this password to login</small>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Student</button>
                <a href="students_list.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>