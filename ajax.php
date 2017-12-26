<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 20:55
 */

require __DIR__."/autoloader.php";

$result = array(
    'success' => false
);

use Controller\Ajax\AjaxController;

$ajax = new AjaxController();

$method = $_POST['action'];
$param = isset($_POST['param']) ? $_POST['param'] : null;
$res = $ajax->$method($param);
$res = json_encode($res);

echo $res;