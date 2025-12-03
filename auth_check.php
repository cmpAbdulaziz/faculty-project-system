<?php
// auth_check.php - Authentication check
if (!isset($_SESSION['user_id'])) {
    // Determine redirect based on requested page
    $current_dir = getcwd();
    if (strpos($current_dir, 'coordinator') !== false) {
        header("Location: ../auth/coordinator_login.php");
    } else {
        header("Location: ../auth/student_login.php");
    }
    exit;
}
?>