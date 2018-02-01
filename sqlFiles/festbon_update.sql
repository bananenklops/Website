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
INSERT INTO `m_bestellung_menue` VALUES (1,1,NULL);
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
  `menge` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_bestellung_produkt`
--

LOCK TABLES `m_bestellung_produkt` WRITE;
/*!40000 ALTER TABLE `m_bestellung_produkt` DISABLE KEYS */;
INSERT INTO `m_bestellung_produkt` VALUES (1,1,NULL),(1,1,NULL);
/*!40000 ALTER TABLE `m_bestellung_produkt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `m_menue_produkt`
--

DROP TABLE IF EXISTS `m_menue_produkt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `m_menue_produkt` (
  `id_menue` int(11) NOT NULL,
  `id_essen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `m_menue_produkt`
--

LOCK TABLES `m_menue_produkt` WRITE;
/*!40000 ALTER TABLE `m_menue_produkt` DISABLE KEYS */;
INSERT INTO `m_menue_produkt` VALUES (1,2),(2,2);
/*!40000 ALTER TABLE `m_menue_produkt` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_bestellung`
--

LOCK TABLES `t_bestellung` WRITE;
/*!40000 ALTER TABLE `t_bestellung` DISABLE KEYS */;
INSERT INTO `t_bestellung` VALUES (1,'2017-06-07 12:00:00',5,2),(2,'0001-01-01 12:00:00',2,6),(3,'0001-01-01 12:00:00',5,3);
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
  `datum_event` date DEFAULT NULL,
  `startzeit_event` time NOT NULL,
  `endezeit_event` time NOT NULL,
  `aktiv_event` tinyint(4) DEFAULT NULL,
  `maxBestellungEssen_event` int(11) DEFAULT NULL,
  `maxBestellungTrinken_event` int(11) DEFAULT NULL,
  `maxBestellungMenue_event` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_event`
--

LOCK TABLES `t_event` WRITE;
/*!40000 ALTER TABLE `t_event` DISABLE KEYS */;
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
  `erstellungsdatum_menue` datetime NOT NULL,
  `aktiv_menue` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_menue`),
  UNIQUE KEY `id_menue_UNIQUE` (`id_menue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_menue`
--

LOCK TABLES `t_menue` WRITE;
/*!40000 ALTER TABLE `t_menue` DISABLE KEYS */;
INSERT INTO `t_menue` VALUES (1,'Pommes + Cola','große Pommes und große Cola',15,'2017-06-06 00:00:00',NULL),(2,'Pommes + Bier','große Pommes und Bier',15,'2017-06-06 00:00:00',NULL);
/*!40000 ALTER TABLE `t_menue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_mitarbeiter`
--

DROP TABLE IF EXISTS `t_mitarbeiter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_mitarbeiter` (
  `id_mitarbeiter` int(11) NOT NULL AUTO_INCREMENT,
  `vorname_mitarbeiter` varchar(45) DEFAULT NULL,
  `nachname_mitarbeiter` varchar(45) DEFAULT NULL,
  `geburtsdatum_mitarbeiter` date DEFAULT NULL,
  `passwort_mitarbeiter` varchar(45) DEFAULT NULL,
  `aktiv_mitarbeiter` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_mitarbeiter`),
  UNIQUE KEY `id_mitarbeiter_UNIQUE` (`id_mitarbeiter`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_mitarbeiter`
--

LOCK TABLES `t_mitarbeiter` WRITE;
/*!40000 ALTER TABLE `t_mitarbeiter` DISABLE KEYS */;
INSERT INTO `t_mitarbeiter` VALUES (2,'Angela','Merkel',NULL,NULL,NULL),(3,'Hoyer','Christian','0001-01-01',NULL,NULL);
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
  `name_produkt` varchar(150) DEFAULT NULL,
  `preis_produkt` int(11) DEFAULT NULL,
  `groesse_produkt` int(11) DEFAULT NULL,
  `menge_produkt` int(11) DEFAULT NULL,
  `art_produkt` enum('Essen','Trinken') DEFAULT NULL,
  `erstellungsdatum_produkt` date DEFAULT NULL,
  `aktiv_produkt` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_produkt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_produkt`
--

LOCK TABLES `t_produkt` WRITE;
/*!40000 ALTER TABLE `t_produkt` DISABLE KEYS */;
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

-- Dump completed on 2017-12-26 14:42:34
