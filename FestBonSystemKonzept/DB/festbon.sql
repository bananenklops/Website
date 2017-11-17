-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. November 2017 um 10:07
-- Server Version: 5.5.8
-- PHP-Version: 5.3.5

CREATE DATABASE `festbon`;
USE `festbon`;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `festbon`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_bestellung_essen`
--

CREATE TABLE IF NOT EXISTS `m_bestellung_essen` (
  `id_bestellung` int(11) NOT NULL,
  `id_essen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_bestellung_essen`
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


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_bestellung_trinken`
--

CREATE TABLE IF NOT EXISTS `m_bestellung_trinken` (
  `id_bestellung` int(11) NOT NULL,
  `id_trinken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_bestellung_trinken`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_menue_essen`
--

CREATE TABLE IF NOT EXISTS `m_menue_essen` (
  `id_menue` int(11) NOT NULL,
  `id_essen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_menue_essen`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `m_menue_trinken`
--

CREATE TABLE IF NOT EXISTS `m_menue_trinken` (
  `id_menue` int(11) NOT NULL,
  `id_trinken` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `m_menue_trinken`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `t_bestand`
--


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `t_bestellung`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_essen`
--

CREATE TABLE IF NOT EXISTS `t_essen` (
  `id_essen` int(11) NOT NULL AUTO_INCREMENT,
  `name_essen` varchar(150) NOT NULL,
  `preis_essen` int(11) NOT NULL,
  `datum_essen` datetime NOT NULL,
  `portion_essen` int(11) NOT NULL,
  `id_bestand` int(11) NOT NULL,
  PRIMARY KEY (`id_essen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `t_essen`
--


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
  `id_menue` int(11) NOT NULL,
  `name_menue` varchar(150) CHARACTER SET utf8 NOT NULL,
  `beschreibung_menue` text NOT NULL,
  `rabatt_menue` double NOT NULL,
  `datum_menue` datetime NOT NULL,
  PRIMARY KEY (`id_menue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `t_menue`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `t_trinken`
--

CREATE TABLE IF NOT EXISTS `t_trinken` (
  `id_trinken` int(11) NOT NULL,
  `name_trinken` int(11) NOT NULL,
  `preis_trinken` int(11) NOT NULL,
  `datum_trinken` datetime NOT NULL,
  `id_bestand` int(11) NOT NULL,
  `portion_trinken` double NOT NULL,
  PRIMARY KEY (`id_trinken`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `t_trinken`
--

