<?php
defined('_JEXEC') or die('Restricted access');
$document =& JFactory::getDocument();
$document->addStyleSheet("components/com_sermons/com_sermons.css");

$db =& JFactory::getDBO();
        
$user =& JFactory::getUser();
$private = "";
if($user->guest) {
    $private = " WHERE privateFile='0'";
}

$query = "SELECT * FROM #__sermonsFile ".$private . "ORDER BY id DESC LIMIT 6";

$db->setQuery($query);
$result = $db->loadObjectList();


echo "<div id='mod_sermons_lastest'>";
echo "<table class='foldertable' cellspacing='0'>";
echo "<tr>";
echo "<th scope='col' class='left'>".JText::_('COM_SERMONS_TOPIC')."</th>";
echo "<th scope='col'>".JText::_('COM_SERMONS_DOWNLOAD')."</th>";
echo "</tr>";
if($result != 0) {
    foreach ($result as $file) {
            echo "<tr>";
            $link = JRoute::_('index.php?option=com_sermons&view=file&id='.$file->id);
            echo "<th class='spec' scope='row'>". JHtml::_('link', $link, $file->topic)."</th>";
            
            echo "<td style='text-align: center;'>";
            echo JHtml::_('link', $file->path, JText::_('COM_SERMONS_DOWNLOAD_FILE'));
            if($file->links != "") {
                $urls = explode("\n", $file->video);
                if(count($urls) == 1) {
                    echo " | " . "<a href='$file->video' onclick='return videopopup(this.href);'>".JText::_('COM_SERMONS_VIDEO')."</a>";
                } else {
                    echo " | ".JText::_('COM_SERMONS_VIDEO')." "; 
                    foreach ($urls as $key => $value) {
                        echo "<a href='$value' onclick='return videopopup(this.href);'>".($key+1)."</a> ";
                    }
                }
                        
            }
            echo "</td>";

            echo "</tr>";
    }
}
echo "</table>";
echo "</div><br /><br />";