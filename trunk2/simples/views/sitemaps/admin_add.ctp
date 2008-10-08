<div class="sitemap">
    <h2>Add new node</h2>

<?php echo $form->create('Sitemap');?>
	<fieldset>
	<?php
		echo $form->input('parent_id', array('type' => 'select', 'options' => $parentNodes));
		echo $form->input('loc');
		echo $form->input('changefreq', array('type' => 'select', 'options' => array('', 'always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never')));
		echo $form->input('priority');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
