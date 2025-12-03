<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$topic_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$topic_id) {
    header("Location: approved_topics_list.php");
    exit;
}

// Get approved topic details
$stmt = $pdo->prepare("
    SELECT at.*, u.full_name as student_name, u.admission_no, u.email as student_email
    FROM approved_topics at 
    JOIN users u ON at.student_id = u.id 
    WHERE at.id = ? AND at.department_id = ?
");
$stmt->execute([$topic_id, $dept_id]);
$topic = $stmt->fetch();

if (!$topic) {
    die("Approved topic not found or access denied.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Topic Details - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Approved Topic Details</h1>
            <div class="action-buttons">
                <a href="approved_topics_list.php" class="btn btn-secondary">← Back to List</a>
                <a href="approved_topic_delete.php?id=<?= $topic['id'] ?>" class="btn btn-delete">Delete Topic</a>
            </div>
        </div>

        <div class="details-card">
            <h2><?= htmlspecialchars($topic['title']) ?></h2>
            
            <div class="detail-group">
                <label>Topic Title:</label>
                <span><?= htmlspecialchars($topic['title']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Case Study:</label>
                <span><?= htmlspecialchars($topic['case_study'] ?: 'Not specified') ?></span>
            </div>
            
            <div class="detail-group">
                <label>Supervisor Name:</label>
                <span><?= htmlspecialchars($topic['supervisor_name']) ?></span>
            </div>
        </div>

        <div class="details-card">
            <h2>Student Information</h2>
            
            <div class="detail-group">
                <label>Student Name:</label>
                <span><?= htmlspecialchars($topic['student_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Admission Number:</label>
                <span><?= htmlspecialchars($topic['admission_no']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Email:</label>
                <span><?= htmlspecialchars($topic['student_email']) ?></span>
            </div>
        </div>

        <div class="details-card">
            <h2>Approval Information</h2>
            
            <div class="detail-group">
                <label>Date of Approval:</label>
                <span><?= date('F j, Y', strtotime($topic['date_of_approval'])) ?></span>
            </div>
        </div>
    </div>
</body>
</html>