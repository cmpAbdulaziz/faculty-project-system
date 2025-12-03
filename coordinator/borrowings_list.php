<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$dept_id = $_SESSION['department_id'];
$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search'] ?? '';

// Build query with filters
$sql = "
    SELECT b.*, p.title as project_title, p.student_name as project_student, 
           p.supervisor_name as project_supervisor, u.full_name as student_name, 
           u.admission_no, u.email as student_email
    FROM bookings b 
    JOIN projects p ON b.project_id = p.id 
    JOIN users u ON b.student_id = u.id 
    WHERE p.department_id = ?
";

$params = [$dept_id];

if (!empty($search)) {
    $sql .= " AND (p.title LIKE ? OR u.full_name LIKE ? OR u.admission_no LIKE ?)";
    $search_term = "%$search%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

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
$stmt->execute($params);
$borrowings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowings Management - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Borrowings Management</h1>
        <p>Manage all project borrowings in your department</p>
        
        <div class="action-bar">
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search by project or student..." value="<?= htmlspecialchars($search) ?>">
                <select name="filter">
                    <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Borrowings</option>
                    <option value="pending" <?= $filter == 'pending' ? 'selected' : '' ?>>Pending Collection</option>
                    <option value="collected" <?= $filter == 'collected' ? 'selected' : '' ?>>Currently Borrowed</option>
                    <option value="returned" <?= $filter == 'returned' ? 'selected' : '' ?>>Returned</option>
                    <option value="expired" <?= $filter == 'expired' ? 'selected' : '' ?>>Expired</option>
                </select>
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="borrowings_list.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Project Title</th>
                        <th>Student</th>
                        <th>Admission No</th>
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
                            <td><?= htmlspecialchars($borrowing['project_title']) ?></td>
                            <td><?= htmlspecialchars($borrowing['student_name']) ?></td>
                            <td><?= htmlspecialchars($borrowing['admission_no']) ?></td>
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
                                <a href="borrowing_details.php?id=<?= $borrowing['id'] ?>" class="btn btn-view">View Details</a>
                                <?php if ($borrowing['booking_status'] == 'pending'): ?>
                                    <a href="borrowing_collect.php?id=<?= $borrowing['id'] ?>" class="btn btn-success">Mark Collected</a>
                                <?php elseif ($borrowing['booking_status'] == 'collected'): ?>
                                    <a href="borrowing_return.php?id=<?= $borrowing['id'] ?>" class="btn btn-primary">Mark Returned</a>
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