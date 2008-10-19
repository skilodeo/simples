<div id="titlebar">
	<div class="inner">
		<h1 class="left"><?= __d($domain, 'headline:pages_index') ?></h1>
		<form class="search" action="#" method="post">
			<fieldset>
				<label for="search"><?= __d($domain, 'label:search') ?></label>
				<input type="text" name="search" id="search" value="" />
			</fieldset>
		</form>
		<br class="clear" />
	</div>
</div>

<div id="content">
	<div class="inner">
		<form class="add pages" action="<?= $html->url('/simples/my_pages/add') ?>" method="post">
			<fieldset>
				<label for="add"><?= __d($domain, 'label:add_page') ?></label>
				<input type="text" name="add" id="add" value="" />
				<input type="submit" name="addSubmit" class="submit" value="<?= __d($domain, 'button:add') ?>" />
				<p class="hide"><?= __d($domain, 'error:add') ?></p>
			</fieldset>
		</form>
		
		<form class="del" action="<?= $html->url('/simples/my_pages/del') ?>" method="post">
			<fieldset>
				<p><?= __d($domain, 'label:del_page') ?></p>
				<input type="button" name="delSubmit" id="del" class="submit off" disabled="disabled" value="<?= __d($domain, 'button:del') ?>" />
			</fieldset>
		</form>
		<br class="clear" />
		
		<table>
			<thead>
				<tr>
					<th scope="col" class="check"><input type="checkbox" value="checkall" name="checkall" id="checkall" /></th>
					<th scope="col"><?= __d($domain, 'th:name') ?></th>
					<th scope="col"><?= __d($domain, 'th:date') ?></th>
					<th scope="col"><?= __d($domain, 'th:author') ?></th>
				</tr>
			</thead>
			<tbody id="list" class="pages">
				<?= $this->render('list', false) ?>
			</tbody>
		</table>
	</div>
</div>