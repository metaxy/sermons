<?php 
defined('_JEXEC') or die('Restricted access'); 
?>
<h1><?php echo $this->file[1]; ?></h1>
Thema : <?php echo $this->file[3]?><br />
Prediger : <?php echo $this->file[2]?><br />
Datum : <?php echo $this->file[5]?><br />
Download : <?php echo JHtml::_('link', $this->file[4], "MP3"); ?><br />