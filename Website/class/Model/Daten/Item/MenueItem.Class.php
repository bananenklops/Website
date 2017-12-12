<?php
/**
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Model\Daten\Item;

// Test
define('ID_MENUE', 'id_menue');
define('NAME_MENUE', 'name_menue');
define('BESCHREIBUNG_MENUE', 'beschreibung_menue');
define('RABATT_MENUE', 'rabatt_menue');
define('DATUM_MENUE', 'datum_menue');

/**
*	Einzelnes Menü
*/
class MenueItem extends TabellenItem
{
// Eigenschaften

	// Private
	public $id_menue = "";
	public $name_menue = "";
	public $beschreibung_menue = 0;
	public $rabatt_menue = "";
	public $datum_menue = 0;
}