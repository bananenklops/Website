<?php

namespace Controller\Printer;

//require_once __DIR__.'/../../../Printer/autoload.php';
require_once __DIR__ . '/../../Mike42/autoload.php';

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\PrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

use Model\Data\Database;

/**
 *    Schnittstelle zum Drucker mit passenden Methoden
 */
class BillPrinter
{
    /** @var Printer */
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
    public function getEventID()
    {
        return $this->_EventID;
    }

    /**
     * @param $EventID
     */
    public function setEventID($EventID)
    {
        $this->_EventID = $EventID;
    }

    /**
     * @return string
     */
    public function getEventName()
    {
        return $this->_EventName;
    }

    /**
     * @param $EventName
     */
    public function setEventName($EventName)
    {
        $this->_EventName = $EventName;
    }

    /**
     * @return string
     */
    public function getEventDate()
    {
        return $this->_EventDate;
    }

    /**
     * @param $EventDate
     */
    public function setEventDate($EventDate)
    {
        $this->_EventDate = $EventDate;
    }

    /**
     * @return string
     */
    public function getBillDate()
    {
        return $this->_BillDate;
    }

    /**
     * @param $BillDate
     */
    public function setBillDate($BillDate)
    {
        $this->_BillDate = $BillDate;
    }

    /**
     * @return int
     */
    public function getBillID()
    {
        return $this->_BillID;
    }

    /**
     * @param $BillID
     */
    public function setBillID($BillID)
    {
        $this->_BillID = $BillID;
    }

    /**
     * @return int
     */
    public function getVendorID()
    {
        return $this->_VendorID;
    }

    /**
     * @param $VendorID
     */
    public function setVendorID($VendorID)
    {
        $this->_VendorID = $VendorID;
    }

    /**
     * @return array
     */
    public function getItemList()
    {
        return $this->_ItemList;
    }

    /**
     * @param $ItemList
     */
    public function setItemList($ItemList)
    {
        $this->_ItemList = $ItemList;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->_Total;
    }

    /**
     * @param $Total
     */
    public function setTotal($Total)
    {
        $this->_Total = $Total;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->_Ip;
    }

    /**
     * @param $Ip
     */
    public function setIp($Ip)
    {
        $this->_Ip = $Ip;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->_Port;
    }

    /**
     * @param $Port
     */
    public function setPort($Port)
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

        $connector = new  NetworkPrintConnector($this->_Ip, $this->_Port);
        $this->setPrinter($connector);
    }

    /**
     * Druckt Rechnung und Bons
     * @param int $billID
     */
    public function printBill()
    {
        $config = Database::getConfig('bon');
        // Bons
        $this->_Printer->setJustification(Printer::JUSTIFY_CENTER);
        $this->printBons();
        // Bons fertig
        // Beleg drucken | falls in der Config eingestellt | in der gewünschten Anzahl
        $numberPrint = $config['receiptAmount'] || 1;
        $doPrint = $config['printBon'] || true;
        for ($i = 0; $i < $numberPrint; ++$i) {
            if (!$doPrint)
                break;
            $this->printLogo();
            $this->_Printer->feed(2);
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
        }
        // Beleg fertig
    }

    /**
     * Druckt die Bons
     */
    private function printBons()
    {
        foreach ($this->_ItemList as $item) {
            for ($i = 0; $i < $item['amount']; ++$i) {
                $this->printBon($item['name'] . "\n");
                $this->_Printer->feed();
                $this->_Printer->cut();
            }
        }
    }

    /**
     * Druckt Logo, falls eins angegeben wurde
     *
     * @return bool
     */
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

    /**
     * Druckt Event- Name und Datum
     */
    private function printEvent()
    {
        $this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->_Printer->text($this->_EventName . "\n");
        $this->_Printer->selectPrintMode();
        $this->_Printer->text($this->_EventDate . "\n");
    }

    /**
     * Druckt Titel
     */
    private function printTitle()
    {
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text("RECHNUNGSBELEG\n");
        $this->_Printer->setEmphasis(false);
    }

    /**
     * Druckt georderte Items
     */
    private function printItem()
    {
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text(new Item('', '€'));
        $this->_Printer->setEmphasis(false);
        foreach ($this->_ItemList as $item) {
            $this->_Printer->text(new Item($item['name'], $this->getNumberFormat($item['rawPrice']), 'x' . $item['amount']));
        }
    }

    /**
     * Berechnet und druckt Nettowert sowie Bruttowert
     */
    private function printTaxAndTotal()
    {
        // Berechne Nettobetrag
        $tax = Database::getConfig('bon', 'tax');
        $taxCalc = $tax + 100;
        $subTotal = $this->_Total / ($taxCalc / 100);
        $taxTotal = $this->_Total - $subTotal;

        $this->_Printer->text(new Item('Gesamtbetrag Netto', $this->getNumberFormat($subTotal)));
        $this->_Printer->text(new Item('Steuerbetrag', $this->getNumberFormat($taxTotal), $tax . '%'));
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text(new Item('Gesamtbetrag Brutto', $this->getNumberFormat($this->_Total)));
        $this->_Printer->setEmphasis(false);
    }

    /**
     * Gibt korrekte Zeichenkette für Eurobeträge zurück
     *
     * @param $number
     * @return string
     */
    private function getNumberFormat($number)
    {
        return number_format($number, 2, ',', '.');
    }

    /**
     * Druckt Footer, der in der Config angegeben werden kann
     * sowie eine Zahlenkette aus BestellID und MitarbeiterID
     */
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

    /**
     * Druckt einen einzelnen Bon
     *
     * @param $item
     */
    private function printBon($item)
    {
        $id = str_pad($this->_BillID, 8, "0", STR_PAD_LEFT);
        $this->_Printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $this->_Printer->setEmphasis(true);
        $this->_Printer->text($id . " " . $item);
        $this->_Printer->setEmphasis(false);
        $this->_Printer->selectPrintMode();
    }

    /**
     * Destruktor
     */
    public function __destruct()
    {
        $this->_Printer->cut();
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
        $middle = str_pad($this->amount, $middleCols);
        $right = str_pad($this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$middle$right\n";
    }
}