<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 19:52
 */

namespace Controller\Index;


class ViewController
{
    protected $_ViewData;
    protected $_ViewName;
    protected $_StyleSheet;
    protected $_Script;

    public function __construct($view = "")
    {
        if ($view !== "")
            $this->_ViewName = $view;

        $this->addStyleSheet('bootstrap.css');
        $this->addStyleSheet('normalize.css');
        $this->addStyleSheet('jquery-ui.css');
        $this->addStyleSheet('jquery-ui.structure.css');
        $this->addStyleSheet('font-awesome.css');
        $this->addStyleSheet('style.css');

        $this->addScript('jquery.js');
        $this->addScript('bootstrap.js');
        $this->addScript('jquery-ui.js');
        $this->addScript('script.js');
    }

    public function viewAction() {
        $this->createView();
    }

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
    <meta charset='utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Festbon</title>
";
        if ($this->_StyleSheet)
            foreach ($this->_StyleSheet as $item) {
                echo "    ".$item."
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

    /**
     * @param $view
     * @return ViewController
     */
    static public function getView($view) {
        return new ViewController($view);
    }
}