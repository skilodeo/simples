<div class="sitemap">
<?php echo $form->create('Sitemap');?>
	<fieldset>
 		<legend><?php echo sprintf(__('Add %s', true), __('Sitemap', true));?></legend>
	<?php
		echo $form->input('lft');
		echo $form->input('rght');
		echo $form->input('parent_id');
		echo $form->input('loc');
		echo $form->input('lastmod');
		echo $form->input('changefreq');
		echo $form->input('priority');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(sprintf(__('List %s', true), __('Sitemaps', true)), array('action'=>'index'));?></li>
	</ul>
</div>
