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
            $query = "SELECT
	t_menue.id_menue AS \"ID\",
	t_menue.name_menue AS \"name\",
    t_menue.beschreibung_menue AS \"desc\",
    t_menue.preis_menue AS \"price\"
FROM
	t_menue
WHERE
	t_menue.aktiv_menue=1;";
        else
            $query = "SELECT
	t_menue.id_menue AS \"ID\",
	t_menue.name_menue AS \"name\",
    t_menue.beschreibung_menue AS \"desc\",
    t_menue.preis_menue AS \"price\"
FROM
	t_menue
WHERE
	t_menue.aktiv_menue=1 AND t_menue.id_menue=".$id.";";

        $result = $this->_DB->executeQuery($query);

        foreach ($result as $k => $v) {
            $datensatz = new TableItem();
            foreach ($v as $k2 => $v2) {
                $datensatz->$k2 = utf8_encode($v2);
            }
            $this->_Data[] = $datensatz;
        }
    }


    // Public
	
}