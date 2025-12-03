<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

$dept_id = $_SESSION['department_id'];
$student_id = $_SESSION['user_id'];
$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? 'available';

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

if ($status === 'available') {
    $sql .= " AND availability_status = 'available'";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$projects = $stmt->fetchAll();

// Check which projects are already booked by this student
$booked_projects_stmt = $pdo->prepare("
    SELECT project_id FROM bookings 
    WHERE student_id = ? AND booking_status IN ('pending', 'collected')
");
$booked_projects_stmt->execute([$student_id]);
$booked_project_ids = $booked_projects_stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Library - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <h1>Project Library</h1>
        <p>Browse available projects from your department</p>
        
        <div class="action-bar">
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search projects..." value="<?= htmlspecialchars($search) ?>">
                <select name="status">
                    <option value="available" <?= $status == 'available' ? 'selected' : '' ?>>Available Only</option>
                    <option value="all" <?= $status == 'all' ? 'selected' : '' ?>>All Projects</option>
                </select>
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="project_library.php" class="btn btn-secondary">Clear</a>
            </form>
        </div>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['success']) ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error"><?= htmlspecialchars($_GET['error']) ?></div>
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
                                <a href="project_details.php?id=<?= $project['id'] ?>" class="btn btn-view">View Details</a>
                                <?php if ($project['availability_status'] === 'available' && !in_array($project['id'], $booked_project_ids)): ?>
                                    <a href="book_project.php?id=<?= $project['id'] ?>" class="btn btn-primary">Book Project</a>
                                <?php elseif (in_array($project['id'], $booked_project_ids)): ?>
                                    <span class="text-muted">Already Booked</span>
                                <?php else: ?>
                                    <span class="text-muted">Not Available</span>
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