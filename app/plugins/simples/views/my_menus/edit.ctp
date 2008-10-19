<div id="titlebar">
	<div class="inner">
		<h1><?= __d($domain, 'headline:menus_edit') ?></h1>
	</div>
</div>

<div id="content">
	<div class="back">
		<?= $html->link('Zurück zur Übersicht', '/simples/my_menus') ?>
	</div>
	
	<div class="inner">
		<?php
			/* open form */
			echo $form->create('MyMenu', array('url' => '/simples/my_menus/edit/'.$menuId, 'class' => 'main'));
			$error = array('wrap' => 'p', 'class' => 'error');
			$clear = '<br class="clear" />';
			
			/* name */
			echo '<p class="desc">Name und Slug des Navigationspunkt. Der Slug identifiziert den Navigationspunkt in der URL<br />'
				.'und darf deshalb weder Sonder- oder Leerzeichen, Umlaute oder Großbuchstaben beinhalten.</p>';
			echo '<fieldset>';
				echo $form->input('name', array('label' => 'Name*:', 'maxLength' => 50, 'div' => array('class' => 'input largeFont'),
					'after' => $clear, 'error' => $error));
				echo $form->input('slug', array('label' => 'Slug*:', 'maxLength' => 50, 'div' => array('class' => 'input'),
					'after' => $clear, 'error' => $error));
			echo '</fieldset>';
			
			/* parent & page */
			echo '<p class="desc">Welchem Navigationspunkt soll dieser Navigationspunkt untergeordnet<br />'
				.'werden und mit welcher Seite soll er verknüpft werden?</p>';
			echo '<fieldset>';
//				echo $form->input('template_id',
//					array('label' => 'Template*:', 'type' => 'select', 'options' => $templateList, 'empty' => '', 'escape' => false,
//					'after' => $clear, 'error' => $error));
				echo $form->input('parent_id',
					array('label' => 'Als Unterpunkt von:', 'type' => 'select', 'options' => $menuList, 'empty' => '', 'escape' => false,
					'after' => $clear, 'error' => $error));
				echo $form->input('page_id',
					array('label' => 'Verknüpft mit Seite:', 'type' => 'select', 'options' => $pageList, 'empty' => '', 'escape' => false,
					'after' => $clear, 'error' => $error));
			echo '</fieldset>';
			
			/* close form */
			echo $form->submit('Speichern', array('div' => array('class' => 'submit left')));
			echo $common->createModifiedTimestamp($this->data['MyMenu']['modified']);
			
			echo $clear;
			echo $form->end();
		?>
	</div>
</div>