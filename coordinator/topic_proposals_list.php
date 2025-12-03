<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$dept_id = $_SESSION['department_id'];
$filter = $_GET['filter'] ?? 'pending';

// Build query with filter
$sql = "
    SELECT pt.*, u.full_name as student_name, u.admission_no 
    FROM proposed_topics pt 
    JOIN users u ON pt.student_id = u.id 
    WHERE pt.department_id = ?
";

switch ($filter) {
    case 'pending':
        $sql .= " AND pt.status = 'pending'";
        break;
    case 'approved':
        $sql .= " AND pt.status = 'approved'";
        break;
    case 'rejected':
        $sql .= " AND pt.status = 'rejected'";
        break;
    // 'all' shows everything
}

$sql .= " ORDER BY pt.created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$dept_id]);
$proposals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Proposals - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Topic Proposals</h1>
        <p>Review and manage student topic proposals</p>
        
        <div class="action-bar">
            <form method="GET" class="search-form">
                <select name="filter" onchange="this.form.submit()">
                    <option value="pending" <?= $filter == 'pending' ? 'selected' : '' ?>>Pending Review</option>
                    <option value="approved" <?= $filter == 'approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="rejected" <?= $filter == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Proposals</option>
                </select>
            </form>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Topic Title</th>
                        <th>Student</th>
                        <th>Admission No</th>
                        <th>Supervisor</th>
                        <th>Submitted Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($proposals)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No topic proposals found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($proposals as $proposal): ?>
                        <tr>
                            <td><?= htmlspecialchars($proposal['title']) ?></td>
                            <td><?= htmlspecialchars($proposal['student_name']) ?></td>
                            <td><?= htmlspecialchars($proposal['admission_no']) ?></td>
                            <td><?= htmlspecialchars($proposal['supervisor_name']) ?></td>
                            <td><?= date('M j, Y', strtotime($proposal['created_at'])) ?></td>
                            <td>
                                <span class="status-<?= $proposal['status'] ?>">
                                    <?= ucfirst($proposal['status']) ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="topic_proposal_review.php?id=<?= $proposal['id'] ?>" class="btn btn-view">
                                    <?= $proposal['status'] == 'pending' ? 'Review' : 'View' ?>
                                </a>
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