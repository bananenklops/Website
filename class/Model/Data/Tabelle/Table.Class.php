<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

namespace Model\Data\Table;

use Model\Data\Database;
use Model\Data\Item\TableItem;

/**
*	Basisklasse
*/
abstract class Table
{
// Eigenschaften
	
	// Protected
	protected $_DB = null;
	protected $_TableName = "";
	protected $_Data = null;
	protected $_Columns = null;
	
	// Public
	
// Methoden

	// protected
	protected function getAllData()
	{
		$query = "SELECT * FROM ".$this->_TableName;
		$result = $this->_DB->executeQuery($query);
		
		foreach ($result as $k => $v) {
			$datensatz = new TabellenItem();
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
		$this->_DB = Database::getInstance();
		$this->getAllData();
	}
	
	public function getData()
	{
	    $this->getAllData();
		return (is_array($this->_Data) && count($this->_Data) > 0) ? $this->_Data : false;
	}
	
	/**
	* Erzeugt einen Datenbankeintrag mit gegebenem Item
	*
	* @param TabellenItem $item
	*/
	public function erstelleEintrag(TabellenItem $item)
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
		$query = "INSERT INTO ".$this->_TableName." VALUES (".$values.");";
		
		$this->_DB->executeQuery($query);
	}
	
	static public function getTabelle($table)
	{
		$table = "\\Model\\Data\\Tabelle\\".$table;
		return new $table();
	}
}