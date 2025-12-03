<?php
// test_connection.php - Test database connection
include 'config.php';

try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch();
    echo "✅ Database connection successful!<br>";
    echo "✅ Users in database: " . $result['count'] . "<br>";
    echo "✅ System is ready for development!";
} catch(PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage();
}
?>