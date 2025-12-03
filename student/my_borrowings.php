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
$sql = "
    SELECT b.*, p.title, p.student_name as project_student, p.supervisor_name 
    FROM bookings b 
    JOIN projects p ON b.project_id = p.id 
    WHERE b.student_id = ?
";

switch ($filter) {
    case 'pending':
        $sql .= " AND b.booking_status = 'pending'";
        break;
    case 'collected':
        $sql .= " AND b.booking_status = 'collected'";
        break;
    case 'returned':
        $sql .= " AND b.booking_status = 'returned'";
        break;
    case 'expired':
        $sql .= " AND b.booking_status = 'expired'";
        break;
    // 'all' shows everything
}

$sql .= " ORDER BY b.booked_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute([$student_id]);
$borrowings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Borrowings - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <h1>My Borrowings</h1>
        <p>Track your project bookings and borrowings</p>
        
        <div class="action-bar">
            <form method="GET" class="search-form">
                <select name="filter" onchange="this.form.submit()">
                    <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Borrowings</option>
                    <option value="pending" <?= $filter == 'pending' ? 'selected' : '' ?>>Pending Collection</option>
                    <option value="collected" <?= $filter == 'collected' ? 'selected' : '' ?>>Currently Borrowed</option>
                    <option value="returned" <?= $filter == 'returned' ? 'selected' : '' ?>>Returned</option>
                    <option value="expired" <?= $filter == 'expired' ? 'selected' : '' ?>>Expired</option>
                </select>
            </form>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Original Student</th>
                        <th>Supervisor</th>
                        <th>Booked Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($borrowings)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No borrowings found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($borrowings as $borrowing): ?>
                        <tr>
                            <td><?= htmlspecialchars($borrowing['title']) ?></td>
                            <td><?= htmlspecialchars($borrowing['project_student']) ?></td>
                            <td><?= htmlspecialchars($borrowing['supervisor_name']) ?></td>
                            <td><?= date('M j, Y g:i A', strtotime($borrowing['booked_at'])) ?></td>
                            <td>
                                <span class="status-<?= $borrowing['booking_status'] ?>">
                                    <?= ucfirst($borrowing['booking_status']) ?>
                                    <?php if ($borrowing['booking_status'] == 'pending' && strtotime($borrowing['expires_at']) < time()): ?>
                                        (Expired)
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="project_details.php?id=<?= $borrowing['project_id'] ?>" class="btn btn-view">View Project</a>
                                <?php if ($borrowing['booking_status'] == 'pending'): ?>
                                    <span class="text-info">
                                        Expires: <?= date('g:i A', strtotime($borrowing['expires_at'])) ?>
                                    </span>
                                <?php elseif ($borrowing['booking_status'] == 'collected'): ?>
                                    <span class="text-info">
                                        Due: <?= date('M j, Y', strtotime($borrowing['due_date'])) ?>
                                    </span>
                                <?php endif; ?>
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