<?php
defined('_JEXEC') or die();
jimport('joomla.application.component.model');

class SermonsModelFile extends JModel
{
	
	function getFile($id = 0)
	{
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__sermonsFile WHERE id='$id'";
		$db->setQuery($query);
		$result = $db->loadRow();
		return $result;
	}
}
?>