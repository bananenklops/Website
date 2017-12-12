<?php
/**
*	Author: Tobias Keßler
*	Datum: 09.11.02017
*/
spl_autoload_register(function ($class_name) {
    include 'class\\' . $class_name . '.Class.php';
});