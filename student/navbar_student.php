<?php
// Get coordinator availability status
$coordinator_availability_stmt = $pdo->prepare("
    SELECT ca.status 
    FROM coordinator_availability ca 
    JOIN departments d ON ca.coordinator_id = d.coordinator_id 
    WHERE d.id = ?
");
$coordinator_availability_stmt->execute([$_SESSION['department_id']]);
$coordinator_status = $coordinator_availability_stmt->fetch();
?>

<nav class="navbar">
    <div class="nav-brand">Faculty Project System - Student</div>
    <ul class="nav-links">
        <li><a href="student_dashboard.php">Dashboard</a></li>
        <li><a href="project_library.php">Project Library</a></li>
        <li><a href="my_borrowings.php">My Borrowings</a></li>
        <li><a href="approved_topics_list.php">Approved Topics</a></li>
        <li><a href="my_proposals.php">My Proposals</a></li>
        <li class="availability-status">
            <span class="status-indicator <?= $coordinator_status['status'] === 'available' ? 'available' : 'unavailable' ?>">
                Coordinator: <?= ucfirst($coordinator_status['status']) ?>
            </span>
        </li>
        <li><a href="../auth/logout.php">Logout (<?= htmlspecialchars($_SESSION['full_name']) ?>)</a></li>
    </ul>
</nav>