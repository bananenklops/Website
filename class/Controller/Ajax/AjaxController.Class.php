<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 20:50
 */

namespace Controller\Ajax;

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

    private function returnData()
    {
        return array(
            'success' => $this->success,
            'result' => $this->result
        );
    }
}