<?php
// เริ่มต้น Session
session_start();

// ล้างข้อมูล Session
$_SESSION = array();

// ลบ Cookie ของ Session (ถ้ามี)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// ทำลาย Session
session_destroy();

// เปลี่ยนเส้นทางไปยังหน้าล็อกอิน
header("Location: login.php");
exit;