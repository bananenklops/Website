<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 20:55
 */

use Controller\Ajax\AjaxController;

$ajax = new AjaxController();

echo $ajax->$_POST["action"]($_POST["param"]);