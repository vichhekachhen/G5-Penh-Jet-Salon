-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2024 at 05:37 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g5_penh_jet_salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `lat` decimal(17,15) NOT NULL,
  `lng` decimal(18,15) NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `city`, `lat`, `lng`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'AGM_Tractor_Machinery156, St 2002, Phnom Penh, Cambodia', 11.556552100000000, 104.880500600000000, 3, '2024-07-22 05:19:35', '2024-07-22 05:19:35'),
(2, '89 Street 103, Phnom Penh, Cambodia', 11.549342767968273, 104.882420968786600, 3, '2024-07-22 05:25:26', '2024-07-22 05:25:26'),
(3, 'Pursat Province, Cambodia', 12.272095600000000, 103.728916700000000, 1, '2024-07-22 05:27:33', '2024-07-22 05:27:33'),
(4, 'Siem Reap, Cambodia', 13.363253300000000, 103.856403000000000, 2, '2024-07-22 06:16:36', '2024-07-22 06:16:36'),
(6, 'GVXP+X95, Phnom Penh, Cambodia', 11.549847324579575, 104.885982942358380, 8, '2024-07-23 20:05:32', '2024-07-23 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_price` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `pay` decimal(8,2) DEFAULT NULL,
  `indebte` decimal(8,2) DEFAULT NULL,
  `status` enum('done','undone') NOT NULL DEFAULT 'undone',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `store_id`, `total_price`, `date`, `time`, `pay`, `indebte`, `status`, `created_at`, `updated_at`) VALUES
