<?php
// เริ่มต้น Session
session_start();

// กำหนดเส้นทางหลัก
define('BASE_PATH', __DIR__);

// นำเข้าไฟล์การตั้งค่า
require_once(BASE_PATH . '/config.php');

// ตรวจสอบว่ามีการล็อกอินหรือไม่
if (!isLoggedIn() && !in_array(basename($_SERVER['PHP_SELF']), ['login.php', 'logout.php'])) {
    redirect('login.php');
}

// กำหนดหน้าเริ่มต้น
$page = isset($_GET['page']) ? clean($_GET['page']) : 'dashboard';

// ตรวจสอบสิทธิ์การเข้าถึงหน้าต่างๆ
$admin_only_pages = ['users', 'user_form'];
$teacher_staff_pages = ['classrooms', 'classroom_form', 'students', 'student_form'];

if (in_array($page, $admin_only_pages) && !checkRole('admin')) {
    setAlert('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 'danger');
    redirect('index.php');
}

if (in_array($page, $teacher_staff_pages) && !checkRole(['admin', 'teacher'])) {
    setAlert('คุณไม่มีสิทธิ์เข้าถึงหน้านี้', 'danger');
    redirect('index.php');
}

// แสดง Header
include(BASE_PATH . '/includes/header.php');
?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include(BASE_PATH . '/includes/sidebar.php'); ?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4 mt-5 mb-5">
            <?php displayAlert(); ?>

            <?php
            // โหลดหน้าตามที่เลือก
            $file_path = BASE_PATH . '/pages/' . $page . '.php';
            if (file_exists($file_path)) {
                include($file_path);
            } else {
                echo '<div class="alert alert-danger">ไม่พบหน้าที่คุณต้องการ</div>';
            }
            ?>
        </main>
    </div>
</div>

<?php
// แสดง Footer
include(BASE_PATH . '/includes/footer.php');
?>