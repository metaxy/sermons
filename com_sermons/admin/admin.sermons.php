<?php
defined('_JEXEC') or die('Restricted access');
require_once(JPATH_COMPONENT.DS.'controller.php');

if($controller = JRequest::getVar('controller'))
{
    require_once(JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php');
}

$classname = 'SermonsController'.$controller;
$controller = new $classname();

$controller->execute(JRequest::getVar('task'));

$controller->redirect();

?>
