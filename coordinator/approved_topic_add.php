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

// Get students from this department for dropdown
$students_stmt = $pdo->prepare("SELECT id, full_name, admission_no FROM users WHERE department_id = ? AND role = 'student' ORDER BY full_name");
$students_stmt->execute([$dept_id]);
$students = $students_stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $case_study = trim($_POST['case_study']);
    $student_id = $_POST['student_id'];
    $supervisor_name = trim($_POST['supervisor_name']);
    $date_of_approval = $_POST['date_of_approval'];
    
    // Basic validation
    if (empty($title) || empty($student_id) || empty($supervisor_name) || empty($date_of_approval)) {
        $error = "Title, Student, Supervisor Name, and Approval Date are required!";
    } else {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO approved_topics 
                (title, case_study, student_id, supervisor_name, date_of_approval, department_id) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            
            if ($stmt->execute([$title, $case_study, $student_id, $supervisor_name, $date_of_approval, $dept_id])) {
                $success = "Approved topic added successfully!";
                // Clear form
                $_POST = array();
            } else {
                $error = "Failed to add approved topic. Please try again.";
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
    <title>Add Approved Topic - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Add Approved Topic</h1>
            <a href="approved_topics_list.php" class="btn btn-secondary">← Back to List</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" class="form-card">
            <div class="form-group">
                <label for="title">Topic Title *</label>
                <input type="text" id="title" name="title" required 
                       value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                       placeholder="Enter the approved topic title">
            </div>
            
            <div class="form-group">
                <label for="case_study">Case Study (Optional)</label>
                <input type="text" id="case_study" name="case_study"
                       value="<?= htmlspecialchars($_POST['case_study'] ?? '') ?>"
                       placeholder="Specific case study or context">
            </div>
            
            <div class="form-group">
                <label for="student_id">Student *</label>
                <select id="student_id" name="student_id" required>
                    <option value="">Select a student</option>
                    <?php foreach ($students as $student): ?>
                        <option value="<?= $student['id'] ?>" <?= ($_POST['student_id'] ?? '') == $student['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($student['full_name']) ?> (<?= $student['admission_no'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="supervisor_name">Supervisor Name *</label>
                <input type="text" id="supervisor_name" name="supervisor_name" required
                       value="<?= htmlspecialchars($_POST['supervisor_name'] ?? '') ?>"
                       placeholder="Name of the supervisor">
            </div>
            
            <div class="form-group">
                <label for="date_of_approval">Date of Approval *</label>
                <input type="date" id="date_of_approval" name="date_of_approval" required
                       value="<?= $_POST['date_of_approval'] ?? date('Y-m-d') ?>">
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add Approved Topic</button>
                <a href="approved_topics_list.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>