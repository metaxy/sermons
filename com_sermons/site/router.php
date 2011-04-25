<?php
function SermonsBuildRoute(&$query)
{
    $segments = array();
    if(isset($query['view']))
    {
        $segments[] = $query['view'];
        unset($query['view']);
    }
    return $segments;
}

function SermonsParseRoute($segments)
{
    $vars = array();

    //Handle View and Identifier
    switch($segments[0])
    {
        case 'folder':
        {
            $vars['view'] = 'folder';
        } break;

        case 'file':
        {
            $vars['view'] = 'file';

        } break;
    }
        
    return $vars;
}
?>