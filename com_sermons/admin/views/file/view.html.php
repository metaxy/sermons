<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class SermonsViewFile extends JView
{
    var $folderAliasArray;
    var $folderIDArray;
    var $notUsed;
    function followArray($folderID,$name)
    {
        $db =& JFactory::getDBO();
        
        $query = "SELECT id,alias FROM #__sermonsFolder WHERE top='$folderID'";
        $db->setQuery($query);
        $folders = $db->loadObjectList();
        foreach($folders as $folder)
        {
            array_push($this->folderAliasArray, $name."/".$folder->alias);
            array_push($this->folderIDArray, $folder->id);
            $this->followArray($folder->id, $name."/".$folder->alias);
        }
    }
    function getNiceFolderArray()
    {
        $db =& JFactory::getDBO();
        $this->folderAliasArray = array();
        $this->folderIDArray = array();
        $query = "SELECT * FROM #__sermonsFolder WHERE top='0'";
        $db->setQuery($query);
        $folders = $db->loadObjectList();
        foreach($folders as $folder)
        {
            array_push($this->folderAliasArray, $folder->alias);
            array_push($this->folderIDArray, $folder->id);
            $this->followArray($folder->id, $folder->alias);
        }
    }
    function getNotUsedFiles($dir)
    {
        if ($handle = opendir ("../".$dir)) {
            $i = 0;
            $cache = "";
            $list = array();
            while (false !== ($file = @readdir ($handle))) {
                if ($file != "." && $file != ".." && $file != "index.php" && $file != "index.html") {
                    if(!is_dir('../'.$dir.'/'.$file)) {
                        $db =& JFactory::getDBO();
                        $query = "SELECT id,path FROM #__sermonsFile WHERE path='".$dir.'/'.$file."'";
                        $db->setQuery($query);
                        $db->query();
                        $vfile = $dir.'/'.$file;
                        if($db->getNumRows() == 0) {
                            $cache .= "	<option value='$vfile'>$file</option>\n";
                        }
                    } else {
                        $list[$i] = $file;
                        $i++;
                    }
                }
            }
            if($cache != "") {
                $this->notUsed .= "<optgroup label='$dir'>\n";
                $this->notUsed .= $cache;
                $this->notUsed .= "</optgroup>\n";
            }
            for($i = 0;$i < count($list);$i++) {
                $this->getNotUsedFiles($dir."/".$list[$i]);
            }
        }
    }
    function display($tpl = null)
    {
        $file =& $this->get('Data');
        $isNew = ($file->id < 1);

        $text = $isNew ? JText::_('New') : JText::_('Edit');
        JToolBarHelper::title( JText::_('File').': <small>[ ' . $text.' ]</small>' );
        JToolBarHelper::save();
        if ($isNew)  {
            JToolBarHelper::cancel();
        } else {
            // for existing items the button is renamed `close`
            JToolBarHelper::cancel( 'cancel', 'Close' );
        }

        $this->assignRef('file',$file);

        $this->getNiceFolderArray();
        $this->assignRef('folders', $this->folderAliasArray);
        $this->assignRef('foldersID', $this->folderIDArray);
        $this->notUsed = "";
        $this->getNotUsedFiles("downloads/Predigten");
        $this->assignRef('notUsed', $this->notUsed);
        parent::display($tpl);
    }
}
