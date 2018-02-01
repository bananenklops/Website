<?php
/**
*	Author: Tobias Keßler
*   Datum: 09.11.2017
*/

namespace Model\Data;

// Konstanten Definitionen
define('QUERY_GET', 1);
define('QUERY_SET', 2);

/**
*   Basis-Schnittstelle zur Datenbank (Singleton)
*/
class Database
{
// Eigenschaften
	
	// Private
	private $_DB	     = null;
	
	private static $_DBInstance = null;
	
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
	    $config = $this::getConfig('database');
		$this->_DB = new \mysqli($config['host'], $config['user'], $config['pass'], $config['database']);
		
		if ($this->_DB->connect_error) {
			die ('MySQL Verbindungsfehler ('.$this->_DB->connect_errno.') '.$this->_DB->connect_error);
		}

		$this->_DB->query("SET NAMES 'utf8'");
	}
	
	// Public
	
	/**
	*	Gibt das Objekt dieser Singleton Klasse zurück oder erstellt eine neue Instanz, falls noch keine vorhanden ist.
	*
	*	@return Database
	*/
	public static function getInstance()
	{
		if (self::$_DBInstance === null)
			self::$_DBInstance = new Database();
		
		return self::$_DBInstance;
	}
	
	/**
	*	Führt MySQL Query aus
	*
	*	@param   string $query SQL-Query
	*	@return  array|bool|string
	*/
	public function executeQuery($query)
	{
		$result = $this->_DB->query($query);
		if ($result === false)
			return '(Nr' . $this->_DB->errno . ') ' . $this->_DB->error;
		else if ($result === true)
			return true;
		
		$res = array();
		while ($row = $result->fetch_assoc()) {
			$res[] = $row;
		}
		return $this->getErrorMessage() === "" ? $res : false;
	}

    /**
     *  Gibt die zuletzt erstellte ID zurück
     *
     *  @return int|string
     */
	public function getLastID()
    {
        return mysqli_insert_id($this->_DB);
    }

    /**
     *  Gibt eine Fehlernachricht aus, falls es eine gibt.
     *
     *  @return string
     */
    public function getErrorMessage()
    {
        return mysqli_error($this->_DB);
    }

    static public function getConfig($section = null, $key = null)
    {
        $config = parse_ini_file('config.ini', true);
        if (is_null($section))
            return $config;
        if (!is_null($section) && is_null($key))
            return $config[$section];

        return $config[$section][$key];
    }
}
?>