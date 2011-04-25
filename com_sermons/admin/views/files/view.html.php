<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.view');

class SermonsViewFiles extends JView
{

    function display($tpl = null) {
        JToolBarHelper::title(JText::_('File Manager'), 'generic.png');
        JToolBarHelper::publishList();
        JToolBarHelper::unpublishList();
        JToolBarHelper::deleteList();
        JToolBarHelper::editListX();
        JToolBarHelper::addNewX();

        // Get data from the model
        $items      = & $this->get('Data');

        $this->assignRef('items',       $items);


        parent::display($tpl);
    }
}
