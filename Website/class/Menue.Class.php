<?php
/*
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

/**
*	Klasse für die Tabelle Menü
*/
class Menue extends Tabelle
{
// Eigenschaften
	
	// Private
	
	
	// Public
	
// Methoden

	// protected
	

	// Public
	public function __construct()
	{
		$this->_Data = array();
		$this->_DB = Datenbank::getInstance();
		$this->getAllData();
	}
}