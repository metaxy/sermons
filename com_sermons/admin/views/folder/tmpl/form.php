<?php defined('_JEXEC') or die('Restricted access'); ?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.path.value == "") {
			alert( "<?php echo JText::_( 'Folder must have a path', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div>
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>
	<table class="admintable">
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Alias' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="alias" id="alias" size="60" value="<?php echo $this->folder->alias; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="alias">
					<?php echo JText::_( 'Path' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="path" id="path" size="60" value="<?php echo $this->folder->path; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="alias">
					<?php echo JText::_( 'Top' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="top" id="top" size="60" value="<?php echo $this->folder->top; ?>" />
			</td>
		</tr>
		<tr>
			<td width="120" class="key">
				<?php echo JText::_( 'Published' ); ?>:
			</td>
			<td>
				<?php echo JHTML::_( 'select.booleanlist',  'published', 'class="inputbox"', $this->folder->published ); ?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_sermons" />
<input type="hidden" name="id" value="<?php echo $this->folder->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="folder" />
</form>
