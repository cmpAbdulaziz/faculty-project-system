<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

$proposal_id = $_GET['id'] ?? null;
$student_id = $_SESSION['user_id'];

if (!$proposal_id) {
    header("Location: my_proposals.php");
    exit;
}

// Get proposal details
$stmt = $pdo->prepare("SELECT * FROM proposed_topics WHERE id = ? AND student_id = ?");
$stmt->execute([$proposal_id, $student_id]);
$proposal = $stmt->fetch();

if (!$proposal) {
    die("Proposal not found or access denied.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Details - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Proposal Details</h1>
            <div class="action-buttons">
                <a href="my_proposals.php" class="btn btn-secondary">← Back to My Proposals</a>
            </div>
        </div>

        <div class="details-card">
            <h2><?= htmlspecialchars($proposal['title']) ?></h2>
            
            <div class="detail-group">
                <label>Topic Title:</label>
                <span><?= htmlspecialchars($proposal['title']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Case Study:</label>
                <span><?= htmlspecialchars($proposal['case_study'] ?: 'Not specified') ?></span>
            </div>
            
            <div class="detail-group">
                <label>Supervisor Name:</label>
                <span><?= htmlspecialchars($proposal['supervisor_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Status:</label>
                <span class="status-<?= $proposal['status'] ?>">
                    <?= ucfirst($proposal['status']) ?>
                </span>
            </div>
            
            <div class="detail-group">
                <label>Submitted Date:</label>
                <span><?= date('F j, Y g:i A', strtotime($proposal['created_at'])) ?></span>
            </div>
        </div>

        <div class="details-card">
            <h3>Problem Statement</h3>
            <div class="content-box">
                <?= nl2br(htmlspecialchars($proposal['problem_statement'])) ?>
            </div>
        </div>

        <div class="details-card">
            <h3>Topic Objectives</h3>
            <div class="content-box">
                <?= nl2br(htmlspecialchars($proposal['topic_objectives'])) ?>
            </div>
        </div>
    </div>
</body>
</html>