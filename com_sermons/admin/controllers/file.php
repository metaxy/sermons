<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class SermonsControllerFile extends SermonsController
{
    function __construct() {
        parent::__construct();

        // Register Extra tasks
        $this->registerTask('add', 'edit');
        $this->registerTask('unpublish', 'publish');
    }

    function edit() {
        JRequest::setVar('view', 'file');
        JRequest::setVar('layout', 'form');
        JRequest::setVar('hidemainmenu', 1);

        parent::display();
    }

    function save() {
        $model = $this->getModel('file');

        if($model->store($post)) {
            $msg = JText::_('Auto Saved!');
        } else {
            $msg = JText::_('Error Saving Auto');
        }

        // Check the table in so it can be edited.... we are done with it anyway
        $link = 'index.php?option=com_sermons&view=files';
        $this->setRedirect($link, $msg);
    }

    function remove() {
        $model = $this->getModel('file');
        if(!$model->delete()) {
            $msg = JText::_('Error: One or more Sermons could not be Deleted');
        } else {
            $msg = JText::_('Sermons(s) Deleted');
        }

        $this->setRedirect('index.php?option=com_sermons', $msg);
    }

    function publish() {
        $this->setRedirect('index.php?option=com_sermons&view=files');

        // Initialize variables
        $db         = & JFactory::getDBO();
        $user       = & JFactory::getUser();
        $cid        = JRequest::getVar('cid', array(), 'post', 'array');
        $task       = JRequest::getCmd('task');
        $publish    = ($task == 'publish');
        $n          = count($cid);

        if(empty($cid)) {
            return JError::raiseWarning(500, JText::_('No items selected'));
        }

        JArrayHelper::toInteger($cid);
        $cids = implode(',', $cid);

        $query = 'UPDATE #__sermonsFile'
                 . ' SET published = ' .(int) $publish
                 . ' WHERE id IN ( '. $cids .' )'
                 ;
        $db->setQuery($query);
        if(!$db->query()) {
            return JError::raiseWarning(500, $row->getError());
        }
        $this->setMessage(JText::sprintf($publish ? 'Items published' : 'Items unpublished', $n));

    }

    function cancel() {
        $msg = JText::_('Operation Cancelled');
        $this->setRedirect('index.php?option=com_sermons&view=files', $msg);
    }
}
?>
