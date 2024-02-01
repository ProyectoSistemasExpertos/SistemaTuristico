-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 01, 2024 at 01:36 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u588272099_TUplas`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `idBooking` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` varchar(191) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `price` double(8,2) NOT NULL,
  `location` varchar(191) NOT NULL,
  `totalPossibleReservation` int(11) NOT NULL,
  `uploadDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `idPerson` bigint(20) UNSIGNED NOT NULL,
  `idCategory` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`idBooking`, `title`, `description`, `state`, `price`, `location`, `totalPossibleReservation`, `uploadDate`, `idPerson`, `idCategory`) VALUES
(1, 'Playa Bonita', 'Playa Bonitaes un destino turístico ubicado en la costa sur de la región, conocida por sus aguas cristalinas y arena blanca. Situada en una bahía protegida.', 1, 12500.00, 'Limon', 4, '2024-02-01 00:49:07', 1, 2),
(5, 'Playa Piuta', 'Playa Piutaes un destino turístico ubicado en la costa sur de la región, conocida por sus aguas cristalinas y arena blanca. Situada en una bahía protegida.', 1, 12500.00, 'Limon', 4, '2024-02-01 00:58:26', 1, 2),
(6, 'Playa Hermosa', 'Playa Hermosa es un destino turístico ubicado en la costa sur de la región, conocida por sus aguas cristalinas y arena blanca. Situada en una bahía protegida.', 1, 12500.00, 'Limon', 2, '2024-02-01 00:59:28', 1, 2),
(7, 'Playa Herradura', 'Playa Herradura es un destino turístico ubicado en la costa sur de la región, conocida por sus aguas cristalinas y arena blanca. Situada en una bahía protegida.', 1, 13500.00, 'Guanacaste', 2, '2024-02-01 01:00:35', 1, 2),
(9, 'Hotel Cueva', 'Hotel Cueva es un destino turístico ubicado en la costa sur de la región, conocida por sus aguas cristalinas y arena blanca. Situada en una bahía protegida.', 1, 13500.00, 'Jacó', 2, '2024-02-01 01:02:35', 1, 2),
(10, 'Catarata Chindama', 'Este es un atractivo dentro de las montañas de la provincia de Limón.', 0, 10000.00, 'Limón', 10, '2024-02-01 01:04:14', 1, 1),
(15, 'Cabañas', 'Vive la experiencia de convivir con animales dentro de nuestros hospedajes', 1, 12000.00, 'Limón', 4, '2024-02-01 01:20:29', 1, 1),
(17, 'Canopy en San Carlos', 'Vive la experiencia de utilizar un canopy extremo donde la flora y fauna son el centro de atención.', 1, 12000.00, 'San Carlos', 4, '2024-02-01 01:25:55', 1, 1),
(18, 'Visita al Volcan', 'Tours de caminatas en volcanes del Valle Central', 0, 12000.00, 'San Carlos', 11, '2024-02-01 01:17:03', 1, 1),
(20, 'Mirador vistas del volcán', 'Un hospedaje maravilloso, donde podrás ver el amanecer y atardecer con tu pareja o familia.', 0, 12000.00, 'Puntarenas', 2, '2024-02-01 01:32:12', 1, 1),
(27, 'Museo Nacional', 'Visita este histórico lugar dentro de la provincia, acompañado de nuestro guías que te contarán nuestra historia.', 1, 12000.00, 'San Jose', 2, '2024-02-01 01:54:03', 1, 3),
(28, 'Museo Nacional', 'Visita este histórico lugar dentro de la provincia, acompañado de nuestro guías que te contarán nuestra historia.', 0, 12000.00, 'San Jose', 2, '2024-02-01 01:55:29', 1, 3),
(29, 'Parque de diversiones', 'Visita este parque con sus multiples atracciones', 0, 8500.00, 'San Jose', 1, '2024-02-01 01:58:20', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_gallerys`
--

