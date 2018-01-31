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
    /** @var bool */
    private $success = false;
    /** @var array */
    private $result = null;

    /**
     * @return array
     */
    public function getProduct()
    {
        $product = new Table\Product();
        $this->result = $product->getRawData();
        $this->success = is_array($this->result);

        return $this->returnData();
    }

    /**
     * @return array
     */
    private function returnData()
    {
        return array(
            'success' => $this->success,
            'result' => $this->result
        );
    }

    /**
     * @return array
     */
    public function getMenu()
    {
        $menu = new Table\Menu();
        $this->result = $menu->getRawData();
        $this->success = is_array($this->result);

        return $this->returnData();
    }

    /**
     * @param $param
     *
     * @return array
     */
    public function addOrder($param)
    {
        if (!isset($_SESSION['order'][$param['key']][$param['id']]))
            $_SESSION['order'][$param['key']][$param['id']] = 1;
        else
            $_SESSION['order'][$param['key']][$param['id']] = ++$_SESSION['order'][$param['key']][$param['id']];

        $this->result = $_SESSION['order'][$param['key']][$param['id']];
        $this->success = is_int($this->result);

        return $this->returnData();
    }

    /**
     * @param $param
     *
     * @return array
     */
    public function getOrder($param)
    {
        $this->result = isset($_SESSION['order'][$param['key']][$param['id']]) ? $_SESSION['order'][$param['key']][$param['id']] : false;
        $this->success = $this->result !== false;

        return $this->returnData();
    }

    /**
     * @return array
     */
    public function commitOrder()
    {
        if (!isset($_SESSION['user'])) {
            $this->result = "Sie müssen angemeldet sein. Bitte melden Sie sich an.";
            return $this->returnData();
        }

        if (!isset($_SESSION['event'])) {
            $this->result = "Sie müssen ein Event ausgewählt haben. Bitte wählen Sie ein Event aus.";
            return $this->returnData();
        }

        // TODO: Maximale Bestellmenge pro Zeit IDEE: SELECT COUNT(*) FROM t_bestellung WHERE datum_bestellung BETWEEN DATE_SUB(NOW(), INTERVAL 1 HOUR) AND NOW();

        if (isset($_SESSION['order'])) {
            // zu bestellende Produkte und Menüs
            $this->result['product'] = isset($_SESSION['order']['product']) ? $_SESSION['order']['product'] : array();
            $this->result['menu'] = isset($_SESSION['order']['menu']) ? $_SESSION['order']['menu'] : array();

            // neue Bestellung erstellen und in Datenbank speichern
            $orderTable = new Table\Order();
            $orderItem = new TableItem();
            $data = array(
                'id_bestellung' => null,
                'datum_bestellung' => 'NOW()',
                'id_mitarbeiter' => $_SESSION['user'],
                'id_event' => $_SESSION['event']['id']
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

            if ($this->success)
                $_SESSION['lastOrderID'] = $this->result['orderID'];

            // TODO: Druckfunktion kommt hier hinein, IP sollte aus einer Konfiguration geladen werden!
            /*$printer = new BillPrinter('IP', 'PORT');
            $printer->printBill($this->result['orderID']);*/

            $this->resetOrder();
        } else {
            $this->success = true;
            $this->result = 'Es gibt nichts zum Bestellen';
        }

        return $this->returnData();
    }

    /**
     * Erstellt Matching Tabellen Einträge
     *
     * @param string $tableName
     * @param string $type
     * @param array  $column
     */
    private function createMatchingEntry($tableName, $type, $column)
    {
        $matchingTable = Table\Table::getTabelle($tableName);
        $matchingItem = new TableItem();
        $result = array();
        foreach ($this->result[$type] as $key => $value) {
            $data = array(
                $column[0] => $this->result['orderID'],
                $column[1] => $key,
                $column[2] => $value
            );
            $matchingItem->setData($data);

            if (($result[] = $matchingTable->erstelleEintrag($matchingItem)) === false)
                return false;
        }
        return $result;
    }

    /**
     * @return array
     */
    public function resetOrder()
    {
        if (isset($_SESSION['order']))
            unset ($_SESSION['order']);

        $this->success = !isset($_SESSION['order']);

        return $this->returnData();
    }

    /**
     * @return array
     */
    public function deleteLastOrder()
    {
        if (!isset($_SESSION['user'])) {
            $this->result = "Für diese Aktion müssen Sie angemeldet sein. Bitte melden Sie sich an.";
            return $this->returnData();
        }

        if (isset($_SESSION['lastOrderID']))
            $this->success = $this->deleteOrder($_SESSION['lastOrderID']);

        if ($this->success)
            unset($_SESSION['lastOrderID']);

        $this->result =
            $this->success
                ?
                "Letzte Bestellung wurde erfolgreich storniert."
                :
                "Die letzte Bestellung wurde bereits storniert, oder es wurde noch keine Bestellung getätigt.";

        return $this->returnData();
    }

    /**
     * @param $id
     *
     * @return bool
     */
    private function deleteOrder($id)
    {
        $order = new Table\Order();
        return $order->deleteEntryByID($id);
    }

    public function logIn($param)
    {
        $userName = $param['userName'];
        $password = $param['password'];

        $user = new Table\User($userName);
        $data = $user->getData();

        if (count($data) === 1) {
            if ($data[0]->passwort_mitarbeiter === $password && $data[0]->aktiv_mitarbeiter) {
                $_SESSION['user'] = $userName;
                $this->success = true;
                $this->result = "Erfolgreich angemeldet.";
                return $this->returnData();
            }
            $this->result = "Benutzername oder Kennwort ist falsch, oder Konto ist nicht aktiv.";
        }
        return $this->returnData();
    }

    public function logOut()
    {
        unset($_SESSION['user']);
        unset($_SESSION['event']);
        if (!isset($_SESSION['user']) && !isset($_SESSION['event'])) {
            $this->success = true;
            $this->result = "Erfolgreich abgemeldet.";
        }

        return $this->returnData();
    }

    public function saveEvent($param)
    {
        $_SESSION['event']['id'] = $param['eventID'];

        $this->success = true;
        return $this->returnData();
    }
}