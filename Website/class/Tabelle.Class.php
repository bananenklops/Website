<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

/**
*	Basisklasse
*/
class Tabelle
{
// Eigenschaften
	
	// Protected
	private $_DB = null;
	private $_TabellenName = "";
	private $_Data = null;
	private $_Columns = null;
	
	// Public
	
// Methoden

	// protected
	private function getAllData()
	{
		$query = "SELECT * FROM ".$this->_TabellenName;
		$result = $this->_DB->executeQuery($query);
		
		foreach ($result as $k => $v) {
			$datensatz = new TabellenItem();
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
		$this->_DB = Datenbank::getInstance();
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