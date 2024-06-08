-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 08, 2024 at 02:01 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jezyki_obce`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('flashcard','quiz') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`) VALUES
(1, 'Podstawowe zwroty', 'flashcard'),
(2, 'Kolory', 'flashcard'),
(3, 'Liczby', 'flashcard'),
(4, 'Zwierzęta', 'flashcard'),
(5, 'Owoce', 'flashcard'),
(6, 'Warzywa', 'flashcard'),
(7, 'Czas', 'flashcard'),
(8, 'Pogoda', 'flashcard'),
(9, 'Praca', 'flashcard'),
(10, 'Szkoła', 'flashcard'),
(11, 'Sport', 'flashcard'),
(12, 'Zdrowie', 'flashcard'),
(13, 'Jedzenie', 'flashcard'),
(14, 'Dom', 'flashcard'),
(15, 'Rodzina', 'flashcard'),
(16, 'Miasto', 'flashcard'),
(17, 'Podróżowanie', 'flashcard'),
(18, 'Kultura', 'flashcard');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `srs_words`
--

CREATE TABLE `srs_words` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `word_id` int(11) NOT NULL,
  `next_review` date NOT NULL,
  `repetitions` int(11) DEFAULT 0,
  `review_interval` int(11) DEFAULT 1,
  `ease` float DEFAULT 2.5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `srs_words`
--

INSERT INTO `srs_words` (`id`, `user_id`, `word_id`, `next_review`, `repetitions`, `review_interval`, `ease`) VALUES
(1, 3, 35, '2024-06-10', 4, 9, 2.35),
(2, 3, 36, '2024-05-22', 2, 4, 2.2),
(3, 3, 37, '2024-05-25', 2, 2, 2.15),
(4, 3, 38, '2024-05-28', 1, 2, 2.46),
(5, 3, 40, '2024-06-08', 2, 4, 2.5),
(6, 3, 41, '2024-06-02', 3, 9, 2.4),
(7, 3, 44, '2024-06-06', 3, 1, 1.6),
(8, 3, 45, '2024-06-06', 1, 1, 1.5),
(9, 3, 47, '2024-06-06', 3, 9, 2.5),
(10, 3, 49, '2024-06-08', 1, 1, 1.8),
(11, 3, 39, '2024-06-04', 2, 5, 2.8),
(12, 3, 42, '2024-05-31', 1, 1, 2),
(13, 3, 43, '2024-07-22', 2, 4, 2.36),
(14, 3, 48, '2024-06-02', 0, 1, 1.3),
(15, 3, 46, '2024-05-24', 2, 4, 2.3),
(16, 3, 51, '2024-05-22', 2, 5, 2.7),
(17, 3, 52, '2024-08-05', 1, 2, 2.61),
(18, 3, 54, '2024-05-23', 0, 1, 2.5),
(19, 3, 56, '2024-05-25', 1, 2, 2.6),
(20, 3, 60, '2024-05-22', 2, 5, 2.7),
(21, 3, 63, '2024-05-24', 1, 2, 2.1),
(22, 3, 64, '2024-05-22', 1, 2, 2.1),
(23, 3, 66, '2024-05-25', 1, 2, 2.4),
(24, 3, 68, '2024-05-27', 1, 2, 2.6),
(25, 3, 69, '2024-05-27', 1, 2, 2.6),
(26, 3, 50, '2024-05-27', 2, 4, 2.45),
(27, 3, 55, '2024-05-26', 1, 2, 2.7),
(28, 3, 58, '2024-05-21', 1, 2, 2.2),
(29, 3, 59, '2024-05-23', 0, 1, 1.8),
(30, 3, 61, '2024-05-25', 1, 2, 2.16),
(31, 3, 65, '2024-05-23', 1, 2, 2.4),
(32, 3, 53, '2024-07-16', 1, 2, 2.55),
(33, 3, 57, '2024-05-25', 1, 2, 2.6),
(34, 3, 62, '2024-05-25', 1, 2, 2.4),
(35, 3, 67, '2024-05-24', 1, 2, 2.5),
(36, 3, 218, '2024-05-22', 2, 5, 2.7),
(37, 3, 347, '2024-05-25', 1, 2, 2.6),
(38, 3, 371, '2024-05-25', 1, 2, 2.6),
(39, 3, 372, '2024-05-24', 1, 2, 2.4),
(40, 3, 374, '2024-05-25', 1, 2, 2.6),
(41, 3, 378, '2024-05-25', 1, 2, 2.6),
(42, 3, 381, '2024-05-24', 1, 2, 2.4),
(43, 3, 383, '2024-05-24', 1, 2, 2.26),
(44, 3, 387, '2024-05-25', 1, 2, 2.6),
(45, 3, 388, '2024-05-22', 1, 2, 2),
(46, 3, 210, '2024-05-25', 1, 2, 2.6),
(47, 3, 213, '2024-05-25', 1, 2, 2.6),
(48, 3, 214, '2024-05-25', 1, 2, 2.6),
(49, 3, 221, '2024-05-25', 1, 2, 2.6),
(50, 3, 222, '2024-05-24', 1, 2, 2.26),
(51, 3, 224, '2024-05-24', 1, 2, 2.26),
(52, 3, 225, '2024-05-25', 1, 2, 2.6),
(53, 3, 228, '2024-05-25', 1, 2, 2.6),
(54, 3, 229, '2024-05-25', 1, 2, 2.6),
(55, 3, 130, '2024-05-25', 1, 2, 2.6),
(56, 3, 131, '2024-05-25', 1, 2, 2.6),
(57, 3, 135, '2024-05-25', 1, 2, 2.6),
(58, 3, 136, '2024-05-25', 1, 2, 2.6),
(59, 3, 138, '2024-05-24', 1, 2, 2.26),
(60, 3, 140, '2024-05-24', 1, 2, 2.5),
(61, 3, 141, '2024-05-21', 0, 1, 2),
(62, 3, 142, '2024-05-21', 1, 2, 1.96),
(63, 3, 144, '2024-05-24', 1, 2, 2.4),
(64, 3, 149, '2024-05-21', 0, 1, 2),
(65, 3, 291, '2024-05-24', 1, 2, 2.5),
(66, 3, 297, '2024-05-24', 1, 2, 2.4),
(67, 3, 298, '2024-05-25', 1, 2, 2.6),
(68, 3, 299, '2024-05-24', 1, 2, 2.26),
(69, 3, 301, '2024-05-21', 0, 1, 2.1),
(70, 3, 304, '2024-05-25', 1, 2, 2.6),
(71, 3, 305, '2024-05-25', 1, 2, 2.6),
(72, 3, 306, '2024-05-24', 1, 2, 2.4),
(73, 3, 308, '2024-05-24', 1, 2, 2.26),
(74, 3, 309, '2024-05-25', 1, 2, 2.6),
(75, 3, 252, '2024-05-25', 1, 2, 2.6),
(76, 3, 254, '2024-05-24', 1, 2, 2.26),
(77, 3, 331, '2024-05-25', 1, 2, 2.6),
(78, 3, 332, '2024-05-24', 1, 2, 2.4),
(79, 3, 333, '2024-05-24', 1, 2, 2.5),
(80, 3, 335, '2024-05-25', 1, 2, 2.6),
(81, 3, 336, '2024-05-25', 1, 2, 2.6),
(82, 3, 343, '2024-05-25', 1, 2, 2.6),
(83, 3, 345, '2024-05-24', 1, 2, 2.4),
(84, 3, 346, '2024-05-24', 1, 2, 2.26),
(85, 3, 248, '2024-05-21', 0, 1, 2.3),
(86, 3, 245, '2024-05-25', 1, 2, 2.6),
(87, 3, 232, '2024-05-25', 1, 2, 2.6),
(88, 3, 236, '2024-05-24', 1, 2, 2.4),
(89, 3, 239, '2024-05-24', 1, 2, 2.26),
(90, 3, 246, '2024-05-25', 1, 2, 2.6),
(91, 3, 244, '2024-05-25', 1, 2, 2.6),
(92, 3, 235, '2024-05-25', 1, 2, 2.6),
(93, 3, 249, '2024-05-21', 0, 1, 2.3),
(94, 3, 234, '2024-05-25', 1, 2, 2.6),
(95, 3, 127, '2024-06-02', 0, 1, 2.16),
(96, 3, 110, '2024-05-25', 1, 2, 2.26),
(97, 3, 115, '2024-05-25', 1, 2, 2.26),
(98, 3, 128, '2024-06-02', 0, 1, 2.16),
(99, 3, 113, '2024-05-25', 1, 2, 2.26),
(100, 3, 129, '2024-05-25', 1, 2, 2.26),
(101, 3, 125, '2024-05-25', 1, 2, 2.26),
(102, 3, 112, '2024-05-25', 1, 2, 2.26),
(103, 3, 117, '2024-06-02', 0, 1, 2.16),
(104, 3, 126, '2024-06-02', 0, 1, 2.16),
(105, 3, 97, '2024-06-06', 1, 2, 2.36),
(106, 3, 107, '2024-06-04', 1, 2, 2.16),
(107, 3, 94, '2024-06-02', 0, 1, 2.4),
(108, 3, 109, '2024-06-02', 0, 1, 2.4),
(109, 3, 105, '2024-06-04', 1, 2, 2.3),
(110, 3, 91, '2024-06-02', 0, 1, 2.4),
(111, 3, 103, '2024-06-02', 0, 1, 2.2),
(112, 3, 101, '2024-06-02', 0, 1, 2.4),
(113, 3, 90, '2024-06-05', 1, 2, 2.5),
(114, 3, 106, '2024-06-02', 0, 1, 2.4),
(115, 3, 124, '2024-06-02', 0, 1, 2.4),
(116, 3, 122, '2024-06-02', 0, 1, 2.4),
(117, 3, 114, '2024-06-02', 0, 1, 2.4),
(118, 3, 119, '2024-06-02', 0, 1, 2.4),
(119, 3, 116, '2024-06-02', 0, 1, 2.4),
(120, 3, 121, '2024-06-02', 0, 1, 2.4),
(121, 7, 96, '2024-06-06', 1, 2, 2.6),
(122, 7, 102, '2024-06-05', 1, 2, 2.26),
(123, 7, 92, '2024-06-06', 1, 2, 2.6),
(124, 7, 97, '2024-06-06', 1, 2, 2.6),
(125, 7, 91, '2024-06-06', 1, 2, 2.6),
(126, 7, 94, '2024-06-06', 1, 2, 2.6),
(127, 7, 107, '2024-06-02', 0, 1, 2.3),
(128, 7, 105, '2024-06-06', 1, 2, 2.6),
(129, 7, 100, '2024-06-06', 1, 2, 2.6),
(130, 7, 93, '2024-06-06', 1, 2, 2.6),
(131, 3, 99, '2024-06-05', 1, 2, 2.26),
(132, 3, 100, '2024-06-05', 1, 2, 2.26),
(133, 3, 102, '2024-06-02', 0, 1, 2.3),
(134, 3, 92, '2024-06-02', 0, 1, 2.3),
(135, 3, 98, '2024-06-02', 0, 1, 2.3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Haslo` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Login`, `Haslo`, `Email`, `is_admin`) VALUES
(3, 'marcin123', '$2y$10$Fbg4JbDe9Zi2REbiYv6D6OFVN6bamSzHPqvouhH/LmbiVf5/NCtr2', 'marcinn2878@gmail.com', 0),
(4, 'admin', '$2y$10$PkqbLk429f0CYa7A8LEE9OgBSMuiXHuAEjjFujdowVNvIlNdNacGa', 'admin@uwb.edu.pl', 1),
(5, 'marcin12345', '$2y$10$.clEHEqEHweTR8uaCWlYpOjA1jlb5.Vfox/aXAexMncQPNBhFngk6', 'marcin@uwb.edu.pl', 0),
(6, 'ja', '$2y$10$EpxRYoqbAhMa1D9P06kxPu1YMfrp0dapeojF/BWXZcoDve9RZ5aSm', 'qweqwe@tak.pl', 0),
(7, 'user', '$2y$10$DOW2kujLTY.aH0KSx2pEj.RGbeUs4uao6Vu/DGYsYCeGSXeSQN3ru', 'user@uwb.edu.pl', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_history`
--

CREATE TABLE `user_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `type` enum('quiz','flashcard') NOT NULL,
  `correct_answers` int(11) NOT NULL,
  `total_questions` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `language` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`id`, `user_id`, `category_id`, `type`, `correct_answers`, `total_questions`, `date`, `language`) VALUES
