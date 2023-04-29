-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2023 at 11:00 AM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsenal`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'Administrator', 'admin@gmail.com', 'admin', 'f925916e2754e5e03f75dd58a5733251', '2023-04-28 07:13:52'),
(6, 'JakubMazur', 'admin', 'Mazur', '978141547d81a7547daf4b9f496b4695', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `issuedgundetails`
--

CREATE TABLE `issuedgundetails` (
  `id` int(11) NOT NULL,
  `GunId` int(11) DEFAULT NULL,
  `ClientID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT current_timestamp(),
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `RetrunStatus` int(1) DEFAULT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `issuedgundetails`
--

INSERT INTO `issuedgundetails` (`id`, `GunId`, `ClientID`, `IssuesDate`, `ReturnDate`, `RetrunStatus`, `fine`) VALUES
(13, 1, 'SID009', '2023-04-28 11:52:50', NULL, NULL, NULL),
(14, 3, 'CID013', '2023-04-28 13:56:22', '2023-04-28 13:56:28', 1, 15),
(15, 8, 'CID013', '2023-04-29 07:29:35', NULL, NULL, NULL),
(16, 22, 'CID015', '2023-04-29 08:54:10', '2023-04-29 08:58:32', 1, 10),
(17, 25, 'CID016', '2023-04-29 08:54:58', NULL, NULL, NULL),
(18, 19, 'CID016', '2023-04-29 08:55:12', NULL, NULL, NULL),
(19, 24, 'CID018', '2023-04-29 08:57:52', NULL, NULL, NULL),
(20, 31, 'CID018', '2023-04-29 08:58:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(1, 'Rifle', 1, '2023-04-28 08:58:35', '2023-04-28 13:10:06'),
(2, 'Sidearm', 1, '2023-04-28 09:13:20', '2023-04-28 09:13:20'),
(3, 'Shotgun', 1, '2023-04-28 09:13:29', '2023-04-28 09:13:29'),
(4, 'DMR', 1, '2023-04-28 09:13:39', '2023-04-28 09:13:39'),
(5, 'Bolt Action', 1, '2023-04-28 09:13:52', '2023-04-28 09:13:52'),
(6, 'LMG', 1, '2023-04-28 09:14:00', '2023-04-28 09:14:00'),
(7, 'SMG', 1, '2023-04-28 09:17:42', '2023-04-28 09:17:42'),
(8, 'Bow & XBow', 1, '2023-04-28 09:18:46', '2023-04-28 09:18:46'),
(9, 'Melee', 0, '2023-04-28 09:19:11', '2023-04-28 13:09:39'),
(10, 'Body Armor', 1, '2023-04-28 09:22:36', '2023-04-28 09:22:36');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tblclients`
--

CREATE TABLE `tblclients` (
  `id` int(11) NOT NULL,
  `ClientId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblclients`
--

INSERT INTO `tblclients` (`id`, `ClientId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(8, 'CID009', 'test', 'test@gmail.com', '2359874527', 'f925916e2754e5e03f75dd58a5733251', 1, '2022-01-10 07:23:03', '2023-04-29 08:51:56'),
(13, 'CID013', 'Jakub Mazur', 'jakub.mazur455@gmail.com', '664844309', '978141547d81a7547daf4b9f496b4695', 1, '2023-04-10 13:25:12', NULL),
(14, 'CID015', 'User1', 'user1@gmail.com', '111222333', '6b908b785fdba05a6446347dae08d8c5', 1, '2023-04-12 08:49:14', NULL),
(15, 'CID016', 'User2', 'user2@gmail.com', '222333444', 'a09bccf2b2963982b34dc0e08d8b582a', 1, '2023-04-13 08:49:33', '2023-04-26 08:52:27'),
(16, 'CID017', 'User3', 'user3@gmal.com', '333444555', 'e5d2ad241ec44cf155bc78ae8d11f715', 1, '2023-04-25 08:49:58', '2023-04-29 08:52:48'),
(17, 'CID018', 'Tomasz Piekarz', 'ponure.maciwody@forge.com', '666289434', '229803e38bc6559679bfd89524550353', 1, '2023-04-29 08:51:05', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tblguns`
--

CREATE TABLE `tblguns` (
  `id` int(11) NOT NULL,
  `GunName` varchar(255) DEFAULT NULL,
  `CatId` int(11) DEFAULT NULL,
  `ManufacturerId` int(11) DEFAULT NULL,
  `SerialNumber` varchar(25) DEFAULT NULL,
  `GunPrice` decimal(10,2) DEFAULT NULL,
  `GunImage` varchar(250) NOT NULL,
  `isIssued` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblguns`
--

INSERT INTO `tblguns` (`id`, `GunName`, `CatId`, `ManufacturerId`, `SerialNumber`, `GunPrice`, `GunImage`, `isIssued`, `RegDate`, `UpdationDate`) VALUES
(1, 'AR-15', 1, 1, '123321#xd', 300.00, 'd6a76b395ed2d563e3ff5bbaac32b88a.jpg', 1, '2023-04-28 09:08:07', '2023-04-28 11:52:50'),
(2, 'AK-12', 1, 7, 'kqS7SERk', 300.00, '91aa6bda3172f500220bddd6aff28a1f.png', NULL, '2023-04-28 12:44:30', NULL),
(3, 'AK - 74', 1, 7, 'Mddcvyd3', 300.00, '08efd99c699b5f088d62d3e05600c0f6.png', 0, '2023-04-28 12:45:51', '2023-04-28 13:56:28'),
(4, '828 Shotgun', 3, 9, 'guQcJdYr', 249.00, 'f0d8e8a06ec4f393d894d9ec0e269e32.png', NULL, '2023-04-28 12:47:37', '2023-04-28 13:08:57'),
(5, 'M4', 3, 9, 'B4MyMQDe', 250.00, '315a290b8980104d04a95e16a3430621.png', NULL, '2023-04-28 12:48:30', NULL),
(6, 'Colt 1851', 2, 1, 'QPBVy2jW', 150.00, '96788171de5f14921f40aa68a579a254.png', NULL, '2023-04-28 12:49:30', NULL),
(7, 'M1911', 2, 1, 'PVApTsx7', 175.00, 'a4a8444d70d2b643fb6ae589cf7dae20.png', NULL, '2023-04-28 12:51:08', NULL),
(8, 'M200 Intervention', 5, 8, 'x3k43boD', 700.00, 'cc2e5cf5e03e29493c51c2ed25145895.png', 1, '2023-04-28 12:52:18', '2023-04-29 07:29:35'),
(9, 'M408', 5, 8, 'gqrYwauS', 750.00, '00dc021a538e147f8cda2357866a4390.png', NULL, '2023-04-28 12:53:03', NULL),
(10, 'CZ - 75B', 2, 2, 'mpqsjDev', 150.00, '9d3ef8b3b621639ce51e7d42fbdddc97.png', NULL, '2023-04-28 12:53:45', NULL),
(11, 'CZ - Bren', 1, 2, 'jAUjpDUc', 300.00, '04cf3fa9d69586ba053d674ea21e4dab.png', NULL, '2023-04-28 12:54:37', NULL),
(12, 'FN DMR3', 4, 10, 'YGPMTQUc', 450.00, '60245cde8a05985a21ddcd781f6c5766.png', NULL, '2023-04-28 12:55:49', NULL),
(13, 'M249', 6, 10, '7p7x8eKp', 500.00, '1dd8b324da574916f8d38b79de189cfc.png', NULL, '2023-04-28 12:56:13', NULL),
(14, 'M249S PARA', 6, 10, 'X2WfxtdV', 450.00, '1ca0f04b7a3426d6a22b64bd3a69b99c.png', NULL, '2023-04-28 12:58:58', NULL),
(15, 'P90', 7, 10, '8372ZT2z', 250.00, '7b83fcb434672586770f54c0da4114ad.png', NULL, '2023-04-28 12:59:28', NULL),
(16, 'SCAR - H', 1, 10, '5fT54JsU', 300.00, '2be158639b2200cb475c05b1b4918008.png', NULL, '2023-04-28 12:59:56', NULL),
(17, 'G17_Gen3', 2, 6, '2W53eu4s', 200.00, 'f063fc388a978ed2863940d4f109da97.png', NULL, '2023-04-28 13:00:46', NULL),
(18, 'G18c', 2, 6, '9BgFfSCy', 200.00, '78e99141914ba3817a13850ddb8e6293.png', NULL, '2023-04-28 13:01:11', NULL),
(19, 'G20', 2, 6, 'DWdsscty', 200.00, '4d8c4d758e2536d5b289d59c7d4f9218.png', 1, '2023-04-28 13:01:40', '2023-04-29 08:55:12'),
(20, 'Helikon Multigun Rig', 10, 15, 'sLKjonGP', 100.00, '0d3e82719c45d0219df4d07eddaf9928.jpg', NULL, '2023-04-28 13:02:53', NULL),
(21, 'Hoyt Cw', 8, 13, 'QrnDuf7y', 100.00, '729e112fcb0573e6cfd1aa8aa9708d07.png', NULL, '2023-04-28 13:03:34', NULL),
(22, 'Hoyt RX7', 8, 13, 'KNbmKSoG', 100.00, '13737b8bc0b11899c0ea4cc9f180b2b6.png', 0, '2023-04-28 13:04:00', '2023-04-29 08:58:32'),
(23, 'MFH USMC Black', 10, 16, 'FGieXBmd', 50.00, 'c86ed7c9efcd48c122e99faf9da683f9.jpg', NULL, '2023-04-28 13:04:38', NULL),
(24, 'Mil-Tec Black Vest', 10, 14, 'JcN5A9Ay', 80.00, '329903dd894547c7c17f8b53e65d36c1.jpg', 1, '2023-04-28 13:05:12', '2023-04-29 08:57:52'),
(25, 'Milt-Tec Vest Olive', 10, 14, 'MhXW6eSp', 120.00, '62e04a1f271fffc54772eb37be111d44.jpg', 1, '2023-04-28 13:05:42', '2023-04-29 08:54:58'),
(26, 'Mossberg 500', 3, 4, 'XbznM7La', 499.00, 'd0bdaa60295fb084c5442efec9512fd9.png', NULL, '2023-04-28 13:06:34', NULL),
(27, 'Mossberg Maveric', 3, 4, 'GPbDS5jX', 299.00, 'adb665e1f6155a4c4148a1259b7bc28e.png', NULL, '2023-04-28 13:07:08', NULL),
(28, 'MPX', 7, 3, 'YhEDh29H', 399.00, 'e886660dfd4ea0a37a6703355cb52369.png', NULL, '2023-04-28 13:07:39', NULL),
(29, 'MCX', 4, 3, '8AuD73P2', 599.00, 'c0268c358a05cc204d2f29bb8e698021.png', NULL, '2023-04-28 13:08:04', NULL),
(30, 'AUG', 1, 5, 'NepKVJHJ', 389.00, '877e9305d3105b434b0141dd4780d2a1.png', NULL, '2023-04-28 13:10:53', NULL),
(31, 'SSG-09', 5, 5, '7uUR55cz', 599.00, 'b14bc772aee266fb811c548ae6ebadba.png', 1, '2023-04-28 13:11:23', '2023-04-29 08:58:17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tblmanufacturer`
--

CREATE TABLE `tblmanufacturer` (
  `id` int(11) NOT NULL,
  `ManufacturerName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblmanufacturer`
--

INSERT INTO `tblmanufacturer` (`id`, `ManufacturerName`, `creationDate`, `UpdationDate`) VALUES
(1, 'Colt', '2023-04-28 08:58:25', NULL),
(2, 'Ceska Zbrojovka', '2023-04-28 09:23:03', NULL),
(3, 'Sig Sauer', '2023-04-28 09:23:27', NULL),
(4, 'Mossberg', '2023-04-28 09:23:34', NULL),
(5, 'Steyr', '2023-04-28 09:23:41', NULL),
(6, 'Glock GMBH', '2023-04-28 09:23:50', NULL),
(7, 'Kalashnikov Concern', '2023-04-28 09:27:25', NULL),
(8, 'CheyTac', '2023-04-28 09:27:58', NULL),
(9, 'Banelli', '2023-04-28 09:28:16', NULL),
(10, 'FN Manufacturing LLC', '2023-04-28 09:28:55', NULL),
(12, 'BowTech', '2023-04-28 11:45:13', NULL),
(13, 'Hoyt', '2023-04-28 11:45:26', NULL),
(14, 'MilTec', '2023-04-28 11:46:15', NULL),
(15, 'Helikon', '2023-04-28 11:46:25', NULL),
(16, 'MFH', '2023-04-28 11:46:38', NULL);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `issuedgundetails`
--
ALTER TABLE `issuedgundetails`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tblclients`
--
ALTER TABLE `tblclients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`ClientId`);

--
-- Indeksy dla tabeli `tblguns`
--
ALTER TABLE `tblguns`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `tblmanufacturer`
--
ALTER TABLE `tblmanufacturer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issuedgundetails`
--
ALTER TABLE `issuedgundetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblclients`
--
ALTER TABLE `tblclients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tblguns`
--
ALTER TABLE `tblguns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tblmanufacturer`
--
ALTER TABLE `tblmanufacturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
