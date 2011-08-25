<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.model');

class SermonsModelFolder extends JModel
{
    var $path;
    var $startFolder;
    function getFolderList($top = 0)
    {
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__sermonsFolder WHERE top='$top' ORDER BY id DESC";
        $result = $this->_getList( $query );
        return @$result;
    }
    
    function getFileList($folder = 0)
    {
        $db =& JFactory::getDBO();
        
        $user =& JFactory::getUser();
        $private = "";
        if($user->guest) {
            $private = " AND privateFile='0'";
        }
        
        if($folder == -1) {//All Files
            $query = "SELECT * FROM #__sermonsFile";
        } else {
            $query = "SELECT * FROM #__sermonsFile WHERE folder='$folder'".$private;
        }
        $result = $this->_getList( $query );
        return @$result;
    }

    function getLastFileList()
    {
        $db =& JFactory::getDBO();
        
        $user =& JFactory::getUser();
        $private = "";
        if($user->guest) {
            $private = " WHERE privateFile='0'";
        }
        
        $query = "SELECT * FROM #__sermonsFile ".$private. "ORDER BY id DESC LIMIT 6";
        $result = $this->_getList( $query );
        return @$result;
    }
    
    function getFileCount($folder = 0)
    {
        $db =& JFactory::getDBO();
        
        $user =& JFactory::getUser();
        $private = "";
        
        
        if($folder == -1) {//All Files
            if($user->guest) {
                $private = " WHERE privateFile='0'";
            }
            $query = "SELECT id,folder FROM #__sermonsFile".$private;
        } else {
            if($user->guest) {
                $private = " AND privateFile='0'";
            }
            $query = "SELECT id,folder FROM #__sermonsFile WHERE folder='$folder'".$private;
        }

        $db->setQuery($query);
        $db->query();
        $num_rows = $db->getNumRows();
        return $num_rows;
    }
    
    function getPath($folder = 0)
    {
        $this->path = " ";
        $this->startFolder = $folder;
        $this->rekPath($folder);
        return $this->path;
    }
    
    function rekPath($folder)
    {
        $db =& JFactory::getDBO();
        $query = "SELECT alias,parentFolder FROM #__sermonsFolder WHERE id='$folder';";
        $db->setQuery($query);
        $row = $db->loadRow();
        
        if($folder != $this->startFolder) {
            $link = JRoute::_('index.php?option=com_sermons&view=folder&id='. $folder );
            $this->path = JHtml::_('link', $link, $row[0])."/".$this->path;
        } else {
            $this->path = $row[0]."/".$this->path;
        }
        if($folder != 0) {
            $this->rekPath($row[1]);
        } else {
            if($folder != $this->startFolder) {
                $link = JRoute::_('index.php?option=com_sermons&view=folder&id=0' );
                $this->path = JHtml::_('link', $link, "Predigten").$this->path;
            } else {
                $this->path = "Predigten".$this->path;
            }
        }
    }
}
?>