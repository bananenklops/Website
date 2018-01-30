<?php
/**
 * Created by PhpStorm.
 * User: Tobias
 * Date: 28.01.2018
 * Time: 21:50
 */

namespace Controller\Index;


use Model\Data\Table\Event;
use Model\Data\Table\Table;

class EventController extends ViewController
{
    protected $_ViewName = "event";

    public function viewAction()
    {
        $event = new Event();
        $eventData = $event->getRawData();
        $this->_ViewData = array(
            'events' => $eventData
        );

        $this->createView();
    }

}