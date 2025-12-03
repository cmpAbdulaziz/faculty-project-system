<nav class="navbar">
    <div class="nav-brand">Faculty Project System - Student</div>
    <ul class="nav-links">
        <li><a href="student_dashboard.php">Dashboard</a></li>
        <li><a href="project_library.php">Project Library</a></li>
        <li><a href="my_borrowings.php">My Borrowings</a></li>
        <li><a href="approved_topics_list.php">Approved Topics</a></li>
        <li><a href="my_proposals.php">My Proposals</a></li>
        <li><a href="../auth/logout.php">Logout (<?php echo htmlspecialchars($_SESSION['full_name']); ?>)</a></li>
    </ul>
</nav>