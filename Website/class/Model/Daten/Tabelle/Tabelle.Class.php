<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

namespace Model\Daten\Tabelle;

use Model\Daten;
use Model\Daten\Item;

/**
*	Basisklasse
*/
abstract class Tabelle
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
	protected function getAllData()
	{
		$query = "SELECT * FROM ".$this->_TabellenName;
		$result = $this->_DB->executeQuery($query);
		
		foreach ($result as $k => $v) {
			$datensatz = Item\TabellenItem::getTableItem(BestellungItem);
			foreach ($v as $k2 => $v2) {
				$datensatz->$k2 = $v2; 
			}
			$this->_Data[] = $datensatz;
		}
	}
	
	// Public
	public function __construct()
	{
		$this->_Data = array();
		$this->_DB = Daten\Datenbank::getInstance();
		$this->getAllData();
	}
	
	public function getData()
	{
		return (is_array($this->_Data) && count($this->_Data) > 0) ? $this->_Data : false;
	}
	
	/**
	* Erzeugt einen Datenbankeintrag mit gegebenem Item
	*
	* @param Item\TabellenItem $item
	*/
	public function createEntry(Item\TabellenItem $item)
	{
		$values = "";
		foreach($item->getColumns() as $key => $value) {
			if (is_string($value)) {
				$values .= '"'.$value.'"';
			} elseif (is_numeric($value)) {
				$values .= $value;
			} elseif (is_null($value)) {
				$values .= 'NULL';
			}
			$values .= ',';
		}
		$values = substr($values, 0, -1);
		$query = "INSERT INTO ".$this->_TabellenName." VALUES (".$values.");";
		
		$this->_DB->executeQuery($query);
	}
	
	static public function getTable($table)
	{
		$table = "\\Model\\Daten\\Tabelle\\".$table;
		return new $table();
	}
}