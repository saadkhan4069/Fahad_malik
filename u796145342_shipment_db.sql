-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 31, 2025 at 02:08 PM
-- Server version: 11.8.3-MariaDB-log
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u796145342_shipment_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_number` varchar(255) NOT NULL,
  `cn_number` varchar(255) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') NOT NULL DEFAULT 'pending',
  `shipper_name` varchar(255) NOT NULL,
  `shipper_email` varchar(255) DEFAULT NULL,
  `shipper_phone` varchar(255) NOT NULL,
  `shipper_address` text NOT NULL,
  `consignee_name` varchar(255) NOT NULL,
  `consignee_email` varchar(255) DEFAULT NULL,
  `consignee_phone` varchar(255) NOT NULL,
  `consignee_address` text NOT NULL,
  `package_description` text NOT NULL,
  `package_value` decimal(10,2) NOT NULL DEFAULT 0.00,
  `weight` decimal(8,2) NOT NULL,
  `dimensions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dimensions`)),
  `service_type` enum('standard','express','overnight','international') NOT NULL DEFAULT 'standard',
  `pickup_date` datetime NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `special_instructions` text DEFAULT NULL,
  `total_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_status` varchar(255) NOT NULL DEFAULT 'unpaid',
  `paid_at` timestamp NULL DEFAULT NULL,
  `booking_date` datetime NOT NULL DEFAULT '2025-10-17 01:53:54',
  `financial_instrument` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipper_city` varchar(255) DEFAULT NULL,
  `shipper_country` varchar(255) DEFAULT NULL,
  `shipper_state` varchar(255) DEFAULT NULL,
  `shipper_zip` varchar(255) DEFAULT NULL,
  `shipper_cnic` varchar(255) DEFAULT NULL,
  `shipper_ntn` varchar(255) DEFAULT NULL,
  `consignee_city` varchar(255) DEFAULT NULL,
  `consignee_country` varchar(255) DEFAULT NULL,
  `consignee_state` varchar(255) DEFAULT NULL,
  `consignee_zip` varchar(255) DEFAULT NULL,
  `consignee_attention` varchar(255) DEFAULT NULL,
  `goods_value_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `hs_code` varchar(255) DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `dox_type` varchar(255) NOT NULL DEFAULT 'NON-DOX',
  `form_e_number` varchar(255) DEFAULT NULL,
  `inco_terms` varchar(255) DEFAULT NULL,
  `shipment_charges` decimal(10,2) DEFAULT NULL,
  `estimated_date` date DEFAULT NULL,
  `shipment_reference` varchar(255) DEFAULT NULL,
  `export_reason` varchar(255) DEFAULT NULL,
  `invoice_items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`invoice_items`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `company_id`, `user_id`, `booking_number`, `cn_number`, `status`, `shipper_name`, `shipper_email`, `shipper_phone`, `shipper_address`, `consignee_name`, `consignee_email`, `consignee_phone`, `consignee_address`, `package_description`, `package_value`, `weight`, `dimensions`, `service_type`, `pickup_date`, `delivery_date`, `special_instructions`, `total_cost`, `payment_status`, `paid_at`, `booking_date`, `financial_instrument`, `created_at`, `updated_at`, `shipper_city`, `shipper_country`, `shipper_state`, `shipper_zip`, `shipper_cnic`, `shipper_ntn`, `consignee_city`, `consignee_country`, `consignee_state`, `consignee_zip`, `consignee_attention`, `goods_value_currency`, `hs_code`, `quantity`, `unit`, `rate`, `dox_type`, `form_e_number`, `inco_terms`, `shipment_charges`, `estimated_date`, `shipment_reference`, `export_reason`, `invoice_items`) VALUES
