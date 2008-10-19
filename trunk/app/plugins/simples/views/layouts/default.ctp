<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

	<head>
		<title>Simples</title>
		<?php
			echo $html->charset();
			echo $html->css('/simples/css/screen');
			
			echo $javascript->link(array(
				'/simples/js/jquery',
				'/simples/js/jquery.checkgroup',
				'/simples/js/jquery.livequery'
			));
			
			echo $javascript->link(array(
				'/simples/js/thickbox',
				'/simples/js/custom'
			));
		?>
	</head>

	<body>
		<div id="header">
			<div class="inner">
				<?= $this->renderElement('header') ?>
			</div>
		</div>
		<div><input type="hidden" name="baseurl" id="baseurl" value="<?= $html->url('') ?>" /></div>
		<?= $content_for_layout ?>
	</body>

</html>