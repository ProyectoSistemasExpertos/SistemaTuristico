-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2024 at 11:06 PM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `touristsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `idBooking` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `state` tinyint(1) NOT NULL,
  `price` double(8,2) NOT NULL,
  `location` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `totalPossibleReservation` int NOT NULL,
  `uploadDate` timestamp NOT NULL,
  `idPerson` bigint UNSIGNED NOT NULL,
  `idCategory` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idBooking`),
  KEY `bookings_idperson_foreign` (`idPerson`),
  KEY `bookings_idcategory_foreign` (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
(18, 'Visita al Volcan', 'Tours de caminatas en volcanes del Valle Central', 1, 12000.00, 'San Carlos', 11, '2024-02-01 01:28:11', 1, 1),
(20, 'Mirador vistas del volcán', 'Un hospedaje maravilloso, donde podrás ver el amanecer y atardecer con tu pareja o familia.', 0, 12000.00, 'Puntarenas', 2, '2024-02-01 01:32:12', 1, 1),
(27, 'Museo Nacional', 'Visita este histórico lugar dentro de la provincia, acompañado de nuestro guías que te contarán nuestra historia.', 1, 12000.00, 'San Jose', 2, '2024-02-01 01:54:03', 1, 3),
(28, 'Museo Nacional', 'Visita este histórico lugar dentro de la provincia, acompañado de nuestro guías que te contarán nuestra historia.', 0, 12000.00, 'San Jose', 2, '2024-02-01 01:55:29', 1, 3),
(29, 'Parque de diversiones', 'Visita este parque con sus multiples atracciones', 0, 8500.00, 'San Jose', 1, '2024-02-01 01:58:20', 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `booking_gallerys`
--

DROP TABLE IF EXISTS `booking_gallerys`;
CREATE TABLE IF NOT EXISTS `booking_gallerys` (
  `idBooking_gallery` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `image` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `idBooking` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idBooking_gallery`),
  KEY `booking_gallerys_idbooking_foreign` (`idBooking`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `booking_gallerys`
--

INSERT INTO `booking_gallerys` (`idBooking_gallery`, `image`, `idBooking`) VALUES
(1, '202401311849_playaBonita.jpg', 1),
(5, '202401311858_playaPiuta.jpg', 5),
(6, '202401311859_PlayaHermosa.jpg', 6),
(7, '202401311900_playa_herradura.jpg', 7),
(9, '202401311902_hotel_cueva.jpg', 9),
(10, '202401311904_chindama.jpeg', 10),
(15, '202401311920_montaña.jpg', 15),
(17, '202401311925_canopy.jpg', 17),
(18, '202401311928_Volcan.jpeg', 18),
(20, '202401311932_mirador2.jpg', 20),
(25, '202401311954_Museo-Jade.jpg', 27),
(26, '202401311955_museojade.jpg', 28),
(27, '202401311958_2022-JunParquedeDiverciones2.jpg', 29);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `idCategory` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `typeCategory` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `housings`
--

DROP TABLE IF EXISTS `housings`;
CREATE TABLE IF NOT EXISTS `housings` (
  `idHousing` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `initial_date` date NOT NULL,
  `final_date` date NOT NULL,
  `arrival_date` date NOT NULL,
  `total_person` int NOT NULL,
  `idPerson` bigint UNSIGNED NOT NULL,
  `idBooking` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idHousing`),
  KEY `housings_idperson_foreign` (`idPerson`),
  KEY `housings_idbooking_foreign` (`idBooking`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `housings`
--

INSERT INTO `housings` (`idHousing`, `initial_date`, `final_date`, `arrival_date`, `total_person`, `idPerson`, `idBooking`) VALUES
(1, '2024-01-31', '2024-02-03', '2024-01-31', 1, 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, 'App\\Models\\User', 2, 'access_token', '6af971250f17784670480b8b7bcdb28b64308b5ea1bca37750cfa8bf057500fe', '[\"*\"]', NULL, NULL, '2024-02-01 04:59:58', '2024-02-01 04:59:58');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
CREATE TABLE IF NOT EXISTS `preferences` (
  `idPreference` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idPerson` bigint UNSIGNED NOT NULL,
  `idCategory` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idPreference`),
  KEY `preferences_idperson_foreign` (`idPerson`),
  KEY `preferences_idcategory_foreign` (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `preferences`
--

INSERT INTO `preferences` (`idPreference`, `idPerson`, `idCategory`) VALUES
(1, 1, 2),
(2, 2, 2),
(3, 1, 2),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

DROP TABLE IF EXISTS `recommendations`;
CREATE TABLE IF NOT EXISTS `recommendations` (
  `idRecommendation` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `idPerson` bigint UNSIGNED NOT NULL,
  `counter` varchar(191) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `idCategory` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idRecommendation`),
  KEY `recommendations_idperson_foreign` (`idPerson`),
  KEY `recommendations_idcategory_foreign` (`idCategory`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `idRol` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `typeRol` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `idCard` int NOT NULL,
  `firstLastName` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `secondLastName` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `phone` int NOT NULL,
  `address` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `idRol` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_idrol_foreign` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `idCard`, `firstLastName`, `secondLastName`, `phone`, `address`, `idRol`) VALUES
(1, 'Mike', 'mike@gmail.com', NULL, '$2y$12$ERaQHMjOqnjEXMCWiMSAx.UNhk1382XZms/JPYI6TtNGUdOTTlcmO', NULL, NULL, NULL, 123456789, 'Mitchel', 'Bolivar', 88888888, 'Limon', 2),
(2, 'Patrick', 'lisby2103@gmail.com', NULL, '$2y$12$cUh5Cd1xAsnFsC5IRUWP5O/H0GS/xm4KTltAOIjdlrDIeY2KuShN2', NULL, NULL, '2024-02-01 02:04:19', 70830927, 'Lisby', 'Córdoba', 83582141, 'Limon', 2),
(3, 'Sujeto', 'prueba@gmail.com', NULL, '$2y$12$ct1n/6PNlzL1ekluM1wRn.uTpLJUvOAnDxBP8XWFB1d5DwGRFqM5O', NULL, NULL, NULL, 123456789, 'De', 'Prueba', 98765432, 'San Jose', 2),
(4, 'Mauricio', 'mau@gmail.com', NULL, '$2y$12$5X9EVbpdos1h9w8HDzSTSeznBu5SNAzP.gSptyjlMcU1vUeDyRRzW', NULL, NULL, NULL, 123456789, 'Bisby', 'Bisby', 88288828, 'Alajuela', 2);

-- --------------------------------------------------------

--
-- Table structure for table `valorations`
--

DROP TABLE IF EXISTS `valorations`;
CREATE TABLE IF NOT EXISTS `valorations` (
  `idValoration` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `score` double(2,1) NOT NULL,
  `commentary` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `idPerson` bigint UNSIGNED NOT NULL,
  `idBooking` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`idValoration`),
  KEY `valorations_idperson_foreign` (`idPerson`),
  KEY `valorations_idbooking_foreign` (`idBooking`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

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
