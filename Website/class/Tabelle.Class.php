<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

namespace Datenbank\Tabelle;

use Datenbank\Verbindung;
use Datenbank\Datensatz;
/**
*	Basisklasse
*/
class Tabelle
{
// Eigenschaften
	
	// Protected
	protected $_DB = null;
	protected $_TabellenName = "";
	protected $_Data = null;
	protected $_Columns = null;
	
	// Public
	
// Methoden

	// protected
	private function getAllData()
	{
		$query = "SELECT * FROM ".$this->_TabellenName;
		$result = $this->_DB->executeQuery($query);
		
		foreach ($result as $k => $v) {
			$datensatz = new Datensatz\TabellenItem();
			foreach ($v as $k2 => $v2) {
				$datensatz->$k2 = $v2; 
			}
			$this->_Data[] = $datensatz;
		}
	}
	
	private function setAllData()
	{
		
	}
	
	// Public
	public function __construct($tabelle)
	{
		$this->_TabellenName = $tabelle;
		$this->_Data = array();
		$this->_DB = Verbindung\Datenbank::getInstance();
		$this->getAllData();
	}
	
	public function insertData($data)
	{
		
	}
	
	public function updateData($id, $oldVal, $newVal)
	{
		
	}
	
	public function deleteData($id)
	{
		
	}
	
	public function getData()
	{
		return (is_array($this->_Data) && count($this->_Data) > 0) ? $this->_Data : false;
	}
}