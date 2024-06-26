-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 16, 2024 alle 19:12
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `gite`
--
CREATE DATABASE IF NOT EXISTS `gite` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gite`;

-- --------------------------------------------------------

--
-- Struttura della tabella `commenti`
--

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

CREATE TABLE `gita` (
  `id` int(11) NOT NULL,
  `fkUtenti` int(11) DEFAULT NULL,
  `fkMete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `mete`
--

CREATE TABLE `mete` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `costo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `possonovedere`
--

CREATE TABLE `possonovedere` (
  `id` int(11) NOT NULL,
  `fkUtente` int(11) NOT NULL,
  `fkGita` int(11) NOT NULL,
  `fkTour` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tour`
--

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

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) DEFAULT NULL,
  `cognome` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `mete`
--
ALTER TABLE `mete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `possonovedere`
--
ALTER TABLE `possonovedere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `tour`
--
ALTER TABLE `tour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
