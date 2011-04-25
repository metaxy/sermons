<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

class SermonsControllerFolder extends SermonsController
{
    function __construct() {
        parent::__construct();

        // Register Extra tasks
        $this->registerTask('add', 'edit');
        $this->registerTask('unpublish', 'publish');
    }
    function edit() {
        JRequest::setVar('view', 'folder');
        JRequest::setVar('layout', 'form');
        JRequest::setVar('hidemainmenu', 1);

        parent::display();
    }
    function save() {
        $model = $this->getModel('folder');

        if($model->store($post)) {
            $msg = JText::_('Folder Saved!');
        } else {
            $msg = JText::_('Error Saving Folder');
        }
        $this->setRedirect('index.php?option=com_sermons&view=folders', $msg);
    }

    function remove() {
        $model = $this->getModel('folder');
        if(!$model->delete()) {
            $msg = JText::_('Error: One or more Folder could not be Deleted');
        } else {
            $msg = JText::_('Folder(s) Deleted');
        }

        $this->setRedirect('index.php?option=com_sermons&view=folders', $msg);
    }

    function publish() {
        $this->setRedirect('index.php?option=com_sermons&view=folders');

        $db = & JFactory::getDBO();
        $user = & JFactory::getUser();
        $cid = JRequest::getVar('cid', array(), 'post', 'array');
        $task  = JRequest::getCmd('task');
        $publish = ($task == 'publish');
        $n = count($cid);

        if(empty($cid)) {
            return JError::raiseWarning(500, JText::_('No items selected'));
        }

        JArrayHelper::toInteger($cid);
        $cids = implode(',', $cid);

        $query = 'UPDATE #__sermonsFolder'
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
        $this->setRedirect('index.php?option=com_sermons&view=folders', $msg);
    }
}
?>
