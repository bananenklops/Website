-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 18. Dezember 2017 um 12:38
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE DATABASE festbon;
USE festbon;

--
-- Datenbank: `festbon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_bestellung_menue`
--

CREATE TABLE IF NOT EXISTS `m_bestellung_menue` (
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

CREATE TABLE IF NOT EXISTS `m_bestellung_produkt` (
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

CREATE TABLE IF NOT EXISTS `m_menue` (
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

CREATE TABLE IF NOT EXISTS `t_bestand` (
  `id_bestand` int(11) NOT NULL AUTO_INCREMENT,
  `name_bestand` varchar(150) CHARACTER SET utf8 NOT NULL,
  `einheit_bestand` enum('Kilogramm','Liter','Stück') NOT NULL,
  `menge_bestand` double NOT NULL,
  PRIMARY KEY (`id_bestand`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `t_bestellung` (
  `id_bestellung` int(11) NOT NULL AUTO_INCREMENT,
  `datum_bestellung` datetime NOT NULL,
  `id_mitarbeiter` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id_bestellung`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `t_event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name_event` varchar(100) NOT NULL,
  `ort_event` varchar(100) NOT NULL,
  `datum_event` datetime NOT NULL,
  `dauer_event` int(10) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `t_event`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_menue`
--

CREATE TABLE IF NOT EXISTS `t_menue` (
  `id_menue` int(11) NOT NULL AUTO_INCREMENT,
  `name_menue` varchar(150) CHARACTER SET utf8 NOT NULL,
  `beschreibung_menue` text NOT NULL,
  `rabatt_menue` double NOT NULL,
  `datum_menue` datetime NOT NULL,
  PRIMARY KEY (`id_menue`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `t_menue`
--

INSERT INTO `t_menue` (`id_menue`, `name_menue`, `beschreibung_menue`, `rabatt_menue`, `datum_menue`) VALUES
(1, 'Menue 1', 'Hamburger mit Cola', 10, '2017-12-18 11:21:06');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_produkt`
--

CREATE TABLE IF NOT EXISTS `t_produkt` (
  `id_produkt` int(11) NOT NULL AUTO_INCREMENT,
  `name_produkt` varchar(150) CHARACTER SET utf8 NOT NULL,
  `preis_produkt` int(11) NOT NULL,
  `letztesUpdate_produkt` datetime NOT NULL,
  `id_bestand` int(11) NOT NULL,
  `portion_produkt` int(11) NOT NULL,
  `aktiv_produkt` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produkt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `t_produkt`
--

INSERT INTO `t_produkt` (`id_produkt`, `name_produkt`, `preis_produkt`, `letztesUpdate_produkt`, `id_bestand`, `portion_produkt`, `aktiv_produkt`) VALUES
(1, 'Hamburger', 399, '2017-12-18 11:15:15', 1, 1, 1),
(2, 'Cola', 245, '2017-12-18 11:16:00', 2, 1, 1);
