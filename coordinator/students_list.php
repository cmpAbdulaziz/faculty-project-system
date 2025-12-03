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
$sql = "SELECT * FROM users WHERE department_id = ? AND role = 'student'";
$params = [$dept_id];

if (!empty($search)) {
    $sql .= " AND (full_name LIKE ? OR admission_no LIKE ? OR email LIKE ?)";
    $search_term = "%$search%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

switch ($filter) {
    case 'active':
        $sql .= " AND is_suspended = FALSE";
        break;
    case 'suspended':
        $sql .= " AND is_suspended = TRUE";
        break;
    // 'all' shows everything
}

$sql .= " ORDER BY full_name ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$students = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students Management - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Students Management</h1>
        <p>Manage students in your department</p>
        
        <div class="action-bar">
            <a href="student_add.php" class="btn btn-primary">Add New Student</a>
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search students..." value="<?= htmlspecialchars($search) ?>">
                <select name="filter">
                    <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Students</option>
                    <option value="active" <?= $filter == 'active' ? 'selected' : '' ?>>Active Only</option>
                    <option value="suspended" <?= $filter == 'suspended' ? 'selected' : '' ?>>Suspended Only</option>
                </select>
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="students_list.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Admission No</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No students found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?= htmlspecialchars($student['full_name']) ?></td>
                            <td><?= htmlspecialchars($student['admission_no']) ?></td>
                            <td><?= htmlspecialchars($student['email']) ?></td>
                            <td><?= htmlspecialchars($student['phone_number']) ?></td>
                            <td>
                                <?php if ($student['is_suspended']): ?>
                                    <span class="status-suspended">Suspended</span>
                                <?php else: ?>
                                    <span class="status-active">Active</span>
                                <?php endif; ?>
                            </td>
                            <!-- td class="actions">
                                <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-view">View</a>
                                <a href="student_edit.php?id=<?= $student['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="student_status.php?id=<?= $student['id'] ?>" class="btn <?= $student['is_suspended'] ? 'btn-success' : 'btn-warning' ?>">
                                    <?= $student['is_suspended'] ? 'Activate' : 'Suspend' ?>
                                </a>
                            </td -->
                            <!-- In the actions column, add delete button -->
                            <td class="actions">
                                  <a href="student_details.php?id=<?= $student['id'] ?>" class="btn btn-view">View</a>
                                  <a href="student_edit.php?id=<?= $student['id'] ?>" class="btn btn-edit">Edit</a>
                                   <a href="student_status.php?id=<?= $student['id'] ?>" class="btn <?= $student['is_suspended'] ? 'btn-success' : 'btn-warning' ?>">
                                   <?= $student['is_suspended'] ? 'Activate' : 'Suspend' ?>
                                   </a>
                                   <a href="student_delete.php?id=<?= $student['id'] ?>" class="btn btn-delete" 
                                      onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
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