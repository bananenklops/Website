<?php
/**
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Model\Data\Item;

/**
*	Klasse für einzelne Daten
*/
class TableItem
{
// Methoden

	// Public
	
	/**
	*	Gibt Namen der Eigenschaften, die den Spaltennamen in der Table entsprechen
	*
	*	@return array
	*/	
	public function getColumns()
	{
		return get_object_vars($this);
	}

    /**
     * Setzt gegebene Eigenschaften eins zu eins. !!Aufpassen mit Array Keys!!
     * @param array $data
     */
	public function setData(array $data)
	{
		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

    /**
     * @param string $col
     * @return mixed
     */
	public function __get($col)
    {
        return $this->$col;
    }
}
