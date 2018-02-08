<?php
/**
 * Created by PhpStorm.
 * User: tobias.kessler
 * Date: 08.02.2018
 * Time: 08:36
 */
require_once "autoloader.php";
use Model\Data\Database;
$config = Database::getConfig('database');

if ($config == null || !is_array($config))
    die ('Bitte Datenbank in der config.ini einrichten!');
echo "<p>Config erfolgreich geladen</p>\n";

$user = $config['user'];
$pass = $config['pass'];
$host = $config['host'];
$schema = $config['database'];

if (!($DB = mysqli_connect($host, $user, $pass)))
    die ('Verbindung zur Datenbank konnte nicht hergestellt werden!');
echo "<p>Datenbankverbindung erfolgreich hergestellt</p>\n";

$query = "";

if (!$DB->select_db('festbon')) {
    $query = "CREATE DATABASE festbon;";
    $DB->query($query);
    if ($DB->error == "") {
        if (!$DB->select_db('festbon')) {
            die ('Datenbank festbon konnte nicht erstellt werden');
        } else {
            echo "<p>Datenbank festbon wurde angelegt, da noch nicht vorhanden.</p>\n";
        }
    }
}

$error = "";

$query = "CREATE TABLE IF NOT EXISTS `m_bestellung_menue` (
  `id_bestellung` int(11) NOT NULL,
  `id_menue` int(11) NOT NULL,
  `menge` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von m_bestellung_menue: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `m_bestellung_produkt` (
  `id_bestellung` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von m_bestellung_produkt: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `m_menue_produkte` (
  `id_menue` int(11) NOT NULL,
  `id_produkt` int(11) NOT NULL,
  `menge` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von m_menue_produkte: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_bestand` (
  `id_bestand` int(11) NOT NULL AUTO_INCREMENT,
  `name_bestand` varchar(150) CHARACTER SET utf8 NOT NULL,
  `einheit_bestand` enum('Kilogramm','Liter','Stück') NOT NULL,
  `menge_bestand` double NOT NULL,
  PRIMARY KEY (`id_bestand`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_bestand: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_bestellung` (
  `id_bestellung` int(11) NOT NULL AUTO_INCREMENT,
  `datum_bestellung` datetime NOT NULL,
  `id_mitarbeiter` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  PRIMARY KEY (`id_bestellung`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_bestellung: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_event` (
  `id_event` int(11) NOT NULL AUTO_INCREMENT,
  `name_event` varchar(100) NOT NULL,
  `ort_event` varchar(100) NOT NULL,
  `datum_event` date NOT NULL,
  `beginn_event` time NOT NULL,
  `ende_event` time NOT NULL,
  `aktiv_event` tinyint(4) NOT NULL,
  `maxBestellung_event` int(11) NOT NULL,
  PRIMARY KEY (`id_event`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_event: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_menue` (
  `id_menue` int(11) NOT NULL AUTO_INCREMENT,
  `name_menue` varchar(150) CHARACTER SET utf8 NOT NULL,
  `beschreibung_menue` text NOT NULL,
  `preis_menue` int(11) NOT NULL,
  `datum_menue` datetime NOT NULL,
  `aktiv_menue` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_menue`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_menue: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_mitarbeiter` (
  `id_mitarbeiter` int(11) NOT NULL AUTO_INCREMENT,
  `vorname_mitarbeiter` varchar(45) NOT NULL,
  `nachname_mitarbeiter` varchar(45) NOT NULL,
  `geburtsdatum_mitarbeiter` date NOT NULL,
  `passwort_mitarbeiter` varchar(45) NOT NULL,
  `aktiv_mitarbeiter` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_mitarbeiter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_mitarbeiter: ".$DB->error."</p>\n";

$query = "CREATE TABLE IF NOT EXISTS `t_produkt` (
  `id_produkt` int(11) NOT NULL AUTO_INCREMENT,
  `name_produkt` varchar(150) CHARACTER SET utf8 NOT NULL,
  `preis_produkt` int(11) NOT NULL,
  `letztesUpdate_produkt` datetime NOT NULL,
  `id_bestand` int(11) NOT NULL,
  `art_produkt` enum('Essen','Trinken') CHARACTER SET utf8 NOT NULL,
  `portion_produkt` int(11) NOT NULL,
  `aktiv_produkt` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_produkt`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
$DB->query($query);
if ($DB->error != "")
    $error .= "<p>Fehler beim Erstellen von t_produkt: ".$DB->error."</p>\n";

if ($error == "")
    echo "<h1>Datenbank erfolgreich eingerichtet!</h1>\n";
else
    echo "<h1>Fehler beim Erstellen der Datenbank: </h1>\n";

echo $error;