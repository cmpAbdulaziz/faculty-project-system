<?php
session_start();
include '../config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 'student') {
    header("Location: ../student/student_dashboard.php");
    exit;
}

$error = '';

// In student_login.php - Update the authentication section:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']); // This can be email or admission number
    $password = $_POST['password'];
    
    // Simple authentication (plain text passwords for now)
    $stmt = $pdo->prepare("
        SELECT u.*, d.name as department_name 
        FROM users u 
        JOIN departments d ON u.department_id = d.id 
        WHERE (u.email = ? OR u.admission_no = ?) AND u.role = 'student'
    ");
    $stmt->execute([$login, $login]);
    $user = $stmt->fetch();
    
    if ($user && $password === $user['password']) {
        // Check if student is suspended
        if ($user['is_suspended']) {
            $error = "Your account has been suspended. Please contact your coordinator.";
        } else {
            // Login successful
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['department_id'] = $user['department_id'];
            $_SESSION['department_name'] = $user['department_name'];
            $_SESSION['admission_no'] = $user['admission_no'];
            
            header("Location: ../student/student_dashboard.php");
            exit;
        }
    } else {
        $error = "Invalid login credentials!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - Faculty Project System</title>
    <link rel="stylesheet" href="../styles.css">
    <!-- Add this CSS -->
<style>
.password-toggle {
    position: relative;
}

.password-toggle input {
    padding-right: 40px;
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
        <h2>Student Login</h2>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        // Update the form field:
        <div class="form-group">
               <label for="login">Email or Admission Number *</label>
               <input type="text" id="login" name="login" required 
                      value="<?php echo isset($_POST['login']) ? htmlspecialchars($_POST['login']) : ''; ?>"
                       placeholder="Enter your email or admission number">
           </div>
            
            <!-- Update the password form group -->
            <div class="form-group password-toggle">
                 <label for="password">Password:</label>
                 <input type="password" id="password" name="password" required>
                 <button type="button" class="toggle-password" onclick="togglePassword()">Show</button>
             </div>
            
            <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
        </form>
        
        <div style="text-align: center; margin-top: 1rem;">
            <p>Test Account: cs_student@udusok.edu.ng / student123</p>
            <p><a href="coordinator_login.php">Coordinator Login</a></p>
        </div>
    </div>
    
    <!-- Add this JavaScript -->
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