(9, 3, 2, 'quiz', 2, 10, '2024-05-15 20:00:00', 'angielski'),
(12, 3, 2, 'quiz', 8, 10, '2024-05-18 13:57:08', 'angielski'),
(13, 3, 2, 'quiz', 1, 10, '2024-05-18 16:08:32', 'angielski'),
(14, 3, 2, 'quiz', 2, 10, '2024-05-19 21:11:16', 'angielski'),
(15, 3, 2, 'quiz', 3, 10, '2024-05-19 21:11:55', 'angielski'),
(22, 3, 2, 'quiz', 2, 10, '2024-05-19 22:07:02', 'angielski'),
(23, 3, 2, 'quiz', 1, 10, '2024-05-19 22:07:18', 'angielski'),
(24, 3, 2, 'quiz', 3, 10, '2024-05-19 22:51:41', 'angielski'),
(25, 3, 2, 'quiz', 3, 10, '2024-05-19 22:52:01', 'angielski'),
(26, 3, 2, 'quiz', 3, 10, '2024-05-19 22:52:03', 'angielski'),
(27, 3, 2, 'quiz', 2, 10, '2024-05-19 22:52:19', 'angielski'),
(28, 3, 2, 'quiz', 4, 10, '2024-05-19 23:31:41', 'angielski'),
(29, 3, 2, 'quiz', 3, 10, '2024-05-19 23:36:34', 'angielski'),
(30, 3, 2, 'quiz', 2, 7, '2024-05-19 23:37:13', 'angielski'),
(31, 3, 2, 'quiz', 5, 10, '2024-05-19 23:37:32', 'angielski'),
(32, 3, 2, 'quiz', 6, 10, '2024-05-19 23:42:35', 'angielski'),
(33, 3, 2, 'quiz', 2, 4, '2024-05-19 23:42:48', 'angielski'),
(34, 3, 2, 'quiz', 5, 10, '2024-05-19 23:50:41', 'angielski'),
(35, 3, 2, 'quiz', 9, 10, '2024-05-19 23:56:18', 'angielski'),
(36, 3, 2, 'quiz', 6, 10, '2024-05-19 23:57:02', 'angielski'),
(37, 3, 2, 'quiz', 4, 10, '2024-05-20 00:10:55', 'angielski'),
(38, 3, 2, 'quiz', 9, 10, '2024-05-20 00:11:19', 'angielski'),
(39, 3, 2, 'quiz', 6, 10, '2024-05-20 00:17:15', 'angielski'),
(40, 3, 2, 'quiz', 2, 4, '2024-05-20 00:17:25', 'angielski'),
(45, 3, 4, 'quiz', 2, 10, '2024-05-20 00:48:55', 'angielski'),
(46, 3, 2, 'quiz', 2, 10, '2024-05-20 00:49:17', 'angielski'),
(47, 3, 2, 'quiz', 0, 10, '2024-05-20 00:54:23', 'angielski'),
(48, 3, 2, 'quiz', 6, 10, '2024-05-20 00:57:31', 'angielski'),
(49, 3, 2, 'quiz', 2, 10, '2024-05-20 00:58:25', 'angielski'),
(50, 3, 2, 'quiz', 3, 10, '2024-05-20 01:00:47', 'angielski'),
(51, 3, 2, 'quiz', 7, 10, '2024-05-20 01:03:04', 'angielski'),
(52, 3, 2, 'quiz', 3, 10, '2024-05-20 01:06:11', 'angielski'),
(53, 3, 4, 'quiz', 4, 10, '2024-05-20 01:10:41', 'angielski'),
(54, 3, 2, 'quiz', 6, 10, '2024-05-20 01:18:46', 'angielski'),
(55, 3, 2, 'quiz', 1, 10, '2024-05-20 01:22:29', 'angielski'),
(56, 3, 2, 'quiz', 7, 10, '2024-05-20 01:25:03', 'angielski'),
(57, 3, 2, 'quiz', 4, 10, '2024-05-20 01:27:58', 'angielski'),
(58, 3, 2, 'quiz', 3, 10, '2024-05-20 01:32:22', 'angielski'),
(59, 3, 2, 'quiz', 1, 10, '2024-05-20 01:35:27', 'angielski'),
(60, 3, 2, 'quiz', 2, 10, '2024-05-20 01:37:14', 'angielski'),
(61, 3, 2, 'quiz', 3, 10, '2024-05-20 01:38:48', 'angielski'),
(62, 3, 2, 'quiz', 2, 10, '2024-05-20 01:45:59', 'angielski'),
(63, 3, 2, 'quiz', 1, 10, '2024-05-20 01:48:02', 'angielski'),
(64, 3, 2, 'quiz', 3, 10, '2024-05-20 01:53:06', 'angielski'),
(65, 3, 2, 'quiz', 5, 10, '2024-05-20 01:57:36', 'angielski'),
(66, 3, 2, 'quiz', 2, 10, '2024-05-20 02:02:16', 'angielski'),
(67, 3, 2, 'quiz', 2, 10, '2024-05-20 08:32:07', 'angielski'),
(68, 3, 2, 'quiz', 4, 10, '2024-05-20 08:34:56', 'angielski'),
(69, 3, 2, 'quiz', 3, 10, '2024-05-20 08:38:07', 'angielski'),
(70, 3, 4, 'quiz', 9, 10, '2024-05-20 08:45:25', 'angielski'),
(71, 3, 4, 'quiz', 9, 10, '2024-05-20 08:48:52', 'angielski'),
(72, 3, 2, 'quiz', 2, 10, '2024-05-20 09:00:23', 'angielski'),
(73, 3, 2, 'quiz', 2, 10, '2024-05-20 09:05:46', 'angielski'),
(74, 3, 4, 'quiz', 0, 10, '2024-05-20 09:15:31', 'angielski'),
(75, 3, 4, 'quiz', 0, 10, '2024-05-20 09:15:55', 'niemiecki'),
(76, 3, 4, 'quiz', 2, 10, '2024-05-20 09:16:16', 'angielski'),
(77, 3, 2, 'quiz', 3, 10, '2024-05-20 09:19:32', 'angielski'),
(78, 3, 4, 'quiz', 2, 10, '2024-05-20 09:19:56', 'angielski'),
(79, 3, 2, 'quiz', 4, 10, '2024-05-20 09:24:52', 'angielski'),
(80, 3, 2, 'quiz', 4, 10, '2024-05-20 09:26:03', 'angielski'),
(81, 3, 4, 'quiz', 6, 10, '2024-05-20 09:28:52', 'angielski'),
(83, 3, 4, 'quiz', 2, 10, '2024-05-20 09:40:57', 'angielski'),
(84, 3, 2, 'quiz', 7, 10, '2024-05-20 09:43:53', 'angielski'),
(85, 3, 2, 'quiz', 8, 10, '2024-05-20 09:44:44', 'angielski'),
(87, 3, 2, 'quiz', 0, 10, '2024-05-20 09:49:27', 'angielski'),
(88, 3, 2, 'quiz', 0, 10, '2024-05-20 09:49:48', 'angielski'),
(89, 3, 2, 'quiz', 3, 10, '2024-05-20 09:51:13', 'angielski'),
(90, 3, 2, 'quiz', 2, 10, '2024-05-20 09:53:20', 'angielski'),
(91, 3, 4, 'quiz', 6, 10, '2024-05-20 09:55:26', 'angielski'),
(92, 3, 4, 'quiz', 2, 10, '2024-05-20 10:01:07', 'angielski'),
(93, 3, 2, 'quiz', 6, 10, '2024-05-20 10:11:06', 'angielski'),
(94, 3, 4, 'quiz', 10, 10, '2024-05-20 19:16:07', 'angielski'),
(95, 3, 4, 'quiz', 3, 10, '2024-05-20 19:19:02', 'angielski'),
(96, 3, 18, 'quiz', 6, 10, '2024-05-20 19:43:19', 'angielski'),
(97, 3, 10, 'quiz', 8, 10, '2024-05-20 19:44:14', 'angielski'),
(98, 3, 6, 'quiz', 4, 10, '2024-05-20 20:00:16', 'angielski'),
(99, 3, 14, 'quiz', 4, 10, '2024-05-20 20:10:03', 'angielski'),
(100, 3, 16, 'quiz', 5, 10, '2024-05-20 20:18:57', 'angielski'),
(101, 3, 11, 'quiz', 6, 10, '2024-05-20 20:22:23', 'angielski'),
(102, 3, 5, 'quiz', 0, 10, '2024-05-21 11:01:26', 'francuski'),
(103, 3, 2, 'quiz', 3, 10, '2024-05-22 08:06:28', 'angielski'),
(104, 3, 4, 'quiz', 0, 10, '2024-05-22 08:12:27', 'niemiecki'),
(105, 3, 2, 'quiz', 7, 10, '2024-05-31 22:17:01', 'angielski'),
(106, 3, 3, 'quiz', 1, 10, '2024-05-31 22:21:47', 'angielski'),
(107, 3, 5, 'quiz', 0, 10, '2024-05-31 22:22:12', 'angielski'),
(108, 7, 3, 'quiz', 8, 10, '2024-06-01 10:58:34', 'angielski'),
(109, 3, 3, 'quiz', 1, 10, '2024-06-01 13:08:57', 'angielski');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_sessions`
--

CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime DEFAULT NULL,
  `session_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `user_id`, `login_time`, `logout_time`, `session_time`) VALUES
