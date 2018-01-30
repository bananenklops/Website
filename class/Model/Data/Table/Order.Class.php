<?php
/*
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Model\Data\Table;

// Test
define('ID_BESTELLUNG', 'id_menue');
define('DATUM_BESTELLUNG', 'name_menue');
define('ID_MITARBEITER', 'id_mitarbeiter');
define('ID_EVENT', 'id_event');

/**
*	Klasse für Bestellungen
*/
class Order extends TTable
{
// Eigenschaften
	
	// Private
	
	// Protected
	protected $_TableName = 'bestellung';

	// Public
    public function deleteEntryByID($id)
    {
        $mOM = new MOrderMenu();
        if (!$mOM->deleteMatchingEntry(0, $id))
            return false;
        $mOP = new MOrderProduct();
        if (!$mOP->deleteMatchingEntry(0, $id))
            return false;
        return parent::deleteEntryByID($id);
    }


// Methoden

	// protected
	
}