CREATE TABLE `booking_gallerys` (
  `idBooking_gallery` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `idBooking` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `booking_gallerys`
--

INSERT INTO `booking_gallerys` (`idBooking_gallery`, `image`, `idBooking`) VALUES
(1, 'https://www.govisitcostarica.com/images/photos/desk-waves-rolling-in-playa-hermosa.JPG', 1),
(5, 'https://www.govisitcostarica.com/images/photos/desk-Los-Suenos-golf-17th-hole.jpg', 5),
(6, 'https://www.govisitcostarica.com/images/photos/desk-salsa-brava-surfer-barreled.jpg', 6),
(7, 'https://www.govisitcostarica.com/images/photos/desk-beautiful-beach-rocks-corcovado.jpg', 7),
(9, 'https://www.govisitcostarica.com/images/photos/desk-Bahia-Potrero-Sunset-Pool.jpg', 9),
(10, 'https://s0.wklcdn.com/image_20/606494/4570499/2296623Master.jpg', 10),
(15, 'https://cf.bstatic.com/xdata/images/hotel/max1280x900/486695813.jpg?k=4da2ff32006c9643ba66be4baef85fc62bcb5ae8882369342e1a87148d008732&o=&hp=1', 15),
(17, 'https://www.govisitcostarica.com/images/photos/desk-canyon-canopy-tour-rincon-de-la-vieja.jpg', 17),
(18, 'https://www.govisitcostarica.com/images/photos/desk-volcano-reflection.JPG', 18),
(20, 'https://www.govisitcostarica.com/images/photos/desk-magia-blanca-waterfall-poas-volcano.jpg', 20),
(25, 'https://museodeljade.grupoins.com/Media/uxrbia5g/exhibiciones_cronologias_661x321.png', 27),
(26, 'https://museodeljade.grupoins.com/Media/frke5frn/exhibiciones_jade_661x321.png', 28),
(27, 'https://www.parquediversiones.com/contenido/wp-content/gallery/Galeria-Tornado/Parque-Diversiones6_124.jpg', 29);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `idCategory` bigint(20) UNSIGNED NOT NULL,
  `typeCategory` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`idCategory`, `typeCategory`) VALUES
(1, 'Montaña'),
(2, 'Playa'),
(3, 'Ciudad');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `housings`
--

