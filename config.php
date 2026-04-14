<?php

// ป้องกันการเข้าถึงไฟล์โดยตรง
if (!defined('BASE_PATH')) {
    exit('No direct script access allowed');
}

// ตั้งค่าการแสดงข้อผิดพลาด (ให้ปิดในโหมด production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ตั้งค่า timezone
date_default_timezone_set('Asia/Bangkok');

// ข้อมูลการเชื่อมต่อกับฐานข้อมูล
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'flag_attendance_system');
define('DB_CHARSET', 'utf8');

// เชื่อมต่อกับฐานข้อมูลด้วย PDO
try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
} catch (PDOException $e) {
    // บันทึกข้อผิดพลาดแทนที่จะแสดงให้ผู้ใช้เห็น
    error_log("Database Connection Error: " . $e->getMessage());
    die("ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้ กรุณาติดต่อผู้ดูแลระบบ");
}

// ฟังก์ชั่นสำหรับทำความสะอาดข้อมูล
function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

// ฟังก์ชั่นสำหรับตรวจสอบการล็อกอิน
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// ฟังก์ชั่นสำหรับตรวจสอบสิทธิ์ของผู้ใช้
function checkRole($role) {
    if (!isLoggedIn()) {
        return false;
    }
    if (is_array($role)) {
        return in_array($_SESSION['role'], $role);
    } else {
        return $_SESSION['role'] === $role;
    }
}

// ฟังก์ชั่นสำหรับการเปลี่ยนเส้นทาง
function redirect($url) {
    header("Location: $url");
    exit();
}

// ฟังก์ชั่นสำหรับแสดงข้อความแจ้งเตือน
function setAlert($message, $type = 'success') {
    $_SESSION['alert'] = [
        'message' => $message,
        'type' => $type
    ];
}

// ฟังก์ชั่นสำหรับแสดงข้อความแจ้งเตือน
function displayAlert() {
    if (isset($_SESSION['alert'])) {
        $alert = $_SESSION['alert'];
        echo '<div class="alert alert-' . $alert['type'] . ' alert-dismissible fade show" role="alert">';
        echo $alert['message'];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        unset($_SESSION['alert']);
    }
}

// ฟังก์ชั่นแปลงวันที่เป็นรูปแบบไทย
function thaiDate($date) {
    $thai_months = [
        "01" => "มกราคม", "02" => "กุมภาพันธ์", "03" => "มีนาคม",
        "04" => "เมษายน", "05" => "พฤษภาคม", "06" => "มิถุนายน",
        "07" => "กรกฎาคม", "08" => "สิงหาคม", "09" => "กันยายน",
        "10" => "ตุลาคม", "11" => "พฤศจิกายน", "12" => "ธันวาคม"
    ];
    
    $date_parts = explode("-", $date);
    $year = $date_parts[0] + 543; // แปลงเป็น พ.ศ.
    $month = $thai_months[$date_parts[1]];
    $day = (int)$date_parts[2];
    
    return "$day $month $year";
}