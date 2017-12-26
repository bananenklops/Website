<?php
/*
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Model\Data\Table;

use Model\Data\Item\TableItem;

// Test

/**
*	Klasse für die Table Menü
*/
class Menu extends Table
{
// Eigenschaften
	
	// Private
	
	// Protected
	protected $_TableName = 't_menue';
	
	// Public
	
// Methoden

	// protected
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
	
}