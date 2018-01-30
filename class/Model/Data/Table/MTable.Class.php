<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 16.01.2018
 * Time: 19:58
 */

namespace Model\Data\Table;


class MTable extends Table
{
    /** @var array */
    protected $_Matching;
    /** @var array */
    protected $_IDs;

    /**
     * MTable constructor.
     *
     * @param int $id
     */
    public function __construct($id = 0)
    {
        if (count($this->_Matching) === 2) {
            $this->_TableName = "m_".$this->_Matching[0]."_".$this->_Matching[1];
            $this->_IDs[0] = "id_".$this->_Matching[0];
            $this->_IDs[1] = "id_".$this->_Matching[1];
        }

        parent::__construct($id);
    }

    /**
     * Löscht Eintrag aus Matching Tabelle
     *
     * @param int $col
     * @param int $id
     * @return bool
     */
    public function deleteMatchingEntry($col, $id)
    {
        $query = "DELETE FROM ".$this->_TableName." WHERE ".$this->_IDs[$col]."=".$id.";";

        return $this->_DB->executeQuery($query);
    }
}