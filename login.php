<?php
// เริ่มต้น Session
session_start();

// กำหนดเส้นทางหลัก
define('BASE_PATH', __DIR__);

// นำเข้าไฟล์การตั้งค่า
require_once(BASE_PATH . '/config.php');

// ตรวจสอบว่ามีการล็อกอินแล้วหรือไม่
if (isLoggedIn()) {
    redirect('index.php');
}

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = clean($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = 'กรุณากรอกชื่อผู้ใช้และรหัสผ่าน';
    } else {
        try {
            // ค้นหาผู้ใช้งานจากฐานข้อมูล
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // บันทึกข้อมูลผู้ใช้ลงใน Session
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['role'] = $user['role'];

                setAlert('เข้าสู่ระบบสำเร็จ', 'success');
                redirect('index.php');
            } else {
                $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
            }
        } catch (PDOException $e) {
            error_log("Login Error: " . $e->getMessage());
            $error = 'เกิดข้อผิดพลาดในการเข้าสู่ระบบ กรุณาลองใหม่อีกครั้ง';
        }
    }
}
?>


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - ระบบบันทึกการเข้าแถวหน้าเสาธง</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font - Kodchasan -->
    <link href="https://fonts.googleapis.com/css2?family=Kodchasan:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            --primary-color: #2575fc;
            --secondary-color: #6a11cb;
        }

        body {
            font-family: 'Kodchasan', sans-serif;
            background: var(--primary-gradient);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            perspective: 1000px;
        }

        .login-container {
            max-width: 450px;
            width: 100%;
            padding: 35px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-10px) rotateX(5deg);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        }

        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .login-header .logo {
            font-size: 60px;
            color: var(--primary-color);
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            border-radius: 25px;
            color: white;
            box-shadow: 0 10px 25px rgba(37, 117, 252, 0.3);
            transition: transform 0.3s ease;
        }

        .login-header .logo:hover {
            transform: scale(1.05) rotate(10deg);
        }

        .login-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-top: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-floating {
            margin-bottom: 20px;
        }

        .form-floating input {
            border-radius: 10px;
            padding: 15px;
            border: 2px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .form-floating input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(37, 117, 252, 0.25);
        }

        .form-floating label {
            opacity: 0.7;
            transition: all 0.3s ease;
        }

        .form-floating input:focus+label,
        .form-floating input:not(:placeholder-shown)+label {
            opacity: 1;
            color: var(--primary-color);
        }

        .btn-login {
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 10px;
            background: var(--primary-gradient);
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: all 0.3s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            font-size: 14px;
        }

        .login-footer a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-footer a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-container {
                width: 95%;
                padding: 25px;
                margin: 15px;
            }
        }

        /* Wave Background */
        .login-wave {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
            z-index: -1;
        }

        .login-wave svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 150px;
        }

        .login-wave .shape-fill {
            fill: white;
        }
    </style>
</head>

<body>
    <!-- Wave Background -->
    <div class="login-wave">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="white"></path>
            <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="white"></path>
            <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="white"></path>
        </svg>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">
                <i class="fas fa-flag"></i>
            </div>
            <h1>บันทึกการเข้าแถวหน้าเสาธง</h1>
        </div>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post" action="" id="loginForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้" required>
                <label for="username"><i class="fas fa-user"></i> ชื่อผู้ใช้</label>
            </div>

            <div class="form-floating mb-4">
                <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                <label for="password"><i class="fas fa-lock"></i> รหัสผ่าน</label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-login btn-lg">
                    <i class="fas fa-sign-in-alt"></i> เข้าสู่ระบบ
                </button>
            </div>
        </form>

        <div class="login-footer">
            <p>© <?php echo date('Y'); ?> ระบบบันทึกการเข้าแถวหน้าเสาธง</p>
            <p>
                พัฒนาโดย Devtaiban
                <a href="https://www.Kruwirat.com" target="_blank">www.Kruwirat.com</a> /
                โทร <a href="tel:0956029737">095-602-9737</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const username = document.getElementById('username');
            const password = document.getElementById('password');

            // Simple client-side validation with visual feedback
            if (!username.value.trim()) {
                username.classList.add('is-invalid');
                e.preventDefault();
                return;
            }

            if (!password.value.trim()) {
                password.classList.add('is-invalid');
                e.preventDefault();
                return;
            }

            // Optional: Add loading state to button
            const submitButton = e.submitter;
            submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> กำลังเข้าสู่ระบบ...';
            submitButton.disabled = true;
        });

        // Remove validation classes on input
        document.getElementById('username').addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });

        document.getElementById('password').addEventListener('input', function() {
            this.classList.remove('is-invalid');
        });
    </script>
</body>

</html>