-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 05:10 PM
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
-- Database: `main`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `likeid` varchar(255) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `likeid`, `productid`, `userid`, `message`, `date`) VALUES
(173, '0ceda41cce6bb591a07e', '6653ae4631c0f', '105994759574816623550', 'User liked a product', '2024-05-30 16:27:34'),
(174, 'f930c4776d1353d3', '6650dc186940f', '105994759574816623550', 'User liked a product', '2024-05-30 16:36:41'),
(175, 'fbbf71352a7c512c', '6650d9ab23093', '105994759574816623550', 'User liked a product', '2024-05-30 16:36:45'),
(176, '456fd3e08d863f10', '6653b0cad80c6', '105994759574816623550', 'User liked a product', '2024-05-30 16:36:48'),
(177, '147ba8dd88f9f664', '6652f28e4c157', '105994759574816623550', 'User liked a product', '2024-05-30 16:36:51'),
(178, 'e931cdf99bc2af36', '6650d09acc840', '105994759574816623550', 'User liked a product', '2024-05-30 16:37:57'),
(179, '78ba908ebb33a7c9', '6652f190b7187', '105994759574816623550', 'User liked a product', '2024-05-30 16:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productid`, `userid`, `username`, `image`, `caption`, `category`) VALUES
(232, '6650cce0b9910', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0019.jpg', 'Wigs 4 Sale Contact me', 'beauty'),
(233, '6650cd32b833b', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0020.jpg', 'Xbox 360 Controller N$500', 'toys'),
(234, '6650cd8d8f309', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0040.jpg', 'Bakkie 4 Sale Contact me', 'vehicle'),
(235, '6650cd8d8f309', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0042.jpg', 'Bakkie 4 Sale Contact me', 'vehicle'),
(236, '6650cd8d8f309', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0043.jpg', 'Bakkie 4 Sale Contact me', 'vehicle'),
(237, '6650cec552956', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0047.jpg', 'Isuzu Bakkie 4 Sale N$250k', 'vehicle'),
(238, '6650cec552956', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0049.jpg', 'Isuzu Bakkie 4 Sale N$250k', 'vehicle'),
(239, '6650cec552956', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0050.jpg', 'Isuzu Bakkie 4 Sale N$250k', 'vehicle'),
(240, '6650cec552956', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0051.jpg', 'Isuzu Bakkie 4 Sale N$250k', 'vehicle'),
(241, '6650cec552956', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0052.jpg', 'Isuzu Bakkie 4 Sale N$250k', 'vehicle'),
(242, '6650cf1356289', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0054.jpg', 'Iphone 7 Plus Give me 2.8k', 'phone'),
(243, '6650cf44d2e90', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0068.jpg', 'Xbox One X Series 7.5k', 'toys'),
(244, '6650d09acc840', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0078.jpg', 'Samsung 4 Sale', 'phone'),
(245, '6650d09acc840', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0081.jpg', 'Samsung 4 Sale', 'phone'),
(246, '6650d0cbd2ba7', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0083.jpg', 'iPad 4 Sale 3k', 'phone'),
(247, '6650d10e57a95', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0070.jpg', 'Contact Us Today', 'furniture'),
(248, '6650d165cb203', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0076.jpg', 'Contact me Today', 'beauty'),
(249, '6650d19d297f2', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0089.jpg', 'Polo 4 Sale', 'vehicle'),
(250, '6650d1cf4284f', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0090.jpg', 'Volkswagen N$100k', 'vehicle'),
(251, '6650d2150f7de', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0092.jpg', 'Washing Machine 12k', 'home-appliances'),
(252, '6650d25844b44', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0093.jpg', 'Upgrade your room Only 2.3k Bed Covers', 'home-appliances'),
(253, '6650d2c359fda', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0094.jpg', 'Fridge 8k', 'home-appliances'),
(254, '6650d2f2ca59e', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0098.jpg', 'Iphone 7 2.4k', 'phone'),
(255, '6650d339c2d5a', '105994759574816623550', 'sourcecodedev', 'IMG-20240523-WA0102.jpg', 'Iphone 11 Pro Max', 'phone'),
(256, '6650d392152ee', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0964.jpg', 'A12 for Sale', 'phone'),
(257, '6650d392152ee', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0121.jpg', 'A12 for Sale', 'phone'),
(258, '6650d3c977b95', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1066.jpg', 'Perfume 4 Sale N$400', 'beauty'),
(259, '6650d3e7bc3f2', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0407.jpg', 'Laptop 4 Sale 4.5k', 'laptop'),
(260, '6650d40b0c135', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0075.jpg', 'Iphone Xs 6.5k', 'phone'),
(261, '6650d40b0c135', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0076.jpg', 'Iphone Xs 6.5k', 'phone'),
(262, '6650d40b0c135', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0073.jpg', 'Iphone Xs 6.5k', 'phone'),
(263, '6650d45ef3e10', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1033.jpg', 'Gambling Machine N$28000', 'other'),
(264, '6650d4ad2d73f', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1029.jpg', 'Women Handbag In Stock', 'cosmetics'),
(265, '6650d4d7d9c3e', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1024.jpg', 'Women Cosmetics Contact me', 'cosmetics'),
(266, '6650d5243338b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1022.jpg', 'Addidas Kicks 4 Sale 650 each', 'clothing'),
(267, '6650d546d1af9', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1010.jpg', 'Instock', 'clothing'),
(268, '6650d5d4c7104', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0994.jpg', 'Arsenal Shirts Available N$450', 'clothing'),
(269, '6650d61437403', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0982.jpg', 'Let me type your cv for you', 'other'),
(270, '6650d63371efa', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0989.jpg', 'Iphone Covers N$150', 'phone'),
(271, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0971.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(272, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0970.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(273, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0969.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(274, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0968.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(275, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0967.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(276, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0966.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(277, '6650d68d9ed43', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0965.jpg', 'Amarock v6 4 Sale Contact me', 'vehicle'),
(278, '6650d6fa9b207', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0731.jpg', 'EarPods 4 Sale', 'other'),
(279, '6650d6fa9b207', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0734.jpg', 'EarPods 4 Sale', 'other'),
(280, '6650d7564ff92', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0932.jpg', '7 GTI 4 Sale', 'vehicle'),
(281, '6650d798df77f', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0959.jpg', 'Contact Us Today', 'other'),
(282, '6650d7c761c82', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0404.jpg', 'huawei', 'phone'),
(283, '6650d7c787afb', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0404.jpg', 'huawei', 'phone'),
(284, '6650d81da956a', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0784.jpg', 'InStock', 'clothing'),
(285, '6650d81da956a', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0783.jpg', 'InStock', 'clothing'),
(286, '6650d81da956a', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0779.jpg', 'InStock', 'clothing'),
(287, '6650d81da956a', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0780.jpg', 'InStock', 'clothing'),
(288, '6650d81da956a', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0782.jpg', 'InStock', 'clothing'),
(289, '6650d8943629b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0891.jpg', 'In stock contact me', 'phone'),
(290, '6650d8d641689', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0266.jpg', 'Contact Us Today', 'other'),
(291, '6650d8ed5e836', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0888.jpg', 'Contact Us Today', 'other'),
(292, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0834.jpg', '6tsi 4 sale', 'vehicle'),
(293, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0833.jpg', '6tsi 4 sale', 'vehicle'),
(294, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0832.jpg', '6tsi 4 sale', 'vehicle'),
(295, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0831.jpg', '6tsi 4 sale', 'vehicle'),
(296, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0829.jpg', '6tsi 4 sale', 'vehicle'),
(297, '6650d91079948', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0820.jpg', '6tsi 4 sale', 'vehicle'),
(298, '6650d93459085', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0759.jpg', 'Iphone11 4 Sale 8k', 'phone'),
(299, '6650d9560a377', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0720.jpg', 'Iphone 7 Plus 4 Sale', 'phone'),
(300, '6650d9560a377', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0719.jpg', 'Iphone 7 Plus 4 Sale', 'phone'),
(301, '6650d9560a377', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0718.jpg', 'Iphone 7 Plus 4 Sale', 'phone'),
(302, '6650d9560a377', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0717.jpg', 'Iphone 7 Plus 4 Sale', 'phone'),
(303, '6650d977e339e', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0710.jpg', 'Contact Me Today', 'other'),
(304, '6650d977e339e', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0709.jpg', 'Contact Me Today', 'other'),
(305, '6650d9ab23093', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0667.jpg', 'Available N$150', 'clothing'),
(306, '6650d9ab23093', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0666.jpg', 'Available N$150', 'clothing'),
(307, '6650d9ab23093', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0664.jpg', 'Available N$150', 'clothing'),
(308, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0580.jpg', 'Contact Me', 'home-appliances'),
(309, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0579.jpg', 'Contact Me', 'home-appliances'),
(310, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0578.jpg', 'Contact Me', 'home-appliances'),
(311, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0577.jpg', 'Contact Me', 'home-appliances'),
(312, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0576.jpg', 'Contact Me', 'home-appliances'),
(313, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0575.jpg', 'Contact Me', 'home-appliances'),
(314, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0574.jpg', 'Contact Me', 'home-appliances'),
(315, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0573.jpg', 'Contact Me', 'home-appliances'),
(316, '6650da1233a6b', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0572.jpg', 'Contact Me', 'home-appliances'),
(317, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0215.jpg', 'Available 150 each', 'clothing'),
(318, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0214.jpg', 'Available 150 each', 'clothing'),
(319, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0213.jpg', 'Available 150 each', 'clothing'),
(320, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0212.jpg', 'Available 150 each', 'clothing'),
(321, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0211.jpg', 'Available 150 each', 'clothing'),
(322, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0210.jpg', 'Available 150 each', 'clothing'),
(323, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0209.jpg', 'Available 150 each', 'clothing'),
(324, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0208.jpg', 'Available 150 each', 'clothing'),
(325, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0205.jpg', 'Available 150 each', 'clothing'),
(326, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0202.jpg', 'Available 150 each', 'clothing'),
(327, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0201.jpg', 'Available 150 each', 'clothing'),
(328, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0200.jpg', 'Available 150 each', 'clothing'),
(329, '6650da9703f23', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0199.jpg', 'Available 150 each', 'clothing'),
(330, '6650dbd9ed131', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0548.jpg', 'Contact me ', 'other'),
(331, '6650dc186940f', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0474.jpg', 'Available 200 each', 'clothing'),
(332, '6650dc186940f', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0473.jpg', 'Available 200 each', 'clothing'),
(333, '6650dc31c0798', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0499.jpg', 'Available 6.5k', 'phone'),
(334, '6650dc31c0798', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0498.jpg', 'Available 6.5k', 'phone'),
(335, '6650dc5b65dda', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0049.jpg', '4 sale 250k', 'vehicle'),
(336, '6650dc5b65dda', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0047.jpg', '4 sale 250k', 'vehicle'),
(337, '6650dc5b65dda', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0045.jpg', '4 sale 250k', 'vehicle'),
(338, '6650dc5b65dda', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0043.jpg', '4 sale 250k', 'vehicle'),
(339, '6650dc5b65dda', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA0039.jpg', '4 sale 250k', 'vehicle'),
(340, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1213.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(341, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1214.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(342, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1215.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(343, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1216.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(344, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1217.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(345, '6652f190b7187', '105994759574816623550', 'sourcecodedev', 'IMG-20240524-WA1218.jpg', 'Soccer Hoodies 4 sale 300 each', 'clothing'),
(346, '6652f1e412327', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0098.jpg', 'Contact me', 'other'),
(347, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0231.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(348, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0230.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(349, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0229.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(350, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0228.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(351, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0227.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(352, '6652f2541d1a6', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0225.jpg', 'Ford Ranger 4 Sale', 'vehicle'),
(353, '6652f28e4c157', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0811.jpg', 'Russian and hake fish, N$200 windhoek', 'other'),
(354, '6652f28e4c157', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0812.jpg', 'Russian and hake fish, N$200 windhoek', 'other'),
(355, '6652f45b0abec', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA1498.jpg', '7tsi 4 sale 230,000', 'vehicle'),
(356, '6652f45b0abec', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA1499.jpg', '7tsi 4 sale 230,000', 'vehicle'),
(357, '6653ae4631c0f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1798.jpg', 'Bmw 4 Sale', 'vehicle'),
(358, '6653ae4631c0f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1799.jpg', 'Bmw 4 Sale', 'vehicle'),
(359, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2178.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(360, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2179.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(361, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2181.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(362, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2185.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(363, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2186.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(364, '6653aeb0d7b8c', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2188.jpg', 'Toyota Bakkie 4 Sale', 'vehicle'),
(365, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0344.jpg', 'Women Dress 4 Sale', 'clothing'),
(366, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0345.jpg', 'Women Dress 4 Sale', 'clothing'),
(367, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0346.jpg', 'Women Dress 4 Sale', 'clothing'),
(368, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0362.jpg', 'Women Dress 4 Sale', 'clothing'),
(369, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0368.jpg', 'Women Dress 4 Sale', 'clothing'),
(370, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0369.jpg', 'Women Dress 4 Sale', 'clothing'),
(371, '6653aefa8b391', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0370.jpg', 'Women Dress 4 Sale', 'clothing'),
(372, '6653af10402b9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0435.jpg', 'Contact me ', 'clothing'),
(373, '6653af10402b9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0436.jpg', 'Contact me ', 'clothing'),
(374, '6653af10402b9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0437.jpg', 'Contact me ', 'clothing'),
(375, '6653af5b0c97f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1067.jpg', 'Tshirts 4 Sale', 'clothing'),
(376, '6653af5b0c97f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1068.jpg', 'Tshirts 4 Sale', 'clothing'),
(377, '6653af5b0c97f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1069.jpg', 'Tshirts 4 Sale', 'clothing'),
(378, '6653afc899ec9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1737.jpg', 'Tiguan 4 Sale', 'vehicle'),
(379, '6653afc899ec9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1738.jpg', 'Tiguan 4 Sale', 'vehicle'),
(380, '6653afc899ec9', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA1739.jpg', 'Tiguan 4 Sale', 'vehicle'),
(381, '6653afe9e4a8a', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0357.jpg', 'Contact Me', 'furniture'),
(382, '6653afe9e4a8a', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0358.jpg', 'Contact Me', 'furniture'),
(383, '6653b0054f328', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0090.jpg', 'Iphone 11 4 sale', 'phone'),
(384, '6653b0054f328', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0092.jpg', 'Iphone 11 4 sale', 'phone'),
(385, '6653b0054f328', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0094.jpg', 'Iphone 11 4 sale', 'phone'),
(386, '6653b01e6d74f', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0063.jpg', 'Nails Training', 'other'),
(387, '6653b040c3c18', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0665.jpg', 'Taxi 4 Sale', 'vehicle'),
(388, '6653b040c3c18', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0667.jpg', 'Taxi 4 Sale', 'vehicle'),
(389, '6653b040c3c18', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0668.jpg', 'Taxi 4 Sale', 'vehicle'),
(390, '6653b05aa6c79', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA2222.jpg', 'Iphone 13 pro 4 sale', 'phone'),
(391, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0482.jpg', 'Contact me 4 your nails', 'beauty'),
(392, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0483.jpg', 'Contact me 4 your nails', 'beauty'),
(393, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0484.jpg', 'Contact me 4 your nails', 'beauty'),
(394, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0486.jpg', 'Contact me 4 your nails', 'beauty'),
(395, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0487.jpg', 'Contact me 4 your nails', 'beauty'),
(396, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0488.jpg', 'Contact me 4 your nails', 'beauty'),
(397, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0489.jpg', 'Contact me 4 your nails', 'beauty'),
(398, '6653b0cad80c6', '105994759574816623550', 'sourcecodedev', 'IMG-20240525-WA0490.jpg', 'Contact me 4 your nails', 'beauty'),
(399, '6653b0f57b858', '105994759574816623550', 'sourcecodedev', 'IMG-20240526-WA0441.jpg', 'Bike 4 Sale', 'vehicle');

-- --------------------------------------------------------

--
-- Table structure for table `saves`
--

CREATE TABLE `saves` (
  `id` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `productid` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `first_name` varchar(50) NOT NULL DEFAULT '',
  `last_name` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(50) NOT NULL DEFAULT '',
  `full_name` varchar(100) NOT NULL DEFAULT '',
  `picture` varchar(255) NOT NULL DEFAULT '',
  `verifiedEmail` int(11) NOT NULL DEFAULT 0,
  `token` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `gender`, `full_name`, `picture`, `verifiedEmail`, `token`) VALUES
(1, 'sourcecodedev6@gmail.com', 'sourcecodedev', '', '', 'sourcecodedev', 'https://lh3.googleusercontent.com/a/ACg8ocLStJ1pZIRjFn8I6SFne7GJTtqnhD8Ne_KcdYHjKEFES9Pfi-c=s96-c', 1, '105994759574816623550');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
