<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$dept_id = $_SESSION['department_id'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $case_study = trim($_POST['case_study']);
    $supervisor_name = trim($_POST['supervisor_name']);
    $problem_statement = trim($_POST['problem_statement']);
    $topic_objectives = trim($_POST['topic_objectives']);
    
    // Basic validation
    if (empty($title) || empty($supervisor_name) || empty($problem_statement) || empty($topic_objectives)) {
        $error = "Title, Supervisor Name, Problem Statement, and Objectives are required!";
    } else {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO proposed_topics 
                (title, case_study, student_id, supervisor_name, problem_statement, topic_objectives, department_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            
            if ($stmt->execute([$title, $case_study, $student_id, $supervisor_name, $problem_statement, $topic_objectives, $dept_id])) {
                $success = "Topic proposed successfully! It will be reviewed by your coordinator.";
                // Clear form
                $_POST = array();
            } else {
                $error = "Failed to propose topic. Please try again.";
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
    <title>Propose Topic - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Propose New Topic</h1>
            <a href="my_proposals.php" class="btn btn-secondary">← My Proposals</a>
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
                       placeholder="Enter a descriptive title for your project topic">
            </div>
            
            <div class="form-group">
                <label for="case_study">Case Study (Optional)</label>
                <input type="text" id="case_study" name="case_study"
                       value="<?= htmlspecialchars($_POST['case_study'] ?? '') ?>"
                       placeholder="Specific case study or context for your project">
            </div>
            
            <div class="form-group">
                <label for="supervisor_name">Supervisor Name *</label>
                <input type="text" id="supervisor_name" name="supervisor_name" required
                       value="<?= htmlspecialchars($_POST['supervisor_name'] ?? '') ?>"
                       placeholder="Name of your proposed supervisor">
            </div>
            
            <div class="form-group">
                <label for="problem_statement">Problem Statement *</label>
                <textarea id="problem_statement" name="problem_statement" required rows="4"
                          placeholder="Describe the problem your project aims to solve"><?= htmlspecialchars($_POST['problem_statement'] ?? '') ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="topic_objectives">Topic Objectives *</label>
                <textarea id="topic_objectives" name="topic_objectives" required rows="4"
                          placeholder="List the main objectives of your project"><?= htmlspecialchars($_POST['topic_objectives'] ?? '') ?></textarea>
            </div>
            
            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Propose Topic</button>
                <a href="my_proposals.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>