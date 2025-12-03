<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$student_id = $_GET['id'] ?? null;
$dept_id = $_SESSION['department_id'];

if (!$student_id) {
    header("Location: students_list.php");
    exit;
}

// Get student details
$stmt = $pdo->prepare("
    SELECT u.*, d.name as department_name 
    FROM users u 
    JOIN departments d ON u.department_id = d.id 
    WHERE u.id = ? AND u.department_id = ? AND u.role = 'student'
");
$stmt->execute([$student_id, $dept_id]);
$student = $stmt->fetch();

if (!$student) {
    die("Student not found or access denied.");
}

// Get student's borrowing history
$borrowings_stmt = $pdo->prepare("
    SELECT b.*, p.title as project_title, p.student_name as project_student
    FROM bookings b 
    JOIN projects p ON b.project_id = p.id 
    WHERE b.student_id = ? 
    ORDER BY b.booked_at DESC 
    LIMIT 10
");
$borrowings_stmt->execute([$student_id]);
$recent_borrowings = $borrowings_stmt->fetchAll();

// Get student's topic proposals
$topics_stmt = $pdo->prepare("
    SELECT * FROM proposed_topics 
    WHERE student_id = ? 
    ORDER BY created_at DESC 
    LIMIT 10
");
$topics_stmt->execute([$student_id]);
$recent_topics = $topics_stmt->fetchAll();

// Count statistics
$stats_stmt = $pdo->prepare("
    SELECT 
        COUNT(*) as total_borrowings,
        SUM(CASE WHEN booking_status = 'collected' THEN 1 ELSE 0 END) as current_borrowings,
        SUM(CASE WHEN booking_status = 'pending' THEN 1 ELSE 0 END) as pending_borrowings
    FROM bookings 
    WHERE student_id = ?
");
$stats_stmt->execute([$student_id]);
$stats = $stats_stmt->fetch();

$topics_count_stmt = $pdo->prepare("SELECT COUNT(*) as total_topics FROM proposed_topics WHERE student_id = ?");
$topics_count_stmt->execute([$student_id]);
$topics_count = $topics_count_stmt->fetch()['total_topics'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <div class="header-actions">
            <h1>Student Details</h1>
            <div class="action-buttons">
                <a href="students_list.php" class="btn btn-secondary">← Back to Students</a>
                <a href="student_edit.php?id=<?= $student['id'] ?>" class="btn btn-primary">Edit Student</a>
                <a href="student_status.php?id=<?= $student['id'] ?>" class="btn <?= $student['is_suspended'] ? 'btn-success' : 'btn-warning' ?>">
                    <?= $student['is_suspended'] ? 'Activate Student' : 'Suspend Student' ?>
                </a>
            </div>
        </div>

        <div class="details-card">
            <h2>Student Information</h2>
            
            <div class="detail-group">
                <label>Full Name:</label>
                <span><?= htmlspecialchars($student['full_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Admission Number:</label>
                <span><?= htmlspecialchars($student['admission_no']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Email Address:</label>
                <span><?= htmlspecialchars($student['email']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Phone Number:</label>
                <span><?= htmlspecialchars($student['phone_number']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Department:</label>
                <span><?= htmlspecialchars($student['department_name']) ?></span>
            </div>
            
            <div class="detail-group">
                <label>Account Status:</label>
                <span class="<?= $student['is_suspended'] ? 'status-suspended' : 'status-active' ?>">
                    <?= $student['is_suspended'] ? 'Suspended' : 'Active' ?>
                </span>
            </div>
            
            <div class="detail-group">
                <label>Registration Date:</label>
                <span><?= date('F j, Y g:i A', strtotime($student['created_at'])) ?></span>
            </div>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <h3>Total Borrowings</h3>
                <p class="stat-number"><?= $stats['total_borrowings'] ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Current Borrowings</h3>
                <p class="stat-number"><?= $stats['current_borrowings'] ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Pending Bookings</h3>
                <p class="stat-number"><?= $stats['pending_borrowings'] ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Topic Proposals</h3>
                <p class="stat-number"><?= $topics_count ?></p>
            </div>
        </div>

        <div class="details-grid">
            <div class="details-card">
                <h3>Recent Borrowings</h3>
                <?php if (empty($recent_borrowings)): ?>
                    <p class="text-muted">No borrowing history.</p>
                <?php else: ?>
                    <div class="compact-list">
                        <?php foreach ($recent_borrowings as $borrowing): ?>
                        <div class="list-item">
                            <strong><?= htmlspecialchars($borrowing['project_title']) ?></strong>
                            <br>
                            <small>
                                <?= date('M j, Y', strtotime($borrowing['booked_at'])) ?> • 
                                <span class="status-<?= $borrowing['booking_status'] ?>">
                                    <?= ucfirst($borrowing['booking_status']) ?>
                                </span>
                            </small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="details-card">
                <h3>Recent Topic Proposals</h3>
                <?php if (empty($recent_topics)): ?>
                    <p class="text-muted">No topic proposals.</p>
                <?php else: ?>
                    <div class="compact-list">
                        <?php foreach ($recent_topics as $topic): ?>
                        <div class="list-item">
                            <strong><?= htmlspecialchars($topic['title']) ?></strong>
                            <br>
                            <small>
                                <?= date('M j, Y', strtotime($topic['created_at'])) ?> • 
                                <span class="status-<?= $topic['status'] ?>">
                                    <?= ucfirst($topic['status']) ?>
                                </span>
                            </small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>