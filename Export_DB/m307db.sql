-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Jul 2021 um 11:52
-- Server-Version: 10.4.19-MariaDB
-- PHP-Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `m307db`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mortgages`
--

CREATE TABLE `mortgages` (
  `mortgageID` int(11) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `repaymentStatus` enum('Repaid','Not Repaid') NOT NULL,
  `FK_riskID` int(11) NOT NULL,
  `FK_packageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `mortgages`
--

INSERT INTO `mortgages` (`mortgageID`, `firstName`, `lastName`, `email`, `phoneNumber`, `startDate`, `repaymentStatus`, `FK_riskID`, `FK_packageID`) VALUES
(1, 'Winston', 'Wolf', 'winston.wolf@gmail.com', '+41 79 302 15 17', '2021-06-30', 'Repaid', 2, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `packages`
--

CREATE TABLE `packages` (
  `packageID` int(11) NOT NULL,
  `packageName` varchar(100) NOT NULL,
  `percentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `packages`
--

INSERT INTO `packages` (`packageID`, `packageName`, `percentage`) VALUES
(1, 'Fest 2', 0.54),
(2, 'Fest 3', 0.54),
(3, 'Fest 4', 0.59),
(4, 'Fest 5', 0.62),
(5, 'Fest 6', 0.75),
(6, 'Fest 7', 0.8),
(7, 'Fest 8', 0.83),
(8, 'Fest 9', 0.86),
(9, 'Fest 10', 0.91),
(10, 'Fest 11', 0.96),
(11, 'Fest 12', 1.02),
(12, 'Fest 13', 1.48),
(13, 'Fest 14', 1.54),
(14, 'Fest 15', 1.4),
(15, 'LIBOR 1M', 0.72),
(16, 'LIBOR 3M', 0.65),
(17, 'LIBOR 6M', 0.65),
(18, 'LIBOR 12M', 0.71),
(19, 'Variabel', 2.25);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `riskranking`
--

CREATE TABLE `riskranking` (
  `riskID` int(11) NOT NULL,
  `riskLevel` varchar(100) NOT NULL,
  `changeRentalDays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `riskranking`
--

INSERT INTO `riskranking` (`riskID`, `riskLevel`, `changeRentalDays`) VALUES
(1, 'sehr tief', 360),
(2, 'tief', 180),
(3, 'normal', 0),
(4, 'hoch', -120),
(5, 'sehr hoch', -240);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `mortgages`
--
ALTER TABLE `mortgages`
  ADD PRIMARY KEY (`mortgageID`),
  ADD KEY `FK_riskID` (`FK_riskID`),
  ADD KEY `FK_packageID` (`FK_packageID`);

--
-- Indizes für die Tabelle `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packageID`);

--
-- Indizes für die Tabelle `riskranking`
--
ALTER TABLE `riskranking`
  ADD PRIMARY KEY (`riskID`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `mortgages`
--
ALTER TABLE `mortgages`
  MODIFY `mortgageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `packages`
--
ALTER TABLE `packages`
  MODIFY `packageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `riskranking`
--
ALTER TABLE `riskranking`
  MODIFY `riskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `mortgages`
--
ALTER TABLE `mortgages`
  ADD CONSTRAINT `mortgages_ibfk_1` FOREIGN KEY (`FK_riskID`) REFERENCES `riskranking` (`riskID`),
  ADD CONSTRAINT `mortgages_ibfk_2` FOREIGN KEY (`FK_packageID`) REFERENCES `packages` (`packageID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
