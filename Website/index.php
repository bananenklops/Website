<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

require_once 'autoloader.php';

$test = new Tabelle('t_menue');
$data = $test->getData();

if ($data) {
	foreach($data as $key => $value){
		foreach ($value->getColumns() as $column => $irgendwas) {
			echo $column . ": " . $irgendwas . " | ";
		}
		echo "<br />";
	}
}
