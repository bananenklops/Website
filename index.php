<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.2017
*/

require __DIR__."/autoloader.php";

session_start();

$viewName = "";

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['event'])) {
        $viewName = "index";
        $view = \Controller\Index\ViewController::getView($viewName);
    } else {
        $viewName = "event";
        $view = new \Controller\Index\EventController();
    }
} else {
    $viewName = "login";
    $view = \Controller\Index\ViewController::getView($viewName);
}

if (!$view)
    $view = \Controller\Index\ViewController::getView("error");

$view->viewAction();
