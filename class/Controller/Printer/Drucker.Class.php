<?php

namespace Controller\Drucker;

require_once __DIR__.'/../../../Printer/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

use Model\Daten\Tabelle;

/**
*	Schnittstelle zum Drucker mit passenden Methoden
*/
class Drucker
{
	private $_Drucker = null;
	
	private $_Ip = "";
	private $_Port = 0;
	
	public function __construct($ip, $port)
	{
		$connector = new  NetworkPrintConnector($ip, $port);
		$this->_Drucker = new Printer($connector);
	}
	
	public function druckeTextGross($text)
	{
		$this->_Drucker->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$this->_Drucker->text($text."\n");
	}
	
	public function druckeText($text)
	{
		$this->_Drucker->selectPrintMode();
		$this->_Drucker->text($text."\n");
	}
	
	public function druckeTextBetonung($text)
	{
		$this->_Drucker->setEmphasis(true);
		$this->_Drucker->text($text."\n");
		$this->_Drucker->setEmphasis(false);
	}
	
	public function feed($n = null)
	{
		if (!is_null($n))
			$this->_Drucker->feed($n);
		else
			$this->_Drucker->feed();
	}
	
	public function zentrieren()
	{
		$this->_Drucker->setJustification(Printer::JUSTIFY_CENTER);
	}

	public function druckeRechnung()
    {
        $veranstaltung;
        $veranstalter;
        $rechnungsnummer;
        $datum;
        $items = array();
    }
	
	public function __destruct()
	{
		$this->_Drucker->cut();
		$this->_Drucker->pulse();
		$this->_Drucker->close();
	}
}