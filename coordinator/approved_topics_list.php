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

// Build query with search
$sql = "
    SELECT at.*, u.full_name as student_name, u.admission_no 
    FROM approved_topics at 
    JOIN users u ON at.student_id = u.id 
    WHERE at.department_id = ?
";

$params = [$dept_id];

if (!empty($search)) {
    $sql .= " AND (at.title LIKE ? OR u.full_name LIKE ? OR at.supervisor_name LIKE ?)";
    $search_term = "%$search%";
    $params[] = $search_term;
    $params[] = $search_term;
    $params[] = $search_term;
}

$sql .= " ORDER BY at.date_of_approval DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$approved_topics = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Topics - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Approved Topics</h1>
        <p>Manage approved project topics in your department</p>
        
        <div class="action-bar">
            <a href="approved_topic_add.php" class="btn btn-primary">Add New Approved Topic</a>
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Search approved topics..." value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-secondary">Search</button>
                <a href="approved_topics_list.php" class="btn btn-secondary">Clear</a>
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
                        <th>Case Study</th>
                        <th>Approval Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($approved_topics)): ?>
                        <tr>
                            <td colspan="7" style="text-align: center;">No approved topics found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($approved_topics as $topic): ?>
                        <tr>
                            <td><?= htmlspecialchars($topic['title']) ?></td>
                            <td><?= htmlspecialchars($topic['student_name']) ?></td>
                            <td><?= htmlspecialchars($topic['admission_no']) ?></td>
                            <td><?= htmlspecialchars($topic['supervisor_name']) ?></td>
                            <td><?= htmlspecialchars($topic['case_study'] ?: 'N/A') ?></td>
                            <td><?= date('M j, Y', strtotime($topic['date_of_approval'])) ?></td>
                            <td class="actions">
                                <a href="approved_topic_details.php?id=<?= $topic['id'] ?>" class="btn btn-view">View</a>
                                <a href="approved_topic_delete.php?id=<?= $topic['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this approved topic?')">Delete</a>
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