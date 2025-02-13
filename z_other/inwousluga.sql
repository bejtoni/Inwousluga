-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2024 at 07:47 PM
-- Server version: 8.3.0
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inwobaza`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AID` int NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CID` int NOT NULL,
  `Category_Type` varchar(255) NOT NULL,
  `Created_At` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CID`, `Category_Type`, `Created_At`) VALUES
(25, 'Home Repairs', '2024-05-29 09:34:35'),
(26, 'Electricity', '2024-05-29 09:34:35'),
(27, 'Material Processing', '2024-05-29 09:34:35'),
(28, 'Construction Works', '2024-05-29 09:34:35'),
(29, 'Pipeline Installations', '2024-05-29 09:34:35'),
(30, 'Vehicle Maintenance', '2024-05-29 09:34:35'),
(31, 'Clothing and Jewelry', '2024-05-29 09:34:35'),
(32, 'Cleaning and Maintenance', '2024-05-29 09:34:35');

-- --------------------------------------------------------

--
-- Table structure for table `collaboration`
--

CREATE TABLE `collaboration` (
  `CID` int NOT NULL,
  `Status` enum('p','o','f') NOT NULL,
  `Review` int DEFAULT NULL,
  `Comment` text,
  `Service_User_Message` text,
  `Worked_Hours` int DEFAULT NULL,
  `Collaboration_Started` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Collaboration_Finished` timestamp NULL DEFAULT NULL,
  `User_ID` int DEFAULT NULL,
  `Provider_Service_ID` int DEFAULT NULL,
  `Date_Requested` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `liked_service`
--

CREATE TABLE `liked_service` (
  `LSID` int NOT NULL,
  `Comment` text,
  `Date_Liked` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `User_ID` int DEFAULT NULL,
  `Provider_Service_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provider_service`
--

CREATE TABLE `provider_service` (
  `PSID` int NOT NULL,
  `Total_Service_Rating` float DEFAULT NULL,
  `Name_Of_Service` varchar(255) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Telephone_Number` varchar(15) DEFAULT NULL,
  `Description` text,
  `Website` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Date_Of_Birth` date DEFAULT NULL,
  `User_ID` int DEFAULT NULL,
  `Service_ID` int DEFAULT NULL,
  `Image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `SID` int NOT NULL,
  `Service_Name` varchar(255) NOT NULL,
  `Service_Description` text,
  `Category_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`SID`, `Service_Name`, `Service_Description`, `Category_ID`) VALUES
(60, 'Electrician', 'Electrician services for home repairs', 25),
(61, 'Plumber', 'Plumbing services for home repairs', 25),
(62, 'Painter', 'Painting services for home repairs', 25),
(63, 'Tiler', 'Tiling services for home repairs', 25),
(64, 'Parquet Installer', 'Parquet installation services', 25),
(65, 'AC Servicer', 'Air conditioning services', 25),
(66, 'Heating', 'Heating system services', 25),
(67, 'Locksmith', 'Locksmith services', 25),
(68, 'Upholsterer', 'Upholstery services', 25),
(69, 'Audio Video Servicer', 'Audio video servicing', 26),
(70, 'Electrician', 'Electrical services', 26),
(71, 'AC Servicer', 'Air conditioning servicing', 26),
(72, 'Elevator Servicer', 'Elevator servicing', 26),
(73, 'Mobile Phone Servicer', 'Mobile phone servicing', 26),
(74, 'Computer Servicer', 'Computer servicing', 26),
(75, 'Other Device Servicer', 'Servicing of z_other devices', 26),
(76, 'Security Systems', 'Installation and servicing of security systems', 26),
(77, 'Coffee Machine Servicer', 'Coffee machine servicing', 26);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` int NOT NULL,
  `First_Name` varchar(255) NOT NULL,
  `Last_Name` varchar(255) NOT NULL,
  `DOB` date DEFAULT NULL,
  `Phone` varchar(15) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Password` varchar(255) NOT NULL,
  `Total_Rating` float DEFAULT NULL,
  `IsAdmin` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UID`, `First_Name`, `Last_Name`, `DOB`, `Phone`, `Email`, `Password`, `Total_Rating`, `IsAdmin`) VALUES
(1, 'Nijaz', 'Andelić', '2024-05-29', '+38762942009', 'andelicnijaz@gmail.com', 'napoleonlm10', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_edit_data`
--

CREATE TABLE `user_edit_data` (
  `UEID` int NOT NULL,
  `Date_Edited` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `User_ID` int DEFAULT NULL,
  `Admin_ID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CID`);

--
-- Indexes for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Provider_Service_ID` (`Provider_Service_ID`);

--
-- Indexes for table `liked_service`
--
ALTER TABLE `liked_service`
  ADD PRIMARY KEY (`LSID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Provider_Service_ID` (`Provider_Service_ID`);

--
-- Indexes for table `provider_service`
--
ALTER TABLE `provider_service`
  ADD PRIMARY KEY (`PSID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Service_ID` (`Service_ID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `Category_ID` (`Category_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- Indexes for table `user_edit_data`
--
ALTER TABLE `user_edit_data`
  ADD PRIMARY KEY (`UEID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `collaboration`
--
ALTER TABLE `collaboration`
  MODIFY `CID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `liked_service`
--
ALTER TABLE `liked_service`
  MODIFY `LSID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider_service`
--
ALTER TABLE `provider_service`
  MODIFY `PSID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `SID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_edit_data`
--
ALTER TABLE `user_edit_data`
  MODIFY `UEID` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collaboration`
--
ALTER TABLE `collaboration`
  ADD CONSTRAINT `collaboration_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `collaboration_ibfk_2` FOREIGN KEY (`Provider_Service_ID`) REFERENCES `provider_service` (`PSID`);

--
-- Constraints for table `liked_service`
--
ALTER TABLE `liked_service`
  ADD CONSTRAINT `liked_service_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `liked_service_ibfk_2` FOREIGN KEY (`Provider_Service_ID`) REFERENCES `provider_service` (`PSID`);

--
-- Constraints for table `provider_service`
--
ALTER TABLE `provider_service`
  ADD CONSTRAINT `provider_service_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `provider_service_ibfk_2` FOREIGN KEY (`Service_ID`) REFERENCES `service` (`SID`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`Category_ID`) REFERENCES `category` (`CID`);

--
-- Constraints for table `user_edit_data`
--
ALTER TABLE `user_edit_data`
  ADD CONSTRAINT `user_edit_data_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `user_edit_data_ibfk_2` FOREIGN KEY (`Admin_ID`) REFERENCES `admin` (`AID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
