<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php" method="post" name="adminForm">
<div id="editcell">
    <table class="adminlist">
    <thead>
        <tr>
            <th width="5">
                <?php echo JText::_( 'NUM' ); ?>
            </th>
            <th width="20">
                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
            </th>
            <th  class="title">
                <?php echo JHTML::_('grid.sort', JText::_( 'COM_SERMONS_TITLE' ), 'a.text', @$lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
             <th >
                <?php echo JHTML::_('grid.sort', JText::_( 'COM_SERMONS_TOPIC' ), 'a.text', @$lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
            <th>
                <?php echo JHTML::_('grid.sort', JText::_( 'COM_SERMONS_PATH' ), 'a.text', @$lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
            <th width="5%" align="center">
                <?php echo JHTML::_('grid.sort','Published', 'a.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
            <th width="20%" align="center">
                <?php echo JHTML::_('grid.sort', JText::_( 'COM_SERMONS_FOLDER' ), 'a.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
            <th width="1%" nowrap="nowrap">
                <?php echo JHTML::_('grid.sort','ID', 'a.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
            </th>
        </tr>
            
    </thead>
    <?php
    $k = 0;
    for ($i=0, $n=count( $this->items ); $i < $n; $i++)
    {
        $row = &$this->items[$i];
        
        $published = JHTML::_('grid.published', $row, $i );
        $checked = JHTML::_('grid.id',   $i, $row->id );
        $link = JRoute::_( 'index.php?option=com_sermons&controller=file&task=edit&cid[]='. $row->id );

        ?>
        <tr class="<?php echo "row$k"; ?>">
            <td>
                <?php echo $row->id; ?>
            </td>
           
            <td>
                <?php echo $checked; ?>
            </td>
            <td>
                <?php echo $row->title; ?>
            </td>
             <td>
                <a href="<?php echo $link; ?>"><?php echo $row->topic; ?></a>
            </td>
            <td>
                <?php
                if($row->title == "")
                    echo "<a href='$link'>";
                    
                echo $row->path;
                
                if($row->title == "")
                    echo "</a>";
                ?>
            </td>
            <td align="center">
                <?php echo $published;?>
            </td>
            <td align="center">
                <?php echo $row->folder;?>
            </td>
            <td align="center">
                <?php echo $row->id; ?>
            </td>
        </tr>
        <?php
        $k = 1 - $k;
    }
    ?>
    </table>
</div>

<input type="hidden" name="option" value="com_sermons" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="controller" value="file" />
</form>
