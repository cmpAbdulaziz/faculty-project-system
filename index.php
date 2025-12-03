<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Project Management System - Usmanu Danfodiyo University Sokoto</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .welcome-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            background: url('faculty-building.jpg') center/cover no-repeat;
            position: relative;
        }

        .welcome-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 800px;
            width: 100%;
        }

        .university-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 1.5rem;
            background: white;
            border-radius: 50%;
            padding: 10px;
            display: inline-block;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            font-weight: 700;
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            font-weight: 300;
        }

        .description {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.8;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .login-buttons {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .login-btn {
            padding: 1.2rem 2.5rem;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: 2px solid transparent;
        }

        .coordinator-btn {
            background: #e74c3c;
            color: white;
        }

        .coordinator-btn:hover {
            background: transparent;
            border-color: #e74c3c;
            color: #e74c3c;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .student-btn {
            background: #3498db;
            color: white;
        }

        .student-btn:hover {
            background: transparent;
            border-color: #3498db;
            color: #3498db;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
            padding: 0 1rem;
        }

        .feature {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .feature h3 {
            margin-bottom: 1rem;
            color: #f39c12;
        }

        .feature p {
            opacity: 0.9;
        }

        footer {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }
            
            .subtitle {
                font-size: 1.2rem;
            }
            
            .description {
                font-size: 1rem;
            }
            
            .login-buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .login-btn {
                width: 100%;
                max-width: 300px;
            }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-content">
            <!-- Replace with actual UDUS logo -->
            <div class="university-logo">
                <img src="udus-logo.jpg" alt="UDUS Logo" style="width: 100%; height: 100%; object-fit: contain;">
            </div>
            
            <h1>Faculty Project Management System</h1>
            <div class="subtitle">Usmanu Danfodiyo University Sokoto</div>
            
            <div class="description">
                A comprehensive platform for managing faculty projects, topic proposals, 
                and resource borrowing across Computer Science, Statistics, Mathematics, 
                Geology, and Physics departments.
            </div>

            <div class="login-buttons">
                <a href="auth/coordinator_login.php" class="login-btn coordinator-btn">
                    Coordinator Login
                </a>
                <a href="auth/student_login.php" class="login-btn student-btn">
                    Student Login
                </a>
            </div>

            <div class="features">
                <div class="feature">
                    <h3>📚 Project Library</h3>
                    <p>Browse and borrow from extensive project collections</p>
                </div>
                <div class="feature">
                    <h3>📝 Topic Management</h3>
                    <p>Propose, review, and approve project topics</p>
                </div>
                <div class="feature">
                    <h3>⏰ Smart Booking</h3>
                    <p>Real-time booking with automatic expiry system</p>
                </div>
                <div class="feature">
                    <h3>👥 Department Focus</h3>
                    <p>Department-specific access and management</p>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Faculty of Science, Usmanu Danfodiyo University Sokoto. All rights reserved.</p>
    </footer>
</body>
</html>