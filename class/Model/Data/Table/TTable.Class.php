<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 16.01.2018
 * Time: 20:58
 */

namespace Model\Data\Table;


class TTable extends Table
{
    /**
     * TTable constructor.
     *
     * @param int $id
     */
    public function __construct($id = 0)
    {
        $this->_IDName = "id_".$this->_TableName;
        $this->_TableName = "t_".$this->_TableName;

        parent::__construct($id);
    }

}