<?php
jimport( 'joomla.application.component.view');
class SermonsViewFolder extends JView
{
	function display($tpl = null)
	{
		$model = &$this->getModel();
		$top = JRequest::getInt("id",0,"GET");
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
            $this->assignRef('files', $fileList);
            
        }
        $this->assignRef('showFileList', $showFileList);
     
		
        $path = substr($model->getPath($top), 0, -2);
		$this->assignRef('topPath', $path);
		$this->assignRef('top', $top);
	
		parent::display($tpl);
	}
}
?>
