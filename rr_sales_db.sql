-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2016 at 11:07 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rr_sales_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL,
  `cart_product_cost` decimal(12,3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `cart_qty`, `cart_product_cost`) VALUES
(1, 2, 1, 4, '228.000'),
(2, 2, 3, 4, '596.000'),
(3, 2, 4, 6, '276.000'),
(4, 2, 6, 4, '226.000');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `category_nicename` varchar(50) NOT NULL,
  `category_img` varchar(100) NOT NULL DEFAULT 'images/no-image.png'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category_name`, `category_nicename`, `category_img`) VALUES
(2, 'Activa', 'Activa.2', 'images/categories/activa_category.jpg'),
(3, 'Ape', 'Ape.3', 'images/categories/ape_category.jpg'),
(4, 'Bajaj 2 wheeler', 'Bajaj_2_wheeler.4', 'images/categories/bajaj_2_wheeler_category.jpg'),
(5, 'Bajaj 3 Wheeler', 'Bajaj_3_Wheeler.5', 'images/categories/bajaj_3_wheeler_category.jpg'),
(6, 'Hero Honda', 'Hero_Honda.6', 'images/categories/hero_honda_category.jpg'),
(7, 'KB-4S', 'KB-4S.7', 'images/categories/kb_4s_category.jpg'),
(8, 'K-Honda', 'K-Honda.8', 'images/categories/k_honda_category.jpg'),
(9, 'Number Plate', 'Number-Plate.9', 'images/categories/number_plate_category.jpg'),
(10, 'Scooty', 'Scooty.10', 'images/categories/scooty_category.jpg'),
(11, 'Suzuki', 'Suzuki.11', 'images/categories/suzuki_category.png'),
(12, 'Yamaha', 'Yamaha.12', 'images/categories/yamaha_category.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_created_at` date NOT NULL,
  `order_total_amount` decimal(11,3) NOT NULL,
  `order_transaction_id` varchar(30) NOT NULL,
  `order_status` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `user_id`, `order_created_at`, `order_total_amount`, `order_transaction_id`, `order_status`) VALUES
