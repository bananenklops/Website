<?php

namespace Controller\Printer;

//require_once __DIR__.'/../../../Printer/autoload.php';
require_once __DIR__.'/../../Mike42/autoload.php';

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\PrintConnector;
//use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;
//use Mike42\Escpos\EscposImage;

use Model\Data\Database;

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
    /** @var float */
    private $_Total;

    /** @var string */
    private $_Ip = "";
    /** @var int */
    private $_Port = 0;

    /**
     * @return int
     */
    public function getEventID(): int
    {
        return $this->_EventID;
    }

    /**
     * @param int $EventID
     */
    public function setEventID(int $EventID): void
    {
        $this->_EventID = $EventID;
    }

    /**
     * @return string
     */
    public function getEventName(): string
    {
        return $this->_EventName;
    }

    /**
     * @param string $EventName
     */
    public function setEventName(string $EventName): void
    {
        $this->_EventName = $EventName;
    }

    /**
     * @return string
     */
    public function getEventDate(): string
    {
        return $this->_EventDate;
    }

    /**
     * @param string $EventDate
     */
    public function setEventDate(string $EventDate): void
    {
        $this->_EventDate = $EventDate;
    }

    /**
     * @return string
     */
    public function getBillDate(): string
    {
        return $this->_BillDate;
    }

    /**
     * @param string $BillDate
     */
    public function setBillDate(string $BillDate): void
    {
        $this->_BillDate = $BillDate;
    }

    /**
     * @return int
     */
    public function getBillID(): int
    {
        return $this->_BillID;
    }

    /**
     * @param int $BillID
     */
    public function setBillID(int $BillID): void
    {
        $this->_BillID = $BillID;
    }

    /**
     * @return int
     */
    public function getVendorID(): int
    {
        return $this->_VendorID;
    }

    /**
     * @param int $VendorID
     */
    public function setVendorID(int $VendorID): void
    {
        $this->_VendorID = $VendorID;
    }

    /**
     * @return array
     */
    public function getItemList(): array
    {
        return $this->_ItemList;
    }

    /**
     * @param array $ItemList
     */
    public function setItemList(array $ItemList): void
    {
        $this->_ItemList = $ItemList;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->_Total;
    }

    /**
     * @param int $Total
     */
    public function setTotal(int $Total): void
    {
        $this->_Total = $Total;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->_Ip;
    }

    /**
     * @param string $Ip
     */
    public function setIp(string $Ip): void
    {
        $this->_Ip = $Ip;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->_Port;
    }

    /**
     * @param int $Port
     */
    public function setPort(int $Port): void
    {
        $this->_Port = $Port;
    }
    
    /**
     * @return Printer
     */
    public function getPrinter()
    {
        return $this->_Printer;
    }

    /**
     * @param PrintConnector $connector
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
    public function printBill()
    {
        // Beleg drucken
        $this->_Printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printLogo();
        $this->printEvent();
        $this->_Printer->feed();
        $this->printTitle();
        $this->_Printer->setJustification(Printer::JUSTIFY_LEFT);
        $this->printItem();
        $this->_Printer->feed();
        $this->printTaxAndTotal();
        $this->_Printer->feed(2);
        $this->_Printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printFooter();
        // Beleg fertig

        // Bons
        $this->_Printer->cut();
        foreach ($this->_ItemList as $item) {
            for ($i = 0; $i < $item['amount']; ++$i) {
                $this->_Printer->feed();
                $this->printBon($item['name']);
                $this->_Printer->feed();
                $this->_Printer->cut();
            }
        }
        // Bons fertig
    }

    private function printLogo()
    {
        $graphicPath = Database::getConfig('logo', 'path');
        if (is_null($graphicPath) || $graphicPath == "")
            return false;
        try {
            $graphic = EscposImage::load($graphicPath, false);
        } catch (\Exception $e) {
            return false;
        }
        $this->_Printer->graphics($graphic);
        return true;
    }

    private function printEvent()
    {
        $this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->_Printer->text($this->_EventName . "\n");
        $this->_Printer->selectPrintMode();
        $this->_Printer->text($this->_EventDate . "\n");
    }

    private function printTitle()
    {
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text("RECHNUNGSBELEG");
        $this->_Printer->setEmphasis(false);
    }

    private function printItem()
    {
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text(new Item('', '€'));
        $this->_Printer->setEmphasis(false);
        foreach ($this->_ItemList as $item) {
            $price = $item['rawPrice'] * $item['amount'];
            $this->_Printer->text(new Item($item['name'], $this->getNumberFormat($price), $item['amount']));
        }
    }

    private function printTaxAndTotal()
    {
        // Berechne Nettobetrag
        $tax = Database::getConfig('bon', 'tax');
        $subTotal = $this->_Total * $tax / 100;

        $this->_Printer->setEmphasis(true);
        $this->_Printer->text(new Item('Gesamtbetrag Netto', $this->getNumberFormat($subTotal)));
        $this->_Printer->setEmphasis(false);
        $this->_Printer->feed();
        $this->_Printer->text(new Item('Steuer', '%' . $tax));
        $this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->_Printer->text(new Item('Gesamtbetrag Brutto', $this->getNumberFormat($this->_Total)));
        $this->_Printer->selectPrintMode();
    }

    private function getNumberFormat($number)
    {
        return number_format($number, 2, ',', '.');
    }

    private function printFooter()
    {
        $message1 = Database::getConfig('bon', 'footerMessage1');
        $message2 = Database::getConfig('bon', 'footerMessage2');
        $this->_Printer->text($message1 . "\n");
        $this->_Printer->text($message2 . "\n");
        $this->_Printer->feed(2);
        $this->_Printer->text($this->_BillDate . "\n");
        $vendorID = str_pad($this->_VendorID, 3, 0, STR_PAD_LEFT);
        $billID = str_pad($this->_BillID, 8, 0, STR_PAD_LEFT);
        $this->_Printer->text("$billID$vendorID\n");
    }

    private function printBon($item)
    {
        $id = str_pad($this->_BillID, 8, "0", STR_PAD_LEFT);
        $this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text($id . " " . $item);
        $this->_Printer->setEmphasis(false);
        $this->_Printer->selectPrintMode();
    }

	public function __destruct()
	{
		$this->_Printer->pulse();
        $this->_Printer->close();
    }
}

class Item
{
    private $name;
    private $price;
    private $amount;

    public function __construct($name = '', $price = '', $amount = '')
    {
        $this->name = $name;
        $this->price = $price;
        $this->amount = $amount;
    }

    public function __toString()
    {
        $rightCols = 10;
        $middleCols = 18;
        $leftCols = 20;
        $left = str_pad($this->name, $leftCols);
        $middle = str_pad('x' . $this->amount, $middleCols);
        $right = str_pad($this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$middle$right\n";
    }
}