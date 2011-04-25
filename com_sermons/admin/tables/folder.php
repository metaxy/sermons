<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableFolder extends JTable
{
    var $id = 0;
    var $alias = '';
    var $path = '';
    var $top = 0;
    var $published = 0;

    function TableFolder(& $db) {
        parent::__construct('#__sermonsFolder', 'id', $db);
    }
}
?>
