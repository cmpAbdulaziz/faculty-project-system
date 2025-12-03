<?php
session_start();
include '../config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'coordinator') {
    header("Location: ../coordinator/coordinator_dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Simple authentication (plain text passwords for now)
    $stmt = $pdo->prepare("
        SELECT u.*, d.name as department_name 
        FROM users u 
        JOIN departments d ON u.department_id = d.id 
        WHERE u.email = ? AND u.role = 'coordinator'
    ");
    $stmt->execute([$email]);
    $user = $stmt->fetch();
    
    if ($user && $password === $user['password']) {
        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['full_name'] = $user['full_name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['department_id'] = $user['department_id'];
        $_SESSION['department_name'] = $user['department_name'];
        
        header("Location: ../coordinator/coordinator_dashboard.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coordinator Login - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
    .password-toggle {
        position: relative;
    }

    .password-toggle input {
        padding-right: 40px;
        width: 100%;
    }

    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #666;
        font-size: 0.9rem;
    }

    .toggle-password:hover {
        color: #333;
    }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Coordinator Login</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" required 
                       value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            </div>
            
            <div class="form-group password-toggle">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">Show</button>
            </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
        
        <div style="text-align: center; margin-top: 1rem;">
            <p>Test Account: cs_coordinator@udusok.edu.ng / coordinator123</p>
            <p><a href="student_login.php">Student Login</a></p>
        </div>
    </div>

    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleButton = document.querySelector('.toggle-password');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleButton.textContent = 'Hide';
        } else {
            passwordInput.type = 'password';
            toggleButton.textContent = 'Show';
        }
    }
    </script>
</body>
</html>