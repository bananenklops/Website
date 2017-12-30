<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 20:50
 */

namespace Controller\Ajax;

use Model\Data\Item\TableItem;
use Model\Data\Table;

class AjaxController
{
    private $success = false;
    private $result = null;

    public function getProduct()
    {
        $product = new Table\Product();
        $this->result = $product->getRawData();
        $this->success = is_array($this->result);

        return $this->returnData();
    }

    public function getMenu()
    {
        $menu = new Table\Menu();
        $this->result = $menu->getRawData();
        $this->success = is_array($this->result);

        return $this->returnData();
    }

    public function addOrder($param)
    {
        if (!isset($_SESSION[$param['key']][$param['id']]))
            $_SESSION[$param['key']][$param['id']] = 1;
        else
            $_SESSION[$param['key']][$param['id']] = ++$_SESSION[$param['key']][$param['id']];

        $this->result = $_SESSION[$param['key']][$param['id']];
        $this->success = is_int($this->result);

        return $this->returnData();
    }

    public function getOrder($param)
    {
        $this->result = isset($_SESSION[$param['key']][$param['id']]) ? $_SESSION[$param['key']][$param['id']] : false;
        $this->success = $this->result !== false;

        return $this->returnData();
    }

    public function resetOrder()
    {
        session_destroy();
        session_start();
        $this->success = count($_SESSION) === 0;

        return $this->returnData();
    }

    public function commitOrder()
    {
        if (isset($_SESSION['menu']) || isset($_SESSION['product'])) {
            // zu bestellende Produkte und Menüs
            $this->result['product'] = isset($_SESSION['product']) ? $_SESSION['product'] : array();
            $this->result['menu'] = isset($_SESSION['menu']) ? $_SESSION['menu'] : array();

            // neue Bestllung erstellen und in Datenbank speichern
            $orderTable = new Table\Order();
            $orderItem = new TableItem();
            // TODO: ID Mitarbeiter und ID Event müssen noch korrekt geladen werden. Vielleicht aus der Session?
            $data = array(
                'id_bestellung' => null,
                'datum_bestellung' => 'NOW()',
                'id_mitarbeiter' => 1,
                'id_event' => 1
            );

            $orderItem->setData($data);
            $this->result['orderID'] = $orderTable->erstelleEintrag($orderItem);

            // Matching Tabellen entsprechend füllen für Produkte und Menüs
            $this->createMatchingEntry('MOrderProduct', 'product', array(
                'id_bestellung', 'id_produkt', 'menge'
            ));

            $this->createMatchingEntry('MOrderMenu', 'menu', array(
                'id_bestellung', 'id_menu', 'menge'
            ));

            $this->success = is_int($this->result['orderID']) && ($this->result['orderID'] > 0);

            $this->resetOrder();
        } else {
            $this->success = true;
            $this->result = 'Es gibt nichts zum Bestellen';
        }
        return $this->returnData();
    }

    /**
     * Erstellt Matching Tabellen Einträge
     * @param string $tableName
     * @param string $type
     * @param array $column
     */
    private function createMatchingEntry($tableName, $type, $column)
    {
        $matchingTable = Table\Table::getTabelle($tableName);
        $matchingItem = new TableItem();
        foreach ($this->result[$type] as $key => $value) {
            $data = array(
                $column[0] => $this->result['orderID'],
                $column[1] => $key,
                $column[2] => $value
            );
            $matchingItem->setData($data);
            $matchingTable->erstelleEintrag($matchingItem);
        }
    }

    private function returnData()
    {
        return array(
            'success' => $this->success,
            'result' => $this->result
        );
    }
}