(10, 1, NULL, 'BKULK0E2B2', '168934', 'confirmed', 'John Do', 'john.doe@example.com', '03062917233', '123 Main St', 'Jane SmitH', 'jane.smith@example.com', '+098-765-42-1', '456 International Blvd', '25 ladies suit', 100.00, 25.00, '{\"length\":50,\"width\":50,\"height\":50,\"vol_weight\":25}', 'express', '2025-11-07 00:00:00', NULL, 'k', 3900.00, 'unpaid', NULL, '2025-10-30 18:48:44', 'N', '2025-10-30 18:48:44', '2025-10-30 18:48:44', 'khi', 'PK', 'SINDH', '12345', '12345-6789012-3', '', 'Otherville', 'US', 'CALIFORNIA', '67890', NULL, 'USD', '42000.32000', NULL, NULL, NULL, 'box', '0', 'DAP', 0.00, '2025-11-07', 'Adex World Wide / fahad malik', NULL, '[]'),
(11, 1, NULL, 'BKW2LRNSQK', '172592', 'confirmed', 'John Do', 'john.doe@example.com', '03062917233', '123 Main St', 'Jane SmitH', 'jane.smith@example.com', '+098-765-42-1', '456 International Blvd', '25 ladies suit', 100.00, 10.00, '{\"length\":50,\"width\":50,\"height\":50,\"vol_weight\":25}', 'express', '2025-11-07 00:00:00', NULL, 'call before delivery', 2775.00, 'unpaid', NULL, '2025-10-30 18:51:59', 'N', '2025-10-30 18:51:59', '2025-10-30 18:51:59', 'khi', 'PK', 'SINDH', '12345', '12345-6789012-3', '', 'Otherville', 'US', 'CALIFORNIA', '67890', NULL, 'USD', '42000.32000', NULL, NULL, NULL, 'box', '0', 'DAP', 0.00, '2025-11-07', 'Adex World Wide / fahad malik', NULL, '[]'),
(12, 1, NULL, 'BKWXDNQCNB', '198099', 'confirmed', 'Sonia Rogers', 'zytuh@mailinator.com', '+1 (514) 132-9901', 'Esse omnis ullam nul', 'Jaime Quinn', 'xafexa@mailinator.com', '+1 (323) 702-1126', 'Eos qui reiciendis', 'Vitae alias eiusmod', 95.00, 79.00, '{\"length\":18,\"width\":83,\"height\":85,\"vol_weight\":25.398}', 'international', '2007-01-24 00:00:00', NULL, 'Totam minima ut labo', 15959.70, 'paid', '2025-10-31 18:23:52', '2025-10-30 18:52:17', 'Y', '2025-10-30 18:52:17', '2025-10-31 18:23:52', 'Sed iure saepe exerc', 'PK', 'Consequat Facere re', '29550', 'Deleniti sit rerum d', 'Omnis minus consequa', 'Saepe cupiditate ius', 'AU', 'Voluptate aut rerum', '55729', NULL, 'USD', 'Deserunt natus eum u', NULL, NULL, NULL, 'flyer', '887', 'DPU', 89.00, '2007-01-24', 'Officiis in reiciend', NULL, '[]'),
(13, 1, 10, 'BKYMRE90CO', '111245', 'confirmed', 'John55 Doe', 'john.doe@example.com', '03062917233', '123 Main Stc', 'Jane Sm', 'jane.smith@example.com', '+098-765-432-1', '456 International Blvd', '25 ladie suit', 100.00, 10.00, '{\"length\":\"50\",\"width\":\"50\",\"height\":\"50\"}', 'standard', '2025-11-07 00:00:00', NULL, 'call before delivery', 1850.00, 'paid', '2025-10-31 18:23:36', '2025-10-30 19:13:50', 'N', '2025-10-30 19:13:50', '2025-10-31 18:23:36', 'khi', 'PK', 'sindh', '12345c', '12345-6789012-3', NULL, 'houston', 'US', 'CALIFORNIA', '67890', NULL, 'USD', '42000.32000', NULL, NULL, NULL, 'box', NULL, NULL, 0.00, '2025-11-07', 'Admin-mcs', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `city` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `code`, `city`, `created_at`, `updated_at`) VALUES
(1, 'Karachi', 'KHI', 'Karachi', NULL, NULL),
(2, 'Lahore', 'LHR', 'Lahore', NULL, NULL),
(3, 'Islamabad', 'ISB', 'Islamabad', NULL, NULL),
(4, 'Quetta', 'QTA', 'Quetta', NULL, NULL),
(5, 'Peshawar', 'PSH', 'Peshawar', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_first_name` varchar(255) DEFAULT NULL,
  `contact_last_name` varchar(255) DEFAULT NULL,
  `cnic_no` varchar(255) DEFAULT NULL,
  `ntn_no` varchar(255) DEFAULT NULL,
  `account_activity` varchar(255) DEFAULT NULL,
  `accounts_email` varchar(255) DEFAULT NULL,
  `accounts_mobile` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `cnic_front` varchar(255) DEFAULT NULL,
  `cnic_back` varchar(255) DEFAULT NULL,
  `ntn_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `city`, `state`, `zip_code`, `country`, `tax_id`, `is_active`, `remember_token`, `created_at`, `updated_at`, `contact_first_name`, `contact_last_name`, `cnic_no`, `ntn_no`, `account_activity`, `accounts_email`, `accounts_mobile`, `website`, `gst_no`, `logo`, `cnic_front`, `cnic_back`, `ntn_image`) VALUES