(1, 3, '2024-05-20 01:10:36', NULL, NULL),
(2, 3, '2024-05-20 01:10:49', NULL, NULL),
(3, 3, '2024-05-20 01:11:00', NULL, NULL),
(4, 3, '2024-05-20 01:12:38', NULL, NULL),
(5, 3, '2024-05-20 01:12:50', NULL, NULL),
(6, 3, '2024-05-20 01:15:36', '2024-05-20 01:17:53', 137),
(7, 3, '2024-05-20 01:17:57', '2024-05-20 01:18:20', 23),
(8, 3, '2024-05-20 01:19:39', '2024-05-20 02:43:20', 5021),
(9, 3, '2024-05-20 02:43:24', NULL, NULL),
(10, 3, '2024-05-20 10:31:51', NULL, NULL),
(11, 3, '2024-05-20 11:28:18', NULL, NULL),
(12, 3, '2024-05-20 11:57:14', NULL, NULL),
(13, 3, '2024-05-20 12:07:14', NULL, NULL),
(14, 3, '2024-05-20 21:14:23', NULL, NULL),
(15, 3, '2024-05-20 22:24:48', '2024-05-20 22:25:26', 38),
(16, 3, '2024-05-21 12:54:50', '2024-05-21 12:56:45', 115),
(17, 3, '2024-05-21 12:56:49', NULL, NULL),
(18, 3, '2024-05-21 13:02:41', '2024-05-21 13:03:00', 19),
(19, 3, '2024-05-22 10:05:43', '2024-05-22 10:07:41', 118),
(20, 4, '2024-05-22 10:07:46', NULL, NULL),
(21, 3, '2024-05-22 10:11:08', '2024-05-22 10:19:09', 481),
(22, 5, '2024-05-22 10:19:58', '2024-05-22 10:21:45', 107),
(23, 6, '2024-05-31 19:57:45', '2024-05-31 19:57:47', 2),
(24, 3, '2024-05-31 20:32:13', '2024-05-31 22:46:53', 8080),
(25, 3, '2024-05-31 22:47:04', '2024-06-01 01:01:55', 8091),
(26, 4, '2024-06-01 01:01:58', NULL, NULL),
(27, 7, '2024-06-01 12:50:40', '2024-06-01 12:59:16', 516),
(28, 3, '2024-06-01 12:59:20', '2024-06-01 15:08:14', 7734),
(29, 3, '2024-06-01 15:08:26', '2024-06-01 15:11:00', 154),
(30, 4, '2024-06-01 15:11:03', NULL, NULL),
(31, 3, '2024-06-01 15:13:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `words`
--

CREATE TABLE `words` (
  `id` int(11) NOT NULL,
  `word` varchar(255) NOT NULL,
  `translation_pl` varchar(255) DEFAULT NULL,
  `translation_de` varchar(255) DEFAULT NULL,
  `translation_en` varchar(255) DEFAULT NULL,
  `translation_es` varchar(255) DEFAULT NULL,
  `translation_fr` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `words`
--

INSERT INTO `words` (`id`, `word`, `translation_pl`, `translation_de`, `translation_en`, `translation_es`, `translation_fr`) VALUES
(35, 'Czerwony', 'Czerwony', 'Rot', 'Red', 'Rojo', 'Rouge'),
(36, 'Niebieski', 'Niebieski', 'Blau', 'Blue', 'Azul', 'Bleu'),
(37, 'Żółty', 'Żółty', 'Gelb', 'Yellow', 'Amarillo', 'Jaune'),
(38, 'Zielony', 'Zielony', 'Grün', 'Green', 'Verde', 'Vert'),
(39, 'Czarny', 'Czarny', 'Schwarz', 'Black', 'Negro', 'Noir'),
(40, 'Biały', 'Biały', 'Weiß', 'White', 'Blanco', 'Blanc'),
(41, 'Pomarańczowy', 'Pomarańczowy', 'Orange', 'Orange', 'Naranja', 'Orange'),
(42, 'Różowy', 'Różowy', 'Rosa', 'Pink', 'Rosado', 'Rose'),
(43, 'Fioletowy', 'Fioletowy', 'Lila', 'Purple', 'Morado', 'Violet'),
(44, 'Brązowy', 'Brązowy', 'Braun', 'Brown', 'Marrón', 'Marron'),
(45, 'Szary', 'Szary', 'Grau', 'Gray', 'Gris', 'Gris'),
(46, 'Srebrny', 'Srebrny', 'Silber', 'Silver', 'Plateado', 'Argent'),
(47, 'Złoty', 'Złoty', 'Gold', 'Gold', 'Dorado', 'Or'),
(48, 'Granatowy', 'Granatowy', 'Marineblau', 'Navy blue', 'Azul marino', 'Bleu marine'),
(49, 'Błękitny', 'Błękitny', 'Hellblau', 'Light blue', 'Azul claro', 'Bleu clair'),
(50, 'Pies', 'Pies', 'Hund', 'Dog', 'Perro', 'Chien'),
(51, 'Kot', 'Kot', 'Katze', 'Cat', 'Gato', 'Chat'),
(52, 'Koń', 'Koń', 'Pferd', 'Horse', 'Caballo', 'Cheval'),
(53, 'Krowa', 'Krowa', 'Kuh', 'Cow', 'Vaca', 'Vache'),
(54, 'Owca', 'Owca', 'Schaf', 'Sheep', 'Oveja', 'Mouton'),
(55, 'Koza', 'Koza', 'Ziege', 'Goat', 'Cabra', 'Chèvre'),
(56, 'Świnia', 'Świnia', 'Schwein', 'Pig', 'Cerdo', 'Cochon'),
(57, 'Kurczak', 'Kurczak', 'Huhn', 'Chicken', 'Pollo', 'Poulet'),
(58, 'Kaczka', 'Kaczka', 'Ente', 'Duck', 'Pato', 'Canard'),
(59, 'Gęś', 'Gęś', 'Gans', 'Goose', 'Ganso', 'Oie'),
(60, 'Królik', 'Królik', 'Kaninchen', 'Rabbit', 'Conejo', 'Lapin'),
(61, 'Wilk', 'Wilk', 'Wolf', 'Wolf', 'Lobo', 'Loup'),
(62, 'Niedźwiedź', 'Niedźwiedź', 'Bär', 'Bear', 'Oso', 'Ours'),
(63, 'Lis', 'Lis', 'Fuchs', 'Fox', 'Zorro', 'Renard'),
(64, 'Jeleń', 'Jeleń', 'Hirsch', 'Deer', 'Ciervo', 'Cerf'),
(65, 'Słoń', 'Słoń', 'Elefant', 'Elephant', 'Elefante', 'Éléphant'),
(66, 'Tygrys', 'Tygrys', 'Tiger', 'Tiger', 'Tigre', 'Tigre'),
(67, 'Lew', 'Lew', 'Löwe', 'Lion', 'León', 'Lion'),
(68, 'Małpa', 'Małpa', 'Affe', 'Monkey', 'Mono', 'Singe'),
(69, 'Wąż', 'Wąż', 'Schlange', 'Snake', 'Serpiente', 'Serpent'),
(70, 'Dzień dobry', 'Dzień dobry', 'Guten Morgen', 'Good morning', 'Buenos días', 'Bonjour'),
(71, 'Dobry wieczór', 'Dobry wieczór', 'Guten Abend', 'Good evening', 'Buenas noches', 'Bonsoir'),
(72, 'Do widzenia', 'Do widzenia', 'Auf Wiedersehen', 'Goodbye', 'Adiós', 'Au revoir'),
(73, 'Proszę', 'Proszę', 'Bitte', 'Please', 'Por favor', 'S\'il vous plaît'),
(74, 'Dziękuję', 'Dziękuję', 'Danke', 'Thank you', 'Gracias', 'Merci'),
(75, 'Przepraszam', 'Przepraszam', 'Entschuldigung', 'Excuse me', 'Perdón', 'Pardon'),
(76, 'Tak', 'Tak', 'Ja', 'Yes', 'Sí', 'Oui'),
(77, 'Nie', 'Nie', 'Nein', 'No', 'No', 'Non'),
(78, 'Jak się masz?', 'Jak się masz?', 'Wie geht\'s?', 'How are you?', '¿Cómo estás?', 'Comment ça va?'),
(79, 'Dobrze, dziękuję', 'Dobrze, dziękuję', 'Gut, danke', 'Fine, thank you', 'Bien, gracias', 'Bien, merci'),
(80, 'Co słychać?', 'Co słychać?', 'Was gibt\'s Neues?', 'What\'s new?', '¿Qué hay de nuevo?', 'Quoi de neuf?'),
(81, 'Jak masz na imię?', 'Jak masz na imię?', 'Wie heißt du?', 'What\'s your name?', '¿Cómo te llamas?', 'Comment tu t\'appelles?'),
(82, 'Miło mi cię poznać', 'Miło mi cię poznać', 'Freut mich', 'Nice to meet you', 'Encantado', 'Enchanté'),
(83, 'Skąd jesteś?', 'Skąd jesteś?', 'Woher kommst du?', 'Where are you from?', '¿De dónde eres?', 'D\'où viens-tu?'),
(84, 'Jestem z Polski', 'Jestem z Polski', 'Ich komme aus Polen', 'I\'m from Poland', 'Soy de Polonia', 'Je viens de Pologne'),
(85, 'Ile masz lat?', 'Ile masz lat?', 'Wie alt bist du?', 'How old are you?', '¿Cuántos años tienes?', 'Quel âge as-tu?'),
(86, 'Mam 25 lat', 'Mam 25 lat', 'Ich bin 25 Jahre alt', 'I\'m 25 years old', 'Tengo 25 años', 'J\'ai 25 ans'),
(87, 'Gdzie mieszkasz?', 'Gdzie mieszkasz?', 'Wo wohnst du?', 'Where do you live?', '¿Dónde vives?', 'Où habites-tu?'),
(88, 'Mieszkam w Warszawie', 'Mieszkam w Warszawie', 'Ich wohne in Warschau', 'I live in Warsaw', 'Vivo en Varsovia', 'J\'habite à Varsovie'),
(89, 'Co robisz?', 'Co robisz?', 'Was machst du?', 'What do you do?', '¿Qué haces?', 'Que fais-tu?'),
(90, 'Jeden', 'Jeden', 'Eins', 'One', 'Uno', 'Un'),
(91, 'Dwa', 'Dwa', 'Zwei', 'Two', 'Dos', 'Deux'),
(92, 'Trzy', 'Trzy', 'Drei', 'Three', 'Tres', 'Trois'),
(93, 'Cztery', 'Cztery', 'Vier', 'Four', 'Cuatro', 'Quatre'),
(94, 'Pięć', 'Pięć', 'Fünf', 'Five', 'Cinco', 'Cinq'),
(95, 'Sześć', 'Sześć', 'Sechs', 'Six', 'Seis', 'Six'),
(96, 'Siedem', 'Siedem', 'Sieben', 'Seven', 'Siete', 'Sept'),
(97, 'Osiem', 'Osiem', 'Acht', 'Eight', 'Ocho', 'Huit'),
(98, 'Dziewięć', 'Dziewięć', 'Neun', 'Nine', 'Nueve', 'Neuf'),
(99, 'Dziesięć', 'Dziesięć', 'Zehn', 'Ten', 'Diez', 'Dix'),
(100, 'Jedenaście', 'Jedenaście', 'Elf', 'Eleven', 'Once', 'Onze'),
(101, 'Dwanaście', 'Dwanaście', 'Zwölf', 'Twelve', 'Doce', 'Douze'),
(102, 'Trzynaście', 'Trzynaście', 'Dreizehn', 'Thirteen', 'Trece', 'Treize'),
(103, 'Czternaście', 'Czternaście', 'Vierzehn', 'Fourteen', 'Catorce', 'Quatorze'),
(104, 'Piętnaście', 'Piętnaście', 'Fünfzehn', 'Fifteen', 'Quince', 'Quinze'),
(105, 'Szesnaście', 'Szesnaście', 'Sechzehn', 'Sixteen', 'Dieciséis', 'Seize'),
(106, 'Siedemnaście', 'Siedemnaście', 'Siebzehn', 'Seventeen', 'Diecisiete', 'Dix-sept'),
(107, 'Osiemnaście', 'Osiemnaście', 'Achtzehn', 'Eighteen', 'Dieciocho', 'Dix-huit'),
(108, 'Dziewiętnaście', 'Dziewiętnaście', 'Neunzehn', 'Nineteen', 'Diecinueve', 'Dix-neuf'),
(109, 'Dwadzieścia', 'Dwadzieścia', 'Zwanzig', 'Twenty', 'Veinte', 'Vingt'),
(110, 'Jabłko', 'Jabłko', 'Apfel', 'Apple', 'Manzana', 'Pomme'),
(111, 'Banana', 'Banana', 'Banane', 'Banana', 'Plátano', 'Banane'),
(112, 'Pomarańcza', 'Pomarańcza', 'Orange', 'Orange', 'Naranja', 'Orange'),
(113, 'Gruszka', 'Gruszka', 'Birne', 'Pear', 'Pera', 'Poire'),
(114, 'Winogrono', 'Winogrono', 'Traube', 'Grape', 'Uva', 'Raisin'),
(115, 'Cytryna', 'Cytryna', 'Zitrone', 'Lemon', 'Limón', 'Citron'),
(116, 'Truskawka', 'Truskawka', 'Erdbeere', 'Strawberry', 'Fresa', 'Fraise'),
(117, 'Ananas', 'Ananas', 'Ananas', 'Pineapple', 'Piña', 'Ananas'),
(118, 'Arbuz', 'Arbuz', 'Wassermelone', 'Watermelon', 'Sandía', 'Pastèque'),
(119, 'Morela', 'Morela', 'Aprikose', 'Apricot', 'Albaricoque', 'Abricot'),
(120, 'Brzoskwinia', 'Brzoskwinia', 'Pfirsich', 'Peach', 'Durazno', 'Pêche'),
(121, 'Malina', 'Malina', 'Himbeere', 'Raspberry', 'Frambuesa', 'Framboise'),
(122, 'Czereśnia', 'Czereśnia', 'Kirsche', 'Cherry', 'Cereza', 'Cerise'),
(123, 'Śliwka', 'Śliwka', 'Pflaume', 'Plum', 'Ciruela', 'Prune'),
(124, 'Granat', 'Granat', 'Granatapfel', 'Pomegranate', 'Granada', 'Grenade'),
(125, 'Figa', 'Figa', 'Feige', 'Fig', 'Higo', 'Figue'),
(126, 'Kiwi', 'Kiwi', 'Kiwi', 'Kiwi', 'Kiwi', 'Kiwi'),
(127, 'Mandarynka', 'Mandarynka', 'Mandarine', 'Tangerine', 'Mandarina', 'Mandarine'),
(128, 'Kokos', 'Kokos', 'Kokosnuss', 'Coconut', 'Coco', 'Noix de coco'),
(129, 'Mango', 'Mango', 'Mango', 'Mango', 'Mango', 'Mangue'),
(130, 'Marchew', 'Marchew', 'Karotte', 'Carrot', 'Zanahoria', 'Carotte'),
(131, 'Ziemniak', 'Ziemniak', 'Kartoffel', 'Potato', 'Patata', 'Pomme de terre'),
(132, 'Pomidor', 'Pomidor', 'Tomate', 'Tomato', 'Tomate', 'Tomate'),
(133, 'Ogórek', 'Ogórek', 'Gurke', 'Cucumber', 'Pepino', 'Concombre'),
(134, 'Papryka', 'Papryka', 'Paprika', 'Pepper', 'Pimiento', 'Poivron'),
(135, 'Cebula', 'Cebula', 'Zwiebel', 'Onion', 'Cebolla', 'Oignon'),
(136, 'Czosnek', 'Czosnek', 'Knoblauch', 'Garlic', 'Ajo', 'Ail'),
(137, 'Kalafior', 'Kalafior', 'Blumenkohl', 'Cauliflower', 'Coliflor', 'Chou-fleur'),
(138, 'Brokuły', 'Brokuły', 'Brokkoli', 'Broccoli', 'Brócoli', 'Brocoli'),
(139, 'Szpinak', 'Szpinak', 'Spinat', 'Spinach', 'Espinaca', 'Épinard'),
(140, 'Sałata', 'Sałata', 'Salat', 'Lettuce', 'Lechuga', 'Laitue'),
(141, 'Burak', 'Burak', 'Rübe', 'Beetroot', 'Remolacha', 'Betterave'),
(142, 'Rzodkiewka', 'Rzodkiewka', 'Radieschen', 'Radish', 'Rábano', 'Radis'),
(143, 'Dynia', 'Dynia', 'Kürbis', 'Pumpkin', 'Calabaza', 'Citrouille'),
(144, 'Kukurydza', 'Kukurydza', 'Mais', 'Corn', 'Maíz', 'Maïs'),
(145, 'Groszek', 'Groszek', 'Erbse', 'Pea', 'Guisante', 'Pois'),
(146, 'Fasola', 'Fasola', 'Bohne', 'Bean', 'Frijol', 'Haricot'),
(147, 'Por', 'Por', 'Lauch', 'Leek', 'Puerro', 'Poireau'),
(148, 'Kalarepa', 'Kalarepa', 'Kohlrabi', 'Kohlrabi', 'Colinabo', 'Chou-rave'),
(149, 'Cukinia', 'Cukinia', 'Zucchini', 'Zucchini', 'Calabacín', 'Courgette'),
(150, 'Godzina', 'Godzina', 'Stunde', 'Hour', 'Hora', 'Heure'),
(151, 'Minuta', 'Minuta', 'Minute', 'Minute', 'Minuto', 'Minute'),
(152, 'Sekunda', 'Sekunda', 'Sekunde', 'Second', 'Segundo', 'Seconde'),
(153, 'Dzień', 'Dzień', 'Tag', 'Day', 'Día', 'Jour'),
(154, 'Tydzień', 'Tydzień', 'Woche', 'Week', 'Semana', 'Semaine'),
(155, 'Miesiąc', 'Miesiąc', 'Monat', 'Month', 'Mes', 'Mois'),
(156, 'Rok', 'Rok', 'Jahr', 'Year', 'Año', 'Année'),
(157, 'Wczoraj', 'Wczoraj', 'Gestern', 'Yesterday', 'Ayer', 'Hier'),
(158, 'Dziś', 'Dziś', 'Heute', 'Today', 'Hoy', 'Aujourd\'hui'),
(159, 'Jutro', 'Jutro', 'Morgen', 'Tomorrow', 'Mañana', 'Demain'),
(160, 'Poranek', 'Poranek', 'Morgen', 'Morning', 'Mañana', 'Matin'),
(161, 'Popołudnie', 'Popołudnie', 'Nachmittag', 'Afternoon', 'Tarde', 'Après-midi'),
(162, 'Wieczór', 'Wieczór', 'Abend', 'Evening', 'Noche', 'Soir'),
(163, 'Noc', 'Noc', 'Nacht', 'Night', 'Noche', 'Nuit'),
(164, 'Poniedziałek', 'Poniedziałek', 'Montag', 'Monday', 'Lunes', 'Lundi'),
(165, 'Wtorek', 'Wtorek', 'Dienstag', 'Tuesday', 'Martes', 'Mardi'),
(166, 'Środa', 'Środa', 'Mittwoch', 'Wednesday', 'Miércoles', 'Mercredi'),
(167, 'Czwartek', 'Czwartek', 'Donnerstag', 'Thursday', 'Jueves', 'Jeudi'),
(168, 'Piątek', 'Piątek', 'Freitag', 'Friday', 'Viernes', 'Vendredi'),
(169, 'Sobota', 'Sobota', 'Samstag', 'Saturday', 'Sábado', 'Samedi'),
(170, 'Słońce', 'Słońce', 'Sonne', 'Sun', 'Sol', 'Soleil'),
(171, 'Deszcz', 'Deszcz', 'Regen', 'Rain', 'Lluvia', 'Pluie'),
(172, 'Śnieg', 'Śnieg', 'Schnee', 'Snow', 'Nieve', 'Neige'),
(173, 'Wiatr', 'Wiatr', 'Wind', 'Wind', 'Viento', 'Vent'),
(174, 'Burza', 'Burza', 'Gewitter', 'Storm', 'Tormenta', 'Orage'),
(175, 'Mgła', 'Mgła', 'Nebel', 'Fog', 'Niebla', 'Brouillard'),
(176, 'Pogoda', 'Pogoda', 'Wetter', 'Weather', 'Tiempo', 'Temps'),
(177, 'Temperatura', 'Temperatura', 'Temperatur', 'Temperature', 'Temperatura', 'Température'),
(178, 'Ciepło', 'Ciepło', 'Wärme', 'Warmth', 'Calor', 'Chaleur'),
(179, 'Zimno', 'Zimno', 'Kälte', 'Cold', 'Frío', 'Froid'),
(180, 'Mróz', 'Mróz', 'Frost', 'Frost', 'Helada', 'Gel'),
(181, 'Lód', 'Lód', 'Eis', 'Ice', 'Hielo', 'Glace'),
(182, 'Chmura', 'Chmura', 'Wolke', 'Cloud', 'Nube', 'Nuage'),
(183, 'Tęcza', 'Tęcza', 'Regenbogen', 'Rainbow', 'Arco iris', 'Arc-en-ciel'),
(184, 'Słońce świeci', 'Słońce świeci', 'Die Sonne scheint', 'The sun is shining', 'El sol brilla', 'Le soleil brille'),
(185, 'Pada deszcz', 'Pada deszcz', 'Es regnet', 'It\'s raining', 'Está lloviendo', 'Il pleut'),
(186, 'Pada śnieg', 'Pada śnieg', 'Es schneit', 'It\'s snowing', 'Está nevando', 'Il neige'),
(187, 'Wieje wiatr', 'Wieje wiatr', 'Es weht', 'It\'s windy', 'Hace viento', 'Il fait du vent'),
(188, 'Burzowo', 'Burzowo', 'Stürmisch', 'Stormy', 'Tormentoso', 'Orageux'),
(189, 'Mglisto', 'Mglisto', 'Nebelig', 'Foggy', 'Nebuloso', 'Brumeux'),
(190, 'Praca', 'Praca', 'Arbeit', 'Work', 'Trabajo', 'Travail'),
(191, 'Zawód', 'Zawód', 'Beruf', 'Profession', 'Profesión', 'Profession'),
(192, 'Szef', 'Szef', 'Chef', 'Boss', 'Jefe', 'Chef'),
(193, 'Kolega z pracy', 'Kolega z pracy', 'Kollege', 'Colleague', 'Compañero de trabajo', 'Collègue'),
(194, 'Spotkanie', 'Spotkanie', 'Besprechung', 'Meeting', 'Reunión', 'Réunion'),
(195, 'Zadanie', 'Zadanie', 'Aufgabe', 'Task', 'Tarea', 'Tâche'),
(196, 'Projekt', 'Projekt', 'Projekt', 'Project', 'Proyecto', 'Projet'),
(197, 'Firma', 'Firma', 'Firma', 'Company', 'Empresa', 'Entreprise'),
(198, 'Biuro', 'Biuro', 'Büro', 'Office', 'Oficina', 'Bureau'),
(199, 'Pracownik', 'Pracownik', 'Mitarbeiter', 'Employee', 'Empleado', 'Employé'),
(200, 'Pracodawca', 'Pracodawca', 'Arbeitgeber', 'Employer', 'Empleador', 'Employeur'),
(201, 'Wynagrodzenie', 'Wynagrodzenie', 'Gehalt', 'Salary', 'Salario', 'Salaire'),
(202, 'Urlop', 'Urlop', 'Urlaub', 'Vacation', 'Vacaciones', 'Vacances'),
(203, 'Delegacja', 'Delegacja', 'Dienstreise', 'Business trip', 'Viaje de negocios', 'Voyage d\'affaires'),
(204, 'Kontrakt', 'Kontrakt', 'Vertrag', 'Contract', 'Contrato', 'Contrat'),
(205, 'Umowa', 'Umowa', 'Abkommen', 'Agreement', 'Acuerdo', 'Accord'),
(206, 'Rekrutacja', 'Rekrutacja', 'Rekrutierung', 'Recruitment', 'Reclutamiento', 'Recrutement'),
(207, 'Kariera', 'Kariera', 'Karriere', 'Career', 'Carrera', 'Carrière'),
(208, 'Emerytura', 'Emerytura', 'Rente', 'Retirement', 'Jubilación', 'Retraite'),
(209, 'Bezrobocie', 'Bezrobocie', 'Arbeitslosigkeit', 'Unemployment', 'Desempleo', 'Chômage'),
(210, 'Szkoła', 'Szkoła', 'Schule', 'School', 'Escuela', 'École'),
(211, 'Uczeń', 'Uczeń', 'Schüler', 'Student', 'Estudiante', 'Étudiant'),
(212, 'Nauczyciel', 'Nauczyciel', 'Lehrer', 'Teacher', 'Profesor', 'Professeur'),
(213, 'Lekcja', 'Lekcja', 'Unterricht', 'Lesson', 'Lección', 'Leçon'),
(214, 'Klasa', 'Klasa', 'Klasse', 'Class', 'Clase', 'Classe'),
(215, 'Przedmiot', 'Przedmiot', 'Fach', 'Subject', 'Asignatura', 'Matière'),
(216, 'Ocena', 'Ocena', 'Note', 'Grade', 'Nota', 'Note'),
(217, 'Egzamin', 'Egzamin', 'Prüfung', 'Exam', 'Examen', 'Examen'),
(218, 'Biblioteka', 'Biblioteka', 'Bibliothek', 'Library', 'Biblioteca', 'Bibliothèque'),
(219, 'Laboratorium', 'Laboratorium', 'Labor', 'Laboratory', 'Laboratorio', 'Laboratoire'),
(220, 'Stypendium', 'Stypendium', 'Stipendium', 'Scholarship', 'Beca', 'Bourse'),
(221, 'Uniwersytet', 'Uniwersytet', 'Universität', 'University', 'Universidad', 'Université'),
(222, 'Studia', 'Studia', 'Studium', 'Studies', 'Estudios', 'Études'),
(223, 'Dyplom', 'Dyplom', 'Diplom', 'Diploma', 'Diploma', 'Diplôme'),
(224, 'Wykształcenie', 'Wykształcenie', 'Bildung', 'Education', 'Educación', 'Éducation'),
(225, 'Zadanie domowe', 'Zadanie domowe', 'Hausaufgabe', 'Homework', 'Tarea', 'Devoirs'),
(226, 'Wychowawca', 'Wychowawca', 'Erzieher', 'Tutor', 'Tutor', 'Tuteur'),
(227, 'Boisko', 'Boisko', 'Spielplatz', 'Playground', 'Patio', 'Cour de récréation'),
(228, 'Książka', 'Książka', 'Buch', 'Book', 'Libro', 'Livre'),
(229, 'Zeszyt', 'Zeszyt', 'Heft', 'Notebook', 'Cuaderno', 'Cahier'),
(230, 'Piłka nożna', 'Piłka nożna', 'Fußball', 'Football', 'Fútbol', 'Football'),
(231, 'Koszykówka', 'Koszykówka', 'Basketball', 'Basketball', 'Baloncesto', 'Basket-ball'),
(232, 'Siatkówka', 'Siatkówka', 'Volleyball', 'Volleyball', 'Voleibol', 'Volley-ball'),
(233, 'Tenis', 'Tenis', 'Tennis', 'Tennis', 'Tenis', 'Tennis'),
(234, 'Pływanie', 'Pływanie', 'Schwimmen', 'Swimming', 'Natación', 'Natation'),
(235, 'Bieganie', 'Bieganie', 'Laufen', 'Running', 'Correr', 'Course'),
(236, 'Lekkoatletyka', 'Lekkoatletyka', 'Leichtathletik', 'Athletics', 'Atletismo', 'Athlétisme'),
(237, 'Hokej', 'Hokej', 'Hockey', 'Hockey', 'Hockey', 'Hockey'),
(238, 'Narciarstwo', 'Narciarstwo', 'Skifahren', 'Skiing', 'Esquí', 'Ski'),
(239, 'Łyżwiarstwo', 'Łyżwiarstwo', 'Eislaufen', 'Ice skating', 'Patinaje', 'Patinage'),
(240, 'Gimnastyka', 'Gimnastyka', 'Gymnastik', 'Gymnastics', 'Gimnasia', 'Gymnastique'),
(241, 'Rugby', 'Rugby', 'Rugby', 'Rugby', 'Rugby', 'Rugby'),
(242, 'Golf', 'Golf', 'Golf', 'Golf', 'Golf', 'Golf'),
(243, 'Jazda na rowerze', 'Jazda na rowerze', 'Radfahren', 'Cycling', 'Ciclismo', 'Cyclisme'),
(244, 'Wspinaczka', 'Wspinaczka', 'Klettern', 'Climbing', 'Escalada', 'Escalade'),
(245, 'Piłka ręczna', 'Piłka ręczna', 'Handball', 'Handball', 'Balonmano', 'Handball'),
(246, 'Judo', 'Judo', 'Judo', 'Judo', 'Judo', 'Judo'),
(247, 'Karate', 'Karate', 'Karate', 'Karate', 'Karate', 'Karate'),
(248, 'Szermierka', 'Szermierka', 'Fechten', 'Fencing', 'Esgrima', 'Escrime'),
(249, 'Sztuki walki', 'Sztuki walki', 'Kampfsport', 'Martial arts', 'Artes marciales', 'Arts martiaux'),
(250, 'Lekarz', 'Lekarz', 'Arzt', 'Doctor', 'Médico', 'Docteur'),
(251, 'Pielęgniarka', 'Pielęgniarka', 'Krankenschwester', 'Nurse', 'Enfermera', 'Infirmière'),
(252, 'Szpital', 'Szpital', 'Krankenhaus', 'Hospital', 'Hospital', 'Hôpital'),
(253, 'Przychodnia', 'Przychodnia', 'Klinik', 'Clinic', 'Clínica', 'Clinique'),
(254, 'Apteka', 'Apteka', 'Apotheke', 'Pharmacy', 'Farmacia', 'Pharmacie'),
(255, 'Choroba', 'Choroba', 'Krankheit', 'Illness', 'Enfermedad', 'Maladie'),
(256, 'Gorączka', 'Gorączka', 'Fieber', 'Fever', 'Fiebre', 'Fièvre'),
(257, 'Ból', 'Ból', 'Schmerz', 'Pain', 'Dolor', 'Douleur'),
(258, 'Złamanie', 'Złamanie', 'Bruch', 'Fracture', 'Fractura', 'Fracture'),
(259, 'Infekcja', 'Infekcja', 'Infektion', 'Infection', 'Infección', 'Infection'),
(260, 'Antybiotyk', 'Antybiotyk', 'Antibiotikum', 'Antibiotic', 'Antibiótico', 'Antibiotique'),
(261, 'Tabletka', 'Tabletka', 'Tablette', 'Tablet', 'Tableta', 'Comprimé'),
(262, 'Operacja', 'Operacja', 'Operation', 'Operation', 'Operación', 'Opération'),
(263, 'Zdrowie', 'Zdrowie', 'Gesundheit', 'Health', 'Salud', 'Santé'),
(264, 'Zdrowy', 'Zdrowy', 'Gesund', 'Healthy', 'Saludable', 'Sain'),
(265, 'Chory', 'Chory', 'Krank', 'Sick', 'Enfermo', 'Malade'),
(266, 'Karetka', 'Karetka', 'Krankenwagen', 'Ambulance', 'Ambulancia', 'Ambulance'),
(267, 'Lekarstwo', 'Lekarstwo', 'Medikament', 'Medicine', 'Medicina', 'Médicament'),
(268, 'Recepta', 'Recepta', 'Rezept', 'Prescription', 'Receta', 'Ordonnance'),
(269, 'Badanie', 'Badanie', 'Untersuchung', 'Examination', 'Examen', 'Examen'),
(270, 'Chleb', 'Chleb', 'Brot', 'Bread', 'Pan', 'Pain'),
(271, 'Masło', 'Masło', 'Butter', 'Butter', 'Mantequilla', 'Beurre'),
(272, 'Ser', 'Ser', 'Käse', 'Cheese', 'Queso', 'Fromage'),
(273, 'Szynka', 'Szynka', 'Schinken', 'Ham', 'Jamón', 'Jambon'),
(274, 'Jajko', 'Jajko', 'Ei', 'Egg', 'Huevo', 'Œuf'),
(275, 'Mleko', 'Mleko', 'Milch', 'Milk', 'Leche', 'Lait'),
(276, 'Kawa', 'Kawa', 'Kaffee', 'Coffee', 'Café', 'Café'),
(277, 'Herbata', 'Herbata', 'Tee', 'Tea', 'Té', 'Thé'),
(278, 'Woda', 'Woda', 'Wasser', 'Water', 'Agua', 'Eau'),
(279, 'Sok', 'Sok', 'Saft', 'Juice', 'Jugo', 'Jus'),
(280, 'Czekolada', 'Czekolada', 'Schokolade', 'Chocolate', 'Chocolate', 'Chocolat'),
(281, 'Cukierek', 'Cukierek', 'Bonbon', 'Candy', 'Caramelo', 'Bonbon'),
(282, 'Ciasto', 'Ciasto', 'Kuchen', 'Cake', 'Pastel', 'Gâteau'),
(283, 'Lody', 'Lody', 'Eis', 'Ice cream', 'Helado', 'Glace'),
(284, 'Pizza', 'Pizza', 'Pizza', 'Pizza', 'Pizza', 'Pizza'),
(285, 'Kanapka', 'Kanapka', 'Sandwich', 'Sandwich', 'Sándwich', 'Sandwich'),
(286, 'Zupa', 'Zupa', 'Suppe', 'Soup', 'Sopa', 'Soupe'),
(287, 'Sałatka', 'Sałatka', 'Salat', 'Salad', 'Ensalada', 'Salade'),
(288, 'Makaron', 'Makaron', 'Nudeln', 'Pasta', 'Pasta', 'Pâtes'),
(289, 'Ryż', 'Ryż', 'Reis', 'Rice', 'Arroz', 'Riz'),
(290, 'Dom', 'Dom', 'Haus', 'House', 'Casa', 'Maison'),
(291, 'Mieszkanie', 'Mieszkanie', 'Wohnung', 'Apartment', 'Apartamento', 'Appartement'),
(292, 'Kuchnia', 'Kuchnia', 'Küche', 'Kitchen', 'Cocina', 'Cuisine'),
(293, 'Łazienka', 'Łazienka', 'Badezimmer', 'Bathroom', 'Baño', 'Salle de bain'),
(294, 'Sypialnia', 'Sypialnia', 'Schlafzimmer', 'Bedroom', 'Dormitorio', 'Chambre'),
(295, 'Salon', 'Salon', 'Wohnzimmer', 'Living room', 'Sala de estar', 'Salon'),
(296, 'Ogród', 'Ogród', 'Garten', 'Garden', 'Jardín', 'Jardin'),
(297, 'Balkon', 'Balkon', 'Balkon', 'Balcony', 'Balcón', 'Balcon'),
(298, 'Garaż', 'Garaż', 'Garage', 'Garage', 'Garaje', 'Garage'),
(299, 'Schody', 'Schody', 'Treppe', 'Stairs', 'Escaleras', 'Escalier'),
(300, 'Piwnica', 'Piwnica', 'Keller', 'Basement', 'Sótano', 'Sous-sol'),
(301, 'Strych', 'Strych', 'Dachboden', 'Attic', 'Ático', 'Grenier'),
(302, 'Drzwi', 'Drzwi', 'Tür', 'Door', 'Puerta', 'Porte'),
(303, 'Okno', 'Okno', 'Fenster', 'Window', 'Ventana', 'Fenêtre'),
(304, 'Ściana', 'Ściana', 'Wand', 'Wall', 'Pared', 'Mur'),
(305, 'Dach', 'Dach', 'Dach', 'Roof', 'Techo', 'Toit'),
(306, 'Podłoga', 'Podłoga', 'Boden', 'Floor', 'Suelo', 'Sol'),
(307, 'Sufit', 'Sufit', 'Decke', 'Ceiling', 'Techo', 'Plafond'),
(308, 'Szafa', 'Szafa', 'Schrank', 'Wardrobe', 'Armario', 'Armoire'),
(309, 'Łóżko', 'Łóżko', 'Bett', 'Bed', 'Cama', 'Lit'),
(310, 'Rodzina', 'Rodzina', 'Familie', 'Family', 'Familia', 'Famille'),
(311, 'Ojciec', 'Ojciec', 'Vater', 'Father', 'Padre', 'Père'),
(312, 'Matka', 'Matka', 'Mutter', 'Mother', 'Madre', 'Mère'),
(313, 'Brat', 'Brat', 'Bruder', 'Brother', 'Hermano', 'Frère'),
(314, 'Siostra', 'Siostra', 'Schwester', 'Sister', 'Hermana', 'Sœur'),
(315, 'Dziadek', 'Dziadek', 'Großvater', 'Grandfather', 'Abuelo', 'Grand-père'),
(316, 'Babcia', 'Babcia', 'Großmutter', 'Grandmother', 'Abuela', 'Grand-mère'),
(317, 'Wujek', 'Wujek', 'Onkel', 'Uncle', 'Tío', 'Oncle'),
(318, 'Ciocia', 'Ciocia', 'Tante', 'Aunt', 'Tía', 'Tante'),
(319, 'Kuzyn', 'Kuzyn', 'Cousin', 'Cousin', 'Primo', 'Cousin'),
(320, 'Kuzynka', 'Kuzynka', 'Cousine', 'Cousin (female)', 'Prima', 'Cousine'),
(321, 'Syn', 'Syn', 'Sohn', 'Son', 'Hijo', 'Fils'),
(322, 'Córka', 'Córka', 'Tochter', 'Daughter', 'Hija', 'Fille'),
(323, 'Małżonek', 'Małżonek', 'Ehemann', 'Husband', 'Esposo', 'Mari'),
(324, 'Małżonka', 'Małżonka', 'Ehefrau', 'Wife', 'Esposa', 'Femme'),
(325, 'Dziecko', 'Dziecko', 'Kind', 'Child', 'Niño', 'Enfant'),
(326, 'Rodzeństwo', 'Rodzeństwo', 'Geschwister', 'Siblings', 'Hermanos', 'Frères et sœurs'),
(327, 'Wnuk', 'Wnuk', 'Enkel', 'Grandson', 'Nieto', 'Petit-fils'),
(328, 'Wnuczka', 'Wnuczka', 'Enkelin', 'Granddaughter', 'Nieta', 'Petite-fille'),
(329, 'Teściowa', 'Teściowa', 'Schwiegermutter', 'Mother-in-law', 'Suegra', 'Belle-mère'),
(330, 'Miasto', 'Miasto', 'Stadt', 'City', 'Ciudad', 'Ville'),
(331, 'Ulica', 'Ulica', 'Straße', 'Street', 'Calle', 'Rue'),
(332, 'Plac', 'Plac', 'Platz', 'Square', 'Plaza', 'Place'),
(333, 'Rynek', 'Rynek', 'Markt', 'Market', 'Mercado', 'Marché'),
(334, 'Ratusz', 'Ratusz', 'Rathaus', 'Town hall', 'Ayuntamiento', 'Hôtel de ville'),
(335, 'Szkoła', 'Szkoła', 'Schule', 'School', 'Escuela', 'École'),
(336, 'Szpital', 'Szpital', 'Krankenhaus', 'Hospital', 'Hospital', 'Hôpital'),
(337, 'Restauracja', 'Restauracja', 'Restaurant', 'Restaurant', 'Restaurante', 'Restaurant'),
(338, 'Kawiarnia', 'Kawiarnia', 'Café', 'Cafe', 'Cafetería', 'Café'),
(339, 'Sklep', 'Sklep', 'Geschäft', 'Shop', 'Tienda', 'Magasin'),
(340, 'Kościół', 'Kościół', 'Kirche', 'Church', 'Iglesia', 'Église'),
(341, 'Park', 'Park', 'Park', 'Park', 'Parque', 'Parc'),
(342, 'Stadion', 'Stadion', 'Stadion', 'Stadium', 'Estadio', 'Stade'),
(343, 'Biblioteka', 'Biblioteka', 'Bibliothek', 'Library', 'Biblioteca', 'Bibliothèque'),
(344, 'Dworzec', 'Dworzec', 'Bahnhof', 'Station', 'Estación', 'Gare'),
(345, 'Lotnisko', 'Lotnisko', 'Flughafen', 'Airport', 'Aeropuerto', 'Aéroport'),
(346, 'Apteka', 'Apteka', 'Apotheke', 'Pharmacy', 'Farmacia', 'Pharmacie'),
(347, 'Muzeum', 'Muzeum', 'Museum', 'Museum', 'Museo', 'Musée'),
(348, 'Teatr', 'Teatr', 'Theater', 'Theater', 'Teatro', 'Théâtre'),
(349, 'Galeria', 'Galeria', 'Galerie', 'Gallery', 'Galería', 'Galerie'),
(350, 'Podróż', 'Podróż', 'Reise', 'Travel', 'Viaje', 'Voyage'),
(351, 'Walizka', 'Walizka', 'Koffer', 'Suitcase', 'Maleta', 'Valise'),
(352, 'Paszport', 'Paszport', 'Reisepass', 'Passport', 'Pasaporte', 'Passeport'),
(353, 'Bilet', 'Bilet', 'Ticket', 'Ticket', 'Billete', 'Billet'),
(354, 'Hotel', 'Hotel', 'Hotel', 'Hotel', 'Hotel', 'Hôtel'),
(355, 'Kemping', 'Kemping', 'Camping', 'Camping', 'Camping', 'Camping'),
(356, 'Lot', 'Lot', 'Flug', 'Flight', 'Vuelo', 'Vol'),
(357, 'Pociąg', 'Pociąg', 'Zug', 'Train', 'Tren', 'Train'),
(358, 'Samolot', 'Samolot', 'Flugzeug', 'Plane', 'Avión', 'Avion'),
(359, 'Autobus', 'Autobus', 'Bus', 'Bus', 'Autobús', 'Bus'),
(360, 'Rezerwacja', 'Rezerwacja', 'Reservierung', 'Reservation', 'Reserva', 'Réservation'),
(361, 'Przewodnik', 'Przewodnik', 'Führer', 'Guide', 'Guía', 'Guide'),
(362, 'Mapa', 'Mapa', 'Karte', 'Map', 'Mapa', 'Carte'),
(363, 'Podróżnik', 'Podróżnik', 'Reisender', 'Traveler', 'Viajero', 'Voyageur'),
(364, 'Atrakcje', 'Atrakcje', 'Attraktionen', 'Attractions', 'Atracciones', 'Attractions'),
(365, 'Plaża', 'Plaża', 'Strand', 'Beach', 'Playa', 'Plage'),
(366, 'Góry', 'Góry', 'Berge', 'Mountains', 'Montañas', 'Montagnes'),
(367, 'Morze', 'Morze', 'Meer', 'Sea', 'Mar', 'Mer'),
(368, 'Wakacje', 'Wakacje', 'Urlaub', 'Holiday', 'Vacaciones', 'Vacances'),
(369, 'Pamiątka', 'Pamiątka', 'Souvenir', 'Souvenir', 'Recuerdo', 'Souvenir'),
(370, 'Kultura', 'Kultura', 'Kultur', 'Culture', 'Cultura', 'Culture'),
(371, 'Sztuka', 'Sztuka', 'Kunst', 'Art', 'Arte', 'Art'),
(372, 'Teatr', 'Teatr', 'Theater', 'Theater', 'Teatro', 'Théâtre'),
(373, 'Film', 'Film', 'Film', 'Film', 'Película', 'Film'),
(374, 'Muzyka', 'Muzyka', 'Musik', 'Music', 'Música', 'Musique'),
(375, 'Literatura', 'Literatura', 'Literatur', 'Literature', 'Literatura', 'Littérature'),
(376, 'Taniec', 'Taniec', 'Tanz', 'Dance', 'Danza', 'Danse'),
(377, 'Wystawa', 'Wystawa', 'Ausstellung', 'Exhibition', 'Exposición', 'Exposition'),
(378, 'Biblioteka', 'Biblioteka', 'Bibliothek', 'Library', 'Biblioteca', 'Bibliothèque'),
(379, 'Muzeum', 'Muzeum', 'Museum', 'Museum', 'Museo', 'Musée'),
(380, 'Opera', 'Opera', 'Oper', 'Opera', 'Ópera', 'Opéra'),
(381, 'Koncert', 'Koncert', 'Konzert', 'Concert', 'Concierto', 'Concert'),
(382, 'Galeria', 'Galeria', 'Galerie', 'Gallery', 'Galería', 'Galerie'),
(383, 'Festyn', 'Festyn', 'Fest', 'Festival', 'Festival', 'Festival'),
(384, 'Kino', 'Kino', 'Kino', 'Cinema', 'Cine', 'Cinéma'),
(385, 'Artysta', 'Artysta', 'Künstler', 'Artist', 'Artista', 'Artiste'),
(386, 'Pisarka', 'Pisarka', 'Schriftstellerin', 'Writer', 'Escritora', 'Écrivaine'),
(387, 'Aktor', 'Aktor', 'Schauspieler', 'Actor', 'Actor', 'Acteur'),
(388, 'Rzeźba', 'Rzeźba', 'Skulptur', 'Sculpture', 'Escultura', 'Sculpture'),
(389, 'Malowanie', 'Malowanie', 'Malerei', 'Painting', 'Pintura', 'Peinture');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `word_categories`
--

CREATE TABLE `word_categories` (
  `word_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `word_categories`
--

INSERT INTO `word_categories` (`word_id`, `category_id`) VALUES
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(58, 4),
(59, 4),
(60, 4),
(61, 4),
(62, 4),
(63, 4),
(64, 4),
(65, 4),
(66, 4),
(67, 4),
(68, 4),
(69, 4),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 3),
(91, 3),
(92, 3),
(93, 3),
(94, 3),
(95, 3),
(96, 3),
(97, 3),
(98, 3),
(99, 3),
(100, 3),
(101, 3),
(102, 3),
(103, 3),
(104, 3),
(105, 3),
(106, 3),
(107, 3),
(108, 3),
(109, 3),
(110, 5),
(111, 5),
(112, 5),
(113, 5),
(114, 5),
(115, 5),
(116, 5),
(117, 5),
(118, 5),
(119, 5),
(120, 5),
(121, 5),
(122, 5),
(123, 5),
(124, 5),
(125, 5),
(126, 5),
(127, 5),
(128, 5),
(129, 5),
(130, 6),
(131, 6),
(132, 6),
(133, 6),
(134, 6),
(135, 6),
(136, 6),
(137, 6),
(138, 6),
(139, 6),
(140, 6),
(141, 6),
(142, 6),
(143, 6),
(144, 6),
(145, 6),
(146, 6),
(147, 6),
(148, 6),
(149, 6),
(150, 7),
(151, 7),
(152, 7),
(153, 7),
(154, 7),
(155, 7),
(156, 7),
(157, 7),
(158, 7),
(159, 7),
(160, 7),
(161, 7),
(162, 7),
(163, 7),
(164, 7),
(165, 7),
(166, 7),
(167, 7),
(168, 7),
(169, 7),
(170, 8),
(171, 8),
(172, 8),
(173, 8),
(174, 8),
(175, 8),
(176, 8),
(177, 8),
(178, 8),
(179, 8),
(180, 8),
(181, 8),
(182, 8),
(183, 8),
(184, 8),
(185, 8),
(186, 8),
(187, 8),
(188, 8),
(189, 8),
(190, 9),
(191, 9),
(192, 9),
(193, 9),
(194, 9),
(195, 9),
(196, 9),
(197, 9),
(198, 9),
(199, 9),
(200, 9),
(201, 9),
(202, 9),
(203, 9),
(204, 9),
(205, 9),
(206, 9),
(207, 9),
(208, 9),
(209, 9),
(210, 10),
(210, 16),
(211, 10),
(212, 10),
(213, 10),
(214, 10),
(215, 10),
(216, 10),
(217, 10),
(218, 10),
(218, 16),
(218, 18),
(219, 10),
(220, 10),
(221, 10),
(222, 10),
(223, 10),
(224, 10),
(225, 10),
(226, 10),
(227, 10),
(228, 10),
(229, 10),
(230, 11),
(231, 11),
(232, 11),
(233, 11),
(234, 11),
(235, 11),
(236, 11),
(237, 11),
(238, 11),
(239, 11),
(240, 11),
(241, 11),
(242, 11),
(243, 11),
(244, 11),
(245, 11),
(246, 11),
(247, 11),
(248, 11),
(249, 11),
(250, 12),
(251, 12),
(252, 12),
(252, 16),
(253, 12),
(254, 12),
(254, 16),
(255, 12),
(256, 12),
(257, 12),
(258, 12),
(259, 12),
(260, 12),
(261, 12),
(262, 12),
(263, 12),
(264, 12),
(265, 12),
(266, 12),
(267, 12),
(268, 12),
(269, 12),
(270, 13),
(271, 13),
(272, 13),
(273, 13),
(274, 13),
(275, 13),
(276, 13),
(277, 13),
(278, 13),
(279, 13),
(280, 13),
(281, 13),
(282, 13),
(283, 13),
(284, 13),
(285, 13),
(286, 13),
(287, 13),
(288, 13),
(289, 13),
(290, 14),
(291, 14),
(292, 14),
(293, 14),
(294, 14),
(295, 14),
(296, 14),
(297, 14),
(298, 14),
(299, 14),
(300, 14),
(301, 14),
(302, 14),
(303, 14),
(304, 14),
(305, 14),
(306, 14),
(307, 14),
(308, 14),
(309, 14),
(310, 15),
(311, 15),
(312, 15),
(313, 15),
(314, 15),
(315, 15),
(316, 15),
(317, 15),
(318, 15),
(319, 15),
(320, 15),
(321, 15),
(322, 15),
(323, 15),
(324, 15),
(325, 15),
(326, 15),
(327, 15),
(328, 15),
(329, 15),
(330, 16),
(331, 16),
(332, 16),
(333, 16),
(334, 16),
(335, 16),
(336, 16),
(337, 16),
(338, 16),
(339, 16),
(340, 16),
(341, 16),
(342, 16),
(343, 16),
(343, 18),
(344, 16),
(345, 16),
(346, 16),
(347, 16),
(347, 18),
(348, 16),
(348, 18),
(349, 16),
(349, 18),
(350, 17),
(351, 17),
(352, 17),
(353, 17),
(354, 17),
(355, 17),
(356, 17),
(357, 17),
(358, 17),
(359, 17),
(360, 17),
(361, 17),
(362, 17),
(363, 17),
(364, 17),
(365, 17),
(366, 17),
(367, 17),
(368, 17),
(369, 17),
(370, 18),
(371, 18),
(372, 18),
(373, 18),
(374, 18),
(375, 18),
(376, 18),
(377, 18),
(378, 18),
(379, 18),
(380, 18),
(381, 18),
(382, 18),
(383, 18),
(384, 18),
(385, 18),
(386, 18),
(387, 18),
(388, 18),
(389, 18);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `srs_words`
--
ALTER TABLE `srs_words`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `word_id` (`word_id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_history`
--
ALTER TABLE `user_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `user_history_ibfk_1` (`user_id`);

--
-- Indeksy dla tabeli `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `words`
--
ALTER TABLE `words`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `word_categories`
--
ALTER TABLE `word_categories`
  ADD PRIMARY KEY (`word_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `srs_words`
--
ALTER TABLE `srs_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_history`
--
ALTER TABLE `user_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `user_sessions`
--
ALTER TABLE `user_sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `words`
--
ALTER TABLE `words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `srs_words`
--
ALTER TABLE `srs_words`
  ADD CONSTRAINT `srs_words_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `srs_words_ibfk_2` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`);

--
-- Constraints for table `user_history`
--
ALTER TABLE `user_history`
  ADD CONSTRAINT `user_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_history_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `user_sessions`
--
ALTER TABLE `user_sessions`
  ADD CONSTRAINT `user_sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `word_categories`
--
ALTER TABLE `word_categories`
  ADD CONSTRAINT `word_categories_ibfk_1` FOREIGN KEY (`word_id`) REFERENCES `words` (`id`),
  ADD CONSTRAINT `word_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
