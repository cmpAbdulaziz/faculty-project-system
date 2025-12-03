<?php
include '../config.php';
include '../auth_check.php';

// Ensure only coordinators can access
if ($_SESSION['role'] !== 'coordinator') {
    header("Location: ../auth/coordinator_login.php");
    exit;
}

$coordinator_id = $_SESSION['user_id'];
$dept_id = $_SESSION['department_id'];

// Get coordinator availability
$availability_stmt = $pdo->prepare("SELECT * FROM coordinator_availability WHERE coordinator_id = ?");
$availability_stmt->execute([$coordinator_id]);
$availability = $availability_stmt->fetch();

// Handle availability toggle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_availability'])) {
    $new_status = $availability['status'] === 'available' ? 'unavailable' : 'available';
    
    $update_stmt = $pdo->prepare("UPDATE coordinator_availability SET status = ? WHERE coordinator_id = ?");
    $update_stmt->execute([$new_status, $coordinator_id]);
    
    // Update all pending bookings expiry time when coordinator becomes available
    if ($new_status === 'available') {
        $update_bookings_stmt = $pdo->prepare("
            UPDATE bookings 
            SET expires_at = DATE_ADD(NOW(), INTERVAL 2 HOUR) 
            WHERE booking_status = 'pending' 
            AND project_id IN (SELECT id FROM projects WHERE department_id = ?)
        ");
        $update_bookings_stmt->execute([$dept_id]);
    }
    
    header("Location: coordinator_dashboard.php");
    exit;
}

// Get dashboard statistics (existing code)
$stmt = $pdo->prepare("SELECT COUNT(*) as total FROM projects WHERE department_id = ?");
$stmt->execute([$dept_id]);
$total_projects = $stmt->fetch()['total'];

// ... rest of your existing statistics code ...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Dashboard - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php include 'navbar_coordinator.php'; ?>
    
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['full_name']); ?></h1>
        <p>Department: <?php echo htmlspecialchars($_SESSION['department_name']); ?></p>
        
        <!-- Availability Toggle -->
        <div class="availability-section">
            <div class="availability-card <?= $availability['status'] === 'available' ? 'available' : 'unavailable' ?>">
                <h3>Office Availability</h3>
                <p class="availability-status">
                    Status: <strong><?= ucfirst($availability['status']) ?></strong>
                </p>
                <p class="availability-description">
                    <?php if ($availability['status'] === 'available'): ?>
                        ✅ Students can collect booked projects. Booking expiry timer is active.
                    <?php else: ?>
                        ❌ Students cannot collect projects. Booking expiry is paused.
                    <?php endif; ?>
                </p>
                <form method="POST">
                    <button type="submit" name="toggle_availability" class="btn <?= $availability['status'] === 'available' ? 'btn-warning' : 'btn-success' ?>">
                        <?= $availability['status'] === 'available' ? 'Set as Unavailable' : 'Set as Available' ?>
                    </button>
                </form>
                <?php if ($availability['status'] === 'available'): ?>
                    <p class="availability-note">
                        <small>All pending bookings will expire 2 hours from now.</small>
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Projects</h3>
                <p class="stat-number"><?php echo $total_projects; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Available Projects</h3>
                <p class="stat-number"><?php echo $available_projects; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Pending Bookings</h3>
                <p class="stat-number"><?php echo $pending_bookings; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Pending Topics</h3>
                <p class="stat-number"><?php echo $pending_topics; ?></p>
            </div>
            
            <div class="stat-card">
                <h3>Total Students</h3>
                <p class="stat-number"><?php echo $total_students; ?></p>
            </div>
        </div>
        
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <div class="action-buttons">
                <a href="projects_list.php" class="btn btn-primary">Manage Projects</a>
                <a href="students_list.php" class="btn btn-primary">Manage Students</a>
                <a href="borrowings_list.php" class="btn btn-primary">View Borrowings</a>
                <a href="topic_proposals_list.php" class="btn btn-primary">Review Topics</a>
            </div>
        </div>
        
    </div>
</body>
</html>