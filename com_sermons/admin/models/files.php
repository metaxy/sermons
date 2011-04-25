<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport('joomla.application.component.model');


class SermonsModelFiles extends JModel
{

    var $_data;

    function _buildQuery() {
        $query = 'SELECT * FROM #__sermonsFile ';
        return $query;
    }
    function getData() {
        // Lets load the data if it doesn't already exist
        if(empty($this->_data)) {
            $query = $this->_buildQuery();
            $this->_data = $this->_getList($query);
        }

        return $this->_data;
    }

}
?>