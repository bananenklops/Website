<?php
/**
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Model\Data\Item;

/**
*	Basisiklasse für einzelne Datensätze
*/
class TableItem
{
// Methoden

	// Public
	
	/**
	*	Gibt Namen der Eigenschaften zurück, die den Spaltennamen in der Tabelle entsprechen
	*
	*	@return array
	*/	
	public function getColumns()
	{
		return get_object_vars($this);
	}
	
	public function setData(array $data)
	{
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}
}
