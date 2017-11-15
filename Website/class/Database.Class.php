<?php
/**
*	Author: Tobias Keßler
*   Datum: 09.11.2017
*/

// Konstanten Definitionen
define('QUERY_GET', 1);
define('QUERY_SET', 2);

/**
*   Basis-Schnittstelle zur Datenbank (Singleton)
*/
class Datenbank
{
// Eigenschaften
	
	// Private
	private $_DBHost     = 'localhost';
	private $_DBUser     = 'root';
	private $_DBPass     = '';
	private $_DBData     = 'festbon';
	
	private $_DB	     = null;
	
	private $_DBInstance = null;
	
	// Public
	
// Methoden

	// Private
	
	/**
	*	Privater Konstruktor für Singleton
	*
	*	Erzeugt Datenbank Objekt bzw. Verbindung
	*/
	private function __construct()
	{
		$this->_DB = new mysqli($_DBHost, $_DBUser, $_DBPass, $_DBData);
		
		if ($this->_DB->connect_error) {
			die ('MySQL Verbindungsfehler ('.$this->_DB->connect_errno.') '.$this->_DB->connect_error);
		}
	}
	
	// Public
	
	/**
	*	Gibt das Objekt dieser Singleton Klasse zurück oder erstellt eine neue Instanz, falls noch keine vorhanden ist.
	*
	*	@return Datenbank  
	*/
	public static function getInstance()
	{
		if ($this->_DBInstance === null)
			$_DBInstance = new Datenbank();
		
		return $_DBInstance;
	}
	
	/**
	*	Führt MySQL Query aus
	*
	*	@param   string $query SQL-Query
	*	@return  array oder bool
	*/
	public function executeQuery($query)
	{
		$result = $this->_DB->query($query);
		if (is_bool($result))
			return $result;
		
		$res = array();
		while ($row = $result->fetch_assoc()) {
			$res[] = $row;
		}
		return $res;
	}
}
?>