<form action="<?= $html->url('/simples/my_media/upload_for_page') ?>" method="post" enctype="multipart/form-data" class="main hide followDirectly">
	<input type="hidden" name="imgKey" value="preview" />
	<input type="hidden" name="pageId" value="'.$this->data['MyPage']['id'].'" />
	
	<fieldset>
		<label>Bild:</label>
		<input type="file" name="upload[]" value="" />
	</fieldset>
	
	<?= $form->submit($imgPreviewLabel, array('div' => array('class' => 'submit left'))); ?>
	<?= $html->link('oder Abbrechen', '#', array('class' => 'cancel')); ?>
	<br class="clear" />
</form>