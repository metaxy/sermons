<?php 
defined('_JEXEC') or die('Restricted access');
$document =& JFactory::getDocument();
$document->addStyleSheet("components/com_sermons/com_sermons.css");
?>
<script type="text/javascript">
function videopopup (url) {
fenster = window.open(url, "Video", "width=400,height=300,resizable=yes");
fenster.focus();
return false;
}
</script>
<div id="com_sermons">
<h1><?php echo $this->topPath;?></h1>
<?php


if($this->showFileList == false) {

    if($this->id == 0) {
        if(count($this->folders) > 0) {
            echo "<div id='welcome'>".JText::_('COM_SERMONS_WELCOME')." ";
            $i = 0;
            foreach ($this->folders as $folder) {
                $link = JRoute::_('index.php?option=com_sermons&view=folder&id='.$folder->id);
                if($i != 0) {
                    echo " | ";
                }
                echo "<span class='big'>" .JHtml::_('link', $link, $folder->alias). "</span>";
                $i++;
            }
            echo "</div>";
        }

        echo "<div id='lastestbox'>";
        echo "<h3 id='ltitle'>".JText::_('COM_SERMONS_LAST_SERMONS')."</h3><br />";
        echo "<table id='lfoldertable' cellspacing='0'>";
        echo "<tr>";
        echo "<th scope='col' class='left'>".JText::_('COM_SERMONS_TITLE')."</th>";
        echo "<th scope='col'>".JText::_('COM_SERMONS_TOPIC')."</th>";
        echo "<th scope='col'>".JText::_('COM_SERMONS_SPEAKER')."</th>";
        echo "<th scope='col'>".JText::_('COM_SERMONS_DATE')."</th>";
        echo "<th scope='col'>".JText::_('COM_SERMONS_DOWNLOAD')."</th>";
        echo "</tr>";

        foreach ($this->last as $file) {
                echo "<tr>";
                echo "<th class='spec' scope='row'>$file->title</th>";
                echo "<td>$file->topic</td>";
                echo "<td>$file->speaker</td>";
                echo "<td>$file->date</td>";
                
                echo "<td>";
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
        echo "</table>";
        echo "</div><br /><br />";

        $link = JRoute::_('index.php?option=com_sermons&view=folder&id=-1');
        echo JHtml::_('link', $link, JText::_('COM_SERMON_SHOW_ALL_SERMONS')). "<br />";
    } else {
        foreach ($this->folders as $folder) {
            $link = JRoute::_('index.php?option=com_sermons&view=folder&id='.$folder->id);
            echo JHtml::_('link', $link, $folder->alias). " <br />";
        }
    }
} else {


    echo "<table id='foldertable' cellspacing='0'><tr><th scope='col' class='left'>".JText::_('COM_SERMONS_TITLE')."</th>";
    
    $topicSort = JRoute::_('index.php?option=com_sermons&view=folder&id='.JRequest::getInt("id",0,"GET")."&sort=topic" );
    echo "<th scope='col'>".JHtml::_('link', $topicSort, JText::_('COM_SERMONS_TOPIC'))."</th>";
    
    $speakerSort = JRoute::_('index.php?option=com_sermons&view=folder&id='.JRequest::getInt("id",0,"GET")."&sort=speaker" );
    echo "<th scope='col'>".JHtml::_('link', $speakerSort, JText::_('COM_SERMONS_SPEAKER'))."</th>";
    
    $dateSort = JRoute::_('index.php?option=com_sermons&view=folder&id='.JRequest::getInt("id",0,"GET")."&sort=date" );
    echo "<th scope='col'>".JHtml::_('link', $dateSort, JText::_('COM_SERMONS_DATE'))."</th>";
    
    echo "<th scope='col'>".JText::_('COM_SERMONS_DOWNLOAD')."</th></tr>";
    foreach ($this->files as $file) {
        echo "<tr>";
        echo "<th class='spec' scope='row'>$file->title</th>";
        echo "<td>$file->topic</td>";
        echo "<td>$file->speaker</td>";
        echo "<td>$file->date</td>";
        echo "<td>";
        echo JHtml::_('link', $file->path, JText::_('COM_SERMONS_DOWNLOAD_FILE'));
        if($file->links != "") {
            $urls = explode("\n", $file->links);
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
    echo "</table>";
}
?>
</div>
