-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2022 at 02:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `landlorddb`
--

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_paid` int(10) UNSIGNED NOT NULL,
  `start_from` date NOT NULL,
  `end_at` date NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `paid_via_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_vendor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_response` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_refference` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `amount_paid`, `start_from`, `end_at`, `tenant_id`, `paid_via_phone`, `pay_vendor`, `transaction_response`, `transaction_id`, `transaction_refference`, `item_description`, `status`, `user_id`, `agent_id`, `created_at`, `updated_at`) VALUES
(1, 'Duka', 600000, '2022-01-12', '2023-01-12', 1, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 2, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(4, 'Duka', 600000, '2022-01-12', '2023-01-12', 5, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(5, 'Duka', 600000, '2022-01-12', '2023-01-12', 6, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(6, 'Demo', 600000, '2022-01-12', '2023-01-12', 4, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(7, 'Uwezo', 180000, '2022-01-12', '2023-01-12', 10, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(8, 'awali', 180000, '2022-04-11', '2023-07-11', 11, '255757654123', 'M-Pesa', 'INS-TS28009', '9AC76GO8V93', '971830', 'The balance in account {2} of account type {1} of identity {0} is insufficient for the transaction.', 'Pending', 5, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `domain` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `db` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` int(10) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tenant_status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `next_renewal` date NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `limit_shops` int(10) NOT NULL DEFAULT 1,
  `limit_users` int(10) NOT NULL DEFAULT 3,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `name`, `domain`, `db`, `phone_number`, `email`, `package`, `amount`, `address`, `payment_status`, `agent_id`, `user_id`, `tenant_status`, `next_renewal`, `customer_id`, `limit_shops`, `limit_users`, `created_at`, `updated_at`) VALUES
(1, 'Zagamba', 'localhost', 'moxacotz_zagamba', 735440144, 'zagambajunior99@gmail.com', 'Uwezo', 360000, 'Dar es Salaam', 'Paid', 2, 5, 'Active', '2023-01-17', 1, 1, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(4, 'demo', 'localhost', 'moxacotz_demo', 735440144, 'adminx@moxa.co.tz', 'Uwezo', 360000, 'Dar es Salaam', 'Paid', 4, 5, 'Active', '2023-01-17', 1, 1, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(5, 'dev', 'localhost', 'moxacotz_demo', 735440144, 'admin@moxa.co.tz', 'Uwezo', 360000, 'Dar es Salaam', 'Paid', 4, 5, 'Active', '2023-01-17', 1, 1, 3, '2022-01-12 10:46:09', '2022-01-12 10:46:09'),
(6, 'Ecoimage investment', 'localhost', 'moxacotz_ecoimage', 4294967295, 'ecoimagetz45@gmail.com', 'Awali', 180000, 'Dodoma', 'Pending', 0, 0, 'Active', '2022-08-21', 0, 1, 3, NULL, NULL),
(10, 'pasah', 'localhost', 'moxacotz_pasah', 4294967295, 'buruwawa@gmail.com', 'Awali', 180000, 'Arusha ', 'Pending', 0, 1, 'Active', '2022-08-23', 0, 1, 3, '2022-02-23 06:58:10', '2022-02-23 06:58:10'),
(11, 'marchrisc', 'localhost', 'moxacotz_marchrisc', 4294967295, 'chris@gmail.com', 'Awali', 180000, 'Arusha ', 'Pending', 0, 1, 'Active', '2022-07-11', 0, 2, 5, '2022-04-11 05:58:10', '2022-04-11 05:58:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
