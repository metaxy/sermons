<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class TableFile extends JTable
{
    var $id = 0;
    var $title = '';
    var $speaker = '';
    var $topic = '';
    var $path = '';
    var $date = '';
    var $folder = 0;
    var $published = 0;
    var $video = '';
    var $privateFile = 0;
    function TableFile(& $db) {
        parent::__construct('#__sermonsFile', 'id', $db);
    }
}
?>
