<?php

namespace Controller\Printer;

require_once __DIR__.'/../../../Printer/autoload.php';

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

use Model\Data\Item\TableItem;
use Model\Data\Table;

/**
*	Schnittstelle zum Drucker mit passenden Methoden
*/
class BillPrinter
{
    /** @var Printer  */
	private $_Printer;
	/** @var int */
	private $_EventID;
	/** @var string */
	private $_EventName;
	/** @var string */
	private $_EventDate;
	/** @var string */
	private $_BillDate;
	/** @var int */
	private $_BillID;
	/** @var int */
	private $_VendorID;
	/** @var array */
	private $_ItemList;
	/** @var int */
    private $_Total;

    /** @var string */
    private $_Ip = "";
    /** @var int */
    private $_Port = 0;


    /**
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->_Printer;
    }

    /**
     * @param NetworkPrintConnector $connector
     */
    public function setPrinter($connector)
    {
        $this->_Printer = new Printer($connector);
    }

    /**
     * BillPrinter constructor.
     * @param string $ip
     * @param int $port
     */
	public function __construct($ip, $port)
	{
	    $this->_Ip = $ip;
	    $this->_Port = $port;

		//$connector = new  NetworkPrintConnector($this->_Ip, $this->_Port);
		//$this->setPrinter($connector);
	}

    /**
     * Druckt Rechnung und Bons
     * @param int $billID
     */
	public function printBill($billID)
    {
        $this->_BillID = $billID;

        // Daten für Rechnung holen

        // Rechnung & Event & Mitarbeiter
        $bill = new Table\Bill($billID);
        /** @var TableItem $billData */
        $billData = count($bill->getData()) === 1 ? $bill->getData()[0] : false;
        if ($billData) {
            $this->_BillDate = $billData->__get('Date');
            $this->_EventName = $billData->__get('EventName');
            $this->_EventDate = $billData->__get('EventDate');
            $this->_VendorID = $billData->__get('VendorID');
        }

        // Bestellte Produkte


    }
	
	public function printTextBig($text)
	{
		$this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$this->_Printer->text($text."\n");
	}
	
	public function printText($text)
	{
		$this->_Printer->selectPrintMode();
		$this->_Printer->text($text."\n");
	}
	
	public function printTextEmphasis($text)
	{
		$this->_Printer->setEmphasis(true);
		$this->_Printer->text($text."\n");
		$this->_Printer->setEmphasis(false);
	}
	
	public function feed($n = null)
	{
		if (!is_null($n))
			$this->_Printer->feed($n);
		else
			$this->_Printer->feed();
	}
	
	public function center()
	{
		$this->_Printer->setJustification(Printer::JUSTIFY_CENTER);
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
		/*$this->_Printer->cut();
		$this->_Printer->pulse();
		$this->_Printer->close();*/
	}
}