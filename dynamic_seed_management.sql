-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2022 at 06:02 AM
-- Server version: 5.7.37-0ubuntu0.18.04.1
-- PHP Version: 7.3.33-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dynamic_seed_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `namesofpicture`
--

CREATE TABLE `namesofpicture` (
  `seed_id` int(11) NOT NULL,
  `picturename` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `namesofpicture`
--

INSERT INTO `namesofpicture` (`seed_id`, `picturename`) VALUES
(101008, 'ImprovedGoldenWaxBush11.jpg'),
(101064, 'DetroitDarkRed11.jpg'),
(101083, 'GreenCurled11.jpg'),
(101145, 'TendersweetLong11.jpg'),
(101146, 'NantesTouchon11.jpg'),
(101154, 'EarlySnowball11.jpg'),
(101229, 'EnglishLong11.png'),
(101375, 'MonstrousCarentan11.jpg'),
(101419, 'Iceberg11.jpg'),
(101624, 'Butternut11.jpg'),
(122343, 'SanMarzano11.jpg'),
(132401, 'GoldRush11.jpg'),
(132404, 'EarlyCopenhagenMarket11.jpg'),
(137147, 'Catskill11.jpg'),
(137817, 'EliteHybrid11.png'),
(137822, 'DeCicco11.jpg'),
(137829, 'ItalianSaladBlend11.jpg'),
(139339, 'PeachesandCream11.jpg'),
(139773, 'BlackBeauty11.jpg'),
(139776, 'Sweetie11.jpg'),
(139790, 'CaliforniaWonder11.jpg'),
(139826, 'ScarletNantes11.jpg'),
(140097, 'GreencropBush11.jpg'),
(140118, 'NationalPickling11.jpg'),
(140124, 'Romaine11.jpg'),
(140136, 'AnnualBunching11.jpg'),
(140147, 'VegetableSpaghettiPasta11.jpg'),
(140163, 'BeefSteakBush11.jpg'),
(140174, 'DarkGreen11.jpg'),
(141459, 'RainbowMix11.jpg'),
(141478, 'Buttercrunch11.jpg'),
(141482, 'BellColor11.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Seeds`
--

CREATE TABLE `Seeds` (
  `seed_id` int(11) NOT NULL,
  `SeedName` varchar(50) NOT NULL,
  `SeedCategory` varchar(15) NOT NULL,
  `PlantingTime` varchar(75) NOT NULL,
  `GrowthTime` varchar(15) NOT NULL,
  `SeedHarvest` date DEFAULT NULL,
  `years` int(11) NOT NULL,
  `ExpireDate` date DEFAULT NULL,
  `ExpireDate2` varchar(15) NOT NULL,
  `PurchaseDate` varchar(20) DEFAULT NULL,
  `quantity1` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Seeds`
--

INSERT INTO `Seeds` (`seed_id`, `SeedName`, `SeedCategory`, `PlantingTime`, `GrowthTime`, `SeedHarvest`, `years`, `ExpireDate`, `ExpireDate2`, `PurchaseDate`, `quantity1`) VALUES
(101008, 'Improved Golden Wax Bush', 'Bean', 'April', '50-55 Days', '2022-04-05', 4, '2026-04-05', 'July 2025', 'N/A (Harvest Only)', 2420),
(101064, 'Detroit Dark Red', 'Beet', 'March / April / August', '50-60 Days', '2022-03-16', 5, '2027-03-16', 'June 2026', 'January 2022', 4621),
(101083, 'Green Curled', 'Kale', 'March / April / May / June / July', '60-75 Days', '2022-03-22', 4, '2026-03-22', 'October 2023', 'March 2020', 1765),
(101145, 'Tendersweet Long', 'Carrot', 'March / April / May / June / July', '75 Days', '2022-04-20', 5, '2027-04-20', 'June 2023', 'September 2018', 2150),
(101146, 'Nantes Touchon', 'Carrot', 'March / April / May / June / July', '60-75 Days', '2022-04-05', 5, '2027-04-05', 'May 2022', 'May 2017', 2222),
(101154, 'Early Snowball', 'Cauliflower', 'April / May', '50 Days', '2022-05-10', 4, '2026-05-10', 'June 2021', 'March 2018', 150),
(101229, 'English Long', 'Cucumber', 'March / April', '50-70 Days', '2022-03-30', 3, '2025-03-30', 'August 2024', 'February 2022', 410),
(101375, 'Monstrous Carentan', 'Leek', 'February / March / April / May', '110-120 Days', '2022-02-08', 5, '2027-02-08', 'July 2026', 'December 2021', 1111),
(101419, 'Iceberg', 'Lettuce', 'March / April / May / August / September', '75 Days', '2022-08-10', 5, '2027-08-10', 'July 2025', 'July 2020', 2226),
(101624, 'Butternut', 'Squash', 'April / May', '85-100 Days', '2022-04-25', 4, '2026-04-25', 'September 2025', 'January 2022', 3526),
(122343, 'San Marzano', 'Tomato', 'April / May / June', '76 Days', '2022-04-12', 4, '2026-04-12', 'August 2022', 'March 2019', 489),
(132401, 'Gold Rush', 'Zucchini', 'May / June', '49 Days', '2022-05-26', 4, '2026-05-26', 'August 2025', 'N/A (Harvest Only)', 1574),
(132404, 'Early Copenhagen Market', 'Cabbage', 'February / March / April', '65-70 Days', '2022-02-24', 3, '2025-02-24', 'May 2023', 'March 2021', 1711),
(137147, 'Catskill', 'Brussel Sprouts', 'March / April / July / August', '90 Days', '2022-07-13', 4, '2026-07-13', 'November 2023', 'December 2019', 1437),
(137817, 'Elite Hybrid', 'Zucchini', 'May / June', '55 Days', '2022-06-16', 4, '2026-06-16', 'August 2025', 'N/A (Harvest Only)', 2750),
(137822, 'De Cicco', 'Broccoli', 'March / April', '50-70 Days', '2022-03-24', 3, '2025-03-24', 'June 2022', 'February 2020', 1232),
(137829, 'Italian Salad Blend', 'Lettuce', 'May', '40-65 Days', '2022-05-13', 5, '2027-05-13', 'July 2022', 'October 2017', 2896),
(139339, 'Peaches and Cream', 'Corn', 'May / June / July', '70-75 Days', '2022-05-06', 2, '2024-05-06', 'October 2023', 'April 2022', 1545),
(139773, 'Black Beauty', 'Zucchini', 'May / June', '52 Days', '2022-06-16', 4, '2026-06-16', 'July 2022', 'N/A (Harvest Only)', 2000),
(139776, 'Sweetie', 'Tomato', 'April / May / June', '70 Days', '2022-06-22', 4, '2026-06-22', 'July 2023', 'July 2019', 100),
(139790, 'California Wonder', 'Pepper', 'June', '75 Days', '2022-06-19', 4, '2026-06-19', 'September 2022', 'May 2019', 300),
(139826, 'Scarlet Nantes', 'Carrot', 'April / May / June / July', '68 Days', '2022-04-28', 3, '2025-04-28', 'August 2024', 'March 2022', 4527),
(140097, 'Green Crop Bush', 'Bean', 'April', '53 Days', '2022-04-23', 4, '2026-04-23', 'July 2024', 'February 2021', 2570),
(140118, 'National Pickling', 'Cucumber', 'May / June', '55 Days', '2022-05-20', 5, '2027-05-20', 'August 2022', 'N/A (Harvest Only)', 2584),
(140124, 'Romaine', 'Lettuce', 'March / April / May / August / September', '65-85 Days', '2022-09-16', 5, '2027-09-16', 'August 2026', 'March 2022', 2276),
(140136, 'Annual Bunching', 'Onion', 'March / April / August / September', '60-75 Days', '2022-08-24', 1, '2023-08-24', 'July 2022', 'August 2021', 1125),
(140147, 'Vegetable Spaghetti Pasta', 'Squash', 'April / May', '75-100 Days', '2022-04-12', 4, '2026-04-12', 'September 2025', 'January 2022', 3000),
(140163, 'Beef Steak Bush', 'Tomatoe', 'April / May / June', '65-80 Days', '2022-04-16', 4, '2026-04-16', 'July 2025', 'September 2021', 150),
(140174, 'Dark Green', 'Zucchini', 'May / June', '52 Days', '2022-05-31', 4, '2026-05-31', 'August 2024', 'March 2021', 3562),
(141459, 'Rainbow Mix', 'Carrot', 'April / May / June / July', '60-70 Days', '2022-07-15', 3, '2025-07-15', 'July 2024', 'N/A (Harvest Only)', 250),
(141478, 'Buttercrunch', 'Lettuce', 'March / April / September', '60-70 Days', '2022-04-27', 5, '2027-04-27', 'June 2026', 'August 2021', 2500),
(141482, 'Bell Color', 'Pepper', 'May / June', '70-90 Days', '2022-05-11', 2, '2024-05-11', 'September 2021', 'January 2020', 1010);

-- --------------------------------------------------------

--
-- Table structure for table `seeds_inventory`
--

CREATE TABLE `seeds_inventory` (
  `seed_id` int(6) NOT NULL,
  `seed_name` varchar(30) NOT NULL,
  `quantity` int(6) NOT NULL,
  `plant_date` date NOT NULL,
  `harvest_date` date NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeds_inventory`
--

INSERT INTO `seeds_inventory` (`seed_id`, `seed_name`, `quantity`, `plant_date`, `harvest_date`, `purchase_date`) VALUES
(101008, 'Improved Golden Wax Bush', 2420, '2022-04-05', '2022-04-05', '2022-04-05'),
(101064, 'Detroit Dark Red', 4621, '2022-04-04', '2022-04-03', '2022-03-29'),
(101083, 'Green Curled', 1765, '2022-04-01', '2022-04-01', '2022-03-29'),
(101145, 'Tendersweet Long', 2150, '2022-03-29', '2022-03-29', '2022-03-29'),
(101146, 'Nantes Touchon', 2222, '2022-04-05', '2022-04-05', '2022-03-29'),
(101154, 'Early Snowball', 150, '2022-04-04', '2022-04-04', '2022-04-04'),
(101229, 'English Long', 410, '2022-03-29', '2022-04-04', '2022-03-29'),
(101375, 'Monstrous Carentan', 1111, '2022-03-29', '2022-03-29', '2022-03-29'),
(101419, 'Iceberg', 2226, '2022-03-29', '2022-03-29', '2022-03-29'),
(101624, 'Butternut', 3526, '2022-03-29', '2022-03-29', '2022-03-29'),
(122343, 'San Marzano', 489, '2022-04-04', '2022-03-29', '2022-04-03'),
(132401, 'Gold Rush', 1574, '2022-03-29', '2022-03-29', '2022-03-29'),
(132404, 'Early Copenhagen Market', 1711, '2022-03-29', '2022-03-29', '2022-03-29'),
(137147, 'Catskill', 1437, '2022-03-29', '2022-03-29', '2022-03-29'),
(137817, 'Elite Hybrid', 2750, '2022-03-29', '2022-03-29', '2022-03-29'),
(137822, 'De Cicco', 1232, '2022-03-29', '2022-03-29', '2022-03-29'),
(137829, 'Italian Salad Blend', 2896, '2022-03-29', '2022-03-29', '2022-03-29'),
(139339, 'Peaches and Cream', 1545, '2022-03-29', '2022-03-29', '2022-03-29'),
(139773, 'Black Beauty', 2000, '2022-03-29', '2022-03-29', '2022-03-29'),
(139776, 'Sweetie', 100, '2022-03-29', '2022-03-29', '2022-03-29'),
(139790, 'California Wonder', 300, '2022-03-29', '2022-03-29', '2022-03-29'),
(139826, 'Scarlet Nantes', 4527, '2022-03-29', '2022-03-29', '2022-03-29'),
(140097, 'Green Crop Bush', 2570, '2022-03-29', '2022-03-29', '2022-03-29'),
(140118, 'National Pickling', 2584, '2022-03-29', '2022-03-29', '2022-03-29'),
(140124, 'Romaine', 2276, '2022-03-29', '2022-03-29', '2022-03-29'),
(140136, 'Annual Bunching', 1125, '2022-03-29', '2022-03-29', '2022-03-29'),
(140147, 'Vegetable Spaghetti Pasta', 3000, '2022-03-29', '2022-03-29', '2022-03-29'),
(140163, 'Beef Steak Bush', 150, '2022-03-29', '2022-03-29', '2022-03-29'),
(140174, 'Dark Green', 3562, '2022-03-29', '2022-03-29', '2022-03-29'),
(141459, 'Rainbow Mix', 250, '2022-03-29', '2022-03-29', '2022-03-29'),
(141478, 'Buttercrunch', 2500, '2022-03-29', '2022-03-29', '2022-03-29'),
(141482, 'Bell Color', 1010, '2022-03-29', '2022-04-01', '2022-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `seed_database`
--

CREATE TABLE `seed_database` (
  `seed_id` int(6) NOT NULL,
  `seed_name` varchar(30) NOT NULL,
  `category` varchar(30) NOT NULL,
  `planting_time` varchar(30) NOT NULL,
  `expire_date` date NOT NULL,
  `growth_time` varchar(30) NOT NULL,
  `quantity1` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seed_database`
--

INSERT INTO `seed_database` (`seed_id`, `seed_name`, `category`, `planting_time`, `expire_date`, `growth_time`, `quantity1`) VALUES
(101226, 'English Long', 'Cucumber', '', '2024-08-01', '50', 2000),
(140136, 'Annual Bunching', 'Onion', '', '2022-07-01', '60', 500),
(101226, 'English Long', 'Cucumber', '', '2024-08-01', '50', 2000),
(140174, 'Dark Green', 'Zucchini', '', '2024-08-01', '50', 300),
(140124, 'Romaine', 'Lettuce', '', '2026-08-01', '65', 2500),
(101624, 'Butternut', 'Squash', '', '2025-09-01', '85', 400),
(101064, 'Detroit Dark Red', 'Beet', '', '2026-05-01', '50', 1180),
(132404, 'Early Copenhagen Market', 'Cabbage', '', '2023-05-01', '65', 1200),
(140136, 'Annual Bunching', 'Onion', '', '2022-07-01', '60', 500);

-- --------------------------------------------------------

--
-- Table structure for table `seed_inventory`
--

CREATE TABLE `seed_inventory` (
  `seed_id` int(6) NOT NULL,
  `seed_name` char(30) NOT NULL,
  `quantity` int(6) NOT NULL,
  `plant_date` date NOT NULL,
  `harvest_date` date NOT NULL,
  `purchase_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seed_inventory`
--

INSERT INTO `seed_inventory` (`seed_id`, `seed_name`, `quantity`, `plant_date`, `harvest_date`, `purchase_date`) VALUES
(101064, 'Detroit Dark Red', 1180, '2022-03-19', '2022-09-19', '2018-02-15'),
(101226, 'English Long', 1020, '2022-03-19', '2022-09-19', '2018-02-15'),
(101229, 'English Long', 400, '2020-01-01', '2020-01-01', '2020-01-01'),
(101624, 'Butternut', 400, '2022-03-19', '2022-09-19', '2018-02-15'),
(132404, 'Early Copenhagen Market', 1200, '2022-03-19', '2022-09-19', '2018-02-15'),
(140124, 'Romain', 2500, '2022-03-19', '2022-09-19', '2018-02-15'),
(140136, 'Annual Bunching', 500, '2022-03-19', '2022-09-19', '2018-02-15'),
(140174, 'Dark Green', 300, '2022-03-19', '2022-09-19', '2018-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `top_5_gardeners`
--

CREATE TABLE `top_5_gardeners` (
  `user_id` int(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `seed_harvest` int(11) NOT NULL,
  `type_user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `top_5_gardeners`
--

INSERT INTO `top_5_gardeners` (`user_id`, `name`, `seed_harvest`, `type_user`) VALUES
(1, 'John Doe', 54, 'Administrator'),
(2, 'Some Person', 0, 'Employee'),
(3, 'Jeff Doe', 0, 'Employee'),
(4, 'Bill Gates', 0, 'Employee'),
(6, 'Jeff Bezos', 0, 'Gardener'),
(7, 'Michael Jackson', 0, 'Gardener'),
(8, 'Bruce Willis', 120, 'Administrator'),
(20, 'Guest Employee', 40, 'Employee'),
(50, 'Guest Gardener', 0, 'Gardener'),
(51, 'Bob Man', 0, 'Employee'),
(52, 'Garry Man', 0, 'Gardener'),
(99, 'Lars Algera', 0, 'Administrator'),
(1000, 'Jendy Admin', 0, 'Administrator'),
(1001, 'Jendy Employee', 0, 'Employee'),
(1003, 'Jendy Gardener', 0, 'Gardener');

-- --------------------------------------------------------

--
-- Table structure for table `top_5_harvested`
--

CREATE TABLE `top_5_harvested` (
  `harvested_id_seed` int(11) NOT NULL,
  `harvested_name_seed` varchar(50) NOT NULL,
  `amount_seed_harvest` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `top_5_harvested`
--

INSERT INTO `top_5_harvested` (`harvested_id_seed`, `harvested_name_seed`, `amount_seed_harvest`) VALUES
(101008, 'Improved Golden Wax Bush', 135),
(101064, 'Detroit Dark Red', 20),
(101083, 'Green Curled', 0),
(101145, 'Tendersweet Long', 0),
(101146, 'Nantes Touchon', 1),
(101154, 'Early Snowball', 138),
(101229, 'English Long', 10),
(101375, 'Monstrous Carentan', 0),
(101419, 'Iceberg', 0),
(101624, 'Butternut', 0),
(122343, 'San Marzano', 0),
(132401, 'Gold Rush', 0),
(132404, 'Early Copenhagen Market', 0),
(137147, 'Catskill', 0),
(137817, 'Elite Hybrid', 0),
(137822, 'De Cicco', 0),
(137829, 'Italian Salad Blend', 0),
(139339, 'Peaches and Cream', 0),
(139773, 'Black Beauty', 0),
(139776, 'Sweetie', 0),
(139790, 'California Wonder', 0),
(139826, 'Scarlet Nantes', 0),
(140097, 'Green Crop Bush', 0),
(140118, 'National Pickling', 0),
(140124, 'Romaine', 0),
(140136, 'Annual Bunching', 0),
(140147, 'Vegetable Spaghetti Pasta', 0),
(140163, 'Beef Steak Bush', 0),
(140174, 'Dark Green', 0),
(141459, 'Rainbow Mix', 0),
(141478, 'Buttercrunch', 0),
(141482, 'Bell Color', 0);

-- --------------------------------------------------------

--
-- Table structure for table `top_5_wasted`
--

CREATE TABLE `top_5_wasted` (
  `wasted_id_seed` int(11) NOT NULL,
  `wasted_name_seed` varchar(50) NOT NULL,
  `amount_seed_wasted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `top_5_wasted`
--

INSERT INTO `top_5_wasted` (`wasted_id_seed`, `wasted_name_seed`, `amount_seed_wasted`) VALUES
(101008, 'Improved Golden Wax Bush', 167),
(101064, 'Detroit Dark Red', 0),
(101083, 'Green Curled', 0),
(101145, 'Tendersweet Long', 0),
(101146, 'Nantes Touchon', 0),
(101154, 'Early Snowball', 20),
(101229, 'English Long', 0),
(101375, 'Monstrous Carentan', 0),
(101419, 'Iceberg', 0),
(101624, 'Butternut', 0),
(122343, 'San Marzano', 50),
(132401, 'Gold Rush', 0),
(132404, 'Early Copenhagen Market', 0),
(137147, 'Catskill', 0),
(137817, 'Elite Hybrid', 0),
(137822, 'De Cicco', 0),
(137829, 'Italian Salad Blend', 0),
(139339, 'Peaches and Cream', 0),
(139773, 'Black Beauty', 0),
(139776, 'Sweetie', 0),
(139790, 'California Wonder', 0),
(139826, 'Scarlet Nantes', 0),
(140097, 'Green Crop Bush', 0),
(140118, 'National Pickling', 0),
(140124, 'Romaine', 0),
(140136, 'Annual Bunching', 0),
(140147, 'Vegetable Spaghetti Pasta', 0),
(140163, 'Beef Steak Bush', 0),
(140174, 'Dark Green', 0),
(141459, 'Rainbow Mix', 0),
(141478, 'Buttercrunch', 0),
(141482, 'Bell Color', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `full_name` varchar(30) NOT NULL,
  `birth_date` date NOT NULL,
  `email_address` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(15) NOT NULL,
  `isAdmin` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `full_name`, `birth_date`, `email_address`, `password`, `user_type`, `isAdmin`) VALUES
(1, 'j.doe', 'John Doe', '1987-05-23', 'john.munialo@email.kpu.ca', 'Testing123!', 'Administrator', 'yes'),
(2, 'S.Person', 'Some Person', '1999-10-15', 'larsalgera@gmail.com', 'Testing123!', 'Employee', 'no'),
(3, 'Je.Doe', 'Jeff Doe', '1987-05-23', 'Nadeem_7860@hotmail.com', 'Testing123!', 'Employee', 'no'),
(4, 'b.gates', 'Bill Gates', '1965-02-25', 'makaylajackson1239@gmail.com', 'Testing123!', 'Employee', 'no'),
(5, 'e.musk', 'Elon Musk', '1977-08-13', 'john.munialo@email.kpu.ca', 'Testing123!', 'Administrator', 'yes'),
(6, 'j.bezos', 'Jeff Bezos', '1955-11-04', 'john.munialo@email.kpu.ca', 'Testing123!', 'Gardener', 'no'),
(7, 'm.jackson', 'Michael Jackson', '1962-07-21', 'cmunialo@gmail.com', 'Testing123!', 'Gardener', 'no'),
(8, 'b.willis', 'Bruce Willis', '1999-10-15', '', 'Testing123!', 'Administrator', 'yes'),
(20, 'G.Employee', 'Guest Employee', '1979-05-03', 'Nadeem_7860@hotmail.com', 'NewPassword1!', 'Employee', 'no'),
(50, 'G.Gardener', 'Guest Gardener', '1980-09-06', 'Nadeem.Malawiya@email.kpu.ca', 'BestGardener123!', 'Gardener', 'no'),
(51, 'B.Man', 'Bob Man', '2020-10-05', 'bobman@gmail.com', 'Testing123!', 'Employee', 'no'),
(52, 'G.Man', 'Garry Man', '2020-07-08', 'garryman@gmail.com', 'Testing123!', 'Gardener', 'no'),
(99, 'Lars', 'Lars Algera', '2002-03-25', 'LarsAlgera@outlook.com', 'Testing123!!', 'Administrator', 'yes'),
(1000, 'J.Admin', 'Jendy Admin', '1980-01-01', 'Jendy.Wu@kpu.ca', 'Admin.Test1', 'Administrator', 'yes'),
(1001, 'J.Employee', 'Jendy Employee', '1980-01-01', 'Jendy.Wu@kpu.ca', 'Employ.Test2', 'Employee', 'no'),
(1003, 'J.Gardener', 'Jendy Gardener', '1980-01-01', 'Jendy.Wu@kpu.ca', 'Garden.Test3', 'Gardener', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE `user_transactions` (
  `transaction_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `seed_name` varchar(30) NOT NULL,
  `seed_id` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `date_assigned` date NOT NULL,
  `date_completed` date NOT NULL,
  `isCompleted` varchar(3) NOT NULL,
  `id_user` int(6) NOT NULL,
  `full_name_transactions` varchar(30) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`transaction_id`, `username`, `seed_name`, `seed_id`, `quantity`, `date_assigned`, `date_completed`, `isCompleted`, `id_user`, `full_name_transactions`, `message`) VALUES
(1, 'j.bezos', 'English Long', 101229, 280, '2022-04-04', '2022-04-05', 'yes', 6, 'Jeff Bezos', 'Go Jefe  '),
(3, 'G.Gardener', 'Butternut', 101624, 5, '2022-04-04', '2022-04-04', 'yes', 50, 'Guest Gardener', 'Please plant the following seed and send notification once completed'),
(5, 'm.jackson', 'English Long', 101229, 20, '2022-03-29', '2022-03-30', 'no', 7, 'Michael Jackson', '	test			  '),
(6, 'j.bezos', 'Improved Golden Wax Bush', 101008, 10, '2022-03-31', '2022-04-05', 'yes', 6, 'Jeff Bezos', '				  '),
(101, 'G.Gardener', 'Dark Green', 140174, 300, '2022-04-04', '2022-04-05', 'no', 50, 'Guest Gardener', 'Please plant seeds and notify when complete.				  ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `namesofpicture`
--
ALTER TABLE `namesofpicture`
  ADD PRIMARY KEY (`seed_id`);

--
-- Indexes for table `Seeds`
--
ALTER TABLE `Seeds`
  ADD PRIMARY KEY (`seed_id`);

--
-- Indexes for table `seeds_inventory`
--
ALTER TABLE `seeds_inventory`
  ADD PRIMARY KEY (`seed_id`);

--
-- Indexes for table `seed_inventory`
--
ALTER TABLE `seed_inventory`
  ADD PRIMARY KEY (`seed_id`);

--
-- Indexes for table `top_5_gardeners`
--
ALTER TABLE `top_5_gardeners`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `top_5_harvested`
--
ALTER TABLE `top_5_harvested`
  ADD PRIMARY KEY (`harvested_id_seed`);

--
-- Indexes for table `top_5_wasted`
--
ALTER TABLE `top_5_wasted`
  ADD PRIMARY KEY (`wasted_id_seed`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