(1, 23, '2016-04-30', '1048.000', 'QLNV1BDD', 'pending'),
(2, 23, '2016-04-30', '130.000', '0Z1VHFTT', 'pending'),
(3, 2, '2016-05-01', '130.000', '9EIUYTBB', 'pending'),
(4, 2, '2016-05-01', '228.000', 'IS9QDRXX', 'pending'),
(5, 23, '2016-05-02', '548.000', 'R6WHQ6KK', 'pending'),
(6, 2, '2016-05-01', '112.500', '1K4G1U44', 'pending'),
(7, 23, '2016-05-01', '370.000', 'ZUME855', 'pending'),
(8, 2, '2016-05-01', '2990.000', 'JDCBPGCC', 'pending'),
(9, 2, '2016-05-04', '800.000', 'SRZBB033', 'pending'),
(10, 2, '2016-05-04', '548.000', '1577CGPP', 'pending'),
(11, 2, '2016-05-04', '548.000', 'BKX68N', 'pending'),
(12, 2, '2016-05-04', '130.000', 'KYLXE266', 'pending'),
(23, 26, '2016-05-05', '548.000', 'D83NUMOO', 'pending'),
(24, 26, '2016-05-05', '359.000', 'MMLMBFF', 'pending'),
(25, 26, '2016-05-05', '0.000', 'W08M1F77', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
`id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_details_product_quantity` int(11) NOT NULL,
  `order_details_product_rate` decimal(11,3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `order_details_product_quantity`, `order_details_product_rate`) VALUES
(1, 1, 3, 4, '149.000'),
(2, 1, 6, 8, '56.500'),
(3, 2, 199, 10, '13.000'),
(4, 3, 199, 10, '13.000'),
(5, 4, 1, 4, '57.000'),
(6, 5, 169, 4, '137.000'),
(7, 6, 173, 6, '18.750'),
(8, 7, 200, 10, '37.000'),
(9, 8, 6, 4, '56.500'),
(10, 8, 169, 8, '137.000'),
(11, 8, 172, 100, '2.300'),
(12, 8, 15, 2, '88.000'),
(13, 8, 3, 4, '149.000'),
(14, 8, 4, 6, '46.000'),
(15, 8, 5, 4, '55.000'),
(16, 8, 259, 4, '42.500'),
(17, 9, 168, 20, '40.000'),
(18, 10, 169, 4, '137.000'),
(19, 11, 169, 4, '137.000'),
(20, 12, 199, 10, '13.000'),
(31, 23, 169, 4, '137.000'),
(32, 24, 204, 6, '31.500'),
(33, 24, 258, 10, '17.000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_vehicle` varchar(50) NOT NULL,
  `product_no_of_wheels` int(1) NOT NULL DEFAULT '0',
  `product_rate` double(6,2) NOT NULL,
  `product_per` varchar(7) NOT NULL DEFAULT 'piece',
  `product_min_qty` int(5) NOT NULL,
  `product_nicename` varchar(105) NOT NULL,
  `product_img` varchar(50) NOT NULL DEFAULT 'images/no-img.png',
  `product_desc` text
) ENGINE=InnoDB AUTO_INCREMENT=288 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `product_id`, `product_name`, `product_vehicle`, `product_no_of_wheels`, `product_rate`, `product_per`, `product_min_qty`, `product_nicename`, `product_img`, `product_desc`) VALUES
(1, 2, 'ACT-001', 'ACCILATOR PIPE WITH GRIP', 'ACTIVA', 0, 57.00, 'piece', 4, 'ACCILATOR_PIPE_WITH_GRIP.1', 'images/dummy_pics/1.jpg', 'No description'),
(2, 2, 'ACT-116', 'AIR (PAPER) FILTER (N/M)', 'ACTIVA', 0, 150.00, 'piece', 4, 'AIR_(PAPER_)FILTER_(N/M).2', 'images/dummy_pics/3.jpg', NULL),
(3, 2, 'ACT-002', 'AIR (PAPER) FILTER (O/M)', 'ACTIVA', 0, 149.00, 'piece', 4, 'AIR_(PAPER)_FILTER_(O/M).3', 'images/dummy_pics/4.jpg', NULL),
(4, 2, 'ACT-003', 'AIR FILTER FOAM', 'ACTIVA', 0, 46.00, 'piece', 6, 'AIR_FILTER_FOAM.4', 'images/dummy_pics/2.jpg', NULL),
(5, 2, 'ACT-004', 'AIR FILTER FOAM', 'ETERNO', 0, 55.00, 'piece', 4, 'AIR_FILTER_FOAM.5', 'images/dummy_pics/3.jpg', NULL),
(6, 2, 'ACT-005', 'AIR PIPE BIG', 'ACTIVA', 2, 56.50, 'piece', 4, 'AIR_PIPE_BIG.6', '/images/products/wheeler_2.jpg', 'No description'),
(7, 2, 'ACT-006', 'AIR PIPE SMALL', 'ACTIVA', 0, 19.00, 'piece', 4, 'AIR_PIPE_SMALL.7', 'images/no-image.png', NULL),
(8, 2, 'ACT-128', 'BAG HOOK', 'ACTIVA', 0, 55.00, 'piece', 6, 'BAG_HOOK.8', 'images/no-image.png', NULL),
(9, 2, 'ACT-161', 'BATTERY BOLT WITH SQUARE NUT (N/M)', 'ACTIVA', 0, 3.25, 'piece', 20, 'BATTERY_BOLT_WITH_SQUARE_NUT_(N/M).9', 'images/no-image.png', NULL),
(10, 2, 'ACT-007', 'BATTERY CLIP (SET OF 2)', 'ACTIVA', 0, 21.25, 'piece', 10, 'BATTERY_CLIP_(SET OF 2).10', 'images/no-image.png', NULL),
(11, 2, 'ACT-124', 'BATTERY CLIP WITH WIRE (SET OF 2)', 'ACTIVA', 0, 52.50, 'piece', 6, 'BATTERY_CLIP_WITH_WIRE_(SET_OF_2).11', 'images/no-image.png', NULL),
(12, 2, 'ACT-145', 'BATTERY SUPPORT PATTI (N/M)', 'ACTIVA', 0, 37.50, 'piece', 4, 'BATTERY_SUPPORT_PATTI_(N/M).12', 'images/no-image.png', NULL),
(13, 2, 'ACT-144', 'BATTERY SUPPORT PATTI (O/M)', 'ACTIVA', 0, 42.25, 'piece', 4, 'BATTERY_SUPPORT_PATTI_(O/M).13', 'images/no-image.png', NULL),
(14, 2, 'ACT-008', 'BENDEX SHIM', 'ACTIVA', 0, 1.50, 'piece', 50, 'BENDEX_SHIM.14', 'images/no-image.png', NULL),
(15, 2, 'ACT-009', 'BRAKE PEDAL SUPPORT', 'ETERNO', 0, 88.00, 'piece', 2, 'BRAKE_PEDAL_SUPPORT.15', 'images/no-image.png', NULL),
(16, 2, 'ACT-010', 'BRAKE SHOE SPRING (SET OF 2)', 'ACTIVA', 0, 7.25, 'piece', 10, 'BRAKE_SHOE_SPRING_(SET_OF_2).16', 'images/no-image.png', NULL),
(17, 2, 'ACT-011', 'BREATHER "J" PIPE', 'ACTIVA', 0, 0.00, 'piece', 4, 'BREATHER_J_PIPE.17', 'images/no-image.png', NULL),
(18, 2, 'ACT-132', 'C.D.I RUBBER', 'ACTIVA', 0, 11.00, 'piece', 10, 'C.D.I_RUBBER.18', 'images/no-image.png', NULL),
(19, 2, 'ACT-012', 'CARBUN BRUSH KIT', 'ACTIVA', 0, 45.00, 'piece', 6, 'CARBUN_BRUSH_KIT.19', 'images/no-image.png', NULL),
(20, 2, 'ACT-013', 'CENTRE STAND SPRING', 'ACTIVA', 0, 18.00, 'piece', 10, 'CENTRE_STAND_SPRING.20', 'images/no-image.png', NULL),
(21, 2, 'ACT-014', 'CLUTCH BELL', 'ACTIVA', 0, 387.00, 'piece', 2, 'CLUTCH_BELL.21', 'images/no-image.png', NULL),
(22, 2, 'ACT-156', 'CLUTCH DAMPER BUSH (N/M)', 'ACTIVA', 0, 12.75, 'piece', 6, 'CLUTCH_DAMPER_BUSH_(N/M).22', 'images/no-image.png', NULL),
(23, 2, 'ACT-015', 'CLUTCH FISH "U" ONLY', 'ACTIVA', 0, 3.50, 'piece', 50, 'CLUTCH_FISH_U_ONLY.23', 'images/no-image.png', NULL),
(24, 2, 'ACT-016', 'CLUTCH FISH KIT', 'ACTIVA', 0, 19.50, 'piece', 6, 'CLUTCH_FISH_KIT.24', 'images/no-image.png', NULL),
(25, 2, 'ACT-017', 'CLUTCH LEVER BOLT', 'ACTIVA', 0, 5.50, 'piece', 20, 'CLUTCH_LEVER_BOLT.25', 'images/no-image.png', NULL),
(26, 2, 'ACT-018', 'CLUTCH NUT', 'ACTIVA', 0, 15.00, 'piece', 10, 'CLUTCH_NUT.26', 'images/no-image.png', NULL),
(27, 2, 'ACT-130', 'CLUTCH NUT (N/M)', 'ACTIVA', 0, 7.00, 'piece', 10, 'CLUTCH_NUT (N/M).27', 'images/no-image.png', NULL),
(28, 2, 'ACT-119', 'CLUTCH PULLY (UPPER ONLY)', 'ACTIVA', 0, 435.00, 'piece', 2, 'CLUTCH_PULLY_(UPPER_ONLY).28', 'images/no-image.png', NULL),
(29, 2, 'ACT-019', 'CLUTCH PULLY ASSY', 'ACTIVA', 0, 1104.00, 'piece', 1, 'CLUTCH_PULLY_ASSY.29', 'images/no-image.png', NULL),
(30, 2, 'ACT-020', 'CLUTCH PULLY KATORI BIG', 'ACTIVA', 0, 36.00, 'piece', 4, 'CLUTCH_PULLY_KATORI_BIG.30', 'images/no-image.png', NULL),
(31, 2, 'ACT-021', 'CLUTCH PULLY KATORI SMALL', 'ACTIVA', 0, 27.50, 'piece', 4, 'CLUTCH_PULLY_KATORI_SMALL.31', 'images/no-image.png', NULL),
(32, 2, 'ACT-162', 'CLUTCH ROLLER (S.O.6) (N/M)', 'ACTIVA', 0, 66.00, 'piece', 6, 'CLUTCH_ROLLER_(S.O.6)_(N/M).32', 'images/no-image.png', NULL),
(33, 2, 'ACT-022', 'CLUTCH ROLLER GUIDE PIN SET', 'ACTIVA', 0, 16.25, 'piece', 6, 'CLUTCH_ROLLER_GUIDE_PIN_SET.33', 'images/no-image.png', NULL),
(34, 2, 'ACT-023', 'CLUTCH ROLLER SET', 'ACTIVA', 0, 60.00, 'piece', 6, 'CLUTCH_ROLLER_SET.34', 'images/no-image.png', NULL),
(35, 2, 'ACT-024', 'CLUTCH SHOE PLATE', 'ACTIVA', 0, 200.00, 'piece', 2, 'CLUTCH_SHOE_PLATE.35', 'images/no-image.png', NULL),
(36, 2, 'ACT-025', 'CLUTCH SHOE RUBBER ', 'ACTIVA', 0, 1.75, 'piece', 50, 'CLUTCH_SHOE_RUBBER.36', 'images/no-image.png', NULL),
(37, 2, 'ACT-026', 'CLUTCH SHOE SPRING (SET OF 3)', 'ACTIVA', 0, 14.50, 'piece', 10, 'CLUTCH_SHOE_SPRING_(SET_OF_3).37', 'images/no-image.png', NULL),
(38, 2, 'ACT-146', 'CLUTCH SHOE SPRING (SET OF 3) (N/M)', 'ACTIVA', 0, 14.50, 'piece', 10, 'CLUTCH_SHOE_SPRING_(SET_OF_3)_(N/M).38', 'images/no-image.png', NULL),
(39, 2, 'ACT-027', 'COIL PLATE ASSY (N/M)', 'ACTIVA', 0, 0.00, 'piece', 1, 'COIL_PLATE_ASSY_(N/M).39', 'images/no-image.png', NULL),
(40, 2, 'ACT-028', 'COIL PLATE ASSY (O/M)', 'ACTIVA', 0, 0.00, 'piece', 1, 'COIL_PLATE_ASSY_(O/M).40', 'images/no-image.png', NULL),
(41, 2, 'ACT-029', 'CRANK CASE BOLT KIT (LEFT)', 'ACTIVA', 0, 31.00, 'piece', 4, 'CRANK_CASE_BOLT_KIT_(LEFT).41', 'images/no-image.png', NULL),
(42, 2, 'ACT-030', 'CRANK CASE BOLT KIT (RIGHT)', 'ACTIVA', 0, 48.00, 'piece', 4, 'CRANK_CASE_BOLT_KIT_(RIGHT).42', 'images/no-image.png', NULL),
(43, 2, 'ACT-031', 'CRASH BAR SCREW', 'ACTIVA', 0, 2.10, 'piece', 50, 'CRASH_BAR_SCREW.43', 'images/no-image.png', NULL),
(44, 2, 'ACT-032', 'CRASH BAR SCREW (O/S)', 'ACTIVA', 0, 2.40, 'piece', 50, 'CRASH_BAR_SCREW_(O/S).44', 'images/no-image.png', NULL),
(45, 2, 'ACT-033', 'DIPPER SWITCH BUTTON', 'ACTIVA', 0, 46.00, 'piece', 6, 'DIPPER_SWITCH_BUTTON.45', 'images/no-image.png', NULL),
(46, 2, 'ACT-125', 'DRUM BOLT (N/M)', 'ACTIVA', 0, 26.25, 'piece', 20, 'DRUM_BOLT_(N/M).46', 'images/no-image.png', NULL),
(47, 2, 'ACT-034', 'DRUM STUD (STD0', 'ACTIVA', 0, 6.00, 'piece', 20, 'DRUM_STUD_(STD0.47', 'images/no-image.png', NULL),
(48, 2, 'ACT-035', 'ENGINE HANGER ASSY.', 'ACTIVA', 0, 465.00, 'piece', 2, 'ENGINE_HANGER_ASSY.48', 'images/no-image.png', NULL),
(49, 2, 'ACT-036', 'ENGINE HANGER BUSH SET', 'ACTIVA', 0, 115.00, 'piece', 4, 'ENGINE_HANGER_BUSH_SET.49', 'images/no-image.png', NULL),
(50, 2, 'ACT-037', 'ENGINE HANGER BUSH SET', 'ETERNO', 0, 238.00, 'piece', 2, 'ENGINE_HANGER_BUSH_SET.50', 'images/no-image.png', NULL),
(51, 2, 'ACT-038', 'ENGINE MOUNTING RUBBER', 'ACTIVA', 0, 15.50, 'piece', 6, 'ENGINE_MOUNTING_RUBBER.51', 'images/no-image.png', NULL),
(52, 2, 'ACT-155', 'FLOOR CHANNEL PATTI ("I" MODEL)', 'ACTIVA ', 0, 206.00, 'piece', 0, 'FLOOR_CHANNEL_PATTI_(I_MODEL).52', 'images/no-image.png', NULL),
(53, 2, 'ACT-154', 'FLOOR CHANNEL PATTI (N/M) STEEL', 'ACTIVA 110', 0, 233.00, 'piece', 0, 'FLOOR_CHANNEL_PATTI_(N/M)_STEEL.53', 'images/no-image.png', NULL),
(54, 2, 'ACT-039', 'FOOT REST REPAIR KIT', 'ACTIVA', 0, 38.00, 'piece', 4, 'FOOT_REST_REPAIR_KIT.54', 'images/no-image.png', NULL),
(55, 2, 'ACT-040', 'FORK LINK BUSH SET', 'ACTIVA', 0, 115.00, 'piece', 6, 'FORK_LINK_BUSH_SET.55', 'images/no-image.png', NULL),
(56, 2, 'ACT-153', 'FORK LINK BUSH SET (N/M)', 'ACTIVA 110', 0, 123.50, 'piece', 4, 'FORK_LINK_BUSH_SET_(N/M).56', 'images/no-image.png', NULL),
(57, 2, 'ACT-041', 'FOUNDATION BUSH (SET OF 2)', 'ACTIVA', 0, 66.00, 'piece', 6, 'FOUNDATION_BUSH_(SET_OF_2).57', 'images/no-image.png', NULL),
(58, 2, 'ACT-151', 'FRONT BRAKE ADJUSTER NUT (N/M)', 'ACTIVA 110', 0, 25.00, 'piece', 6, 'FRONT_BRAKE_ADJUSTER_NUT_(N/M).58', 'images/no-image.png', NULL),
(59, 2, 'ACT-159', 'FRONT BRAKE CAME WITH LEVER (N/M)(COMBI BRAKE)', 'ACTIVA', 0, 177.00, 'piece', 4, 'FRONT_BRAKE_CAME_WITH_LEVER_(N/M)(COMBI BRAKE).59', 'images/no-image.png', NULL),
(60, 2, 'ACT-158', 'FRONT BRAKE LEVER ONLY (N/M)(COMBI BRAKE)', 'ACTIVA', 0, 116.00, 'piece', 4, 'FRONT_BRAKE_LEVER_ONLY_(N/M)(COMBI BRAKE).60', 'images/no-image.png', NULL),
(61, 2, 'ACT-152', 'FRONT BRAKE WIRE SPACER', 'ACTIVA 110', 0, 13.75, 'piece', 6, 'FRONT_BRAKE_WIRE_SPACER.61', 'images/no-image.png', NULL),
(62, 2, 'ACT-118', 'FRONT NUMBER PLATE (N/M)', 'ACTIVA', 0, 53.50, 'piece', 6, 'FRONT_NUMBER_PLATE_(N/M).62', 'images/no-image.png', NULL),
(63, 2, 'ACT-042', 'FRONT NUMBER PLATE (STEEL)', 'ACTIVA', 0, 60.00, 'piece', 6, 'FRONT_NUMBER_PLATE_(STEEL).63', 'images/no-image.png', NULL),
(64, 2, 'ACT-043', 'FRONT NUMBER PLATE (WHITE)', 'ACTIVA', 0, 47.00, 'piece', 6, 'FRONT_NUMBER_PLATE_(WHITE).64', 'images/no-image.png', NULL),
(65, 2, 'ACT-044', 'FRONT NUMBER PLATE SCREW KIT', 'ACTIVA', 0, 23.00, 'piece', 10, 'FRONT_NUMBER_PLATE_SCREW_KIT.65', 'images/no-image.png', NULL),
(66, 2, 'ACT-045', 'GREEN BUSH SET', 'ACTIVA', 0, 31.60, 'piece', 6, 'GREEN_BUSH_SET.66', 'images/no-image.png', NULL),
(67, 2, 'ACT-046', 'HANDLE BALLS KIT', 'ACTIVA', 0, 15.00, 'piece', 10, 'HANDLE_BALLS_KIT.67', 'images/no-image.png', NULL),
(68, 2, 'ACT-047', 'HANDLE BOLT NUT', 'ACTIVA', 0, 20.50, 'piece', 10, 'HANDLE_BOLT_NUT.68', 'images/no-image.png', NULL),
(69, 2, 'ACT-048', 'HANDLE COVER PATTI (SET OF 2)', 'ACTIVA', 0, 13.25, 'piece', 6, 'HANDLE_COVER_PATTI_(SET_OF_2).69', 'images/no-image.png', NULL),
(70, 2, 'ACT-049', 'HANDLE GRIP (SET OF 3)', 'ACTIVA', 0, 62.00, 'piece', 4, 'HANDLE_GRIP_(SET_O_F3).70', 'images/no-image.png', NULL),
(71, 2, 'ACT-050', 'HANDLE LOWER COVER FIXING SCREW', 'ACTIVA', 0, 0.95, 'piece', 50, 'HANDLE LOWER COVER FIXING SCREW.71', 'images/no-image.png', NULL),
(72, 2, 'ACT-051', 'HANDLE TOP COVER SCREW (N/M)', 'ACTIVA', 0, 1.90, 'piece', 50, '', 'images/no-image.png', NULL),
(73, 2, 'ACT-131', 'HANDLE WELDING PATTI ', 'ACTIVA', 0, 34.50, 'piece', 6, 'HANDLE WELDING PATTI .73', 'images/no-image.png', NULL),
(74, 2, 'ACT-052', 'HANDLE YOKE PATTI (LEFT)', 'ACTIVA', 0, 8.00, 'piece', 10, 'HANDLE YOKE PATTI (LEFT).74', 'images/no-image.png', NULL),
(75, 2, 'ACT-053', 'HEAD "O" RING (O/M)', 'ACTIVA', 0, 23.00, 'piece', 6, 'HEAD O RING (O/M).75', 'images/no-image.png', NULL),
(76, 2, 'ACT-055', 'HEAD BOLT (N/M)', 'ACTIVA', 0, 17.75, 'piece', 10, 'HEAD BOLT (N/M).76', 'images/no-image.png', NULL),
(77, 2, 'ACT-054', 'HEAD BOLT (O/M)', 'ACTIVA', 0, 22.25, 'piece', 10, 'HEAD BOLT (O/M).77', 'images/no-image.png', NULL),
(78, 2, 'ACT-056', 'HEAD DOWEL KIT', 'ACTIVA', 0, 6.50, 'piece', 10, 'HEAD DOWEL KIT.78', 'images/no-image.png', NULL),
(79, 2, 'ACT-057', 'HEAD LAMP ADJUSTER BOLT', 'ACTIVA', 0, 4.50, 'piece', 20, 'HEAD LAMP ADJUSTER BOLT.79', 'images/no-image.png', NULL),
(80, 2, 'ACT-058', 'HEAD LAMP ADJUSTER NUT (SQUARE)', 'ACTIVA', 0, 1.50, 'piece', 20, 'HEAD LAMP ADJUSTER NUT (SQUARE).80', 'images/no-image.png', NULL),
(81, 2, 'ACT-059', 'HEAD LAMP SCREW WITH WASHER', 'ACTIVA', 0, 2.75, 'piece', 50, 'HEAD LAMP SCREW WITH WASHER.81', 'images/no-image.png', NULL),
(82, 2, 'ACT-060', 'HEAD LAMP SWITCH BUTTON', 'ACTIVA', 0, 46.00, 'piece', 6, 'HEAD LAMP SWITCH BUTTON.82', 'images/no-image.png', NULL),
(83, 2, 'ACT-061', 'HEAD LAMP WISOR SCREW', 'ACTIVA', 0, 2.00, 'piece', 50, 'HEAD LAMP WISOR SCREW.83', 'images/no-image.png', NULL),
(84, 2, 'ACT-139', 'HEAD RING (N/M)', 'ACTIVA', 0, 37.50, 'piece', 4, 'HEAD RING (N/M).84', 'images/no-image.png', NULL),
(85, 2, 'ACT-062', 'HEAD STUD BIG (STD)', 'ACTIVA', 0, 25.00, 'piece', 6, 'HEAD STUD BIG (STD).85', 'images/no-image.png', NULL),
(86, 2, 'ACT-063', 'HEAD STUD SMALL (STD)', 'ACTIVA', 0, 24.00, 'piece', 6, 'HEAD STUD SMALL (STD).86', 'images/no-image.png', NULL),
(87, 2, 'ACT-068', 'HORN SWITCH BUTTON', 'ACTIVA', 0, 35.00, 'piece', 6, 'HORN SWITCH BUTTON.87', 'images/no-image.png', NULL),
(88, 2, 'ACT-069', 'HOSE PIPE', 'ACTIVA', 0, 44.00, 'piece', 4, 'HOSE PIPE.88', 'images/no-image.png', NULL),
(89, 2, 'ACT-115', 'HOSE PIPE BIG (O/M)', 'ACTIVA', 0, 148.00, 'piece', 4, 'HOSE PIPE BIG (O/M).89', 'images/no-image.png', NULL),
(90, 2, 'ACT-070', 'HUB COVER SET ', 'ACTIVA', 0, 32.00, 'piece', 6, 'HUB COVER SET .90', 'images/no-image.png', NULL),
(91, 2, 'ACT-071', 'HUB COVER SET (N/M)', 'ACTIVA', 0, 40.50, 'piece', 6, 'HUB COVER SET (N/M).91', 'images/no-image.png', NULL),
(92, 2, 'ACT-143', 'HUB COVER SET (N/M) (3rd model)', 'ACTIVA DLX', 0, 35.00, 'piece', 0, 'HUB COVER SET (N/M) (3rd model).92', 'images/no-image.png', NULL),
(93, 2, 'ACT-072', 'INDICATOR SWITCH BUTTON', 'ACTIVA', 0, 46.00, 'piece', 6, 'INDICATOR SWITCH BUTTON.93', 'images/no-image.png', NULL),
(94, 2, 'ACT-073', 'KICK BUSH', 'ACTIVA', 0, 16.25, 'piece', 6, 'KICK BUSH.94', 'images/no-image.png', NULL),
(95, 2, 'ACT-141', 'KICK BUSH (N/M)', 'ACTIVA', 0, 18.75, 'piece', 6, 'KICK BUSH (N/M).95', 'images/no-image.png', NULL),
(96, 2, 'ACT-074', 'KICK RATCHET (BIG ONLY)', 'ACTIVA', 0, 151.00, 'piece', 6, 'KICK RATCHET (BIG ONLY).96', 'images/no-image.png', NULL),
(97, 2, 'ACT-075', 'KICK RATCHET (SET OF 2)', 'ACTIVA', 0, 229.00, 'piece', 6, 'KICK RATCHET (SET OF 2).97', 'images/no-image.png', NULL),
(98, 2, 'ACT-138', 'KICK RATCHET BIG (N/M)', 'ACTIVA', 0, 168.00, 'piece', 4, 'KICK RATCHET BIG (N/M).98', 'images/no-image.png', NULL),
(99, 2, 'ACT-137', 'KICK RATCHET SET (N/M)', 'ACTIVA', 0, 245.00, 'piece', 4, 'KICK RATCHET SET (N/M).99', 'images/no-image.png', NULL),
(100, 2, 'ACT-135', 'KICK RATCHET SHIM', 'ACTIVA', 0, 1.80, 'piece', 50, 'KICK RATCHET SHIM.100', 'images/no-image.png', NULL),
(101, 2, 'ACT-166', 'KICK RATCHET SMALL (O/M)', 'ACTIVA', 0, 80.00, 'piece', 6, 'KICK RATCHET SMALL (O/M).101', 'images/no-image.png', NULL),
(102, 2, 'ACT-076', 'KICK RATCHET TAR LOCK', 'ACTIVA', 0, 10.50, 'piece', 10, 'KICK RATCHET TAR LOCK.102', 'images/no-image.png', NULL),
(103, 2, 'ACT-077', 'KICK SHAFT ', 'ACTIVA', 0, 237.00, 'piece', 2, 'KICK SHAFT .103', 'images/no-image.png', NULL),
(104, 2, 'ACT-148', 'KICK SHAFT (N/M)', 'ACTIVA', 0, 256.00, 'piece', 0, 'KICK SHAFT (N/M).104', 'images/no-image.png', NULL),
(105, 2, 'ACT-127', 'KICK SHAFT COLLOR WASHER (PVC)', 'ACTIVA', 0, 7.75, 'piece', 10, 'KICK SHAFT COLLOR WASHER (PVC).105', 'images/no-image.png', NULL),
(106, 2, 'ACT-078', 'KICK SHAFT LOCK', 'ACTIVA', 0, 1.35, 'piece', 50, 'KICK_SHAFT_LOCK.106', 'images/no-image.png', NULL),
(107, 2, 'ACT-079', 'KICK SHAFT SHIM', 'ACTIVA', 0, 1.80, 'piece', 20, 'KICK_SHAFT_SHIM.107', 'images/no-image.png', NULL),
(108, 2, 'ACT-080', 'KICK SPRING', 'ACTIVA', 0, 29.50, 'piece', 6, 'KICK_SPRING.108', 'images/no-image.png', NULL),
(109, 2, 'ACT-123', 'MAGNET KEY', 'ACTIVA', 0, 2.50, 'piece', 20, 'MAGNET_KEY.109', 'images/no-image.png', NULL),
(110, 2, 'ACT-081', 'MAGNET NUT ', 'ACTIVA', 0, 4.90, 'piece', 10, 'MAGNET_NUT.110', 'images/no-image.png', NULL),
(111, 2, 'ACT-082', 'METER SCREW', 'ACTIVA', 0, 1.30, 'piece', 50, 'METER_SCREW.111', 'images/no-image.png', NULL),
(112, 2, 'ACT-114', 'METER VERM SET (N/M) (PVC)', 'ACTIVA', 0, 30.00, 'piece', 6, 'METER_VERM_SET.112', 'images/no-image.png', NULL),
(113, 2, 'ACT-121', 'METER VERM SET (O/M) (PVC)', 'ACTIVA', 0, 30.00, 'piece', 6, 'METER_VERM_SET.113', 'images/no-image.png', NULL),
(114, 2, 'ACT-150', 'MIRROR ADAPTER NUT (N/M)', 'ACTIVA 110', 0, 23.50, 'piece', 6, 'MIRROR_ADAPTER_NUT.114', 'images/no-image.png', NULL),
(115, 2, 'ACT-083', 'MIRROR BOLT (SET OF 2)', 'ACTIVA', 0, 75.50, 'piece', 4, 'MIRROR_BOLT.115', 'images/no-image.png', NULL),
(116, 2, 'ACT-064', 'NOSE BEEDING', 'ACTIVA', 0, 15.00, 'piece', 10, 'NOSE_BEEDING.116', 'images/no-image.png', NULL),
(117, 2, 'ACT-065', 'NOSE CLIP', 'ACTIVA', 0, 1.70, 'piece', 20, 'NOSE_CLIP.117', 'images/no-image.png', NULL),
(118, 2, 'ACT-120', 'NOSE CLIP KIT (N/M)', 'ACTIVA', 0, 27.00, 'piece', 6, 'NOSE_CLIP_KIT.118', 'images/no-image.png', NULL),
(119, 2, 'ACT-066', 'NOSE CLIP KIT (O/M)', 'ACTIVA', 0, 11.25, 'piece', 6, 'NOSE_CLIP_KIT.119', 'images/no-image.png', NULL),
(120, 2, 'ACT-067', 'NOSE RUBBER', 'ACTIVA', 0, 1.75, 'piece', 20, 'NOSE_RUBBER.120', 'images/no-image.png', NULL),
(121, 2, 'ACT-084', 'NOSE SUPPORT PATTI (LOWER)', 'ACTIVA', 0, 23.00, 'piece', 4, 'NOSE_SUPPORT_PATTI(LOWER).121', 'images/no-image.png', NULL),
(122, 2, 'ACT-085', 'NOSE SUPPORT PATTI (UPPER)', 'ACTIVA', 0, 23.00, 'piece', 4, 'NOSE_SUPPORT_PATTI(UPPER).122', 'images/no-image.png', NULL),
(123, 2, 'ACT-140', 'OIL GAUGE (N/M)', 'ACTIVA', 0, 24.75, 'piece', 4, 'OIL_GAUGE(N/M).123', 'images/no-image.png', NULL),
(124, 2, 'ACT-086', 'PETROL PIPE', 'ACTIVA', 0, 57.50, 'piece', 4, 'PETROL_PIPE.124', 'images/no-image.png', NULL),
(125, 2, 'ACT-087', 'PETROL TANK COVER', 'ACTIVA', 0, 78.00, 'piece', 4, 'PETROL_TANK_COVER.125', 'images/no-image.png', NULL),
(126, 2, 'ACT-126', 'PLUG ADAPTER', 'ACTIVA', 0, 31.25, 'piece', 6, 'PLUG_ADAPTER.126', 'images/no-image.png', NULL),
(127, 2, 'ACT-134', 'POLLUTION (COTTON) PIPE', 'ACTIVA', 0, 82.00, 'piece', 4, 'POLLUTION(COTTON)PIPE.127', 'images/no-image.png', NULL),
(128, 2, 'ACT-088', 'REAR AXLE NUT', 'ACTIVA', 0, 24.00, 'piece', 10, 'REAR_AXLE_NUT.128', 'images/no-image.png', NULL),
(129, 2, 'ACT-136', 'REAR AXLE NUT WASHER', 'ACTIVA', 0, 3.80, 'piece', 20, 'REAR_AXLE_NUT_WASHER.129', 'images/no-image.png', NULL),
(130, 2, 'ACT-142', 'REAR BRAKE CAME WITH LEVER', 'ACTIVA', 0, 127.00, 'piece', 4, 'REAR_BRAKE_CAME_WITH_LEVER.130', 'images/no-image.png', NULL),
(131, 2, 'ACT-160', 'REAR BRAKE CAME WITH LEVER (N/M)', 'ACTIVA', 0, 133.00, 'piece', 4, 'REAR_BRAKE_CAME_WITH_LEVER(N/M).131', 'images/no-image.png', NULL),
(132, 2, 'ACT-157', 'REAR BRAKE LEVER ONLY (N/M)', 'ACTIVA', 0, 72.00, 'piece', 4, 'REAR_BRAKE_LEVER_ONLY(N/M).132', 'images/no-image.png', NULL),
(133, 2, 'ACT-089', 'REAR NUMBER PLATE (N/M) (STEEL)', 'ACTIVA', 0, 85.00, 'piece', 10, 'REAR_NUMBER_PLATE(N/M)(STEEL).133', 'images/no-image.png', NULL),
(134, 2, 'ACT-090', 'REAR NUMBER PLATE (N/M) (WHITE)', 'ACTIVA', 0, 55.00, 'piece', 10, 'REAR_NUMBER_PLATE(N/M)(WHITE).134', 'images/no-image.png', NULL),
(135, 2, 'ACT-091', 'REAR NUMBER PLATE (STEEL)', 'ACTIVA', 0, 85.00, 'piece', 6, 'REAR_NUMBER_PLATE(STEEL).135', 'images/no-image.png', NULL),
(136, 2, 'ACT-092', 'REAR NUMBER PLATE (WHITE)', 'ACTIVA', 0, 55.00, 'piece', 6, 'REAR_NUMBER_PLATE(WHITE).136', 'images/no-image.png', NULL),
(137, 2, 'ACT-147', 'SEAT BRACKET PIN', 'ACTIVA', 0, 15.00, 'piece', 10, 'SEAT_BRACKET_PIN.137', 'images/no-image.png', NULL),
(138, 2, 'ACT-093', 'SEAT KADI (U)', 'ACTIVA', 0, 7.85, 'piece', 10, 'SEAT_KADI(U).138', 'images/no-image.png', NULL),
(139, 2, 'ACT-094', 'SEAT LOCK BRACKET (N/M)', 'ACTIVA', 0, 116.00, 'piece', 4, 'SEAT_LOCK_BRACKET(N/M).139', 'images/no-image.png', NULL),
(140, 2, 'ACT-095', 'SEAT LOCK BRACKET (O/M)', 'ACTIVA', 0, 105.00, 'piece', 4, 'SEAT_LOCK_BRACKET(O/M).140', 'images/no-image.png', NULL),
(141, 2, 'ACT-096', 'SELF MANDIR', 'ACTIVA', 0, 75.00, 'piece', 4, 'SELF_MANDIR.141', 'images/no-image.png', NULL),
(142, 2, 'ACT-097', 'SELF STARTOR BUSH (S.O.2)', 'ACTIVA', 0, 15.50, 'piece', 6, 'SELF_STARTOR_BUSH_(S.O.2).142', 'images/no-image.png', NULL),
(143, 2, 'ACT-098', 'SHIELD SCREW', 'ACTIVA', 0, 1.50, 'piece', 50, 'SHIELD_SCREW.143', 'images/no-image.png', NULL),
(144, 2, 'ACT-099', 'SIDE PANEL RUBBER', 'ACTIVA', 0, 4.75, 'piece', 10, 'SIDE_PANEL_RUBBER.144', 'images/no-image.png', NULL),
(145, 2, 'ACT-100', 'SIDE STAND SPRING', 'ACTIVA', 0, 10.25, 'piece', 10, 'SIDE_STAND_SPRING.145', 'images/no-image.png', NULL),
(146, 2, 'ACT-101', 'SILENCER BOLT (N/M)', 'ACTIVA', 0, 12.50, 'piece', 10, 'SILENCER_BOLT_(N/M).146', 'images/no-image.png', NULL),
(147, 2, 'ACT-102', 'SILENCER BOLT (O/M)', 'ACTIVA', 0, 8.20, 'piece', 10, 'SILENCER_BOLT_(O/M).147', 'images/no-image.png', NULL),
(148, 2, 'ACT-129', 'STAND PIN', 'ACTIVA', 0, 73.00, 'piece', 4, 'STAND_PIN.148', 'images/no-image.png', NULL),
(149, 2, 'ACT-163', 'STARTOR GEAR PLATE (2013 MODEL)', 'ACTIVA', 0, 415.00, 'piece', 0, 'STARTOR_GEAR_PLATE_(2013_MODEL).149', 'images/no-image.png', NULL),
(150, 2, 'ACT-103', 'STARTOR GEAR PLATE (N/M)', 'ACTIVA', 0, 400.00, 'piece', 2, 'STARTO_RGEAR_PLATE_(N/M).150', 'images/no-image.png', NULL),
(151, 2, 'ACT-104', 'STARTOR GEAR PLATE (O/M)', 'ACTIVA', 0, 400.00, 'piece', 2, 'STARTOR_GEAR_PLATE_(O/M).151', 'images/no-image.png', NULL),
(152, 2, 'ACT-105', 'STARTOR MAGNET CUP', 'ACTIVA', 0, 413.00, 'piece', 2, 'STARTOR_MAGNET_CUP.152', 'images/no-image.png', NULL),
(153, 2, 'ACT-106', 'STARTOR SWITCH BUTTON', 'ACTIVA', 0, 35.00, 'piece', 6, 'STARTOR_SWITCH_BUTTON.153', 'images/no-image.png', NULL),
(154, 2, 'ACT-107', 'TIMMING SPROCKET ', 'ACTIVA', 0, 90.00, 'piece', 4, 'TIMMING_SPROCKET.154 ', 'images/no-image.png', NULL),
(155, 2, 'ACT-108', 'VARIATOR', 'ACTIVA', 0, 284.00, 'piece', 2, 'VARIATOR.155', 'images/no-image.png', NULL),
(156, 2, 'ACT-149', 'VARIATOR (N/M)', 'ACTIVA 110', 0, 300.00, 'piece', 0, 'VARIATOR_(N/M).156', 'images/no-image.png', NULL),
(157, 2, 'ACT-117', 'VARIATOR BOSS (BUSH)', 'ACTIVA', 0, 80.00, 'piece', 4, 'VARIATOR_BOSS_(BUSH).157', 'images/no-image.png', NULL),
(158, 2, 'ACT-109', 'VARIATOR BUSH', 'ACTIVA', 0, 42.50, 'piece', 6, 'VARIATOR_BUSH.158', 'images/no-image.png', NULL),
(159, 2, 'ACT-110', 'VARIATOR NUT', 'ACTIVA', 0, 6.00, 'piece', 10, 'VARIATOR_NUT.159', 'images/no-image.png', NULL),
(160, 2, 'ACT-111', 'WHEEL RIM NUT (N/M)', 'ACTIVA', 0, 10.00, 'piece', 20, 'WHEEL_RIM_NUT_(N/M).160', 'images/no-image.png', NULL),
(161, 2, 'ACT-112', 'WHEEL RIM NUT (NO.13)', 'ACTIVA', 0, 4.90, 'piece', 20, 'WHEEL_RIM_NUT_(NO.13).161', 'images/no-image.png', NULL),
(162, 2, 'ACT-113', 'WHEEL RIM NUT (NO.14)', 'ACTIVA', 0, 8.75, 'piece', 20, 'WHEEL_RIM_NUT_(NO.14).162', 'images/no-image.png', NULL),
(163, 2, 'ACT-165', 'AIR (PAPER) FILTER', 'PLEASURE', 0, 150.00, 'piece', 4, 'AIR_(PAPER)_FILTER.163', 'images/no-image.png', NULL),
(164, 2, 'ACT-133', 'METER VERM SET (o.e)', 'PLEASURE', 0, 30.00, 'piece', 6, 'METER_VERM_SET_(o.e).164', 'images/no-image.png', NULL),
(165, 2, 'ACT-122', 'NOSE CLIP', 'PLEASURE', 0, 3.25, 'piece', 20, 'NOSE_CLIP.165', 'images/no-image.png', NULL),
(166, 2, 'ACT-164', 'SHIELD SCREW NUT (8*60)', 'PLEASURE', 0, 6.50, 'piece', 50, 'SHIELD_SCREW_NUT_(8*60).166', 'images/no-image.png', NULL),
(167, 3, 'APE-109', 'HEAD WASHER', 'APE', 0, 2.50, 'piece', 20, 'HEAD_WASHER.167', 'images/no-image.png', NULL),
(168, 3, 'APE-063', 'KAMAN BUSHING (SET OF 6) ', 'A-Shakti', 0, 40.00, 'set', 10, 'KAMAN_BUSHING.168', 'images/no-image.png', NULL),
(169, 3, 'APE-064', 'M. C. BOTTLE', 'APE', 0, 137.00, 'piece', 4, 'M.C.BOTTLE.169', 'images/no-image.png', NULL),
(170, 3, 'APE-065', 'M. C. BOTTLE', 'GC-1000', 0, 106.50, 'piece', 4, 'M.C.BOTTLE.170', 'images/no-image.png', NULL),
(171, 3, 'APE-066', 'MAIN SHAFT LOCK BIG', 'APE', 0, 4.00, 'piece', 20, 'MAIN_SHAFT_LOCK_BIG.171', 'images/no-image.png', NULL),
(172, 3, 'APE-067', 'MAIN SHAFT LOCK SMALL (EXT-20)', 'APE', 0, 2.30, 'piece', 100, 'MAIN_SHAFT_LOCK_SMALL(EXT-20).172', 'images/no-image.png', NULL),
(173, 3, 'APE-068', 'METER VERM ', 'APE', 0, 18.75, 'piece', 6, 'METER_VERM.173', 'images/no-image.png', NULL),
(174, 3, 'APE-069', 'MOUNTING WASHER (MED) (LESS DEEP)', 'APE', 0, 22.50, 'piece', 6, 'MOUNTING_WASHER_(MED)(LESS DEEP).174', 'images/no-image.png', NULL),
(175, 3, 'APE-070', 'MOUNTING WASHER (SMALL)', 'APE', 0, 14.50, 'piece', 6, 'MOUNTING_WASHER(SMALL).175', 'images/no-image.png', NULL),
(176, 3, 'APE-071', 'MOUNTING WASHER BIG', 'APE', 0, 25.50, 'piece', 6, 'MOUNTING_WASHER_BIG.176', 'images/no-image.png', NULL),
(177, 3, 'APE-072', 'MOUNTNG WASHER (MED) (DEEP)', 'APE', 0, 22.50, 'piece', 6, 'MOUNTNG_WASHER(MED)(DEEP).177', 'images/no-image.png', NULL),
(178, 3, 'APE-111', 'NOZZLE STUD', 'APE', 0, 11.50, 'piece', 10, 'NOZZLE_STUD.178', 'images/no-image.png', NULL),
(179, 3, 'APE-112', 'OIL DEFLECTOR PATTI', 'APE', 0, 15.50, 'piece', 6, 'OIL_DEFLECTOR_PATTI.179', 'images/no-image.png', NULL),
(180, 3, 'APE-073', 'OIL GAUGE (O/S) (RED)', 'APE', 0, 35.00, 'piece', 6, 'OIL_GAUGE(O/S)(RED).180', 'images/no-image.png', NULL),
(181, 3, 'APE-074', 'OIL GAUGE (STD)', 'APE', 0, 33.75, 'piece', 6, 'OIL_GAUGE(STD).181', 'images/no-image.png', NULL),
(182, 3, 'APE-113', 'OIL PUMP KEY', 'APE', 0, 5.50, 'piece', 20, 'OIL_PUMP_KEY.182', 'images/no-image.png', NULL),
(183, 3, 'APE-151', 'PUSH ROD PIPE', 'APE', 0, 27.50, 'piece', 6, 'PUSH_ROD_PIPE.183', 'images/no-image.png', NULL),
(184, 3, 'APE-152', 'PUSH ROD PIPE', 'APE BS-3', 0, 30.00, 'piece', 6, 'PUSH_ROD_PIPE.184', 'images/no-image.png', NULL),
(185, 3, 'APE-134', 'REAR AXLE CUT CONE', 'APE', 0, 18.75, 'piece', 6, 'REAR_AXLE_CUT_CONE.185', 'images/no-image.png', NULL),
(186, 3, 'APE-146', 'REAR AXLE TAR LOCK', 'APE', 0, 2.00, 'piece', 20, 'REAR_AXLE_TAR_LOCK.186', 'images/no-image.png', NULL),
(187, 3, 'APE-145', 'REAR AXLE WASHER', 'APE', 0, 5.00, 'piece', 20, 'REAR_AXLE_WASHER.187', 'images/no-image.png', NULL),
(188, 3, 'APE-075', 'REVERSE GEAR BUSH (Special)', 'APE', 0, 47.00, 'piece', 10, 'REVERSE_GEAR_BUSH(Special).188', 'images/no-image.png', NULL),
(189, 3, 'APE-120', 'REVERSE GEAR ROD', 'APE', 0, 68.00, 'piece', 6, 'REVERSE_GEAR_ROD.189', 'images/no-image.png', NULL),
(190, 3, 'APE-076', 'REVERSE GEAR SPRING BIG', 'APE', 0, 20.50, 'piece', 6, 'REVERSE_GEAR_SPRING_BIG.190', 'images/no-image.png', NULL),
(191, 3, 'APE-077', 'REVERSE GEAR SPRING SMALL', 'APE', 0, 8.00, 'piece', 10, 'REVERSE_GEAR_SPRING_SMALL.191', 'images/no-image.png', NULL),
(192, 3, 'APE-078', 'SEAT BELT', 'ALFA', 0, 33.75, 'piece', 10, 'SEAT_BELT.192', 'images/no-image.png', NULL),
(193, 3, 'APE-138', 'SEAT BELT', 'APE', 0, 33.75, 'piece', 10, 'SEAT_BELT.193', 'images/no-image.png', NULL),
(194, 3, 'APE-115', 'SIDE MIRROR CLAMP (N/M) (BIG HOLE)', 'APE', 0, 20.00, 'piece', 10, 'SIDE_MIRROR_CLAMP(N/M)(BIG HOLE).194', 'images/no-image.png', NULL),
(195, 3, 'APE-114', 'SIDE MIRROR CLAMP (O/M) (SMALL HOLE)', 'APE', 0, 17.50, 'piece', 10, 'SIDE_MIRROR_CLAMP(O/M)(SMALL_HOLE).195', 'images/no-image.png', NULL),
(196, 3, 'APE-079', 'SIDE PANEL SPRING', 'APE', 0, 2.80, 'piece', 20, 'SIDE_PANEL_SPRING.196', 'images/no-image.png', NULL),
(197, 3, 'APE-080', 'SILENCER BRACKET (HEAVY DUTY)', 'APE', 0, 74.50, 'piece', 4, 'SILENCER_BRACKET(HEAVY DUTY).197', 'images/no-image.png', NULL),
(198, 4, 'BJ2-001', 'ACCILATOR MUTHA SHIM', 'BJ2', 0, 1.25, 'piece', 100, 'ACCILATOR_MUTHA_SHIM.198', 'images/dummy_pics/2.jpg', NULL),
(199, 4, 'BJ2-002', 'ACCILATOR PULLY (NYLON)', 'BJ2', 0, 13.00, 'piece', 10, 'ACCILATOR_PULLY(NYLON).199', 'images/no-image.png', NULL),
(200, 4, 'BJ2-003', 'ACCILATOR PULLY METAL', 'BJ2', 0, 37.00, 'piece', 10, 'ACCILATOR_PULLY_METAL.200', 'images/no-image.png', NULL),
(201, 4, 'BJ2-004', 'AIR CLEANER SCREW (F.T)', 'BJ2', 0, 1.10, 'piece', 100, 'AIR_CLEANER_SCREW(F.T).201', 'images/no-image.png', NULL),
(202, 4, 'BJ2-005', 'AIR FILTER', 'BJ2', 0, 83.50, 'piece', 4, 'AIR_FILTER.202', 'images/no-image.png', NULL),
(203, 4, 'BJ2-006', 'AIR FILTER', 'CLASSIC', 0, 91.50, 'piece', 4, 'AIR_FILTER.203', 'images/no-image.png', NULL),
(204, 4, 'BJ2-007', 'BAG HOOK (SAFARI TYPE)', 'BJ2', 0, 31.50, 'piece', 6, 'BAG_HOOK_(SAFARI_TYPE).204', 'images/no-image.png', NULL),
(205, 4, 'BJ2-008', 'BOLT NUT COMP. 10*15 (6mm)', 'BJ2', 0, 2.35, 'piece', 100, 'BOLT_NUT_COMP10*15(6mm).205', 'images/no-image.png', NULL),
(206, 4, 'BJ2-009', 'BOLT NUT COMP. 10*18 (6mm)', 'BJ2', 0, 2.40, 'piece', 100, 'BOLT NUT COMP10*18(6mm).206', 'images/no-image.png', NULL),
(207, 4, 'BJ2-010', 'BOLT NUT COMP. 10*25 (6mm)', 'BJ2', 0, 3.00, 'piece', 100, 'BOLT_NUT_COMP10*25(6mm).207', 'images/no-image.png', NULL),
(208, 4, 'BJ2-011', 'BOLT NUT COMP. 10*35 (6mm)', 'BJ2', 0, 3.00, 'piece', 100, 'BOLT NUT COMP10*35(6mm).208', 'images/no-image.png', NULL),
(209, 4, 'BJ2-012', 'BOLT NUT COMP. 10*50 (6mm)', 'BJ2', 0, 3.75, 'piece', 100, 'BOLT_NUT_COMP10*50(6mm).209', 'images/no-image.png', NULL),
(210, 4, 'BJ2-013', 'BOLT NUT COMP. 14*15 (8mm)', 'BJ2', 0, 4.30, 'piece', 50, 'BOLT_NUT_COMP14*15(8mm).210', 'images/no-image.png', NULL),
(211, 4, 'BJ2-014', 'BOLT NUT COMP. 14*20 (8mm)', 'BJ2', 0, 4.50, 'piece', 50, 'BOLT_NUT_COMP14*20(8mm).211', 'images/no-image.png', NULL),
(212, 4, 'BJ2-015', 'BOLT NUT COMP. 14*25 (8mm)', 'BJ2', 0, 4.90, 'piece', 50, 'BOLT_NUT_COMP14*25(8mm).212', 'images/no-image.png', NULL),
(213, 4, 'BJ2-016', 'BOLT NUT COMP. 14*35 (8mm)', 'BJ2', 0, 5.75, 'piece', 50, 'BOLT_NUT_COMP14*35(8mm).213', 'images/no-image.png', NULL),
(214, 4, 'BJ2-017', 'BOLT NUT COMP. 14*50 (8mm)', 'BJ2', 0, 6.40, 'piece', 50, 'BOLT_NUT_COMP14*50(8mm).214', 'images/no-image.png', NULL),
(215, 4, 'BJ2-018', 'BOLT NUT COMP. 14*65 (8mm)', 'BJ2', 0, 8.00, 'piece', 20, 'BOLT_NUT_COMP14*65(8mm).215', 'images/no-image.png', NULL),
(216, 4, 'BJ2-019', 'BOLT NUT COMP. 14*75 (8mm)', 'BJ2', 0, 10.00, 'piece', 20, 'BOLT_NUT_COMP14*75(8mm).216', 'images/no-image.png', NULL),
(217, 4, 'BJ2-020', 'BOLT NUT COMP. 7*15 (4mm)', 'BJ2', 0, 1.40, 'piece', 100, 'BOLT_NUT_COMP7*15(4mm).217', 'images/no-image.png', NULL),
(218, 4, 'BJ2-021', 'BOLT NUT COMP. 8*15 (5mm)', 'BJ2', 0, 1.55, 'piece', 100, 'BOLT_NUT_COMP8*15(5mm).218', 'images/no-image.png', NULL),
(219, 4, 'BJ2-022', 'BOLT NUT COMP. 8*20 (5mm)', 'BJ2', 0, 1.70, 'piece', 100, 'BOLT_NUT_COMP8*20(5mm).219', 'images/no-image.png', NULL),
(220, 4, 'BJ2-023', 'BOLT NUT COMP. 8*25 (5mm)', 'BJ2', 0, 2.25, 'piece', 100, 'BOLT_NUT_COMP8*25(5mm).220', 'images/no-image.png', NULL),
(221, 4, 'BJ2-024', 'BOLT NUT COMP. 8*35 (5mm)', 'BJ2', 0, 2.25, 'piece', 100, 'BOLT_NUT_COMP8*35(5mm).221', 'images/no-image.png', NULL),
(222, 4, 'BJ2-025', 'BOLT NUT COMP. 8*50 (5mm)', 'BJ2', 0, 2.80, 'piece', 100, 'BOLT_NUT_COMP8*50(5mm).222', 'images/no-image.png', NULL),
(223, 4, 'BJ2-026', 'BRAKE CAME COTTER PIN', 'BJ2', 0, 0.24, 'piece', 200, 'BRAKE_CAME_COTTER_PIN.223', 'images/no-image.png', NULL),
(224, 4, 'BJ2-027', 'BRAKE CHAPLA (PATTY) ASSY. FRONT', 'BJ2', 0, 17.00, 'piece', 10, 'BRAKE_CHAPLA(PATTY)ASSYFRONT.224', 'images/no-image.png', NULL),
(225, 4, 'BJ2-028', 'BRAKE CHAPLA (PATTY) ASSY. REAR', 'BJ2', 0, 18.75, 'piece', 10, 'BRAKE_CHAPLA(PATTY)ASSYREAR.225', 'images/no-image.png', NULL),
(226, 4, 'BJ2-029', 'BRAKE PEDAL PIN', 'BJ2', 0, 0.00, 'piece', 50, 'BRAKE_PEDAL_PIN.226', 'images/no-image.png', NULL),
(227, 4, 'BJ2-030', 'BRAKE PEDAL PIN SMALL', 'CLASSIC', 0, 3.00, 'piece', 50, 'BRAKE_PEDAL_PIN_SMALL.227', 'images/no-image.png', NULL),
(228, 5, 'BJ3-001', 'ACCILATOR CHAPLA (PATTI) METAL', 'BJ3', 0, 8.25, 'piece', 20, 'ACCILATOR_CHAPLA(PATTI)METAL.228', 'images/no-image.png', NULL),
(229, 5, 'BJ3-002', 'ACCILATOR MUTHA SHIM', 'BJ3', 0, 1.25, 'piece', 50, 'ACCILATOR_MUTHA_SHIM.229', 'images/no-image.png', NULL),
(230, 5, 'BJ3-003', 'ACCILATOR PULLY (2-STRK)', 'BJ.2Stk', 0, 14.25, 'piece', 10, 'ACCILATOR_PULLY(2-STRK).230', 'images/no-image.png', NULL),
(231, 5, 'BJ3-004', 'ACCILATOR WIRE ADJUSTER ', 'BJ3', 0, 6.00, 'piece', 20, 'ACCILATOR_WIRE_ADJUSTER.231 ', 'images/no-image.png', NULL),
(232, 5, 'BJ3-005', 'AIR CLEANER LOCK ("W")', 'BJ3.FE', 0, 5.25, 'piece', 20, 'AIR_CLEANER_LOCK(W).232', 'images/no-image.png', NULL),
(233, 5, 'BJ3-006', 'AIR CLEANER PATRA BIG', 'BJ3.FE', 0, 18.50, 'piece', 12, 'AIR_CLEANER_PATRA_BIG.233', 'images/no-image.png', NULL),
(234, 5, 'BJ3-007', 'AIR CLEANER PATRA SMALL', 'BJ3.FE', 0, 8.40, 'piece', 20, 'AIR_CLEANER_PATRA_SMALL.234', 'images/no-image.png', NULL),
(235, 5, 'BJ3-780', 'AIR FILTER FOAM (N/M)', 'BJ.4Stk.', 0, 40.00, 'piece', 4, 'AIR_FILTER_FOAM(N/M).235', 'images/no-image.png', NULL),
(236, 5, 'BJ3-806', 'AIR FILTER FOAM (N/M)', 'BJ.2Stk.', 0, 88.00, 'piece', 4, 'AIR_FILTER_FOAM(N/M).236', 'images/no-image.png', NULL),
(237, 5, 'BJ3-823', 'AIR FILTER FOAM (WITHOUT HOLES)', 'BJ.2Stk', 0, 45.00, 'piece', 4, 'AIR_FILTER_FOAM(WITHOUT_HOLES).237', 'images/no-image.png', NULL),
(238, 5, 'BJ3-008', 'AIR FILTER ''Z'' CLAMP', 'BJ3.RE', 0, 67.00, 'piece', 6, 'AIR_FILTER_Z_CLAMP.238', 'images/no-image.png', NULL),
(239, 5, 'BJ3-009', 'AXLE BOOT CLAMP (WITH SCREW NUT)', 'BJ3RE', 0, 22.00, 'piece', 6, 'AXLE_BOOT_CLAMP(WITH_SCREW_NUT).239', 'images/no-image.png', NULL),
(240, 5, 'BJ3-010', 'AXLE BOOT CLIP (TAR TYPE)', 'BJ3.RE', 0, 4.60, 'piece', 20, 'AXLE_BOOT_CLIP(TAR_TYPE).240', 'images/no-image.png', NULL),
(241, 5, 'BJ3-011', 'AXLE NUT "Z" LOCK', 'BJ3.RE', 0, 1.55, 'piece', 100, 'AXLE_NUT_Z_LOCK.241', 'images/no-image.png', NULL),
(242, 5, 'BJ3-012', 'AXLE TRUNION (C.P) (Without Bush)', 'BJ3.RE', 0, 85.00, 'piece', 6, 'AXLE_TRUNION(CP)(Without_Bush).242', 'images/no-image.png', NULL),
(243, 5, 'BJ3-013', 'AXLE TRUNION BLUE BIG', 'BJ3.RE', 0, 65.00, 'piece', 6, 'AXLE_TRUNION_BLUE_BIG.243', 'images/no-image.png', NULL),
(244, 5, 'BJ3-014', 'AXLE TRUNION BLUE SMALL', 'BJ3.FE', 0, 53.50, 'piece', 6, 'AXLE_TRUNION_BLUE_SMALL.244', 'images/no-image.png', NULL),
(245, 5, 'BJ3-015', 'AXLE TRUNION BUSH (BRASS) O/S', 'BJ3', 0, 20.20, 'piece', 6, 'AXLE_TRUNION_BUSH(BRASS)O/S.245', 'images/no-image.png', NULL),
(246, 5, 'BJ3-016', 'AXLT TRUNION WITH BRASS BUSH', 'BJ3.RE', 0, 122.50, 'piece', 6, 'AXLT_TRUNION_WITH_BRASS_BUSH.246', 'images/no-image.png', NULL),
(247, 5, 'BJ3-017', 'BATTERY CLAMP SET', 'BJ3', 0, 56.00, 'set', 6, 'BATTERY_CLAMP_SET.247', 'images/no-image.png', NULL),
(248, 5, 'BJ3-805', 'BATTERY CLAMP SET (N/M) BIG', 'BJ.4Stk.', 0, 111.00, 'set', 4, 'BATTERY_CLAMP_SET(N/M)BIG.248', 'images/no-image.png', NULL),
(249, 5, 'BJ3-804', 'BATTERY CLAMP SET (N/M) SMALL', 'BJ.2Stk.', 0, 98.00, 'set', 4, 'BATTERY_CLAMP_SET(N/M)SMALL.249', 'images/no-image.png', NULL),
(250, 5, 'BJ3-018', 'BENJO BOLT  (F/T) (5-PORT)', 'BJ3 5-PORT', 0, 18.50, 'piece', 10, 'BENJO_BOLT(F/T)(5-PORT).250', 'images/no-image.png', NULL),
(251, 5, 'BJ3-019', 'BENJO BOLT (R/T) (3-PORT)', 'BJ3 3-PORT', 0, 18.50, 'piece', 10, 'BENJO_BOLT(R/T)(3-PORT).251', 'images/no-image.png', NULL),
(252, 5, 'BJ3-827', 'BODY BOLT KIT (SET OF 16)', 'BJ3RE', 0, 127.00, 'kit', 4, 'BODY_BOLT_KIT(SETOF16).252', 'images/no-image.png', NULL),
(253, 5, 'BJ3-020', 'BODY BOLT NUT COMP. (13*40)', 'BJ3', 0, 9.00, 'piece', 50, 'BODY_BOLT_NUT_COMP(13*40).253', 'images/no-image.png', NULL),
(254, 5, 'BJ3-021', 'BODY BOLT NUT COMP. (13*50)', 'BJ3', 0, 9.35, 'piece', 50, 'BODY_BOLT_NUT_COMP(13*50).254', 'images/no-image.png', NULL),
(255, 5, 'BJ3-022', 'BODY BOLT NUT COMP. (13*75)', 'BJ3', 0, 12.75, 'piece', 20, 'BODY_BOLT_NUT_COMP(13*75).255', 'images/no-image.png', NULL),
(256, 5, 'BJ3-830', 'BODY BOLT NUT COMP. (17*50)', 'BJ3', 0, 13.75, 'piece', 20, 'BODY_BOLT_NUT_COMP(17*50).256', 'images/no-image.png', NULL),
(257, 5, 'BJ3-023', 'BODY CHANGER (BED LEVER SET)', 'BJ3.RE', 0, 92.50, 'piece', 6, 'BODY_CHANGER_(BEDLEVERSET).257', 'images/no-image.png', NULL),
(258, 6, 'HH-001', 'ACCILATOR PIPE', 'H-HONDA', 0, 17.00, 'piece', 10, 'ACCILATOR_PIPE.258', 'images/no-image.png', NULL),
(259, 6, 'HH-002', 'ACCILATOR PIPE WITH GRIP (SET OF 2)', 'H-HONDA', 0, 42.50, 'piece', 4, 'ACCILATOR_PIPE_WITH_GRIP(SETOF2).259', 'images/no-image.png', NULL),
(260, 6, 'HH-003', 'ACCILATOR PIPE WITH GRIP (SET OF 2)', 'SPLENDER', 0, 57.00, 'piece', 4, 'ACCILATOR_PIPE_WITH_GRIP(SETOF2).260', 'images/no-image.png', NULL),
(261, 6, 'HH-004', 'ACCILATOR YOKE (MOUNTING)', 'H-HONDA', 0, 22.00, 'piece', 6, 'ACCILATOR_YOKE(MOUNTING).261', 'images/no-image.png', NULL),
(262, 6, 'HH-005', 'ACCILATOR YOKE SCREW', 'H-HONDA', 0, 1.55, 'piece', 50, 'ACCILATOR_YOKE_SCREW.262', 'images/no-image.png', NULL),
(263, 6, 'HH-404', 'AIR (PAPER) FILTER', 'SUP-SPLENDER', 0, 108.00, 'piece', 4, 'AIR(PAPER)FILTER.263', 'images/no-image.png', NULL),
(264, 6, 'HH-434', 'AIR (PAPER) FILTER', 'SHINE', 0, 101.00, 'piece', 4, 'AIR(PAPER)FILTER.264', 'images/no-image.png', NULL),
(265, 6, 'HH-006', 'AIR FILTER FOAM ', 'H-HONDA', 0, 30.00, 'piece', 6, 'AIR_FILTER_FOAM.265 ', 'images/no-image.png', NULL),
(266, 6, 'HH-007', 'AIR FILTER FOAM ', 'SPLENDER', 0, 53.00, 'piece', 6, 'AIR_FILTER_FOAM.266 ', 'images/no-image.png', NULL),
(267, 6, 'HH-008', 'AIR FILTER FOAM ', 'C.B.Z', 0, 62.00, 'piece', 4, 'AIR_FILTER_FOAM.267 ', 'images/no-image.png', NULL),
(268, 6, 'HH-009', 'AIR FILTER FOAM (O.E TYPE)', 'SPLENDER', 0, 0.00, 'piece', 6, 'AIR_FILTER_FOAM(O.ETYPE).268', 'images/no-image.png', NULL),
(269, 6, 'HH-010', 'ALLUM WASHER KIT (SET OF 5)', 'H-HONDA', 0, 4.00, 'kit', 10, 'ALLUM_WASHER_KIT(SETOF5).269', 'images/no-image.png', NULL),
(270, 6, 'HH-011', 'ALLUM. WASHER NO.10', 'H-HONDA', 0, 0.55, 'piece', 50, 'ALLUM_WASHER_NO10.270', 'images/no-image.png', NULL),
(271, 6, 'HH-012', 'BACK GEAR RUBBER', 'H.HONDA', 0, 10.00, 'piece', 10, 'BACK_GEAR_RUBBER.271', 'images/no-image.png', NULL),
(272, 6, 'HH-013', 'BAG HOOK (SAFARI TYPE)', 'H-HONDA', 0, 31.50, 'piece', 6, 'BAG_HOOK(SAFARI_TYPE).272', 'images/no-image.png', NULL),
(273, 6, 'HH-014', 'BAG HOOK (SAFARI TYPE)', 'PASSION', 0, 38.00, 'piece', 6, 'BAG_HOOK(SAFARI_TYPE).273', 'images/no-image.png', NULL),
(274, 6, 'HH-015', 'BATTERY BELT', 'H-HONDA', 0, 9.25, 'piece', 10, 'BATTERY_BELT.274', 'images/no-image.png', NULL),
(275, 6, 'HH-440', 'BATTERY CLIP WITH WIRE', 'SUP-SPLENDER', 0, 118.00, 'piece', 4, 'BATTERY_CLIP_WITH_WIRE.275', 'images/no-image.png', NULL),
(276, 6, 'HH-016', 'BRAKE PEDAL RUBBER', 'H.HONDA', 0, 13.25, 'piece', 10, 'BRAKE_PEDAL_RUBBER.276', 'images/no-image.png', NULL),
(277, 6, 'HH-017', 'BRAKE PEDAL SETTING BOLT', 'SPLENDER', 0, 6.30, 'piece', 10, 'BRAKE_PEDAL_SETTING_BOLT.277', 'images/no-image.png', NULL),
(278, 6, 'HH-018', 'BRAKE PEDAL SPRING', 'H-HONDA', 0, 8.60, 'piece', 20, 'BRAKE_PEDAL_SPRING.278', 'images/no-image.png', NULL),
(279, 6, 'HH-019', 'BRAKE PEDAL SPRING', 'SPLENDER', 0, 12.40, 'piece', 10, 'BRAKE_PEDAL_SPRING.279', 'images/no-image.png', NULL),
(280, 6, 'HH-020', 'BRAKE ROD', 'SPLENDER', 0, 57.50, 'piece', 4, 'BRAKE_ROD.280', 'images/no-image.png', NULL),
(281, 6, 'HH-021', 'BRAKE ROD', 'SUP-SPLENDER', 0, 61.50, 'piece', 4, 'BRAKE_ROD.281', 'images/no-image.png', NULL),
(282, 6, 'HH-022', 'BRAKE ROD ', 'H-HONDA', 0, 51.00, 'piece', 4, 'BRAKE_ROD.282', 'images/no-image.png', NULL),
(283, 6, 'HH-453', 'BRAKE ROD ', 'SHINE', 0, 62.00, 'piece', 4, 'BRAKE_ROD.283', 'images/no-image.png', NULL),
(284, 6, 'HH-023', 'BRAKE ROD NUT', 'H-HONDA', 0, 5.50, 'piece', 20, 'BRAKE_ROD_NUT.284', 'images/no-image.png', NULL),
(285, 6, 'HH-424', 'BRAKE ROD NUT', 'UNICORN', 0, 8.25, 'piece', 10, 'BRAKE_ROD_NUT.285', 'images/no-image.png', NULL),
(286, 6, 'HH-024', 'BRAKE ROD PIN', 'H-HONDA', 0, 3.00, 'piece', 20, 'BRAKE_ROD_PIN.286', 'images/no-image.png', NULL),
(287, 6, 'HH-025', 'BRAKE ROD SPACER', 'H-HONDA', 0, 5.50, 'piece', 20, 'BRAKE_ROD_SPACER.287', 'images/no-image.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_meta`
--

CREATE TABLE IF NOT EXISTS `product_meta` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_meta`
--

INSERT INTO `product_meta` (`id`, `product_id`, `meta_key`, `meta_value`) VALUES
(1, 1, 'abc', 'bcd'),
(2, 1, 'pqr', 'xyz');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_address_line_1` text,
  `user_address_line_2` text,
  `user_area` varchar(50) DEFAULT NULL,
  `user_town` varchar(50) DEFAULT NULL,
  `user_state` varchar(50) DEFAULT NULL,
  `user_pin_code` int(7) DEFAULT NULL,
  `user_country` varchar(50) DEFAULT NULL,
  `user_contact_number` varchar(13) NOT NULL,
  `user_role` varchar(15) NOT NULL,
  `user_password` varchar(300) NOT NULL,
  `user_activation_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_email`, `user_name`, `user_address_line_1`, `user_address_line_2`, `user_area`, `user_town`, `user_state`, `user_pin_code`, `user_country`, `user_contact_number`, `user_role`, `user_password`, `user_activation_code`) VALUES
