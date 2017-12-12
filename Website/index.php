<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

require_once 'autoloader.php';

$test = Model\Daten\Tabelle\Tabelle::getTable('Bestellung');

$item = new Model\Daten\Item\BestellungItem();
$item->setData(array(
	ID_BESTELLUNG => null,
	DATUM_BESTELLUNG => time(),
	ID_MITARBEITER => 1,
	ID_EVENT => 1
));

$test->createEntry($item);