<ul>
	<?php
		$menu = array('dashboard', 'menus', 'pages');
		
		foreach ($menu AS $item) {
			if (('my'.$item) == low($this->name)) { $class = ' class="on"'; } else { $class = ''; }
			echo '<li'.$class.'>'.$html->link(__d($domain, 'title:'.$item, true), '/simples/my_'.$item).'</li>'; 
		}
	?>
</ul>

<ul class="right">
	<li>
		<fieldset>
			<form action="<?= $html->url('') ?>" method="post">
				<select name="pageLanguage" id="pageLanguage" size="1"<?= ($this->action != 'index') ? ' disabled="disabled" class="off"' : '' ?>>
					<option value="de"<?= ($pageLanguage == 'de') ? ' selected="selected"' : '' ?>>Deutsch</option>
					<option value="en"<?= ($pageLanguage == 'en') ? ' selected="selected"' : '' ?>>Englisch</option>
				</select>
			</form>
		</fieldset>
	</li>
	<li class="logout"><?= $html->link(__d($domain, 'title:logout', true), '/simples/myUsers/logout') ?></li>
</ul>
<br class="clear" />