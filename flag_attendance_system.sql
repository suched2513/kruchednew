-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2025 at 06:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `flag_attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_details`
--

CREATE TABLE `attendance_details` (
  `detail_id` int(11) NOT NULL,
  `record_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('present','late','absent','leave') NOT NULL,
  `remark` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_details`
--

INSERT INTO `attendance_details` (`detail_id`, `record_id`, `student_id`, `status`, `remark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'present', NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(2, 1, 2, 'present', NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(3, 1, 3, 'present', NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(4, 2, 4, 'late', 'มาสาย 15 นาที', '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(5, 2, 5, 'present', NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(6, 2, 6, 'present', NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(10, 4, 1, 'present', '', '2025-02-25 02:59:31', '2025-02-25 03:11:55'),
(11, 4, 2, 'present', '', '2025-02-25 02:59:31', '2025-02-25 03:11:51'),
(12, 4, 3, 'present', NULL, '2025-02-25 02:59:31', '2025-02-25 02:59:31'),
(13, 5, 4, 'present', NULL, '2025-02-25 03:03:49', '2025-02-25 03:03:49'),
(14, 5, 5, 'present', NULL, '2025-02-25 03:03:49', '2025-02-25 03:03:49'),
(15, 5, 6, 'present', NULL, '2025-02-25 03:03:49', '2025-02-25 03:03:49'),
(16, 6, 4, 'present', NULL, '2025-02-25 03:05:19', '2025-02-25 03:05:19'),
(17, 6, 5, 'late', '', '2025-02-25 03:05:19', '2025-02-25 03:08:21'),
(18, 6, 6, 'present', NULL, '2025-02-25 03:05:19', '2025-02-25 03:05:19'),
(20, 8, 8, 'present', '', '2025-02-25 07:07:59', '2025-02-25 07:09:27'),
(21, 9, 8, 'late', '', '2025-02-26 05:10:39', '2025-02-26 05:11:11'),
(22, 9, 9, 'present', '', '2025-02-26 05:10:39', '2025-02-26 05:11:38'),
(23, 10, 1, 'present', NULL, '2025-02-26 05:13:12', '2025-02-26 05:13:12'),
(24, 10, 2, 'present', NULL, '2025-02-26 05:13:12', '2025-02-26 05:13:12'),
(25, 10, 3, 'present', NULL, '2025-02-26 05:13:12', '2025-02-26 05:13:12'),
(26, 10, 7, 'leave', '', '2025-02-26 05:13:12', '2025-02-26 05:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `record_id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `recorded_by` int(11) NOT NULL,
  `note` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance_records`
--

INSERT INTO `attendance_records` (`record_id`, `record_date`, `classroom_id`, `recorded_by`, `note`, `created_at`, `updated_at`) VALUES
(1, '2025-02-24', 1, 2, 'วันจันทร์ เข้าแถวปกติ', '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(2, '2025-02-24', 2, 2, 'วันจันทร์ มีนักเรียนมาสาย 1 คน', '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(4, '2025-02-25', 1, 1, '', '2025-02-25 02:59:31', '2025-02-25 02:59:31'),
(5, '2025-02-25', 2, 1, '', '2025-02-25 03:03:49', '2025-02-25 03:03:49'),
(6, '2025-02-21', 2, 1, '', '2025-02-25 03:05:19', '2025-02-25 03:05:19'),
(8, '2025-02-25', 4, 1, '', '2025-02-25 07:07:59', '2025-02-25 07:07:59'),
(9, '2025-02-26', 4, 1, '', '2025-02-26 05:10:39', '2025-02-26 05:10:39'),
(10, '2025-02-26', 1, 2, '', '2025-02-26 05:13:12', '2025-02-26 05:13:12');

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `classroom_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`classroom_id`, `class_name`, `grade`, `teacher_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '1/1', 'ม.1', 2, 1, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(2, '1/2', 'ม.1', 2, 1, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(3, '2/1', 'ม.2', 2, 1, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(4, '1', 'ป.3', 4, 1, '2025-02-25 07:06:04', '2025-02-25 07:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_code` varchar(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `classroom_id` int(11) DEFAULT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `birth_date` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `parent_phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_code`, `first_name`, `last_name`, `classroom_id`, `gender`, `birth_date`, `address`, `parent_phone`, `created_at`, `updated_at`) VALUES
(1, 'S001', 'วรชัย', 'รักเรียน', 1, 'male', '2010-05-15', '', '', '2025-02-25 02:20:36', '2025-02-25 03:00:14'),
(2, 'S002', 'วรรณา', 'ใจดี', 1, 'female', '2010-03-20', NULL, NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(3, 'S003', 'สมชาย', 'มานี', 1, 'male', '2010-06-10', '', '', '2025-02-25 02:20:36', '2025-02-25 03:00:26'),
(4, 'S004', 'สมหญิง', 'เก่งกล้า', 2, 'female', '2010-07-25', NULL, NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(5, 'S005', 'ภูมิ', 'สมบูรณ์', 2, 'male', '2010-09-12', NULL, NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(6, 'S006', 'มินตรา', 'พัฒนา', 2, 'female', '2010-11-05', NULL, NULL, '2025-02-25 02:20:36', '2025-02-25 02:20:36'),
(7, 'S007', 'สมปอง', 'ใจงาม', 1, 'male', '2025-02-25', '91 บ้านขี้นาคน้อย ม.7', '0956029737', '2025-02-25 07:05:04', '2025-02-25 07:05:14'),
(8, 'S008', 'สมหลาย', 'ใจเด่น', 4, 'male', '2025-02-24', '91 บ้านขี้นาคน้อย ม.7', '0956029737', '2025-02-25 07:06:45', '2025-02-25 07:06:45'),
(9, 'S009', 'ด.ช.สมปอง', 'ใจดำ', 4, 'male', '2025-02-20', '91 บ้านขี้นาคน้อย ม.7', '0956029737', '2025-02-26 05:03:43', '2025-02-26 05:03:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `role` enum('admin','teacher','staff') NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `full_name`, `role`, `email`, `phone`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$Uumo9jLcX2SAHcTOoGHHaOSRim28LoDDPkwm88L7ZJ43gcgF5.iTG', 'ผู้ดูแลระบบ', 'admin', 'admin@school.ac.th', '0956029737', '2025-02-25 02:20:36', '2025-02-25 02:31:33'),
(2, 'teacher1', '$2y$10$nBZ1T6htEifZSHrKbz.Eye6tIWdAruyr8j4hBr6OS2xqES8PiJmvq', 'อาจารย์วิรัตน์  ชัดเจน', 'teacher', 'teacher1@school.ac.th', '0956029738', '2025-02-25 02:20:36', '2025-02-26 05:10:17'),
(3, 'staff1', '$2y$10$TOSXPo2ZSnfh1zYxjfPrrOr/7z3dEdvCGp3gaDbYCVqKOufBiKe4u', 'เจ้าหน้าที่ทดสอบ', 'staff', 'staff1@school.ac.th', '0956029739', '2025-02-25 02:20:36', '2025-02-25 03:15:03'),
(4, 'teacher2', '$2y$10$HRrYPLMHusFzAEcZZuFXxuTWonG7889FJ1YmkJeCiy0oq86xkuwhC', 'ครูสมชาย  ใจดี', 'teacher', 'wirat@gmail.com', '0956029737', '2025-02-25 06:53:03', '2025-02-25 07:04:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD UNIQUE KEY `record_id` (`record_id`,`student_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`record_id`),
  ADD UNIQUE KEY `record_date` (`record_date`,`classroom_id`),
  ADD KEY `classroom_id` (`classroom_id`),
  ADD KEY `recorded_by` (`recorded_by`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`classroom_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `student_code` (`student_code`),
  ADD KEY `classroom_id` (`classroom_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_details`
--
ALTER TABLE `attendance_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `classroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_details`
--
ALTER TABLE `attendance_details`
  ADD CONSTRAINT `attendance_details_ibfk_1` FOREIGN KEY (`record_id`) REFERENCES `attendance_records` (`record_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_details_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`);

--
-- Constraints for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD CONSTRAINT `attendance_records_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`classroom_id`),
  ADD CONSTRAINT `attendance_records_ibfk_2` FOREIGN KEY (`recorded_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD CONSTRAINT `classrooms_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`classroom_id`) REFERENCES `classrooms` (`classroom_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
