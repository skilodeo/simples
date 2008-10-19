<h1 class="float"><?= __('h1:'.$paramMain) ?></h1>
<h2 class="follow"><?= __('h2:'.$paramBy) ?></h2>

<form id="submenu-form" action="<?= $html->url('/'.$paramMain.'/'.$paramBy); ?>" method="post">
	<fieldset>
		<select size="1" name="submenu" id="submenu">
			<?php
				foreach($submenu AS $item) {
					if ($paramList == $item['Menu']['slug']) { $select = ' selected="selected"'; } else { $select = ''; }
					echo '<option value="'.$item['Menu']['slug'].'"'.$select.'>'.$item['Menu']['name'].'</option>';
				}
			?>
		</select>
		<input type="submit" name="submit" id="submenu-btn" class="btn" value="" />
	</fieldset>
</form>
<br class="clear" /><hr />

<div class="showcase">
	<?php
		if (!empty($productList)) {
			echo $this->renderElement('product_list');
		} else {
			__('error:no_products');
		}
	?>
	<br class="clear" />
</div>