(1, 'ADEX WORLD WIDE', 'admin@adex.com', NULL, '$2y$12$.Nsm4tiMl3vDd5gG2rKj0eDYb4QUpO.9N63j5RF32/IvZvvU70kA6', '+92-300-1234567', '123 Business Avenue, Gulberg', 'Lahore', 'Punjab', '54000', 'Pakistan', 'TAX-001-2024', 1, 'xbhACX0WL8yTv3Fkmb7e0OQFVDaP1JsgBOLYemcwJGtUfTaDcVBFfYIUoY48', '2025-10-17 08:54:13', '2025-10-30 17:48:04', 'FAHAD', 'MALIK', '42301-8322355-3', 'B066709-1', 'Courier / Bucket Shop', 'adexworldwideexpress@gmail.com', '03062917233', NULL, NULL, 'company/logos/97rODthPHNHGoSgO5Ooxj04diSKKvirP1t65agpU.jpg', 'company/documents/1iWoErQqJuUv41uhN0TuQCaeuGEZhpJ6K1tIXScI.jpg', 'company/documents/341u4uGdRFi0GZPSTjm5YfvziME0896yFA4xzotn.jpg', 'company/documents/3kjcHk9WDnAG4Dpp26Ou1FuzYbpSOB47AzZdAYiR.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `consignments`
--

CREATE TABLE `consignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `cn_number` varchar(255) NOT NULL,
  `cn_date` date NOT NULL,
  `run_number` varchar(255) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `no_of_packages` int(11) NOT NULL DEFAULT 1,
  `weight` decimal(8,2) NOT NULL,
  `shipper_name` varchar(255) NOT NULL,
  `shipper_address` text NOT NULL,
  `consignee_name` varchar(255) NOT NULL,
  `consignee_address` text NOT NULL,
  `status` enum('pending','in_transit','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `consignments`
--

INSERT INTO `consignments` (`id`, `user_id`, `cn_number`, `cn_date`, `run_number`, `tracking_number`, `no_of_packages`, `weight`, `shipper_name`, `shipper_address`, `consignee_name`, `consignee_address`, `status`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 1, '76100080221', '2025-10-16', '211', '1ZHR16840402682331', 1, 8.57, 'ZAIBI ASHRAF', '123 Main Street, City, Country', 'ZEBA ASHRAF', '456 Oak Avenue, City, Country', 'in_transit', 930.33, '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(2, 1, '76100080222', '2025-10-15', '211', '1ZHR16840402682332', 1, 5.34, 'MOHAMMAD SHOAIB', '123 Main Street, City, Country', 'NUZHAT KAZMI', '456 Oak Avenue, City, Country', 'pending', 561.75, '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(3, 1, '76100080223', '2025-10-14', '211', '1ZHR16840402682333', 1, 5.23, 'AHMED ALI', '123 Main Street, City, Country', 'SARA AHMED', '456 Oak Avenue, City, Country', 'delivered', 330.94, '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(4, 1, '76100080224', '2025-10-13', '211', '1ZHR16840402682334', 1, 10.18, 'FATIMA KHAN', '123 Main Street, City, Country', 'OMAR KHAN', '456 Oak Avenue, City, Country', 'delivered', 158.30, '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(5, 1, '76100080225', '2025-10-12', '211', '1ZHR16840402682335', 1, 10.68, 'HASSAN SHAH', '123 Main Street, City, Country', 'AYESHA MALIK', '456 Oak Avenue, City, Country', 'in_transit', 601.00, '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(7, 1, '76100080101', '2025-10-16', '211', '1ZHR1684040268233101', 1, 9.20, 'ZAIBI ASHRAF', '123 Main Street, City, Country', 'ZEBA ASHRAF', '456 Oak Avenue, City, Country', 'pending', 501.18, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(8, 1, '76100080102', '2025-10-15', '211', '1ZHR1684040268233102', 1, 6.30, 'MOHAMMAD SHOAIB', '123 Main Street, City, Country', 'NUZHAT KAZMI', '456 Oak Avenue, City, Country', 'pending', 113.29, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(9, 1, '76100080103', '2025-10-14', '211', '1ZHR1684040268233103', 1, 10.89, 'AHMED ALI', '123 Main Street, City, Country', 'SARA AHMED', '456 Oak Avenue, City, Country', 'delivered', 921.96, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(10, 1, '76100080104', '2025-10-13', '211', '1ZHR1684040268233104', 1, 2.19, 'FATIMA KHAN', '123 Main Street, City, Country', 'OMAR KHAN', '456 Oak Avenue, City, Country', 'in_transit', 588.64, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(11, 1, '76100080105', '2025-10-12', '211', '1ZHR1684040268233105', 1, 2.32, 'HASSAN SHAH', '123 Main Street, City, Country', 'AYESHA MALIK', '456 Oak Avenue, City, Country', 'delivered', 769.82, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(12, 2, '76100080201', '2025-10-16', '211', '1ZHR1684040268233201', 1, 10.11, 'ZAIBI ASHRAF', '123 Main Street, City, Country', 'ZEBA ASHRAF', '456 Oak Avenue, City, Country', 'delivered', 915.12, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(13, 2, '76100080202', '2025-10-15', '211', '1ZHR1684040268233202', 1, 6.26, 'MOHAMMAD SHOAIB', '123 Main Street, City, Country', 'NUZHAT KAZMI', '456 Oak Avenue, City, Country', 'pending', 730.05, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(14, 2, '76100080203', '2025-10-14', '211', '1ZHR1684040268233203', 1, 1.18, 'AHMED ALI', '123 Main Street, City, Country', 'SARA AHMED', '456 Oak Avenue, City, Country', 'delivered', 956.94, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(15, 2, '76100080204', '2025-10-13', '211', '1ZHR1684040268233204', 1, 6.64, 'FATIMA KHAN', '123 Main Street, City, Country', 'OMAR KHAN', '456 Oak Avenue, City, Country', 'delivered', 565.08, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(16, 2, '76100080205', '2025-10-12', '211', '1ZHR1684040268233205', 1, 6.79, 'HASSAN SHAH', '123 Main Street, City, Country', 'AYESHA MALIK', '456 Oak Avenue, City, Country', 'pending', 871.84, '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(17, 3, '76100080301', '2025-10-16', '211', '1ZHR1684040268233301', 1, 7.32, 'ZAIBI ASHRAF', '123 Main Street, City, Country', 'ZEBA ASHRAF', '456 Oak Avenue, City, Country', 'delivered', 485.06, '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(18, 3, '76100080302', '2025-10-15', '211', '1ZHR1684040268233302', 1, 3.36, 'MOHAMMAD SHOAIB', '123 Main Street, City, Country', 'NUZHAT KAZMI', '456 Oak Avenue, City, Country', 'pending', 103.41, '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(19, 3, '76100080303', '2025-10-14', '211', '1ZHR1684040268233303', 1, 8.10, 'AHMED ALI', '123 Main Street, City, Country', 'SARA AHMED', '456 Oak Avenue, City, Country', 'in_transit', 181.36, '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(20, 3, '76100080304', '2025-10-13', '211', '1ZHR1684040268233304', 1, 9.67, 'FATIMA KHAN', '123 Main Street, City, Country', 'OMAR KHAN', '456 Oak Avenue, City, Country', 'pending', 419.54, '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(21, 3, '76100080305', '2025-10-12', '211', '1ZHR1684040268233305', 1, 4.23, 'HASSAN SHAH', '123 Main Street, City, Country', 'AYESHA MALIK', '456 Oak Avenue, City, Country', 'pending', 908.07, '2025-10-17 09:52:43', '2025-10-17 09:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `currency` varchar(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `currency`, `created_at`, `updated_at`) VALUES
(1, 'Pakistan', 'PK', 'PKR', NULL, NULL),
(2, 'United States', 'US', 'USD', NULL, NULL),
(3, 'United Kingdom', 'UK', 'GBP', NULL, NULL),
(4, 'Canada', 'CA', 'CAD', NULL, NULL),
(5, 'Australia', 'AU', 'AUD', NULL, NULL),
(6, 'Germany', 'DE', 'EUR', NULL, NULL),
(7, 'France', 'FR', 'EUR', NULL, NULL),
(8, 'China', 'CN', 'CNY', NULL, NULL),
(9, 'Japan', 'JP', 'JPY', NULL, NULL),
(10, 'India', 'IN', 'INR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `code`, `symbol`, `created_at`, `updated_at`) VALUES
(1, 'US Dollar', 'USD', '$', NULL, NULL),
(2, 'Pakistani Rupee', 'PKR', 'Rs', NULL, NULL),
(3, 'British Pound', 'GBP', '£', NULL, NULL),
(4, 'Euro', 'EUR', '€', NULL, NULL),
(5, 'Canadian Dollar', 'CAD', 'C$', NULL, NULL),
(6, 'Australian Dollar', 'AUD', 'A$', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('draft','sent','paid','overdue','cancelled') NOT NULL DEFAULT 'draft',
  `subtotal` decimal(10,2) NOT NULL,
  `tax_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','credit_card','bank_transfer','check','other') DEFAULT NULL,
  `payment_status` enum('unpaid','paid','partial','refunded') NOT NULL DEFAULT 'unpaid',
  `payment_date` datetime DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `billed_to` varchar(255) DEFAULT NULL,
  `from_company` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `services` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `bank_title` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `iban` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `company_id`, `user_id`, `booking_id`, `shipment_id`, `invoice_number`, `invoice_date`, `due_date`, `status`, `subtotal`, `tax_amount`, `discount_amount`, `total_amount`, `payment_method`, `payment_status`, `payment_date`, `notes`, `billed_to`, `from_company`, `address`, `contact`, `services`, `bank_title`, `account_number`, `iban`, `bank_name`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, NULL, '727', '1980-10-14', '2008-07-31', 'draft', 297495.00, 18.00, 0.00, 297495.00, NULL, 'unpaid', NULL, NULL, 'Laudantium repudian', 'Benjamin Trevino Associates', 'Sapiente dolor irure', 'Officia ullamco et s', '[{\"hrs_qty\":\"562\",\"service_name\":\"Cairo Gaines\",\"description\":\"Laborum Duis dignis\",\"rate_piece\":\"48\",\"adjust\":\"36\",\"sub_total\":\"297495\"}]', 'Cupidatat neque sint', '682', 'Incididunt quis labo', 'Audrey Armstrong', '2025-10-30 18:33:21', '2025-10-30 18:33:21'),
