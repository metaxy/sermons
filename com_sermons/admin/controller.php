<?php

jimport('joomla.application.component.controller');

class SermonsController extends JController
{
    function display() {
        if(!JRequest::getCmd('view')) {
            JRequest::setVar('view', 'files');
        }
        parent::display();
    }

}
?>
