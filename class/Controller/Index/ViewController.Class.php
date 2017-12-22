<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 19:52
 */

namespace Controller\Index;


abstract class ViewController
{
    protected $_ViewData;
    protected $_ViewName;
    protected $_StyleSheet;
    protected $_Script;

    abstract public function viewAction();

    protected function addStyleSheet($fileName)
    {
        $this->_StyleSheet[] = "<link href='public/css/{$fileName}' rel='stylesheet' />";
    }

    protected function addScript($fileName)
    {
        $this->_Script[] = "<script src='public/js/{$fileName}'></script>";
    }

    public function createView()
    {
        echo "<!DOCTYPE html>
<html lang='de'>
<head>
    <title>Festbon</title>
";
        if ($this->_StyleSheet)
            foreach ($this->_StyleSheet as $item) {
                echo $item."
";
            }

        echo "</head>
<body>
";
        include "public/view/{$this->_ViewName}.phtml";

        if ($this->_Script)
            foreach ($this->_Script as $item) {
                echo $item."
";
            }

        echo "
</body>
</html>";
    }
}