-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Dez 2017 um 20:59
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `festbon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_bestellung_menue`
--

CREATE TABLE `m_bestellung_menue` (
  `id_bestellung` int(11) NOT NULL,
  `id_menue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_bestellung_menue`
--

INSERT INTO `m_bestellung_menue` (`id_bestellung`, `id_menue`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_bestellung_produkt`
--

CREATE TABLE `m_bestellung_produkt` (
  `id_bestellung` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_bestellung_produkt`
--

INSERT INTO `m_bestellung_produkt` (`id_bestellung`, `id_produkt`, `menge`) VALUES
(1, 1, 3),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_menue`
--

CREATE TABLE `m_menue` (
  `id_menue` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_menue`
--

INSERT INTO `m_menue` (`id_menue`, `id_produkt`, `menge`) VALUES
(1, 1, 1),
(1, 2, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_bestand`
--

CREATE TABLE `t_bestand` (
  `id_bestand` int(11) NOT NULL,
  `name_bestand` varchar(150) CHARACTER SET utf8 NOT NULL,
  `einheit_bestand` enum('Kilogramm','Liter','Stück') NOT NULL,
  `menge_bestand` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `t_bestand`
--

INSERT INTO `t_bestand` (`id_bestand`, `name_bestand`, `einheit_bestand`, `menge_bestand`) VALUES
(1, 'Hamburger', 'Stück', 1000),
(2, 'Cola', 'Stück', 1000);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_bestellung`
--

CREATE TABLE `t_bestellung` (
  `id_bestellung` int(11) NOT NULL,
  `datum_bestellung` datetime NOT NULL,
  `id_mitarbeiter` int(11) NOT NULL,
  `id_event` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `t_bestellung`
--

INSERT INTO `t_bestellung` (`id_bestellung`, `datum_bestellung`, `id_mitarbeiter`, `id_event`) VALUES
(1, '2017-12-18 11:22:26', 1, 1),
(2, '2017-12-18 11:22:40', 1, 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_event`
--

CREATE TABLE `t_event` (
  `id_event` int(11) NOT NULL,
  `name_event` varchar(100) NOT NULL,
  `ort_event` varchar(100) NOT NULL,
  `datum_event` datetime NOT NULL,
  `dauer_event` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `t_event`
--

INSERT INTO `t_event` (`id_event`, `name_event`, `ort_event`, `datum_event`, `dauer_event`) VALUES
(1, 'Schützenfest 2018', 'Alter Sportplatz Obergimpern', '2018-04-29 00:00:00', 2),
(2, 'VoFi 2018', 'Stadthalle Neckarbischofsheim', '2018-05-19 00:00:00', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_menue`
--

CREATE TABLE `t_menue` (
  `id_menue` int(11) NOT NULL,
  `name_menue` varchar(150) CHARACTER SET utf8 NOT NULL,
  `beschreibung_menue` text NOT NULL,
  `preis_menue` int(11) NOT NULL,
  `datum_menue` datetime NOT NULL,
  `aktiv_menue` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `t_menue`
--

INSERT INTO `t_menue` (`id_menue`, `name_menue`, `beschreibung_menue`, `preis_menue`, `datum_menue`, `aktiv_menue`) VALUES
(1, 'Menue 1', 'Hamburger mit Cola', 10, '2017-12-18 11:21:06', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_produkt`
--

CREATE TABLE `t_produkt` (
  `id_produkt` int(11) NOT NULL,
  `name_produkt` varchar(150) CHARACTER SET utf8 NOT NULL,
  `preis_produkt` int(11) NOT NULL,
  `letztesUpdate_produkt` datetime NOT NULL,
  `id_bestand` int(11) NOT NULL,
  `art_produkt` enum('Essen','Trinken') CHARACTER SET utf8 NOT NULL,
  `portion_produkt` int(11) NOT NULL,
  `aktiv_produkt` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `t_produkt`
--

INSERT INTO `t_produkt` (`id_produkt`, `name_produkt`, `preis_produkt`, `letztesUpdate_produkt`, `id_bestand`, `art_produkt`, `portion_produkt`, `aktiv_produkt`) VALUES
(1, 'Hamburger', 399, '2017-12-18 11:15:15', 1, 'Essen', 1, 1),
(2, 'Cola', 245, '2017-12-18 11:16:00', 2, 'Essen', 1, 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `t_bestand`
--
ALTER TABLE `t_bestand`
  ADD PRIMARY KEY (`id_bestand`);

--
-- Indizes für die Tabelle `t_bestellung`
--
ALTER TABLE `t_bestellung`
  ADD PRIMARY KEY (`id_bestellung`);

--
-- Indizes für die Tabelle `t_event`
--
ALTER TABLE `t_event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indizes für die Tabelle `t_menue`
--
ALTER TABLE `t_menue`
  ADD PRIMARY KEY (`id_menue`);

--
-- Indizes für die Tabelle `t_produkt`
--
ALTER TABLE `t_produkt`
  ADD PRIMARY KEY (`id_produkt`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `t_bestand`
--
ALTER TABLE `t_bestand`
  MODIFY `id_bestand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `t_bestellung`
--
ALTER TABLE `t_bestellung`
  MODIFY `id_bestellung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `t_event`
--
ALTER TABLE `t_event`
  MODIFY `id_event` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `t_menue`
--
ALTER TABLE `t_menue`
  MODIFY `id_menue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `t_produkt`
--
ALTER TABLE `t_produkt`
  MODIFY `id_produkt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
