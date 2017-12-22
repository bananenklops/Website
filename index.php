<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

require __DIR__."/autoloader.php";

$view = new \Controller\Index\IndexController();
$view->viewAction();