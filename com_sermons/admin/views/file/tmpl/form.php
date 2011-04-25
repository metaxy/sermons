<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHtml::_('behavior.modal'); ?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		/*if (form.path.value == "") {
			alert( "<?php echo JText::_( 'File must have a path', true ); ?>" );
		} else {*/
			submitform( pressbutton );
		/*}*/
	}
	String.prototype.ltrim = function (clist) 
	{
		if (clist)
			return this.replace (new RegExp ('^[' + clist + ']+'), '');
		return this.replace (/^\s+/, '');
	};

	String.prototype.rtrim = function (clist) 
	{
		if (clist)
			return this.replace (new RegExp ('[' + clist + ']+$'), '');
		return this.replace (/\s+$/, '');
	};
	String.prototype.trim = function (clist) 
	{
		if (clist)
			return this.ltrim (clist).rtrim (clist);
		return this.ltrim ().rtrim ();
	};

	function pharse(string)
	{
		var date;
		var prediger;
	
		var lastSep = string.lastIndexOf("/");
		var path = string.substr(0,lastSep);
		string = string.substr(lastSep+1);
		
		var year="";
		var lang="";
		res = path.match(/\d\d\d\d/);
		if (res) {
			year = res; 
		}
		
		res = path.match(/de/);
		if (res) {
			lang = "Deutsch"; 
		}
		
		res = path.match(/ru/);
		if (res) {
			lang = "Russisch"; 
		}
		for(var i=0; i<document.forms["adminForm"].elements["folder"].options.length;i++)
		{

			if(document.forms["adminForm"].elements["folder"].options[i].text  == lang+"/"+year) {
				document.forms["adminForm"].elements["folder"].options[i].selected = true;
			}
		}
		var suf = string.lastIndexOf(".");
		string = string.substr(0,suf);
		string = string.replace(/(\_+)/g," ");
		
		res = string.match(/\d\d\d\d-\d\d-\d\d/);
		string = string.replace(/\d\d\d\d-\d\d-\d\d/,"");
		if (res) {
			date = res; 
			document.getElementById('date').value = date;
		}
		
		res = string.match(/\((.*)\)/);
		string = string.replace(/\((.*)\)/,"");
		if (res) {
			prediger = res; 
			prediger = prediger[1];
			document.getElementById('prediger').value = prediger;
		}
		string = string.replace(/\[(.*)\]/,"");
		var res1 = string.search(/Predigt(\s*)(-*)/);
		if(res && res1 != -1) {
			string = string.replace(/Predigt(\s*)(-*)/,"");
			document.getElementById('title').value = "Predigt";
		}
		string = string.trim();
		document.getElementById('topic').value = string;
		//selecet the correct dir
		//remove lang
		//remove suffix
		//if containts predigt set title predigt
		//remove it and the rest is the topic
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
					<?php echo JText::_( 'Title' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="title" id="title" size="60" value="<?php echo $this->file->title; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Prediger' ); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="prediger" id="prediger" size="60" value="<?php echo $this->file->prediger; ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo htmlentities(JText::_( 'Topic' )); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="topic" id="topic" size="60" value="<?php echo htmlspecialchars($this->file->topic); ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Path' ); ?>:
				</label>
			</td>
			<td>
			<?php if($this->file->path) {?>
				<input class="inputbox" type="text" name="path" id="path" size="60" value="<?php echo $this->file->path; ?>" />
				<?php } else {?>
				<select name="path" size="30" onchange="pharse(this.form.path.options[this.form.path.selectedIndex].value)">
				<?php
					echo $this->notUsed;
				?>
				</select>
				<?php } ?>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo htmlentities(JText::_( 'Video' )); ?>:
				</label>
			</td>
			<td>
				<input class="inputbox" type="text" name="video" id="video" size="60" value="<?php echo htmlspecialchars($this->file->video); ?>" />
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Date' ); ?>:
				</label>
			</td>
			<td>
				<?php echo JHtml::_('calendar', $this->file->date, "date", "date"); ?>
			</td>
		</tr>
		<tr>
			<td width="110" class="key">
				<label for="title">
					<?php echo JText::_( 'Folder' );?>:
				</label>
			</td>
			<td>
			<select name="folder" id="folder">
			<?php
			for($i=0;$i<count($this->folders);$i++) {
				$add = "";
				if($this->foldersID[$i] == $this->file->folder) {
					$add = " selected='selected' ";
				}
				echo "<option value='".$this->foldersID[$i]."' $add>".$this->folders[$i]."</option>";
			}
/*echo $this->file->folder;*/
			?>
			</select>
				
			</td>
		</tr>
		<tr>
			<td width="120" class="key">
				<?php echo JText::_( 'Published' ); ?>:
			</td>
			<td>
				<?php if(!$this->file->folder) $this->file->published = true; echo JHTML::_( 'select.booleanlist',  'published', 'class="inputbox"', $this->file->published ); ?>
			</td>
		</tr>
	</table>
	</fieldset>
</div>
<div class="clr"></div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_sermons" />
<input type="hidden" name="id" value="<?php echo $this->file->id; ?>" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="controller" value="file" />
</form>
