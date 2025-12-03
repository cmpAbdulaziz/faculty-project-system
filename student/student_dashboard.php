<?php
include '../config.php';
include '../auth_check.php';

// Ensure only students can access
if ($_SESSION['role'] !== 'student') {
    header("Location: ../auth/student_login.php");
    exit;
}

// Get student statistics
$student_id = $_SESSION['user_id'];
$dept_id = $_SESSION['department_id'];

// Total available projects
$stmt = $pdo->prepare("SELECT COUNT(*) as available FROM projects WHERE department_id = ? AND availability_status = 'available'");
$stmt->execute([$dept_id]);
$available_projects = $stmt->fetch()['available'];

// My pending bookings
$stmt = $pdo->prepare("SELECT COUNT(*) as pending FROM bookings WHERE student_id = ? AND booking_status = 'pending'");
$stmt->execute([$student_id]);
$my_pending_bookings = $stmt->fetch()['pending'];

// My current borrowings
$stmt = $pdo->prepare("SELECT COUNT(*) as borrowed FROM bookings WHERE student_id = ? AND booking_status = 'collected'");
$stmt->execute([$student_id]);
$my_borrowings = $stmt->fetch()['borrowed'];

// My topic proposals
$stmt = $pdo->prepare("SELECT COUNT(*) as proposals FROM proposed_topics WHERE student_id = ?");
$stmt->execute([$student_id]);
$my_proposals = $stmt->fetch()['proposals'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_student.php'; ?>
    
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></h1>
        <p>Admission: <?php echo htmlspecialchars($_SESSION['admission_no']); ?> | Department: <?php echo htmlspecialchars($_SESSION['department_name']); ?></p>
        
        <div class="availability-banner <?= $coordinator_status['status'] === 'available' ? 'available' : 'unavailable' ?>">
    <div class="availability-content">
        <h3>
            <?php if ($coordinator_status['status'] === 'available'): ?>
                ✅ Coordinator is Available
            <?php else: ?>
                ❌ Coordinator is Unavailable
            <?php endif; ?>
        </h3>
        <p>
            <?php if ($coordinator_status['status'] === 'available'): ?>
                You can collect your booked projects from the coordinator's office. 
                Bookings expire 2 hours after being made.
            <?php else: ?>
                The coordinator is currently unavailable. You cannot collect booked projects at this time.
            <?php endif; ?>
        </p>
    </div>
</div>
        
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Available Projects</h3>
                <p class="stat-number"><?php echo $available_projects; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>My Pending Bookings</h3>
                <p class="stat-number"><?php echo $my_pending_bookings; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>My Current Borrowings</h3>
                <p class="stat-number"><?php echo $my_borrowings; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>My Topic Proposals</h3>
                <p class="stat-number"><?php echo $my_proposals; ?></p>
            </div>
        </div>
        
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="project_library.php" class="btn btn-primary">Browse Projects</a>
                <a href="my_borrowings.php" class="btn btn-primary">My Borrowings</a>
                <a href="approved_topics_list.php" class="btn btn-primary">View Approved Topics</a>
                <a href="topic_propose.php" class="btn btn-primary">Propose Topic</a>
            </div>
        </div>
    </div>
</body>
</html>