(1, 9, 5, 2.00, '2024-07-24', '11:00:00', 2.00, NULL, 'done', '2024-07-22 06:37:16', '2024-07-22 06:37:16'),
(2, 9, 2, 3.00, '2024-07-26', '20:46:00', 6.00, -3.00, 'undone', '2024-07-22 06:44:54', '2024-07-22 06:44:54'),
(3, 9, 1, 8.00, '2024-07-22', '11:49:00', 8.00, NULL, 'done', '2024-07-22 06:46:19', '2024-07-22 06:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `booking_services`
--

CREATE TABLE `booking_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_services`
--

INSERT INTO `booking_services` (`id`, `booking_id`, `service_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2024-07-22 06:37:16', '2024-07-22 06:37:16'),
(2, 2, 3, '2024-07-22 06:44:54', '2024-07-22 06:44:54'),
(3, 3, 1, '2024-07-22 06:46:19', '2024-07-22 06:46:19'),
(4, 3, 2, '2024-07-22 06:46:19', '2024-07-22 06:46:19');

-- --------------------------------------------------------

--
-- Table structure for table `card_items`
--

CREATE TABLE `card_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `card_items`
--

INSERT INTO `card_items` (`id`, `user_id`, `service_id`, `quantity`, `created_at`, `updated_at`) VALUES
(20, 2, 2, 1, '2024-07-23 20:15:49', '2024-07-23 20:15:49'),
(21, 2, 1, 1, '2024-07-23 20:15:52', '2024-07-23 20:15:52');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Man', '2024-07-22 05:16:37', '2024-07-22 05:16:37'),
(2, 'Woman', '2024-07-22 05:16:45', '2024-07-22 05:16:45'),
(3, 'Product', '2024-07-22 05:16:54', '2024-07-22 05:16:54');

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` char(36) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `favorite_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_favorites`
--

INSERT INTO `ch_favorites` (`id`, `user_id`, `favorite_id`, `created_at`, `updated_at`) VALUES
('0f0795b7-1c62-4871-8e00-5d9d3d0a9a0f', 1, 4, '2024-07-22 20:58:40', '2024-07-22 20:58:40'),
('3179fbfd-9087-47a9-9624-beef4e13a8cb', 7, 1, '2024-07-22 06:17:44', '2024-07-22 06:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` char(36) NOT NULL,
  `from_id` bigint(20) NOT NULL,
  `to_id` bigint(20) NOT NULL,
  `body` varchar(5000) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ch_messages`
--

INSERT INTO `ch_messages` (`id`, `from_id`, `to_id`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
('02c53f48-166b-4809-b7ee-7eb535832d48', 4, 1, 'Hello', NULL, 1, '2024-07-22 20:19:18', '2024-07-22 20:20:42'),
('29455bb9-6d44-4f69-b2c8-dcb875ffac58', 1, 4, 'please pay !', NULL, 0, '2024-07-22 20:58:56', '2024-07-22 20:58:56'),
('3cbced7a-8f30-417d-bbdc-c170cfff40a9', 7, 1, '', '{\"new_name\":\"bb40ec12-880a-44da-a4ea-d48e0be9c7dc.jpg\",\"old_name\":\"women (14).jpg\"}', 0, '2024-07-22 06:18:24', '2024-07-22 06:18:24'),
('e0060de0-bb62-489a-8b1a-95a06ab4b0fc', 7, 7, 'me', NULL, 0, '2024-07-22 06:17:34', '2024-07-22 06:17:34'),
('f4f1b4f6-95a6-45b6-a3a5-ddb8706fdf96', 7, 1, 'Dear bong, I would like to ask some question.', NULL, 0, '2024-07-22 06:18:13', '2024-07-22 06:18:13');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `service_id`, `user_id`, `text`, `image`, `created_at`, `updated_at`) VALUES
(1, 7, 9, 'thanks for giving good service', NULL, '2024-07-22 06:36:14', '2024-07-22 06:36:14'),
(2, 3, 9, 'good', NULL, '2024-07-22 06:41:28', '2024-07-22 06:41:28'),
(3, 1, 9, 'look good', NULL, '2024-07-22 17:32:45', '2024-07-22 17:32:45'),
(5, 2, 9, 'good del', NULL, '2024-07-22 17:33:21', '2024-07-22 17:33:21'),
(6, 1, 9, 'Best', NULL, '2024-07-22 19:08:59', '2024-07-22 19:08:59'),
(7, 1, 9, 'good\r\n', NULL, '2024-07-23 06:59:53', '2024-07-23 06:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `frontusers`
--

CREATE TABLE `frontusers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `isLike` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `service_id`, `isLike`, `created_at`, `updated_at`) VALUES
(1, 9, 7, 1, '2024-07-22 06:35:58', '2024-07-22 06:35:58'),
(2, 9, 3, 1, '2024-07-22 06:40:48', '2024-07-22 06:40:48'),
(3, 9, 2, 1, '2024-07-22 06:48:48', '2024-07-22 06:48:48'),
(5, 9, 1, 1, '2024-07-22 20:27:59', '2024-07-22 20:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `mailsettings`
--

CREATE TABLE `mailsettings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_transport` varchar(255) NOT NULL,
  `mail_host` varchar(255) NOT NULL,
  `mail_port` varchar(255) NOT NULL,
  `mail_username` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_encryption` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mailsettings`
--

INSERT INTO `mailsettings` (`id`, `mail_transport`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_encryption`, `mail_from`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'smtp.gmail.com', '465', 'dggihhg@gmail.com', 'kkbu vjmd ppme gpnx', 'tls', 'dggihhg@gmail.com', '2024-07-22 05:08:46', '2024-07-23 04:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_24_052122_create_frontusers_table', 1),
(6, '2021_10_24_055150_create_permission_tables', 1),
(7, '2021_10_31_101342_create_posts_table', 1),
(8, '2022_05_01_060321_add_profile_to_users_table', 1),
(9, '2022_05_19_122208_create_mailsettings_table', 1),
(10, '2024_06_21_015154_create_stores_table', 1),
(11, '2024_06_21_022347_add_store_to_users_table', 1),
(12, '2024_06_21_031219_create_provinces_table', 1),
(13, '2024_06_25_005215_add_image_to_provinces_table', 1),
(14, '2024_06_27_030050_create_categories_table', 1),
(15, '2024_06_27_030354_create_services_table', 1),
(16, '2024_06_28_061201_create_slideshows_table', 1),
(17, '2024_07_03_165701_create_cart_items_table', 1),
(18, '2024_07_03_174619_create_bookings_table', 1),
(19, '2024_07_03_174802_create_booking_services_table', 1),
(20, '2024_07_05_202736_create_comments_table', 1),
(21, '2024_07_05_202747_create_replies_table', 1),
(22, '2024_07_08_103202_create_q_rcodes_table', 1),
(23, '2024_07_11_024110_create_payments_table', 1),
(24, '2024_07_15_084751_create_addresses_table', 1),
(25, '2024_07_16_091709_create_likes_table', 1),
(26, '2024_07_19_999999_add_active_status_to_users', 1),
(27, '2024_07_19_999999_add_avatar_to_users', 1),
(28, '2024_07_19_999999_add_dark_mode_to_users', 1),
(29, '2024_07_19_999999_add_messenger_color_to_users', 1),
(30, '2024_07_19_999999_create_chatify_favorites_table', 1),
(31, '2024_07_19_999999_create_chatify_messages_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 9),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 4),
(3, 'App\\Models\\User', 5),
(3, 'App\\Models\\User', 6),
(3, 'App\\Models\\User', 7),
(3, 'App\\Models\\User', 8),
(3, 'App\\Models\\User', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('pssamsung04@gmail.com', '$2y$10$qQPwH0PoPTdVGz04xxJKRuNOkDDEh5CexRnZGKeyDU4WTQXDMOvgO', '2024-07-23 06:37:56');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `currency` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `status` enum('success','incomplete') NOT NULL DEFAULT 'incomplete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `owner_id`, `amount`, `currency`, `payment_method`, `date`, `zip_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 3.80, 'USD', '4242 4242 4242 4242', NULL, '12123', 'success', '2024-07-22 20:04:55', '2024-07-22 20:04:55');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Post access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(2, 'Post edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(3, 'Post create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(4, 'Post delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(5, 'Role access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(6, 'Role edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(7, 'Role create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(8, 'Role delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(9, 'User access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(10, 'User edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(11, 'User create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(12, 'User delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(13, 'Province access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(14, 'Province edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(15, 'Province create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(16, 'Province delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(17, 'Category access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(18, 'Category edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(19, 'Category create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(20, 'Category delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(21, 'Permission access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(22, 'Permission edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(23, 'Permission create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(24, 'Permission delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(25, 'Slideshow access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(26, 'Slideshow edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(27, 'Slideshow create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(28, 'Slideshow delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(29, 'Mail access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(30, 'Mail edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(31, 'Service access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(32, 'Service edit', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(33, 'Service create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(34, 'Service delete', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(35, 'Service show', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(36, 'Payment access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(37, 'Payment create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(38, 'Booking access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(39, 'Booking create', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(40, 'Booking show', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(41, 'Schedule access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(42, 'Schedule show', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(43, 'Report access', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 9, 'authToken', '3adc3e80bedadeeb6937983abe883ab2e21d00715741ce20b900fd318652412a', '[\"*\"]', NULL, NULL, '2024-07-22 06:31:37', '2024-07-22 06:31:37'),
(3, 'App\\Models\\User', 9, 'auth_token', '70795322d99bc4405e0664d33cf902b5307c5668e2dc72c0ed718546d0467b77', '[\"*\"]', '2024-07-23 20:06:26', NULL, '2024-07-22 23:41:20', '2024-07-23 20:06:26'),
(5, 'App\\Models\\User', 9, 'auth_token', '7ab9ee7c31cc484c1382913e8ca0296d424bbb918a6b9f2f5a6e25077e8d6e5c', '[\"*\"]', '2024-07-23 20:24:43', NULL, '2024-07-23 20:17:29', '2024-07-23 20:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `user_id`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Voluptatibus impedit earum sapiente animi. Modi in sed inventore qui ducimus provident. Nemo officia accusantium non architecto. Hic blanditiis nihil eos ipsam aut et.', 'Est veritatis qui enim nisi sapiente. Recusandae dolorem nobis ullam nemo facilis officia rem dolores. Quasi aut deleniti esse. Ipsa voluptatem quia eum eum laborum.', 3, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(2, 'Eius tenetur tempore ratione molestiae. Et non voluptas in ut earum. Dolores veritatis aut ad tempore in rerum. Praesentium labore et qui dolores dolorem minima.', 'Officia sit aut rerum minus. Minus eum consequatur pariatur nobis modi alias quis ut. Odit ipsam facilis aliquid sequi. Iure sapiente quaerat et magnam.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(3, 'Harum dolorem voluptatem enim. Voluptatem ipsa sequi et. Sequi vel adipisci quae blanditiis debitis.', 'Ratione corporis id et esse quia aspernatur. Ex aut esse aut distinctio qui. Dolorem aut adipisci quo.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(4, 'Est molestiae commodi minima ut dolorem. Sint error voluptate nemo voluptas. Praesentium quod dignissimos ratione repellendus. Sed dolorem cum adipisci eius neque sint quaerat.', 'Cum id voluptatem quos consequatur. Dolorem eaque rerum modi quia. Quam provident qui consequatur ipsum amet qui et. Numquam officiis expedita soluta eveniet et magni debitis incidunt.', 3, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(5, 'Culpa voluptatem rerum et labore eaque similique vero. Soluta quibusdam doloremque vero. Velit sed exercitationem omnis. Similique provident sed dolor animi ad.', 'Saepe quis est illum omnis quisquam. Repellendus ea quidem est. Quam voluptatem perspiciatis ducimus laboriosam et consequatur.', 1, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(6, 'Iure et perferendis deleniti laborum cupiditate. Quia odit itaque dicta molestiae exercitationem ut perferendis.', 'Provident debitis suscipit corrupti nulla voluptates voluptates amet est. Repudiandae ex eligendi enim corrupti. Id animi blanditiis quia eveniet voluptatem soluta officiis. Non sed ipsa ad voluptatem labore.', 3, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(7, 'Sed dolor sint aut. Corporis laudantium provident rem rem facere et nulla. Et consequatur quas rerum id velit assumenda quis.', 'Ab commodi architecto sunt eius. Id in occaecati nisi pariatur qui minus quo. Veritatis rem cum ad.', 1, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(8, 'Distinctio nemo consequatur odit. Impedit nam quam dignissimos iusto. In voluptate temporibus maxime voluptatem omnis assumenda. Iste culpa iure mollitia odit accusamus.', 'Consequatur laborum ullam placeat repudiandae consectetur quia. Voluptatem quidem rerum qui dolores repellendus aliquam. Dolores est et esse aperiam.', 1, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(9, 'Doloremque consequuntur vel et dolorem ipsa odio. Accusamus accusamus tenetur et harum magnam nostrum. Reiciendis accusamus excepturi aspernatur quis. Labore fugiat quaerat sit placeat sunt.', 'Qui sit molestiae id assumenda qui sunt consequatur. Et alias eum est illo nam. Non quo est sapiente dolorem ut incidunt.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(10, 'Autem dolore quis sint maxime sunt quaerat consequatur. Consectetur numquam autem nam corrupti. Consequatur nostrum est veritatis quo quaerat quia voluptatem. Commodi sint quos modi.', 'Fuga est nihil tempore a. Animi nobis nulla porro adipisci eveniet iure. Ipsam voluptas qui excepturi iste hic sint qui omnis. Est aut dolor earum quis quasi dolores sit. Nam sunt reiciendis ab vel voluptatibus quia et.', 3, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(11, 'Dolores maiores quidem perferendis illo. Rerum atque nemo natus assumenda voluptatem est sed ullam. Sapiente est aut eum magnam.', 'Et quis explicabo excepturi magnam. Vel voluptas reprehenderit minus. Voluptates minima quos dolorem sequi eum. Dolorem nobis quo enim quasi dolorem sed illum ut.', 3, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(12, 'Dolor velit quasi unde itaque quae. Odio iusto sunt quibusdam illo aut. Voluptatum minus sapiente labore nihil aspernatur temporibus placeat debitis. Ipsum aut suscipit id tempora.', 'Facilis iusto cum et aut. Est dolorem hic tenetur. Amet voluptas nesciunt omnis optio laboriosam eveniet qui numquam. Placeat et accusantium dolores debitis nobis fuga.', 1, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(13, 'Alias delectus nihil voluptates adipisci consequatur explicabo facilis. Sint ex sed fugiat excepturi tempore doloremque odit. Itaque quae assumenda cum sapiente dolores. Consequuntur ut odio et iure.', 'Aut delectus porro natus non aperiam harum quia. A sint excepturi aliquid et tempora. Delectus eaque odit accusamus reprehenderit blanditiis voluptas.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(14, 'Veniam delectus sunt et sit. Ea eos consectetur ut dolore voluptatem quo. Consequatur perspiciatis commodi possimus. Est iste ipsam voluptatibus ab provident quidem repudiandae.', 'Nihil consectetur quasi cumque error accusantium quibusdam quia. Odit beatae assumenda aut qui totam molestias. Est quia ut qui quia minima sed illo et.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(15, 'Facilis sint consequuntur asperiores magni natus cum nulla. Quos veniam et quos tempora. Porro repudiandae molestias et doloribus possimus ratione rerum.', 'Quam sint dolores saepe non cum in. Enim et voluptates qui qui. Quia nobis autem recusandae itaque ipsa.', 2, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(16, 'Adipisci optio velit ipsum quisquam. Aut qui est reprehenderit cumque ipsum quia ea. Aut voluptatem dolorem modi aut quo.', 'Laboriosam neque velit omnis enim. Molestiae officiis asperiores in voluptatem sed doloremque eligendi officia. Consectetur cumque officiis laudantium explicabo.', 2, 1, '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(17, 'Hic ipsa cumque ducimus earum explicabo. Deserunt et officia nisi officiis. Modi consequatur aliquid sint aut ullam et. Officia ipsam et fuga dolores excepturi est.', 'Est suscipit labore quo. In ab voluptatem qui dignissimos quos commodi voluptas. Sapiente minima consequuntur quo optio aut laboriosam quae vel.', 1, 0, '2024-07-22 05:08:46', '2024-07-22 05:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province_name`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Pursat', '2024-07-22 05:15:58', '2024-07-22 05:15:58', '/storage/ProvinceImages/Cha0V0j3gVVgmaq4fUOY5VhWnwuwZgvtVUyrftba.png'),
(2, 'Siem Reap', '2024-07-22 05:16:13', '2024-07-22 05:16:13', '/storage/ProvinceImages/D6V5IKya36L1kTQkVUcoRmN08n8B8gRIgpYgdzKH.jpg'),
(3, 'Phnom Penh', '2024-07-22 05:16:27', '2024-07-22 05:16:27', '/storage/ProvinceImages/EHDeG5AJRFrjzol8Jibf9LgxGjyAKnSXZeGZ62PU.jpg'),
(8, 'Prey Veng', '2024-07-23 20:03:18', '2024-07-23 20:03:18', '/storage/ProvinceImages/71ra3McLBsNLbqhwJ3829npgLuhRxQev88HpAisw.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `q_rcodes`
--

CREATE TABLE `q_rcodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `q_rcodes`
--

INSERT INTO `q_rcodes` (`id`, `qr_code`, `store_id`, `created_at`, `updated_at`) VALUES
(1, '/storage/QRImages/UEf2rZdam5EHm7I5Fw0ImDq7kf0SwI4GAFIYRqdF.png', 1, '2024-07-22 05:19:35', '2024-07-22 05:19:35'),
(2, '/storage/QRImages/zZiXTntrdfRSjn1yJSGC1Qoc9FBcCiKeVEVHpBcu.png', 2, '2024-07-22 05:25:26', '2024-07-22 05:25:26'),
(3, '/storage/QRImages/xy7rAsIVdSeeAfRHy7agNRoaWDiQWTt5Kfi3zAtL.jpg', 3, '2024-07-22 05:27:33', '2024-07-22 05:27:33'),
(4, '/storage/QRImages/XnNQgTm95zVo6ECsHFWUmqOlDVTXHtl7M1SETfPF.jpg', 4, '2024-07-22 06:16:36', '2024-07-22 06:16:36'),
(5, '/storage/QRImages/rYBMZ5udXHceckBJP9Ei58trOsOiLjLQJpJoovyG.jpg', 5, '2024-07-22 06:28:25', '2024-07-22 06:28:25'),
(6, '/storage/QRImages/XCzf9sJmBRLMqJ8SlwbBVa6DGf8uy1nszq2674SC.png', 6, '2024-07-23 20:05:32', '2024-07-23 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `images` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `owner_id`, `text`, `images`, `created_at`, `updated_at`) VALUES
(7, 6, 4, 'thank\r\n', NULL, '2024-07-23 02:38:31', '2024-07-23 02:38:31'),
(8, 6, 4, 'good', NULL, '2024-07-23 02:38:43', '2024-07-23 02:38:43'),
(9, 3, 4, 'good', NULL, '2024-07-23 02:43:34', '2024-07-23 02:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(2, 'user', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46'),
(3, 'owner', 'web', '2024-07-22 05:08:46', '2024-07-22 05:08:46');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(13, 3),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(17, 3),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 3),
(32, 3),
(33, 3),
(34, 3),
(35, 3),
(36, 1),
(37, 3),
(38, 3),
(39, 1),
(40, 1),
(40, 3),
(41, 3),
(42, 1),
(42, 3),
(43, 3);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `duration` int(11) NOT NULL,
  `discount` decimal(8,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `store_id`, `category_id`, `service_name`, `description`, `price`, `duration`, `discount`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Nail treatment', 'Nail treatment', 3.00, 30, 1.00, '/storage/SlideshowImages/eKaFz2QRXMmlejWx6K9m0xMlz6luoqOwnxYIYpzf.jpg', '2024-07-22 05:21:08', '2024-07-22 05:21:08'),
(2, 1, 2, 'Hair style', NULL, 5.00, 50, NULL, '/storage/SlideshowImages/p5JEbzmUQhdFFWsp64xdjckEmDkqNJXYQzzPTiHi.jpg', '2024-07-22 05:21:48', '2024-07-22 05:21:48'),
(3, 2, 1, 'Hire cut', 'for u', 3.00, 35, NULL, '/storage/SlideshowImages/A3OgjSeCwUQ7L6fqXlEhOlTOfllmrle376wOKuux.jpg', '2024-07-22 05:26:09', '2024-07-22 05:26:09'),
(4, 3, 1, 'Hire cut', 'good service', 3.00, 60, NULL, '/storage/SlideshowImages/ChJyn6Z53UxBIT0erV6coEpQhuqlgM4LXUY4rINU.jpg', '2024-07-22 05:28:48', '2024-07-22 05:28:48'),
(5, 4, 1, 'Curly hair', 'Aut quis cillum quis', 9.00, 70, 1.00, '/storage/SlideshowImages/FwGMst8zRZoCvrw2w52M9ntDzBq76YV7evgtyrXy.jpg', '2024-07-22 06:17:09', '2024-07-22 06:17:09'),
(6, 4, 3, 'Bob hair', 'Voluptatibus non qui', 6.00, 90, NULL, '/storage/SlideshowImages/9TqAE7opFPGyHKxHJlTpnawwp0VL69ef6B38Vpn3.jpg', '2024-07-22 06:22:33', '2024-07-22 06:22:33'),
(7, 5, 1, 'Hire cut', 'good time with me', 2.00, 30, NULL, '/storage/SlideshowImages/D1aUId3TKuURcXGqbjtto99JnBfuvZQNxUAoUF3w.jpg', '2024-07-22 06:29:02', '2024-07-22 06:29:02'),
(8, 1, 3, 'Hair cut', 'Et quisquam laboris', 3.00, 90, NULL, '/storage/SlideshowImages/VHeGKdn6WzdtoHJEf3tauKTPGhWEkgqsFFzjMV1x.jpg', '2024-07-22 18:07:01', '2024-07-22 18:07:01'),
(9, 6, 2, 'Massage\r\n', NULL, 3.00, 30, NULL, '/storage/SlideshowImages/paIBr2P0FuKAHuaOhX3zLV3zcwwBqaP6nlwOCigT.jpg', '2024-07-23 20:06:15', '2024-07-23 20:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `slideshows`
--

CREATE TABLE `slideshows` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slideshows`
--

INSERT INTO `slideshows` (`id`, `image`, `title`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '/storage/SlideshowImages/4KL2T1ke17PrE2ogceeTpwn7V8qqjClqeyUReIws.jpg', NULL, '2024-07-23 19:39:03', '2024-07-22 19:55:08', '2024-07-23 19:39:03'),
(2, '/storage/SlideshowImages/h8MIp6ugigTg1Wnq4xEEYsTM1IIxqV5sMRw2thHb.jpg', NULL, '2024-07-23 19:39:05', '2024-07-22 19:55:30', '2024-07-23 19:39:05'),
(3, '/storage/SlideshowImages/mnSgCEDHSGtSun1I7iOEFx1ZlUhgIGTWX1osYVbG.jpg', NULL, '2024-07-23 19:39:07', '2024-07-22 19:55:44', '2024-07-23 19:39:07'),
(4, '/storage/SlideshowImages/jloXC5ydNcjbmnZeQLnM6LbzgczWtdCuarlKlrkC.png', NULL, '2024-07-23 19:32:31', '2024-07-23 19:26:49', '2024-07-23 19:32:31'),
(5, '/storage/SlideshowImages/BMDaV0YchhdHD3h7V5y2eQCAeetPALwHqBADDIvd.png', NULL, NULL, '2024-07-23 19:32:40', '2024-07-23 19:32:40'),
(6, '/storage/SlideshowImages/AR4tmzO4LShuVCqke6N6yZwSpmOB7ySY5sW8Pmam.png', NULL, NULL, '2024-07-23 19:39:15', '2024-07-23 19:39:15'),
(7, '/storage/SlideshowImages/bmfTBp8zFoEinWAYl5ygaU1OHt9jU1drVGe4NkOu.png', NULL, NULL, '2024-07-23 19:39:50', '2024-07-23 19:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shop_name` varchar(255) NOT NULL,
  `shop_profile` varchar(255) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `to_admin` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `shop_name`, `shop_profile`, `address_id`, `to_admin`, `created_at`, `updated_at`) VALUES
(1, 'Vichheka Salon', '/storage/StoreImages/x7484hBXjAQdLoocMdVBsyp7F5yynj1gBiXe61rY.jpg', 1, 0.80, '2024-07-22 05:19:35', '2024-07-22 06:46:19'),
(2, 'Veak Salon', '/storage/StoreImages/nuqrOjqqXAyiKT4wLyh1j0osTJUUFzYFj64ukDA2.jpg', 2, 0.30, '2024-07-22 05:25:26', '2024-07-22 06:44:54'),
(3, 'Khav Salon', '/storage/StoreImages/q71g5ynT1Mzzqjk7napplLPwmxqr8aolqK3JjEBU.jpg', 3, 0.00, '2024-07-22 05:27:33', '2024-07-22 05:27:33'),
(4, 'Socheat salon', '/storage/StoreImages/4DQfqXkkqm6V9yKWaz3GyVqciokREz3T8gQJLofF.png', 4, 0.00, '2024-07-22 06:16:36', '2024-07-22 06:16:36'),
(5, 'Tem salon', '/storage/StoreImages/GTBrGjbd1J0H0fn6TmIW5M3CvxHpoNID9tebUGmn.jpg', 5, 0.20, '2024-07-22 06:28:25', '2024-07-22 06:37:16'),
(6, 'Makara salon', '/storage/StoreImages/8tXNh3p8w4vqjaPkCoREIrdo9jsvT6VAAZ2b0vrP.jpg', 6, 0.00, '2024-07-23 20:05:32', '2024-07-23 20:05:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `store_id` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `birth` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active_status` tinyint(1) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png',
  `dark_mode` tinyint(1) NOT NULL DEFAULT 0,
  `messenger_color` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `profile`, `email_verified_at`, `password`, `store_id`, `phone`, `birth`, `location`, `gender`, `remember_token`, `created_at`, `updated_at`, `active_status`, `avatar`, `dark_mode`, `messenger_color`) VALUES
(1, 'Admin', 'admin@gmail.com', '/storage/Profiles/CaynxMvGGWZYYAxBmCcxmvBGd2gpXlFs79h5cVHv.jpg', NULL, '$2y$10$586NpcQOYG9WMqOjrb3ZWeP1sjxygG7ZT6YKQzhNY3i6pIVHLxwIK', '0', '010250337', '2024-07-10', NULL, NULL, NULL, '2024-07-22 05:08:46', '2024-07-22 20:20:14', 1, 'avatar.png', 0, NULL),
(2, 'User', 'user@gmail.com', NULL, NULL, '$2y$10$J3PGD.CLrzUrPFHag6tdOOejViZxmqQ50OdjKAerfoCU0LtDWO9qG', '0', NULL, NULL, NULL, NULL, NULL, '2024-07-22 05:08:46', '2024-07-22 05:08:46', 0, 'avatar.png', 0, NULL),
(3, 'Owner', 'owner@gmail.com', NULL, NULL, '$2y$10$Tfd6rNgfdGAvYzzbvRUikOSET7NFzzFaA1OOiTJTHCSjaSwb9Ukya', '0', NULL, NULL, NULL, NULL, NULL, '2024-07-22 05:08:46', '2024-07-22 05:08:46', 0, 'avatar.png', 0, NULL),
(4, 'Vichheka Chhen', 'vichheka@gmail.com', '/storage/Profiles/4xf69Z7rLLu7o2Si2zymS4vBK64BJenUJhrzdiEv.jpg', NULL, '$2y$10$8zWSKbJJhLHZ9tE127BHQOsRU6HFOUtKjCX8G5yy7.lrt9RQYokea', '1', '0885048743', '2001-12-11', NULL, 'female', NULL, '2024-07-22 05:19:35', '2024-07-22 20:21:21', 0, 'avatar.png', 0, NULL),
(5, 'Veak KTP', 'veak@gmail.com', NULL, NULL, '$2y$10$wijoEEeMrIHSZxZA69m1v.cfqmsMtKbGIv9vP3p007nWqNG5czX4S', '2', NULL, NULL, NULL, 'male', NULL, '2024-07-22 05:25:26', '2024-07-22 05:25:26', 0, 'avatar.png', 0, NULL),
(6, 'Cao Khav', 'pssamsung04@gmail.com', NULL, NULL, '$2y$10$gyVj25udBTN5hY3Cldm0ru7EW.6TqpClInjoih//vda9DuoUzQQJe', '3', NULL, NULL, NULL, 'male', 'FWsWP3V0J8ToaUQ1RSqyj0glGydGPrAt2BFPQaSK8uaPFDExCDzxRTPczIDW', '2024-07-22 05:27:33', '2024-07-23 05:09:16', 0, 'avatar.png', 0, NULL),
(7, 'Tem ley', 'temley@gmail.com', NULL, NULL, '$2y$10$ps6M4Rczc6RchM1y9B8pEu205s83KCLukCUycnn4sYXYNGHbjMdaS', '4', NULL, NULL, NULL, 'other', NULL, '2024-07-22 06:16:36', '2024-07-23 20:35:09', 0, 'avatar.png', 0, NULL),
(8, 'Socheat', 'socheat@gmail.com', NULL, NULL, '$2y$10$fDgiGe7UuZwEcswFLgz0R.lAvVltLjGF0okWvcT2sOgHomR2A3.xG', '5', NULL, NULL, NULL, 'other', NULL, '2024-07-22 06:28:25', '2024-07-23 20:35:59', 0, 'avatar.png', 0, NULL),
(9, 'LaLa', 'lala@gmail.com', '/storage/Profiles/PaEI1hiI8bCRkCLi96NA87BIHkDjGJF0898ie06V.jpg', NULL, '$2y$10$BYd4Hish5XKL.I68AB3ppu8kyxHBDTS4KyChmbDb2suXjUMXWzyRu', '0', '10250337', '2024-06-30', NULL, 'other', NULL, '2024-07-22 06:31:37', '2024-07-22 19:15:24', 0, 'avatar.png', 0, NULL),
(10, 'Mama', 'mama@gmail.com', NULL, NULL, '$2y$10$EiDRy8iz/lu6jnm3e1ClGOMtPOzqtv8Ak0E8l01U/tF0CfvIwNrCK', '6', NULL, NULL, NULL, 'other', NULL, '2024-07-23 20:05:33', '2024-07-23 20:05:33', 0, 'avatar.png', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_province_id_foreign` (`province_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_store_id_foreign` (`store_id`);

--
-- Indexes for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_services_booking_id_foreign` (`booking_id`),
  ADD KEY `booking_services_service_id_foreign` (`service_id`);

--
-- Indexes for table `card_items`
--
ALTER TABLE `card_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `card_items_service_id_foreign` (`service_id`),
  ADD KEY `card_items_user_id_foreign` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_service_id_foreign` (`service_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `frontusers`
--
ALTER TABLE `frontusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `frontusers_email_unique` (`email`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_service_id_foreign` (`service_id`);

--
-- Indexes for table `mailsettings`
--
ALTER TABLE `mailsettings`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provinces_province_name_unique` (`province_name`);

--
-- Indexes for table `q_rcodes`
--
ALTER TABLE `q_rcodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `q_rcodes_store_id_foreign` (`store_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_comment_id_foreign` (`comment_id`),
  ADD KEY `replies_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_store_id_foreign` (`store_id`),
  ADD KEY `services_category_id_foreign` (`category_id`);

--
-- Indexes for table `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking_services`
--
ALTER TABLE `booking_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `card_items`
--
ALTER TABLE `card_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `frontusers`
--
ALTER TABLE `frontusers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mailsettings`
--
ALTER TABLE `mailsettings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `q_rcodes`
--
ALTER TABLE `q_rcodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `booking_services`
--
ALTER TABLE `booking_services`
  ADD CONSTRAINT `booking_services_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `booking_services_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `card_items`
--
ALTER TABLE `card_items`
  ADD CONSTRAINT `card_items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `card_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `q_rcodes`
--
ALTER TABLE `q_rcodes`
  ADD CONSTRAINT `q_rcodes_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `replies_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