CREATE TABLE `housings` (
  `idHousing` bigint(20) UNSIGNED NOT NULL,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `total_person` int(11) NOT NULL,
  `idPerson` bigint(20) UNSIGNED NOT NULL,
  `idBooking` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `housings`
--

INSERT INTO `housings` (`idHousing`, `initial_date`, `final_date`, `arrival_date`, `total_person`, `idPerson`, `idBooking`) VALUES
(1, '2024-01-31', '2024-02-03', '2024-01-31', 1, 2, 20),
(8, '2024-02-01', '2024-01-30', '2024-01-24', 5, 6, 10),
(9, '2024-01-31', '2024-02-11', '2024-01-31', 5, 6, 10),
(10, '2024-01-03', '2024-01-17', '2024-01-18', 1, 5, 18);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_01_10_014431_rol', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_01_19_01000_create_category', 1),
(7, '2024_01_20_000_create_booking', 1),
(8, '2024_01_20_010518_create_recomendation', 1),
(9, '2024_01_21_00000_create_booking_gallery', 1),
(10, '2024_01_21_010201_cont_recommendation', 1),
(11, '2024_01_21_011439_create_preference', 1),
(12, '2024_01_21_012828_create_housing', 1),
(13, '2024_01_21_013218_create_valoration', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'access_token', '44b3f3561e3962cda64b6ecaf2fa7750d163232ff26648854eeb272d7489e00c', '[\"*\"]', NULL, NULL, '2024-02-01 00:55:41', '2024-02-01 00:55:41'),
(2, 'App\\Models\\User', 1, 'access_token', '9fa71008f02f2045bd51f124e33882f2a18ba615514a2b2b716fe95c6f6f8f10', '[\"*\"]', NULL, NULL, '2024-02-01 01:42:30', '2024-02-01 01:42:30'),
(3, 'App\\Models\\User', 2, 'access_token', '6400484b647b41392e36782b80efb3442ff5f4222209dbc532036b06e7c8a7e5', '[\"*\"]', NULL, NULL, '2024-02-01 02:02:43', '2024-02-01 02:02:43'),
(4, 'App\\Models\\User', 3, 'access_token', '5b7a4bc8dbe2da6c3e1e34242982e151f53a9014e483cfbab18987762fa9f164', '[\"*\"]', NULL, NULL, '2024-02-01 02:29:25', '2024-02-01 02:29:25'),
(5, 'App\\Models\\User', 3, 'access_token', '32499ebc4af3d50bc2895e2636aeee49910f46d7f99fe5f185af7712b6044ab5', '[\"*\"]', NULL, NULL, '2024-02-01 02:34:19', '2024-02-01 02:34:19'),
(6, 'App\\Models\\User', 3, 'access_token', '8a5d4e4ccf3e329862abad4ec7cd6fd67c79b4cab96caee5d295ac124fa9338f', '[\"*\"]', NULL, NULL, '2024-02-01 02:35:24', '2024-02-01 02:35:24'),
(7, 'App\\Models\\User', 4, 'access_token', '6505dbfe78906de448f8ba50ef3c504e24971b9d29ea2b9a4940cc27532b40d0', '[\"*\"]', NULL, NULL, '2024-02-01 02:39:42', '2024-02-01 02:39:42'),
(8, 'App\\Models\\User', 2, 'access_token', '61300315afaa75834fe8aafcdb159e103746669bce8627262ebad242fb4265a3', '[\"*\"]', NULL, NULL, '2024-02-01 04:58:33', '2024-02-01 04:58:33'),
(9, 'App\\Models\\User', 2, 'access_token', '6af971250f17784670480b8b7bcdb28b64308b5ea1bca37750cfa8bf057500fe', '[\"*\"]', NULL, NULL, '2024-02-01 04:59:58', '2024-02-01 04:59:58'),
(10, 'App\\Models\\User', 2, 'access_token', '71d8a2501ba3dbdec090e1566178cd1fdd3720715e2ce456c29c74e67bf6b3d5', '[\"*\"]', NULL, NULL, '2024-02-01 00:21:52', '2024-02-01 00:21:52'),
(11, 'App\\Models\\User', 2, 'access_token', 'c8b839287b7ef2c5bc41ffa2fbd416f37b6bae0886177d5f92ceaac5dea6d104', '[\"*\"]', NULL, NULL, '2024-02-01 00:46:47', '2024-02-01 00:46:47'),
(12, 'App\\Models\\User', 2, 'access_token', 'ac6f6b9174ccebf7efb2757772d5a80413747c35ac536e35178710479032e16e', '[\"*\"]', NULL, NULL, '2024-02-01 00:48:35', '2024-02-01 00:48:35'),
(13, 'App\\Models\\User', 5, 'access_token', '3d5d33068218f7112e9c5b287aaf07d24de71bb2405f0755ba7d50f120186bfa', '[\"*\"]', NULL, NULL, '2024-02-01 00:50:26', '2024-02-01 00:50:26'),
(14, 'App\\Models\\User', 5, 'access_token', 'd5269d504ab5253d56e78fa237dcbef8422ef1dc130655da69995eeea6946d81', '[\"*\"]', NULL, NULL, '2024-02-01 00:56:57', '2024-02-01 00:56:57'),
(15, 'App\\Models\\User', 5, 'access_token', '0bc7fc22084f8c1e9529a609639720124419c77353c01979ec826be20215e82f', '[\"*\"]', NULL, NULL, '2024-02-01 00:58:40', '2024-02-01 00:58:40'),
(16, 'App\\Models\\User', 6, 'access_token', 'ca9637dcd05d180b5d0e9ef48b6c43c62d0fe2ed7a27ad50b3ef1a505e15ada4', '[\"*\"]', NULL, NULL, '2024-02-01 01:00:44', '2024-02-01 01:00:44'),
(17, 'App\\Models\\User', 7, 'access_token', '4ca1974f044cc47860242183253d719d0950aaf105ae4f0990c4a9ad79ee395a', '[\"*\"]', NULL, NULL, '2024-02-01 01:06:54', '2024-02-01 01:06:54'),
(18, 'App\\Models\\User', 5, 'access_token', 'eac53a14f4c8c3a2f725cad6251b87ba114382c5a8cae53c41d1084ecb35cef2', '[\"*\"]', NULL, NULL, '2024-02-01 01:13:41', '2024-02-01 01:13:41'),
(19, 'App\\Models\\User', 5, 'access_token', '09a4a392e126eceef9d6eddf8ffbd54e1d1f1dd4a1698108d74d721ad20798ed', '[\"*\"]', NULL, NULL, '2024-02-01 01:19:12', '2024-02-01 01:19:12'),
(20, 'App\\Models\\User', 2, 'access_token', '567d9e0ae7268b0f231161d0c1f6c8d82034dcb2b8d9860db3bdeb831f544a49', '[\"*\"]', NULL, NULL, '2024-02-01 01:26:10', '2024-02-01 01:26:10'),
(21, 'App\\Models\\User', 2, 'access_token', '3076f0b3a065cefd830621c145c4130b4c35c57c9d11e831f8e8ab43e40efe0c', '[\"*\"]', NULL, NULL, '2024-02-01 01:29:14', '2024-02-01 01:29:14'),
(22, 'App\\Models\\User', 2, 'access_token', '0ee0e3c069b25cad2c47155ee5f7db4cd8abc29c0003cb3c0ba165538b9c9ec6', '[\"*\"]', NULL, NULL, '2024-02-01 01:31:59', '2024-02-01 01:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `idPreference` bigint(20) UNSIGNED NOT NULL,
  `idPerson` bigint(20) UNSIGNED NOT NULL,
  `idCategory` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`idPreference`, `idPerson`, `idCategory`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 1, 2),
