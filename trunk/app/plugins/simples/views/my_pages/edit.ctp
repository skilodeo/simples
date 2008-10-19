<div id="titlebar">
	<div class="inner">
		<h1><?= __d($domain, 'headline:pages_edit') ?></h1>
	</div>
</div>

<div id="content">
	<div class="back">
		<?= $html->link('Zurück zur Übersicht', '/simples/my_pages') ?>
	</div>
	
	<div class="inner">
		<?php
			/* open article form */
			echo $form->create('MyPage', array('url' => '/simples/my_pages/edit/'.$pageId, 'class' => 'main'));
			$error = array('wrap' => 'p', 'class' => 'error');
			$clear = '<br class="clear" />';
			
			/* name */
			echo '<fieldset>';
				echo $form->input('name', array('label' => 'Name*:', 'maxLength' => 50, 'div' => array('class' => 'input largeFont'),
					'after' => $clear, 'error' => $error));
			echo '</fieldset>';
			
			/* short & full text */
			echo '<p class="desc">Texte der Seite. Eine kurze Einleitung und der eigentliche Artikel (Formatierung via Markdown).</p>';
			echo '<fieldset>';
				echo $form->input('txt_short', array('label' => 'Einleitung:', 'div' => array('class' => 'input heightS'),
					'after' => $clear, 'error' => $error));
				
				echo $form->input('txt_full', array('label' => 'Artikel:', 'div' => array('class' => 'input heightL'),
					'after' => $clear, 'error' => $error));
			echo '</fieldset>';
			
			/* close article form */
			echo $form->submit('Speichern', array('div' => array('class' => 'submit left')));
			echo $common->createModifiedTimestamp($this->data['MyPage']['modified']);
			
			echo $clear;
			echo $form->end();
			
			/* imgPreview */
			echo '<div class="form main follow">';
				echo '<p>Vorschaubild:</p>';
				echo $list->createMediaList($this->data['ImgPreview'], $pageId, 'preview');
				echo $clear;
			echo '</div>';
			echo $html->link('Hochladen und hinzufügen?', '/simples/my_media/upload_for_page/'.$pageId.'/preview?height=300&width=500', array('class' => 'button thickbox'));
			echo $clear;
			
			/* imgMain */
			echo '<div class="form main follow">';
				echo '<p>Hauptbilder:</p>';
				echo $list->createMediaList($this->data['ImgMain'], $pageId, 'main');
				echo $clear;
			echo '</div>';
			echo $html->link('Hochladen und hinzufügen?', '/simples/my_media/upload_for_page/'.$pageId.'/main?height=300&width=500', array('class' => 'button thickbox'));
			echo $clear;
		?>
	</div>
</div>