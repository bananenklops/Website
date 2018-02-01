-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: festbon
-- ------------------------------------------------------
-- Server version	5.7.20-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `m_bestellung_menue`
--

DROP TABLE IF EXISTS `m_bestellung_menue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_bestellung_menue` (
  `id_bestellung` int(11) NOT NULL,
  `id_menue` int(11) NOT NULL,
  `menge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_bestellung_menue`
--

LOCK TABLES `m_bestellung_menue` WRITE;
/*!40000 ALTER TABLE `m_bestellung_menue` DISABLE KEYS */;
INSERT INTO `m_bestellung_menue` VALUES (2,1,NULL);
/*!40000 ALTER TABLE `m_bestellung_menue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_bestellung_produkt`
--

DROP TABLE IF EXISTS `m_bestellung_produkt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_bestellung_produkt` (
  `id_bestellung` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_bestellung_produkt`
--

LOCK TABLES `m_bestellung_produkt` WRITE;
/*!40000 ALTER TABLE `m_bestellung_produkt` DISABLE KEYS */;
INSERT INTO `m_bestellung_produkt` VALUES (1,1,3),(1,2,1);
/*!40000 ALTER TABLE `m_bestellung_produkt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_menue_produkte`
--

DROP TABLE IF EXISTS `m_menue_produkte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_menue_produkte` (
  `id_menue` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_menue_produkte`
--

LOCK TABLES `m_menue_produkte` WRITE;
/*!40000 ALTER TABLE `m_menue_produkte` DISABLE KEYS */;
INSERT INTO `m_menue_produkte` VALUES (1,1,1),(1,2,1);
/*!40000 ALTER TABLE `m_menue_produkte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bestand`
--

DROP TABLE IF EXISTS `t_bestand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bestand` (
  `id_bestand` int(11) NOT NULL AUTO_INCREMENT,
  `name_bestand` varchar(150) CHARACTER SET utf8 NOT NULL,
  `einheit_bestand` enum('Kilogramm','Liter','Stück') NOT NULL,
  `menge_bestand` double NOT NULL,
  PRIMARY KEY (`id_bestand`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bestand`
--

LOCK TABLES `t_bestand` WRITE;
/*!40000 ALTER TABLE `t_bestand` DISABLE KEYS */;
INSERT INTO `t_bestand` VALUES (1,'Hamburger','Stück',1000),(2,'Cola','Stück',1000);
/*!40000 ALTER TABLE `t_bestand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_bestellung`
--

DROP TABLE IF EXISTS `t_bestellung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_bestellung` (
  `id_bestellung` int(11) NOT NULL AUTO_INCREMENT,
  `datum_bestellung` datetime NOT NULL,
  `id_mitarbeiter` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id_bestellung`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bestellung`
--

LOCK TABLES `t_bestellung` WRITE;
/*!40000 ALTER TABLE `t_bestellung` DISABLE KEYS */;
INSERT INTO `t_bestellung` VALUES (1,'2017-12-18 11:22:26',1,1),(2,'2017-12-18 11:22:40',1,1);
/*!40000 ALTER TABLE `t_bestellung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_event`
--

DROP TABLE IF EXISTS `t_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name_event` varchar(100) NOT NULL,
  `ort_event` varchar(100) NOT NULL,
  `datum_event` date NOT NULL,
  `beginn_event` time NOT NULL,
  `ende_event` time NOT NULL,
  `aktiv_event` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_event`
--

LOCK TABLES `t_event` WRITE;
/*!40000 ALTER TABLE `t_event` DISABLE KEYS */;
INSERT INTO `t_event` VALUES (1,'Schützenfest 2018','Alter Sportplatz Obergimpern','2018-04-29','00:00:02','00:00:00',0),(2,'VoFi 2018','Stadthalle Neckarbischofsheim','2018-05-19','00:00:01','00:00:00',0);
/*!40000 ALTER TABLE `t_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_menue`
--

DROP TABLE IF EXISTS `t_menue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_menue` (
  `id_menue` int(11) NOT NULL AUTO_INCREMENT,
  `name_menue` varchar(150) CHARACTER SET utf8 NOT NULL,
  `beschreibung_menue` text NOT NULL,
  `preis_menue` int(11) NOT NULL,
  `datum_menue` datetime NOT NULL,
  `aktiv_menue` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_menue`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_menue`
--

LOCK TABLES `t_menue` WRITE;
/*!40000 ALTER TABLE `t_menue` DISABLE KEYS */;
INSERT INTO `t_menue` VALUES (1,'Menue 1','Hamburger mit Cola',10,'2017-12-18 11:21:06',0);
/*!40000 ALTER TABLE `t_menue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_mitarbeiter`
--

DROP TABLE IF EXISTS `t_mitarbeiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_mitarbeiter` (
  `id_mitarbeiter` int(11) NOT NULL,
  `vorname_mitarbeiter` varchar(45) NOT NULL,
  `nachname_mitarbeiter` varchar(45) NOT NULL,
  `geburtsdatum_mitarbeiter` date NOT NULL,
  `passwort_mitarbeiter` varchar(45) NOT NULL,
  `aktiv_mitarbeiter` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_mitarbeiter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_mitarbeiter`
--

LOCK TABLES `t_mitarbeiter` WRITE;
/*!40000 ALTER TABLE `t_mitarbeiter` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_mitarbeiter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_produkt`
--

DROP TABLE IF EXISTS `t_produkt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_produkt` (
  `id_produkt` int(11) NOT NULL AUTO_INCREMENT,
  `name_produkt` varchar(150) CHARACTER SET utf8 NOT NULL,
  `preis_produkt` int(11) NOT NULL,
  `letztesUpdate_produkt` datetime NOT NULL,
  `id_bestand` int(11) NOT NULL,
  `art_produkt` enum('Essen','Trinken') CHARACTER SET utf8 NOT NULL,
  `portion_produkt` int(11) NOT NULL,
  `aktiv_produkt` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produkt`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_produkt`
--

LOCK TABLES `t_produkt` WRITE;
/*!40000 ALTER TABLE `t_produkt` DISABLE KEYS */;
INSERT INTO `t_produkt` VALUES (1,'Hamburger',399,'2017-12-18 11:15:15',1,'Essen',1,1),(2,'Cola',245,'2017-12-18 11:16:00',2,'Essen',1,1);
/*!40000 ALTER TABLE `t_produkt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-26 21:28:23
