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
    /** @var Database */
	protected $_DB;
	/** @var string */
	protected $_TableName = "";
	/** @var array */
	protected $_Data;
	/** @var array */
	protected $_Columns;
	
	// Public
	
// Methoden

	// protected

    /**
     * Holt alle Dateien für diese Table aus der Datenbank
     */
	protected function getAllData($id)
	{
	    if ($id === 0)
		    $query = "SELECT * FROM ".$this->_TableName;
	    else
            $query = "SELECT * FROM ".$this->_TableName." WHERE `id_".$this->_TableName."` = ".$id.";";

		$result = $this->_DB->executeQuery($query);
		
		foreach ($result as $k => $v) {
			$datensatz = new TableItem();
			foreach ($v as $k2 => $v2) {
				$datensatz->$k2 = $v2; 
			}
			$this->_Data[] = $datensatz;
		}
	}
	
	// Public

    /**
     * Table constructor.
     * @param int $id
     */
	public function __construct($id = 0)
	{
		$this->_Data = array();
		$this->_DB = Database::getInstance();
		$this->getAllData($id);
	}

    /**
     * Tabellendaten oder false
     * @return array|bool
     */
	public function getData()
	{
		return (is_array($this->_Data) && count($this->_Data) > 0) ? $this->_Data : false;
	}

	public function getRawData()
    {
        $res = array();
        if (is_array($this->_Data) && count($this->_Data) > 0) {
            foreach ($this->_Data as $number => $item) {
                foreach ($item as $key => $value) {
                    $res[$number][$key] = $value;
                }
            }
        }

        return $res;
    }
	
	/**
	* Erzeugt einen Datenbankeintrag mit gegebenem Item
	*
	* @param TableItem $item
	*/
	public function erstelleEintrag(TableItem $item)
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

    /**
     * Gibt einem die richtige Table
     * @param $table
     * @param int $id
     * @return Table
     */
	static public function getTabelle($table, $id = 0)
	{
		$table = "\\Model\\Data\\Table\\".$table;
		return new $table($id);
	}
}