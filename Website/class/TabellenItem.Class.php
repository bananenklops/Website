<?php
/**
*	Author: Tobias Keßler
*	Datum: 10.11.2017
*/

namespace Datenbank\Datensatz;

/**
*	Basisiklasse für einzelne Datensätze
*/
class TabellenItem
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
}
