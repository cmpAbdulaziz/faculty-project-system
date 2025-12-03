<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$proposal_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$proposal_id) {
    header("Location: topic_proposals_list.php");
    exit;
}

// Get proposal details
$stmt = $pdo->prepare("
    SELECT pt.*, u.full_name as student_name, u.admission_no 
    FROM proposed_topics pt 
    JOIN users u ON pt.student_id = u.id 
    WHERE pt.id = ? AND pt.department_id = ?
");
$stmt->execute([$proposal_id, $dept_id]);
$proposal = $stmt->fetch();

if (!$proposal) {
    die("Proposal not found or access denied.");
}

// Check if student already has an approved topic
$approved_check_stmt = $pdo->prepare("
    SELECT COUNT(*) as approved_count 
    FROM approved_topics 
    WHERE student_id = ? AND department_id = ?
");
$approved_check_stmt->execute([$proposal['student_id'], $dept_id]);
$approved_count = $approved_check_stmt->fetch()['approved_count'];

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    
    try {
        if ($action === 'approve') {
            // Check if student already has an approved topic
            if ($approved_count > 0) {
                $error = "This student already has an approved topic. Students can only have one approved topic.";
            } else {
                // Update proposal status
                $stmt = $pdo->prepare("UPDATE proposed_topics SET status = 'approved' WHERE id = ?");
                $stmt->execute([$proposal_id]);
                
                // Add to approved topics
                $approve_stmt = $pdo->prepare("
                    INSERT INTO approved_topics 
                    (title, case_study, student_id, supervisor_name, date_of_approval, department_id) 
                    VALUES (?, ?, ?, ?, CURDATE(), ?)
                ");
                $approve_stmt->execute([
                    $proposal['title'],
                    $proposal['case_study'],
                    $proposal['student_id'],
                    $proposal['supervisor_name'],
                    $dept_id
                ]);
                
                $success = "Topic approved and added to approved topics list!";
            }
            
        } elseif ($action === 'reject') {
            // Update proposal status
            $stmt = $pdo->prepare("UPDATE proposed_topics SET status = 'rejected' WHERE id = ?");
            $stmt->execute([$proposal_id]);
            
            $success = "Topic rejected!";
        }
        
        // Refresh proposal data
        $stmt = $pdo->prepare("
            SELECT pt.*, u.full_name as student_name, u.admission_no 
            FROM proposed_topics pt 
            JOIN users u ON pt.student_id = u.id 
            WHERE pt.id = ? AND pt.department_id = ?
        ");
        $stmt->execute([$proposal_id, $dept_id]);
        $proposal = $stmt->fetch();
        
        // Refresh approved count
        $approved_check_stmt->execute([$proposal['student_id'], $dept_id]);
        $approved_count = $approved_check_stmt->fetch()['approved_count'];
        
    } catch (PDOException $e) {
        $error = "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Topic Proposal - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Review Topic Proposal</h1>
            <a href="topic_proposals_list.php" class="btn btn-secondary">← Back to Proposals</a>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <div class="details-card">
            <h2><?= htmlspecialchars($proposal['title']) ?></h2>
            
            <div class="detail-group">
                <label>Student Name:</label>
                <span><?= htmlspecialchars($proposal['student_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Admission Number:</label>
                <span><?= htmlspecialchars($proposal['admission_no']) ?></span>
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

            <!-- Show approval status warning -->
            <?php if ($approved_count > 0 && $proposal['status'] == 'pending'): ?>
            <div class="detail-group">
                <label>Approval Status:</label>
                <span class="status-warning" style="color: #e74c3c; font-weight: bold;">
                    ⚠ This student already has an approved topic
                </span>
            </div>
            <?php endif; ?>
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

        <?php if ($proposal['status'] == 'pending'): ?>
        <div class="review-actions details-card">
            <h3>Review Actions</h3>
            
            <?php if ($approved_count > 0): ?>
                <div class="alert alert-error">
                    <strong>Cannot Approve:</strong> This student already has an approved topic. 
                    Students can only have one approved topic at a time.
                </div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-actions">
                    <button type="submit" name="action" value="approve" class="btn btn-success" <?= $approved_count > 0 ? 'disabled' : '' ?>>
                        Approve Topic
                    </button>
                    <button type="submit" name="action" value="reject" class="btn btn-danger">Reject Topic</button>
                    <a href="topic_proposals_list.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>