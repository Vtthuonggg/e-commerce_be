-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2024 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `maiprojectbe`
--

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
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_11_28_062029_add_details_to_users_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'App\\Models\\User', 1, 'auth_token', 'e23a2257aa87ac8419612512766b30d00f0756b282f3131afa44d321a5ba1a92', '[\"*\"]', NULL, NULL, '2024-11-25 00:22:34', '2024-11-25 00:22:34'),
(2, 'App\\Models\\User', 1, 'auth_token', '70d7557fbaa6ebd3cde55f8ae804e67e13f371097176fa797e9cad1da5d38730', '[\"*\"]', '2024-11-25 00:40:59', NULL, '2024-11-25 00:25:11', '2024-11-25 00:40:59'),
(3, 'App\\Models\\User', 1, 'auth_token', '5f24585dba1159c575c4bcf377a3760128ba25f02e5b6cf438022a520db13bdb', '[\"*\"]', NULL, NULL, '2024-11-25 00:57:15', '2024-11-25 00:57:15'),
(4, 'App\\Models\\User', 1, 'auth_token', 'a3baa97606e16fbfc16a85e4c04299bc09d329ab90f61c9ec00d5caff1d96d1d', '[\"*\"]', NULL, NULL, '2024-11-25 01:02:22', '2024-11-25 01:02:22'),
(5, 'App\\Models\\User', 1, 'auth_token', 'd2890cb9657b0e4778654c9cfe0ed9f8c186f64f66ced49888a9034b2773bd17', '[\"*\"]', NULL, NULL, '2024-11-25 01:29:19', '2024-11-25 01:29:19'),
(6, 'App\\Models\\User', 1, 'auth_token', 'bafa7493bf52b7118daac361ed20b70edb61882ca94ef3d8a29454ceab11617a', '[\"*\"]', NULL, NULL, '2024-11-25 01:30:25', '2024-11-25 01:30:25'),
(7, 'App\\Models\\User', 1, 'auth_token', 'aae9a9c88a1b6395115df438f3c213f40f8dcf74a9f4a65bec7d7d68e188ebd3', '[\"*\"]', '2024-11-25 01:43:00', NULL, '2024-11-25 01:42:59', '2024-11-25 01:43:00'),
(8, 'App\\Models\\User', 2, 'auth_token', '5a627437a865d75749cf91135d4c90c04fef496d8f64e7ed23e2e92808c5d5f4', '[\"*\"]', NULL, NULL, '2024-11-25 01:52:50', '2024-11-25 01:52:50'),
(9, 'App\\Models\\User', 2, 'auth_token', '065aaa253e28f11a80a86f2d0f7f42c99797c35788361eb19ce31196a7eb8591', '[\"*\"]', '2024-11-25 01:53:22', NULL, '2024-11-25 01:53:21', '2024-11-25 01:53:22'),
(10, 'App\\Models\\User', 1, 'auth_token', 'f9c33c7b44d5506ba060ca8c37215b0552d3d6c80c16242cbd3a2f12eb6e415f', '[\"*\"]', NULL, NULL, '2024-11-28 04:53:48', '2024-11-28 04:53:48'),
(11, 'App\\Models\\User', 1, 'auth_token', '37bb90c7f7f6b95b1eca2e56d1be0c6e6dd6a44c875a5d3adcf50613c4023508', '[\"*\"]', NULL, NULL, '2024-11-28 09:11:36', '2024-11-28 09:11:36'),
(12, 'App\\Models\\User', 1, 'auth_token', 'a4a02b30ac5240b35f7f8bbc5c7dd39be61348c8def1677ababc28e5c2a3eca7', '[\"*\"]', NULL, NULL, '2024-11-28 09:21:22', '2024-11-28 09:21:22'),
(13, 'App\\Models\\User', 1, 'auth_token', '6b632e4c05cb4591990a3008bb0fb3a39cf8ff03590e444703342fcd0ce9f039', '[\"*\"]', NULL, NULL, '2024-11-28 09:43:22', '2024-11-28 09:43:22'),
(14, 'App\\Models\\User', 1, 'auth_token', 'd604b904645b271f0032f672e552f10705fe7c882d0f6485276e282b6ba5b93f', '[\"*\"]', NULL, NULL, '2024-11-28 09:47:09', '2024-11-28 09:47:09'),
(15, 'App\\Models\\User', 1, 'auth_token', '6563772ed47c5da9c6f5224d37983d07acd85eed2981c1bb118857a814c7bb2f', '[\"*\"]', NULL, NULL, '2024-11-28 09:50:02', '2024-11-28 09:50:02'),
(16, 'App\\Models\\User', 1, 'auth_token', 'a2717478db4758610047c52a0eadcc237081ff2d23dd0c93542899af4329f364', '[\"*\"]', NULL, NULL, '2024-11-28 09:53:11', '2024-11-28 09:53:11'),
(17, 'App\\Models\\User', 1, 'auth_token', 'bbfdafcfa2fb8ca456d603c0d337b82e0de71f0d4701954a36e07958f5ff37f8', '[\"*\"]', NULL, NULL, '2024-11-29 09:08:29', '2024-11-29 09:08:29'),
(18, 'App\\Models\\User', 1, 'auth_token', '356e57fbbca7b35a731cd84e4add28d96da48a7ce1a9362941b868df91735cf2', '[\"*\"]', NULL, NULL, '2024-11-29 09:23:32', '2024-11-29 09:23:32'),
(19, 'App\\Models\\User', 1, 'auth_token', 'b397faa6b00de737cc4735ea5035141c948c5526dce111087c518aab0cac68d3', '[\"*\"]', NULL, NULL, '2024-11-29 09:23:55', '2024-11-29 09:23:55'),
(20, 'App\\Models\\User', 3, 'auth_token', '715353ac263cfc67c4c1cccdc0a0a10d7159be5dca4d5244ada738b22983114c', '[\"*\"]', NULL, NULL, '2024-11-29 09:25:33', '2024-11-29 09:25:33'),
(21, 'App\\Models\\User', 4, 'auth_token', 'af57623d75d3e87a0304a3ef0d61af188d4ff81ee8bed4868bcc543cf59b79e0', '[\"*\"]', NULL, NULL, '2024-11-29 09:30:16', '2024-11-29 09:30:16'),
(22, 'App\\Models\\User', 5, 'auth_token', 'b06c719d93e9552bcb41e5be77575c846229a1caabc6ff2093e8b799b706bc76', '[\"*\"]', NULL, NULL, '2024-11-29 09:31:14', '2024-11-29 09:31:14'),
(23, 'App\\Models\\User', 4, 'auth_token', 'c6e6aa586a1bb7c5e867a368586dc882c538137c89ed7d8987798712404d6f7c', '[\"*\"]', NULL, NULL, '2024-11-29 09:34:50', '2024-11-29 09:34:50'),
(24, 'App\\Models\\User', 4, 'auth_token', '025595cc8b5388264de8471172d5483db8cd10b9553870913fb3664b8b5591ff', '[\"*\"]', NULL, NULL, '2024-12-01 04:42:15', '2024-12-01 04:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `store_name` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone_number`, `store_name`, `notes`) VALUES
(4, 'Vu Thanh Thuong', 'thuong', NULL, '$2y$10$oNF90S0c2jFPgubHNkG0v.OPk1ZzPS8C1.rXI61yeCzqRBiVae5Ta', NULL, '2024-11-29 09:30:16', '2024-11-29 09:30:16', NULL, NULL, NULL),
(5, 'Thuong', 'thuong2', NULL, '$2y$10$cmg2HfUwvr4qw0UFoOs.g.0u7XWGpOhzLKSAkPUnki2wPU8PUR7bS', NULL, '2024-11-29 09:31:14', '2024-11-29 09:31:14', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
