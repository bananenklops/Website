<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 22.12.2017
 * Time: 20:20
 */

namespace Controller\Index;


class IndexController extends ViewController
{
    protected $_ViewName = "index";

    public function viewAction()
    {
        $this->addStyleSheet('bootstrap.css');
        $this->addStyleSheet('bootstrap-theme.css');
        $this->addStyleSheet('style.css');

        $this->addScript('jquery.js');
        $this->addScript('bootstrap.js');
        $this->addScript('script.js');

        $this->_ViewData = array(
            "Hausnummer" => 9
        );
        $this->createView();
    }
}