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
            if($file->path != "")
                echo JHtml::_('link', $file->path, JText::_('COM_SERMONS_DOWNLOAD_FILE'));
                
            if($file->links != "") {
                $urls = explode("\n", $file->links);
                
                if($file->path != "")
                    echo " | ";
                
               
                foreach ($urls as $key => $value) {
                        $ext = pathinfo($value, PATHINFO_EXTENSION);
                        $isVideo = strpos($value, "justin.tv");
                        if ($isVideo !== false) {
                            $ext = "video";
                        }
                        $urls[$value] = $ext;
                }
                
                $before_ext = "";
                $counter = 0;
                foreach ($urls as $url => $ext) {
                        if($ext == $before_ext) {
                            $counter++;
                            if($ext == "video") {
                                echo "<a href='$url' onclick='return videopopup(this.href);'>".($counter)."</a> ";
                            } else {
                               echo "<a href='$url'>".($counter)."</a> "; 
                            }
                        } else {
                            $before_ext = $ext;
                            $counter = 0;
                            if($ext == "video") {
                                echo "<a href='$url' onclick='return videopopup(this.href);'>".JText::_('COM_SERMON_EXT_VIDEO')."</a> ";
                            } else if($ext == "pdf") {
                               echo "<a href='$url'>".JText::_('COM_SERMON_EXT_PDF')."</a> "; 
                            }
                        }
                }
                        
            }
            echo "</td>";

            echo "</tr>";
    }
}
echo "</table>";
echo "</div><br /><br />";