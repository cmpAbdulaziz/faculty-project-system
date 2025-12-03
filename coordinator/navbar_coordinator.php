<nav class="navbar">
    <div class="nav-brand">Faculty Project System - Coordinator</div>
    <ul class="nav-links">
        <li><a href="coordinator_dashboard.php">Dashboard</a></li>
        <li><a href="projects_list.php">Projects</a></li>
        <li><a href="students_list.php">Students</a></li>
        <li><a href="borrowings_list.php">Borrowings</a></li>
        <li><a href="approved_topics_list.php">Approved Topics</a></li>
        <li><a href="topic_proposals_list.php">Topic Proposals</a></li>
        <li><a href="../auth/logout.php">Logout (<?php echo htmlspecialchars($_SESSION['full_name']); ?>)</a></li>
    </ul>
</nav>