(2, 'jay_gagnani94@gmail.com', 'Jay Gagnani', '203 Labh Exotica', '', 'abcd', 'Vadodara', 'Gujarat', 390023, 'India', '9978858366', 'user', 'fcea920f7412b5da7be0cf42b8c93759', NULL),
(23, 'jaygagnani94@gmail.com', 'Jay Gagnani', '203, Labh Exotica', 'Radiatba Road', 'Gotri', 'Vadodara', 'Gujarat', 390021, 'India', '09978858366', 'user', 'fcea920f7412b5da7be0cf42b8c93759', NULL),
(26, 'jay.gagnani94@gmail.com', 'Jay Gagnani', '203, Labh Exotica', NULL, 'Gotri', 'Vadodara', 'Gujarat', 390021, 'India', '09978858366', 'user', 'fcea920f7412b5da7be0cf42b8c93759', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `meta_key` varchar(50) NOT NULL,
  `meta_value` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_meta`
--

INSERT INTO `user_meta` (`id`, `user_id`, `meta_key`, `meta_value`) VALUES
(1, 2, 'abc', 'qwerty'),
(2, 2, 'pqr', 'ytrewq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_id_2` (`user_id`,`product_id`), ADD UNIQUE KEY `user_id_3` (`user_id`,`product_id`), ADD KEY `user_id` (`user_id`,`product_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `order_transaction_id` (`order_transaction_id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
 ADD PRIMARY KEY (`id`), ADD KEY `order_id` (`order_id`,`product_id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `product_id` (`product_id`,`product_nicename`), ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_meta`
--
ALTER TABLE `product_meta`
 ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `user_email` (`user_email`,`user_activation_code`);

--
-- Indexes for table `user_meta`
--
ALTER TABLE `user_meta`
 ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=288;
--
-- AUTO_INCREMENT for table `product_meta`
--
ALTER TABLE `product_meta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `user_meta`
--
ALTER TABLE `user_meta`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_meta`
--
ALTER TABLE `product_meta`
ADD CONSTRAINT `product_meta_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_meta`
--
ALTER TABLE `user_meta`
ADD CONSTRAINT `user_meta_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
