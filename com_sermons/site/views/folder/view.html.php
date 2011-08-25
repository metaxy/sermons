<?php
jimport( 'joomla.application.component.view');
function cmp( $a, $b )
{
    $sortBy = JRequest::getString("sort", "date", "GET");
    
    if($sortBy == "date") {
        if( $a->date ==  $b->date) { 
            return 0; 
        } 
        return (strtotime($a->date) > strtotime($b->date)) ? -1 : 1;
    } else if($sortBy == "topic") {
        if($a->topic == "")
            return 1;
        if($b->topic == "")
            return -1;
        return strnatcmp($a->topic, $b->topic);
    }
    else if($sortBy == "speaker") {
        if($a->speaker == "")
            return 1;
        if($b->speaker == "")
            return -1;
        return strnatcmp($a->speaker, $b->speaker);
    }

}

class SermonsViewFolder extends JView
{
    function display($tpl = null)
    {
        $model = &$this->getModel();
        $id = JRequest::getInt("id", 0, "GET");
        $fileCount = $model->getFileCount($top);

        $showFileList;
        if($fileCount == 0) {
            $showFileList = false;
            $folderList = $model->getFolderList($top);
            if($top == 0) {
                $last = $model->getLastFileList();
                $this->assignRef('last', $last);
            }
            $this->assignRef('folders', $folderList);
            
        } else {
            $showFileList = true;

            $fileList = $model->getFileList($top);
            
            usort($fileList, 'cmp');
            
            $this->assignRef('files', $fileList);
            
        }
        $this->assignRef('showFileList', $showFileList);
    
        
        $path = substr($model->getPath($top), 0, -2);
        $this->assignRef('topPath', $path);
        $this->assignRef('id', $id);
    
        parent::display($tpl);
    }
}
?>