(4, 1, 2),
(5, 5, 2),
(6, 6, 2),
(7, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `idRecommendation` bigint(20) UNSIGNED NOT NULL,
  `idPerson` bigint(20) UNSIGNED NOT NULL,
  `counter` varchar(191) DEFAULT NULL,
  `idCategory` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `recommendations`
--

INSERT INTO `recommendations` (`idRecommendation`, `idPerson`, `counter`, `idCategory`) VALUES
(11, 2, '1', 1),
(12, 5, '5', 1),
(13, 6, '6', 1),
(14, 7, '0', 2),
(15, 5, '0', 3);

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `idRol` bigint(20) UNSIGNED NOT NULL,
  `typeRol` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`idRol`, `typeRol`) VALUES
(1, 'Vendedor'),
(2, 'Cliente');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idCard` int(11) NOT NULL,
  `firstLastName` varchar(191) NOT NULL,
  `secondLastName` varchar(191) NOT NULL,
  `phone` int(11) NOT NULL,
  `address` varchar(191) NOT NULL,
  `idRol` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `idCard`, `firstLastName`, `secondLastName`, `phone`, `address`, `idRol`) VALUES
(1, 'Mike', 'mike@gmail.com', NULL, '$2y$12$ERaQHMjOqnjEXMCWiMSAx.UNhk1382XZms/JPYI6TtNGUdOTTlcmO', NULL, NULL, NULL, 123456789, 'Mitchel', 'Bolivar', 88888888, 'Limon', 2),
(2, 'Patrick', 'lisby2103@gmail.com', NULL, '$2y$12$cUh5Cd1xAsnFsC5IRUWP5O/H0GS/xm4KTltAOIjdlrDIeY2KuShN2', NULL, NULL, '2024-02-01 02:04:19', 70830927, 'Lisby', 'Córdoba', 83582141, 'Limon', 2),
(3, 'Sujeto', 'prueba@gmail.com', NULL, '$2y$12$ct1n/6PNlzL1ekluM1wRn.uTpLJUvOAnDxBP8XWFB1d5DwGRFqM5O', NULL, NULL, NULL, 123456789, 'De', 'Prueba', 98765432, 'San Jose', 2),
(4, 'Mauricio', 'mau@gmail.com', NULL, '$2y$12$5X9EVbpdos1h9w8HDzSTSeznBu5SNAzP.gSptyjlMcU1vUeDyRRzW', NULL, NULL, NULL, 123456789, 'Bisby', 'Bisby', 88288828, 'Alajuela', 2),
(5, 'Mike', 'memb8631@gmail.com', NULL, '$2y$12$nyVQgWXaEEXf8rlKIoiYkuqCVxLRUrvHb5XA0yxVgmfK1RdsGttH6', NULL, NULL, NULL, 118340950, 'Mitchel', 'Bolivar', 87256259, '500 Mts Norte De La Escuela 28 Millas', 1),
(6, 'Dereck', 'dereck748210@gmail.com', NULL, '$2y$12$VaM/meFZr8b7xo5WbG7TGOYbT1spXKYKb7agcs9BNBtLAC3BKJEKC', NULL, NULL, '2024-02-01 01:01:49', 702770858, 'Mitchellll', 'Bolívar', 87256139, 'nicaragua khgghujcgfyuiuicvghuihuivhubji', 1),
(7, 'Nathalia Nerixi', 'nathaliasanchezb2002@gmail.com', NULL, '$2y$12$/NcQwChU1GBnMfDlSWw9RORdHFAjVDDP5ak24qj0iD00A2Uv5g3F2', NULL, NULL, NULL, 702910427, 'Sánchez', 'Barquero', 64507527, 'Matina Bataan Luzon, Iglesia Apostolica Despues De Tanques De Agua', 1);

-- --------------------------------------------------------

--
-- Table structure for table `valorations`
--

CREATE TABLE `valorations` (
  `idValoration` bigint(20) UNSIGNED NOT NULL,
  `score` double(2,1) NOT NULL,
  `commentary` varchar(191) NOT NULL,
  `idPerson` bigint(20) UNSIGNED NOT NULL,
  `idBooking` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `valorations`
--

INSERT INTO `valorations` (`idValoration`, `score`, `commentary`, `idPerson`, `idBooking`) VALUES
(1, 5.0, 'Bueno', 1, 1),
(2, 5.0, 'Bueno', 1, 5),
(3, 5.0, 'Bueno', 1, 6),
(4, 5.0, 'Bueno', 1, 7),
(5, 5.0, 'Bueno', 1, 9),
(6, 5.0, 'Bueno', 1, 10),
(7, 5.0, 'Bueno', 1, 15),
(8, 5.0, 'Bueno', 1, 17),
(9, 5.0, 'Bueno', 1, 18),
(10, 5.0, 'Bueno', 1, 20),
(11, 5.0, 'Bueno', 1, 27),
(12, 5.0, 'Bueno', 1, 28),
(13, 5.0, 'Bueno', 1, 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`idBooking`),
  ADD KEY `bookings_idperson_foreign` (`idPerson`),
  ADD KEY `bookings_idcategory_foreign` (`idCategory`);

--
-- Indexes for table `booking_gallerys`
--
ALTER TABLE `booking_gallerys`
  ADD PRIMARY KEY (`idBooking_gallery`),
  ADD KEY `booking_gallerys_idbooking_foreign` (`idBooking`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategory`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `housings`
