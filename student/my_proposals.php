<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

$student_id = $_SESSION['user_id'];
$filter = $_GET['filter'] ?? 'all';

// Build query with filter
$sql = "SELECT * FROM proposed_topics WHERE student_id = ?";

switch ($filter) {
    case 'pending':
        $sql .= " AND status = 'pending'";
        break;
    case 'approved':
        $sql .= " AND status = 'approved'";
        break;
    case 'rejected':
        $sql .= " AND status = 'rejected'";
        break;
    // 'all' shows everything
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$student_id]);
$proposals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Proposals - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>My Topic Proposals</h1>
            <a href="topic_propose.php" class="btn btn-primary">Propose New Topic</a>
        </div>

        <div class="action-bar">
            <form method="GET" class="search-form">
                <select name="filter" onchange="this.form.submit()">
                    <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Proposals</option>
                    <option value="pending" <?= $filter == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="approved" <?= $filter == 'approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="rejected" <?= $filter == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
            </form>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Topic Title</th>
                        <th>Case Study</th>
                        <th>Supervisor</th>
                        <th>Submitted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($proposals)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No topic proposals found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($proposals as $proposal): ?>
                        <tr>
                            <td><?= htmlspecialchars($proposal['title']) ?></td>
                            <td><?= htmlspecialchars($proposal['case_study'] ?: 'N/A') ?></td>
                            <td><?= htmlspecialchars($proposal['supervisor_name']) ?></td>
                            <td><?= date('M j, Y', strtotime($proposal['created_at'])) ?></td>
                            <td>
                                <span class="status-<?= $proposal['status'] ?>">
                                    <?= ucfirst($proposal['status']) ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="proposal_details.php?id=<?= $proposal['id'] ?>" class="btn btn-view">View Details</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>