<?php
jimport( 'joomla.application.component.view');
class SermonsViewFile extends JView
{
	function display($tpl = null)
	{
		$model = &$this->getModel();
		$id = JRequest::getInt("id", 0, "GET");
		$file = $model->getFile($id);
		$this->assignRef('file', $file);
		parent::display($tpl);
	}	
}
?>