--
ALTER TABLE `housings`
  ADD PRIMARY KEY (`idHousing`),
  ADD KEY `housings_idperson_foreign` (`idPerson`),
  ADD KEY `housings_idbooking_foreign` (`idBooking`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`idPreference`),
  ADD KEY `preferences_idperson_foreign` (`idPerson`),
  ADD KEY `preferences_idcategory_foreign` (`idCategory`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`idRecommendation`),
  ADD KEY `recommendations_idperson_foreign` (`idPerson`),
  ADD KEY `recommendations_idcategory_foreign` (`idCategory`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_idrol_foreign` (`idRol`);

--
-- Indexes for table `valorations`
--
ALTER TABLE `valorations`
  ADD PRIMARY KEY (`idValoration`),
  ADD KEY `valorations_idperson_foreign` (`idPerson`),
  ADD KEY `valorations_idbooking_foreign` (`idBooking`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `idBooking` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `booking_gallerys`
--
ALTER TABLE `booking_gallerys`
  MODIFY `idBooking_gallery` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `housings`
--
ALTER TABLE `housings`
  MODIFY `idHousing` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `idPreference` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `idRecommendation` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `valorations`
--
ALTER TABLE `valorations`
  MODIFY `idValoration` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_idcategory_foreign` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
  ADD CONSTRAINT `bookings_idperson_foreign` FOREIGN KEY (`idPerson`) REFERENCES `users` (`id`);

--
-- Constraints for table `booking_gallerys`
--
ALTER TABLE `booking_gallerys`
  ADD CONSTRAINT `booking_gallerys_idbooking_foreign` FOREIGN KEY (`idBooking`) REFERENCES `bookings` (`idBooking`);

--
-- Constraints for table `housings`
--
ALTER TABLE `housings`
  ADD CONSTRAINT `housings_idbooking_foreign` FOREIGN KEY (`idBooking`) REFERENCES `bookings` (`idBooking`),
  ADD CONSTRAINT `housings_idperson_foreign` FOREIGN KEY (`idPerson`) REFERENCES `users` (`id`);

--
-- Constraints for table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_idcategory_foreign` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
  ADD CONSTRAINT `preferences_idperson_foreign` FOREIGN KEY (`idPerson`) REFERENCES `users` (`id`);

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_idcategory_foreign` FOREIGN KEY (`idCategory`) REFERENCES `categories` (`idCategory`),
  ADD CONSTRAINT `recommendations_idperson_foreign` FOREIGN KEY (`idPerson`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_idrol_foreign` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

--
-- Constraints for table `valorations`
--
ALTER TABLE `valorations`
  ADD CONSTRAINT `valorations_idbooking_foreign` FOREIGN KEY (`idBooking`) REFERENCES `bookings` (`idBooking`),
  ADD CONSTRAINT `valorations_idperson_foreign` FOREIGN KEY (`idPerson`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
