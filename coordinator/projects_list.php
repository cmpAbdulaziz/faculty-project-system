<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$dept_id = $_SESSION['department_id'];
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';

// Build query with filters
$sql = "SELECT * FROM projects WHERE department_id = ?";
$params = [$dept_id];

if (!empty($search)) {
    $sql .= " AND (title LIKE ? OR student_name LIKE ? OR supervisor_name LIKE ?)";
    $search_term = "%$search%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

if (!empty($status)) {
    $sql .= " AND availability_status = ?";
    $params[] = $status;
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Projects Management</h1>
        
        <div class="action-bar">
            <a href="project_add.php" class="btn btn-primary">Add New Project</a>
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search projects..." value="<?= htmlspecialchars($search) ?>">
                <select name="status">
                    <option value="">All Status</option>
                    <option value="available" <?= $status == 'available' ? 'selected' : '' ?>>Available</option>
                    <option value="borrowed" <?= $status == 'borrowed' ? 'selected' : '' ?>>Borrowed</option>
                    <option value="booked" <?= $status == 'booked' ? 'selected' : '' ?>>Booked</option>
                </select>
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="projects_list.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Student</th>
                        <th>Supervisor</th>
                        <th>Year</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($projects)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No projects found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?= htmlspecialchars($project['title']) ?></td>
                            <td><?= htmlspecialchars($project['student_name']) ?></td>
                            <td><?= htmlspecialchars($project['supervisor_name']) ?></td>
                            <td><?= htmlspecialchars($project['year_of_submission']) ?></td>
                            <td>
                                <span class="status-<?= $project['availability_status'] ?>">
                                    <?= ucfirst($project['availability_status']) ?>
                                </span>
                            </td>
                            <td class="actions">
                                <a href="project_details.php?id=<?= $project['id'] ?>" class="btn btn-view">View</a>
                                <a href="project_edit.php?id=<?= $project['id'] ?>" class="btn btn-edit">Edit</a>
                                <a href="project_delete.php?id=<?= $project['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
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