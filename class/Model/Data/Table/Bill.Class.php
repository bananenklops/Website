<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 18:59
 */

namespace Model\Data\Table;

use Model\Data\Item\TableItem;

class Bill extends TTable
{
    protected $_TableName = "bestellung";

    protected function getAllData($id)
    {
        $query = "SELECT
	t_bestellung.id_bestellung AS \"ID\",
	t_bestellung.datum_bestellung AS \"Date\",
    t_bestellung.id_mitarbeiter AS \"VendorID\",
    t_event.name_event AS \"EventName\",
    t_event.datum_event AS \"EventDate\"
FROM t_bestellung
INNER JOIN t_event
ON t_bestellung.id_event=t_event.id_event";
        if ($id !== 0)
            $query .= " WHERE t_bestellung.id_bestellung=".$id;
        $query .= ";";

        $result = $this->_DB->executeQuery($query);

        foreach ($result as $k => $v) {
            $datensatz = new TableItem();
            foreach ($v as $k2 => $v2) {
                $datensatz->$k2 = utf8_encode($v2);
            }
            $this->_Data[] = $datensatz;
        }
    }

}