<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 24.12.2017
 * Time: 22:52
 */

namespace Model\Data\Table;

use Model\Data\Item\TableItem;

class Product extends Table
{
    protected $_TableName = 't_produkt';

    protected function getAllData($id)
    {
        if ($id === 0)
            $query = "SELECT
	t_produkt.id_produkt AS \"ID\",
	t_produkt.name_produkt AS \"name\",
    t_produkt.preis_produkt AS \"price\",
    t_produkt.portion_produkt AS \"portion\",
    t_produkt.id_bestand AS \"stockID\",
    t_bestand.einheit_bestand AS \"unit\"
FROM
	t_produkt
INNER JOIN 
	t_bestand
ON
	t_produkt.id_bestand=t_bestand.id_bestand
WHERE
	t_produkt.aktiv_produkt=1
ORDER BY
    t_produkt.art_produkt;
    ";
        else
            $query = "SELECT
	t_produkt.id_produkt AS \"ID\",
	t_produkt.name_produkt AS \"name\",
    t_produkt.preis_produkt AS \"price\",
    t_produkt.portion_produkt AS \"portion\",
    t_produkt.id_bestand AS \"stockID\",
    t_bestand.einheit_bestand AS \"unit\"
FROM
	t_produkt
INNER JOIN 
	t_bestand
ON
	t_produkt.id_bestand=t_bestand.id_bestand
WHERE
	t_produkt.aktiv_produkt=1
AND `id_".$this->_TableName."` = ".$id.";";

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