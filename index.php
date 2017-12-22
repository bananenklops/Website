<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

require __DIR__."/autoloader.php";

$printer = new Controller\Printer\Drucker("10.12.1.246", 9100);
$printer->center();
$printer->printBig("Jäger und Förster EV.");
$printer->printText("Schützenfest");
$printer->feed();
$printer->printEmphasis("Rechnung");
$printer->feed(4);