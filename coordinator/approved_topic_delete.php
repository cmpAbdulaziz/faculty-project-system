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
    SELECT at.*, u.full_name as student_name 
    FROM approved_topics at 
    JOIN users u ON at.student_id = u.id 
    WHERE at.id = ? AND at.department_id = ?
");
$stmt->execute([$topic_id, $dept_id]);
$topic = $stmt->fetch();

if (!$topic) {
    die("Approved topic not found or access denied.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        try {
            $stmt = $pdo->prepare("DELETE FROM approved_topics WHERE id = ? AND department_id = ?");
            if ($stmt->execute([$topic_id, $dept_id])) {
                header("Location: approved_topics_list.php?success=Approved topic deleted successfully");
                exit;
            } else {
                $error = "Failed to delete approved topic.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    } else {
        header("Location: approved_topics_list.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Approved Topic - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Delete Approved Topic</h1>
            <a href="approved_topics_list.php" class="btn btn-secondary">← Back to List</a>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?= $error ?></div>
        <?php endif; ?>

        <div class="confirmation-card">
            <h2>Confirm Deletion</h2>
            
            <div class="topic-info">
                <p><strong>Topic Title:</strong> <?= htmlspecialchars($topic['title']) ?></p>
                <p><strong>Student:</strong> <?= htmlspecialchars($topic['student_name']) ?></p>
                <p><strong>Supervisor:</strong> <?= htmlspecialchars($topic['supervisor_name']) ?></p>
                <p><strong>Case Study:</strong> <?= htmlspecialchars($topic['case_study'] ?: 'N/A') ?></p>
                <p><strong>Approval Date:</strong> <?= date('F j, Y', strtotime($topic['date_of_approval'])) ?></p>
            </div>
            
            <div class="alert alert-error">
                <strong>Warning:</strong> This action cannot be undone. The approved topic will be permanently deleted from the system.
            </div>
            
            <form method="POST">
                <div class="form-actions">
                    <button type="submit" name="confirm" value="1" class="btn btn-danger">Confirm Delete</button>
                    <a href="approved_topic_details.php?id=<?= $topic['id'] ?>" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>