(2, 1, NULL, 10, 10, 'INVCUKB78GN', '2025-10-30', '2025-11-29', 'sent', 3900.00, 195.00, 0.00, 4095.00, NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 18:48:44', '2025-10-30 18:48:44'),
(3, 1, NULL, 11, 11, 'INVTETTH5GT', '2025-10-30', '2025-11-29', 'sent', 2775.00, 138.75, 0.00, 2913.75, NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 18:51:59', '2025-10-30 18:51:59'),
(4, 1, NULL, 12, 12, 'INVAIVFD1LJ', '2025-10-30', '2025-11-29', 'sent', 15959.70, 797.99, 0.00, 16757.69, NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 18:52:17', '2025-10-30 18:52:17'),
(5, 1, 10, 13, 13, 'INVGI46UOL1', '2025-10-30', '2025-11-29', 'sent', 1850.00, 92.50, 0.00, 1942.50, NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 19:13:50', '2025-10-30 19:13:50'),
(6, 1, NULL, NULL, NULL, 'Adex 7860011', '2025-10-30', '2025-10-30', 'draft', 297495.00, 0.00, 0.00, 297495.00, NULL, 'unpaid', NULL, NULL, 'Habib Rice', 'Adex Worldwide Logistics', '13 A Block A SMCHS Karachi, 74200', 'www.adexworldwide.com | +92 339 1231239', '[{\"hrs_qty\":\"1\",\"service_name\":\"International Logistics\",\"description\":\"Logistic Service, Prediscussed\",\"rate_piece\":\"0\",\"adjust\":\"0\",\"sub_total\":\"297495\"}]', 'ADEX WORLDWIDE EXPRESS', '118900150750001', 'PK48BKIP0118900150750001', 'Bank Islami Pakistan Limited', '2025-10-30 19:57:31', '2025-10-30 19:57:31'),
(7, 1, NULL, NULL, NULL, '745', '1996-07-24', '2025-03-20', 'draft', 3103.00, 25.00, 0.00, 3128.00, NULL, 'unpaid', NULL, NULL, 'Facilis ipsum aut se', 'Christensen Whitney LLC', 'Quaerat do dolor ab', 'Explicabo Et dicta', '[{\"hrs_qty\":\"33\",\"service_name\":\"Brittany Bryan\",\"description\":\"Repellendus Veritat\",\"rate_piece\":\"91\",\"adjust\":\"100\",\"sub_total\":\"3103.00\"}]', 'Et sunt quia et fug', '34', 'Qui voluptatum nisi', 'Harlan Reid', '2025-10-30 19:58:43', '2025-10-30 19:58:43'),
(11, 1, NULL, NULL, NULL, 'Adex 7860012', '2025-10-30', '2025-10-30', 'draft', 297495.00, 0.00, 0.00, 297495.00, NULL, 'unpaid', NULL, NULL, 'Habib Rice', 'Adex Worldwide Logistics', '13 A Block A SMCHS Karachi, 74200', 'www.adexworldwide.com | +92 339 1231239', '[{\"hrs_qty\":\"1\",\"service_name\":\"International Logistics\",\"description\":\"Logistic Service, Prediscussed\",\"rate_piece\":\"500\",\"adjust\":\"0\",\"sub_total\":\"297495\"}]', 'ADEX WORLDWIDE EXPRESS', '118900150750001', 'PK48BKIP0118900150750001', 'Bank Islami Pakistan Limited', '2025-10-30 20:00:12', '2025-10-30 20:00:12'),
(12, 1, NULL, NULL, NULL, '853', '2001-12-15', '1993-03-28', 'draft', 5087.00, 37.00, 0.00, 5124.00, NULL, 'unpaid', NULL, NULL, 'Deserunt ad in odit', 'Sanders Bentley Traders', 'Minim voluptatem qu', 'Consequat Voluptate', '[{\"hrs_qty\":\"109\",\"service_name\":\"Ivana Paul\",\"description\":\"Ipsam ut ut sint qua\",\"rate_piece\":\"46\",\"adjust\":\"73\",\"sub_total\":\"5087.00\"}]', 'Sed nobis quae obcae', '477', 'Ea aut qui ipsa opt', 'Odessa Weiss', '2025-10-30 20:01:03', '2025-10-30 20:01:03'),
(15, 1, NULL, NULL, NULL, 'Adex 7860014', '2025-10-31', '2025-10-31', 'draft', 297495.00, 0.00, 0.00, 297495.00, NULL, 'unpaid', NULL, NULL, 'Habib Rice', 'Adex Worldwide Logistics', '13 A Block A SMCHS Karachi, 74200', 'www.adexworldwide.com | +92 339 1231239', '[{\"hrs_qty\":\"1\",\"service_name\":\"International Logistics\",\"description\":\"Logistic Service, Prediscussed\",\"rate_piece\":\"0\",\"adjust\":\"0\",\"sub_total\":\"297495\"}]', 'ADEX WORLDWIDE EXPRESS', '118900150750001', 'PK48BKIP0118900150750001', 'Bank Islami Pakistan Limited', '2025-10-31 17:07:05', '2025-10-31 17:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipment_id` bigint(20) UNSIGNED NOT NULL,
  `label_number` varchar(255) NOT NULL,
  `label_type` enum('shipping','return','custom') NOT NULL DEFAULT 'shipping',
  `status` enum('pending','generated','printed','cancelled') NOT NULL DEFAULT 'pending',
  `file_path` varchar(255) DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `generated_at` datetime DEFAULT NULL,
  `printed_at` datetime DEFAULT NULL,
  `tracking_code` varchar(255) DEFAULT NULL,
  `barcode_data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_01_01_000001_create_companies_table', 1),
(3, '2024_01_01_000002_create_bookings_table', 1),
(4, '2024_01_01_000003_create_shipments_table', 1),
(5, '2024_01_01_000004_create_invoices_table', 1),
(6, '2024_01_01_000005_create_labels_table', 1),
(7, '2024_01_01_000000_create_users_table', 2),
(8, '2024_01_01_000006_add_user_id_to_tables', 2),
(9, '2024_01_01_000007_create_consignments_table', 3),
(10, '2024_01_01_000008_create_payments_table', 3),
(11, '2025_10_17_041458_create_static_data_tables', 4),
(12, '2025_10_18_012507_add_proforma_fields_to_bookings_table', 5),
(13, '2025_10_18_155146_add_financial_instrument_to_bookings_table', 6),
(14, '2025_10_18_162543_add_shipment_details_to_bookings_table', 7),
(15, '2025_10_19_034658_add_payment_fields_to_bookings_table', 8),
(16, '2025_10_28_192320_add_missing_fields_to_bookings_table', 9),
(17, '2025_10_29_183844_add_tracking_notes_to_shipments_table', 10),
(18, '2025_10_18_014003_add_profile_fields_to_companies_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payment_date` date NOT NULL,
  `cheque_number` varchar(255) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','cheque','bank_transfer','credit_card') NOT NULL DEFAULT 'cash',
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `invoice_id`, `payment_date`, `cheque_number`, `cheque_date`, `amount`, `payment_method`, `status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2025-10-15', 'CHQ000001', '2025-10-14', 517.11, 'cheque', 'completed', 'Payment for consignment services', '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(2, 1, NULL, '2025-10-13', 'CHQ000002', '2025-10-12', 1708.14, 'cheque', 'pending', 'Payment for consignment services', '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(3, 1, NULL, '2025-10-11', 'CHQ000003', '2025-10-10', 1570.44, 'bank_transfer', 'pending', 'Payment for consignment services', '2025-10-17 09:52:15', '2025-10-17 09:52:15'),
(4, 1, NULL, '2025-10-15', 'CHQ000101', '2025-10-14', 896.54, 'bank_transfer', 'pending', 'Payment for consignment services', '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(5, 1, NULL, '2025-10-13', 'CHQ000102', '2025-10-12', 1553.95, 'cheque', 'completed', 'Payment for consignment services', '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(6, 1, NULL, '2025-10-11', 'CHQ000103', '2025-10-10', 1041.77, 'cash', 'pending', 'Payment for consignment services', '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(7, 2, NULL, '2025-10-15', 'CHQ000201', '2025-10-14', 1632.68, 'cash', 'pending', 'Payment for consignment services', '2025-10-17 09:52:42', '2025-10-17 09:52:42'),
(8, 2, NULL, '2025-10-13', 'CHQ000202', '2025-10-12', 536.44, 'bank_transfer', 'pending', 'Payment for consignment services', '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(9, 2, NULL, '2025-10-11', 'CHQ000203', '2025-10-10', 1610.11, 'cheque', 'completed', 'Payment for consignment services', '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(10, 3, NULL, '2025-10-15', 'CHQ000301', '2025-10-14', 1615.20, 'bank_transfer', 'completed', 'Payment for consignment services', '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(11, 3, NULL, '2025-10-13', 'CHQ000302', '2025-10-12', 1525.15, 'cash', 'completed', 'Payment for consignment services', '2025-10-17 09:52:43', '2025-10-17 09:52:43'),
(12, 3, NULL, '2025-10-11', 'CHQ000303', '2025-10-10', 1328.64, 'cheque', 'completed', 'Payment for consignment services', '2025-10-17 09:52:43', '2025-10-17 09:52:43');

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

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Standard', 'standard', 'Standard shipping service', NULL, NULL),
(2, 'Express', 'express', 'Express shipping service', NULL, NULL),
(3, 'Overnight', 'overnight', 'Overnight delivery service', NULL, NULL),
(4, 'International', 'international', 'International shipping service', NULL, NULL),
(5, 'Direct UAE Express', 'direct_uae_express', 'Direct UAE Express service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(6, 'Direct UAE Economy', 'direct_uae_economy', 'Direct UAE Economy service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(7, 'Direct UAE DDP', 'direct_uae_ddp', 'Direct UAE DDP service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(8, 'Direct UK Express', 'direct_uk_express', 'Direct UK Express service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(9, 'Direct UK Economy', 'direct_uk_economy', 'Direct UK Economy service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(10, 'Direct Saudi Arabia DDP', 'direct_saudi_arabia_ddp', 'Direct Saudi Arabia DDP service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(11, 'Import UAE DDP', 'import_uae_ddp', 'Import UAE DDP service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(12, 'International Import', 'international_import', 'International Import service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(13, 'Via Dubai UPS Economy', 'via_dubai_ups_economy', 'Via Dubai UPS Economy service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(14, 'Via Dubai UPS Express', 'via_dubai_ups_express', 'Via Dubai UPS Express service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(15, 'Via Dubai Aramex', 'via_dubai_aramex', 'Via Dubai Aramex service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(16, 'Via Dubai FedEx', 'via_dubai_fedex', 'Via Dubai FedEx service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(17, 'Via Dubai DHL', 'via_dubai_dhl', 'Via Dubai DHL service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(18, 'Direct Dubai', 'direct_dubai', 'Direct Dubai shipping service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(19, 'KHI DHL', 'khi_dhl', 'Karachi DHL service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(20, 'KHI FedEx', 'khi_fedex', 'Karachi FedEx service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(21, 'KHI UPS', 'khi_ups', 'Karachi UPS service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(22, 'KHI Aramex', 'khi_aramex', 'Karachi Aramex service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(23, 'Skynet', 'skynet', 'Skynet courier service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(24, 'Other', 'other', 'Other shipping service', '2025-10-30 14:16:00', '2025-10-30 14:16:00'),
(25, 'Via UK Europe DPD', 'via_uk_europe_dpd', 'Via UK Europe DPD shipping service', '2025-10-30 14:49:47', '2025-10-30 14:49:47'),
(26, 'Via UK Europe DHL Belfast', 'via_uk_europe_dhl_belfast', 'Via UK Europe DHL Belfast shipping service', '2025-10-30 14:49:47', '2025-10-30 14:49:47'),
(27, 'Australia DDP', 'australia_ddp', 'Australia DDP shipping service', '2025-10-30 15:25:34', '2025-10-30 15:25:34');

-- --------------------------------------------------------

--
-- Table structure for table `shipments`
--

CREATE TABLE `shipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `status` enum('pending','picked_up','in_transit','out_for_delivery','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `origin_address` text NOT NULL,
  `destination_address` text NOT NULL,
  `origin_city` varchar(255) NOT NULL,
  `destination_city` varchar(255) NOT NULL,
  `origin_country` varchar(255) NOT NULL,
  `destination_country` varchar(255) NOT NULL,
  `weight` decimal(8,2) NOT NULL,
  `dimensions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`dimensions`)),
  `shipping_date` datetime NOT NULL,
  `estimated_delivery` datetime DEFAULT NULL,
  `actual_delivery` datetime DEFAULT NULL,
  `shipping_cost` decimal(10,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `tracking_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipments`
--

INSERT INTO `shipments` (`id`, `company_id`, `user_id`, `booking_id`, `tracking_number`, `status`, `origin_address`, `destination_address`, `origin_city`, `destination_city`, `origin_country`, `destination_country`, `weight`, `dimensions`, `shipping_date`, `estimated_delivery`, `actual_delivery`, `shipping_cost`, `notes`, `tracking_notes`, `created_at`, `updated_at`) VALUES
(10, 1, NULL, 10, '3490318329', 'pending', '123 Main St', '456 International Blvd', 'khi', 'Otherville', 'PK', 'US', 25.00, '{\"length\":50,\"width\":50,\"height\":50,\"vol_weight\":25}', '2025-11-07 00:00:00', NULL, NULL, 3900.00, NULL, NULL, '2025-10-30 18:48:44', '2025-10-30 18:48:44'),
(11, 1, NULL, 11, '7052575757', 'in_transit', '123 Main St', '456 International Blvd', 'khi', 'Otherville', 'PK', 'US', 10.00, '{\"length\":50,\"width\":50,\"height\":50,\"vol_weight\":25}', '2025-11-07 00:00:00', NULL, NULL, 2775.00, NULL, NULL, '2025-10-30 18:51:59', '2025-10-31 19:02:48'),
(12, 1, NULL, 12, '2846054795', 'pending', 'Esse omnis ullam nul', 'Eos qui reiciendis', 'Sed iure saepe exerc', 'Saepe cupiditate ius', 'PK', 'AU', 79.00, '{\"length\":18,\"width\":83,\"height\":85,\"vol_weight\":25.398}', '2007-01-24 00:00:00', NULL, NULL, 15959.70, NULL, NULL, '2025-10-30 18:52:17', '2025-10-30 18:52:17'),
(13, 1, 10, 13, '6433054786', 'in_transit', '123 Main Stc', '456 International Blvd', 'khi', 'houston', 'PK', 'US', 10.00, '{\"length\":50,\"width\":50,\"height\":50,\"vol_weight\":25}', '2025-11-07 00:00:00', '2025-11-01 07:15:00', NULL, 1850.00, NULL, 'At destination warehouse', '2025-10-30 19:13:50', '2025-10-31 18:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Pieces', 'PCS', 'Individual pieces', NULL, NULL),
(2, 'Kilograms', 'KG', 'Weight in kilograms', NULL, NULL),
(3, 'Boxes', 'BOX', 'Boxes', NULL, NULL),
(4, 'Cartons', 'CARTON', 'Cartons', NULL, NULL),
(5, 'Pallets', 'PALLET', 'Pallets', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `company_id` bigint(20) UNSIGNED NOT NULL,
  `role` enum('admin','manager','user') NOT NULL DEFAULT 'user',
  `phone` varchar(225) DEFAULT NULL,
  `department` varchar(225) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `company_id`, `role`, `phone`, `department`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@adex.com', NULL, '$2y$12$hxwCXdPBazgCcQTYsJDTkuKaq2H1c1dsM0QHUek.WQpUqXHUiKqV6', 1, 'admin', NULL, '', 1, NULL, '2025-10-17 09:01:23', '2025-10-17 09:01:23'),
(2, 'Manager User', 'manager@techsolutions.com', NULL, '$2y$12$MAHCWx2f0AE0eoI0Pl4GSusbNC0ZSiUkgZrmvZShbyGqwRSrKdQCq', 1, 'manager', NULL, '', 1, NULL, '2025-10-17 09:01:24', '2025-10-17 09:01:24'),
(3, 'Regular User', 'user@adex.com', NULL, '$2y$12$TEyNlqhG7fTW70lp3ND6aO2NHoiPehBww7FGCH8iiXyXV3f2ch19O', 1, 'user', NULL, '', 1, NULL, '2025-10-17 09:01:24', '2025-10-17 09:01:24'),
(9, 'Amena Ruiz', 'sudeb@mailinator.com', NULL, '$2y$12$spQMCMd3Hzk0.yLnXqp73uaickrhNXfViJ/47uQlbAcumgY4evvkW', 1, 'user', '+1 (846) 339-7719', 'Quis aut natus repre', 1, NULL, '2025-10-30 19:07:54', '2025-10-30 19:07:54'),
(10, 'mcs', 'kashif.booking@gmail.com', NULL, '$2y$12$wO1p9/qebeN6AVkqXLDXw.XtHUGuyB5O2z6orkZ8J2/1v2xenHfU2', 1, 'user', '03391231239', NULL, 1, NULL, '2025-10-30 19:09:56', '2025-10-30 19:09:56'),
(11, 'fahad', 'fahadmalikadex@gmail.com', NULL, '$2y$12$IP.OZme.KpTjkQceiElg2uxGnQcVStRq6ewQ.R3fOewHx/JrX7AP6', 1, 'user', '03062917233', 'user', 1, NULL, '2025-10-31 18:10:11', '2025-10-31 18:10:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bookings_booking_number_unique` (`booking_number`),
  ADD KEY `bookings_company_id_foreign` (`company_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_code_unique` (`code`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`);

--
-- Indexes for table `consignments`
--
ALTER TABLE `consignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `consignments_cn_number_unique` (`cn_number`),
  ADD UNIQUE KEY `consignments_tracking_number_unique` (`tracking_number`),
  ADD KEY `consignments_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_code_unique` (`code`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `idx_company_id` (`company_id`),
  ADD KEY `idx_booking_id` (`booking_id`),
  ADD KEY `idx_shipment_id` (`shipment_id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `labels_label_number_unique` (`label_number`),
  ADD KEY `labels_company_id_foreign` (`company_id`),
  ADD KEY `labels_shipment_id_foreign` (`shipment_id`),
  ADD KEY `labels_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_code_unique` (`code`);

--
-- Indexes for table `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `shipments_tracking_number_unique` (`tracking_number`),
  ADD KEY `shipments_company_id_foreign` (`company_id`),
  ADD KEY `shipments_booking_id_foreign` (`booking_id`),
  ADD KEY `shipments_user_id_foreign` (`user_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `units_code_unique` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `consignments`
--
ALTER TABLE `consignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `consignments`
--
ALTER TABLE `consignments`
  ADD CONSTRAINT `consignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `labels`
--
ALTER TABLE `labels`
  ADD CONSTRAINT `labels_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `labels_shipment_id_foreign` FOREIGN KEY (`shipment_id`) REFERENCES `shipments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `labels_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipments`
--
ALTER TABLE `shipments`
  ADD CONSTRAINT `shipments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shipments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
