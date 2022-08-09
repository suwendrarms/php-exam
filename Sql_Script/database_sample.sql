-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 09, 2022 at 11:17 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Amoxicillin 250mg', '23', 1, '2022-08-08 18:37:50', '2022-08-08 18:41:00'),
(2, 'Paracetamol 500mg', '24', 1, '2022-08-08 18:56:36', '2022-08-08 18:56:36');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_08_05_000000_create_users_table', 1),
(3, '2022_08_05_090644_create_notifications_table', 1),
(4, '2022_08_05_100000_create_password_resets_table', 1),
(6, '2022_08_05_032113_create_permission_tables', 2),
(7, '2022_08_08_130318_create_prescriptions_table', 3),
(8, '2022_08_08_130436_create_prescription_images_table', 3),
(9, '2022_08_08_235431_create_drugs_table', 4),
(12, '2022_08_09_010808_create_quotations_table', 5),
(13, '2022_08_09_010835_create_quotation_rows_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_permissions`
--

INSERT INTO `model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 1),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(2, 'App\\User', 2),
(3, 'App\\User', 1),
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type_id`, `type`, `success`, `status`, `created_at`, `updated_at`) VALUES
(2, 6, 'user_accept', 0, NULL, '2022-08-09 04:12:12', '2022-08-09 04:12:12'),
(3, 8, 'user_accept', 0, NULL, '2022-08-09 09:16:24', '2022-08-09 09:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, '2022-08-08 05:27:30', '2022-08-08 05:27:30'),
(2, 'User', 'web', NULL, '2022-08-08 21:48:38', '2022-08-08 21:48:38'),
(3, 'Pharmacy', 'web', NULL, '2022-08-08 21:48:49', '2022-08-08 21:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `user_id`, `note`, `delivery_address`, `start_time`, `end_time`, `status`, `created_at`, `updated_at`) VALUES
(14, 2, 'test note 1', '123/3,colombo', '02:02:00', '01:01:00', 2, '2022-08-09 09:12:11', '2022-08-09 09:16:24'),
(15, 2, 'test note 2', '234/c,colombo', '01:02:00', '03:03:00', 1, '2022-08-09 09:15:18', '2022-08-09 09:17:26'),
(16, 2, 'test note 3', '234/c,colombo', '02:01:00', '04:03:00', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `prescription_images`
--

CREATE TABLE `prescription_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `prescription_id` int(10) UNSIGNED NOT NULL,
  `url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prescription_images`
--

INSERT INTO `prescription_images` (`id`, `prescription_id`, `url`, `status`, `created_at`, `updated_at`) VALUES
(15, 14, '/images/products/1660036331_5579.jpg', 0, '2022-08-09 09:12:11', '2022-08-09 09:12:11'),
(16, 14, '/images/products/1660036331_5159.jpg', 0, '2022-08-09 09:12:11', '2022-08-09 09:12:11'),
(17, 14, '/images/products/1660036331_3332.jpg', 0, '2022-08-09 09:12:11', '2022-08-09 09:12:11'),
(18, 14, '/images/products/1660036331_9929.jpg', 0, '2022-08-09 09:12:11', '2022-08-09 09:12:11'),
(19, 14, '/images/products/1660036331_1864.jpg', 0, '2022-08-09 09:12:11', '2022-08-09 09:12:11'),
(20, 15, '/images/products/1660036518_1202.jpg', 0, '2022-08-09 09:15:18', '2022-08-09 09:15:18'),
(21, 15, '/images/products/1660036518_2331.jpg', 0, '2022-08-09 09:15:18', '2022-08-09 09:15:18'),
(22, 15, '/images/products/1660036518_5412.jpg', 0, '2022-08-09 09:15:18', '2022-08-09 09:15:18'),
(23, 15, '/images/products/1660036518_3549.jpg', 0, '2022-08-09 09:15:18', '2022-08-09 09:15:18'),
(24, 16, '/images/products/1660036567_2756.jpg', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07'),
(25, 16, '/images/products/1660036567_1982.jpg', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07'),
(26, 16, '/images/products/1660036567_2551.jpg', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07'),
(27, 16, '/images/products/1660036567_8461.jpg', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07'),
(28, 16, '/images/products/1660036567_7605.jpg', 0, '2022-08-09 09:16:07', '2022-08-09 09:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `quotations`
--

CREATE TABLE `quotations` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `prescription_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotations`
--

INSERT INTO `quotations` (`id`, `user_id`, `prescription_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(8, 2, 14, 238, 2, '2022-08-09 09:13:14', '2022-08-09 09:16:24'),
(9, 2, 15, 1387, 1, '2022-08-09 09:17:11', '2022-08-09 09:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_rows`
--

CREATE TABLE `quotation_rows` (
  `id` int(10) UNSIGNED NOT NULL,
  `quotation_id` int(10) UNSIGNED NOT NULL,
  `drug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qtr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_rows`
--

INSERT INTO `quotation_rows` (`id`, `quotation_id`, `drug`, `qtr`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(16, 8, 'Amoxicillin 250mg', '23 x 2', 46, 0, '2022-08-09 09:13:14', '2022-08-09 09:13:14'),
(17, 8, 'Paracetamol 500mg', '24 x 8', 192, 0, '2022-08-09 09:13:30', '2022-08-09 09:13:30'),
(18, 9, 'Amoxicillin 250mg', '23 x 5', 115, 0, '2022-08-09 09:17:11', '2022-08-09 09:17:11'),
(19, 9, 'Paracetamol 500mg', '24 x 53', 1272, 0, '2022-08-09 09:17:23', '2022-08-09 09:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delete_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `delete_status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', NULL, '2022-08-08 06:32:44', '2022-08-08 06:32:44'),
(2, 'User', 'web', NULL, '2022-08-08 21:49:47', '2022-08-08 21:49:47'),
(3, 'Pharmacy', 'web', NULL, '2022-08-08 21:49:58', '2022-08-08 21:49:58');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `user_type` int(11) NOT NULL DEFAULT 0,
  `dob` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `phone_number`, `status`, `user_type`, `dob`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'suwendra', 'suwendra50@gmail.com', '$2y$10$k1.UpQ5c8Nn.lf8ivzhe.O9mp0ixjKWlWtEX3UfZyHMN7NXi4Ul6W', '143/1,uvaparanagama', '071 993 5386', 1, 0, '1993-03-08', 'NKU6Ft6BkiKdn8hPcUuX2mK8JrpSHspww5vmQvPaGlm32L6HAzyeckaBNH5y', '2022-08-08 03:31:06', '2022-08-08 03:31:06'),
(2, 'user', 'suwendrarms@gmail.com', '$2y$10$glVGsFpN5SPJY/VkzW8eMOhdCY2f9ha4Ixs2ave1zir5kMxfa.eBC', '123/3,colombo', '078 445 7634', 1, 0, '1994-03-04', 'Z02hUQkbfP8YB0AOkEfYk96cKH1PMBb2Mzm0PDH0ATrZQTWumcu3Gug2ehlO', '2022-08-08 21:46:05', '2022-08-08 21:46:05'),
(3, 'Pharmacy', 'pharmacy@gmail.com', '$2y$10$pwswqR.FYVmBnQHxvPQ.LeMH5bP.Ta75PNUVNlq5M.65jyXoe2Iw.', '345c/3,dankotuwa', '076 543 2345', 1, 0, '1887-03-04', 'lZZvHNhOZMc14kDOqDKysjCeeEv3OGHVyXk6YnvkiSooUmn4IMgFmhW37Zgh', '2022-08-08 21:48:01', '2022-08-08 21:48:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescriptions_user_id_foreign` (`user_id`);

--
-- Indexes for table `prescription_images`
--
ALTER TABLE `prescription_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prescription_images_prescription_id_foreign` (`prescription_id`);

--
-- Indexes for table `quotations`
--
ALTER TABLE `quotations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotations_prescription_id_foreign` (`prescription_id`);

--
-- Indexes for table `quotation_rows`
--
ALTER TABLE `quotation_rows`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotation_rows_quotation_id_foreign` (`quotation_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `prescription_images`
--
ALTER TABLE `prescription_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `quotations`
--
ALTER TABLE `quotations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quotation_rows`
--
ALTER TABLE `quotation_rows`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `prescriptions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription_images`
--
ALTER TABLE `prescription_images`
  ADD CONSTRAINT `prescription_images_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotations`
--
ALTER TABLE `quotations`
  ADD CONSTRAINT `quotations_prescription_id_foreign` FOREIGN KEY (`prescription_id`) REFERENCES `prescriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotation_rows`
--
ALTER TABLE `quotation_rows`
  ADD CONSTRAINT `quotation_rows_quotation_id_foreign` FOREIGN KEY (`quotation_id`) REFERENCES `quotations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
