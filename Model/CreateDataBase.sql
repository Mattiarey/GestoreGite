-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 08, 2024 alle 21:42
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gite`
--
CREATE DATABASE IF NOT EXISTS `gite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gite`;

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

DROP TABLE IF EXISTS `commenti`;
CREATE TABLE `commenti` (
  `id` int(11) NOT NULL,
  `titolo` varchar(60) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `valutazione` float DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `fkUtenti` int(11) DEFAULT NULL,
  `fkMete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `gita`
--

DROP TABLE IF EXISTS `gita`;
CREATE TABLE `gita` (
  `id` int(11) NOT NULL,
  `fkUtenti` int(11) DEFAULT NULL,
  `fkMete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `gita`
--

INSERT INTO `gita` (`id`, `fkUtenti`, `fkMete`) VALUES
(1, 56, 1),
(2, 56, 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `mete`
--

DROP TABLE IF EXISTS `mete`;
CREATE TABLE `mete` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `costo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `mete`
--

INSERT INTO `mete` (`id`, `nome`, `descrizione`, `data`, `costo`) VALUES
(1, 'Pizzo Calabro', 'Un bellissimo posto in Calabria', '2003-02-24', 25),
(2, 'Pizzo Calabro', 'Un bellissimo posto in Calabria', '2003-02-24', 25);

-- --------------------------------------------------------

--
-- Struttura della tabella `possonovedere`
--

DROP TABLE IF EXISTS `possonovedere`;
CREATE TABLE `possonovedere` (
  `id` int(11) NOT NULL,
  `fkUtente` int(11) NOT NULL,
  `fkGita` int(11) NOT NULL,
  `fkTour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `possonovedere`
--

INSERT INTO `possonovedere` (`id`, `fkUtente`, `fkGita`, `fkTour`) VALUES
(2, 56, 1, 1),
(3, 63, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `tour`
--

DROP TABLE IF EXISTS `tour`;
CREATE TABLE `tour` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `durata` int(11) DEFAULT NULL,
  `costo` float DEFAULT NULL,
  `fkMeta` int(11) DEFAULT NULL,
  `maxPart` int(11) NOT NULL,
  `partAttuali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `tour`
--

INSERT INTO `tour` (`id`, `nome`, `descrizione`, `durata`, `costo`, `fkMeta`, `maxPart`, `partAttuali`) VALUES
(1, 'Tour della caccca', 'c\'è la cacca', 5, 73, 1, 10, 1),
(3, 'Tour del 39', 'Don\'t you hear my call, don\'t you hear me calling you', 39, 25198500, 1, 0, 0),
(4, 'Sono invisibile', 'Questo tour non si deve vedere, scemo', 23, 312312, 2, 0, 0),
(5, 'Sono invisibile', 'Questo tour non si deve vedere, scemo', 23, 312312, 2, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

DROP TABLE IF EXISTS `utenti`;
CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`id`, `nome`, `cognome`, `email`, `password`, `isAdmin`) VALUES
(56, 'Gino', 'Carlo', 'ginoCarlo@virgilio.it', '1234', 1),
(62, 'Giacomo', 'Rossi', 'mail@gmail.com', '123', 0),
(63, 'caccamo', 'Eros', '231@gasd.cm', '123213', 0),
(64, 'Cristian', 'Preutesi', 'protesi@mail.org', '123', 0),
(65, 'andrea', 'bianchi', 'sonoscemo3@mail.com', '123', 0),
(66, 'Andrea', 'Rocci', 'roccicacca@mail.com', '123', 0),
(67, 'eros', 'caccamo', 'mail@mail.com', '123', 0),
(68, 'bubu', 'settete', '123@123.123', '123', 0),
(69, 'Emanuele', 'Pighi', 'ep@mail.com', '123', 0),
(70, 'Cacate', 'Chiappe', 'chiappacacata1@mail.com', '123', 0),
(87, 'dasda', 'asdasd', 'dasdas@asd.cas', '112e', 0),
(88, 'Utente', 'Prova', 'up@dwn.com', '123', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `commenti`
--
ALTER TABLE `commenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkUtenti` (`fkUtenti`),
  ADD KEY `fkMete` (`fkMete`);

--
-- Indici per le tabelle `gita`
--
ALTER TABLE `gita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkUtenti` (`fkUtenti`),
  ADD KEY `fkMete` (`fkMete`);

--
-- Indici per le tabelle `mete`
--
ALTER TABLE `mete`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `possonovedere`
--
ALTER TABLE `possonovedere`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkMeta` (`fkMeta`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `commenti`
--
ALTER TABLE `commenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `gita`
--
ALTER TABLE `gita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `mete`
--
ALTER TABLE `mete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `possonovedere`
--
ALTER TABLE `possonovedere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `commenti`
--
ALTER TABLE `commenti`
  ADD CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`fkUtenti`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`fkMete`) REFERENCES `mete` (`id`);

--
-- Limiti per la tabella `gita`
--
ALTER TABLE `gita`
  ADD CONSTRAINT `gita_ibfk_1` FOREIGN KEY (`fkUtenti`) REFERENCES `utenti` (`id`),
  ADD CONSTRAINT `gita_ibfk_2` FOREIGN KEY (`fkMete`) REFERENCES `mete` (`id`);

--
-- Limiti per la tabella `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `tour_ibfk_1` FOREIGN KEY (`fkMeta`) REFERENCES `mete` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
