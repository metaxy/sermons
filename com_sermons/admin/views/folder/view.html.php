<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class SermonsViewFolder extends JView
{
    function display($tpl = null)
    {
        $folder =& $this->get('Data');
        $isNew = ($folder->id < 1);

        $text = $isNew ? JText::_( 'New' ) : JText::_( 'Edit' );
        JToolBarHelper::title(   JText::_( 'Folder' ).': <small>[ ' . $text.' ]</small>' );
        JToolBarHelper::save();
        if ($isNew)  {
            JToolBarHelper::cancel();
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel( 'cancel', 'Close' );
        }

        $this->assignRef('folder',$folder);

        parent::display($tpl);
    }
}
?>