<?php

	$pageTitle = 'FERROTEC GmbH : ';
		if (empty($pageKey)) { $pageTitle .= 'Ihr Plomben-Spezialist für Stahl- und Sicherheitstechnik'; }
		else { $pageTitle .= __('page_title:'.$pageKey, TRUE); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<title><?= $pageTitle ?></title>
		<?php
			echo $html->charset();
			echo $html->css('screen');
			
			echo $javascript->link(array('prototype', 'borders', 'tooltip', 'custom'));
		?>
		<!--[if lt IE 8]>
			<?= $html->css('lib/ie') ?>
		<![endif]-->
	</head>
	
	<body>
		<div id="center">
			<div id="header">
				<?= $list->createMenuList($menuStructure, (!empty($pageSlug)) ? $pageSlug : '') ?>
				<?= $language->createLangLink($lang,$allLanguages) ?>
				<br class="clear" />
			</div>
			
			<div id="between">
				<?=
					$html->link(
						$html->image('logo.gif', array('alt' => 'FERROTEC GmbH', 'width' => '191', 'height' => '70')),
						'/', false, false, false
					)
				?>
				<div class="search-wrapper">
					<form action="<?= $html->url('/search'); ?>" method="post">
						<fieldset>
							<input type="text" name="search" id="search" value="<?= __('search:input_value') ?>" maxlength="30" onfocus="this.value=''" />
							<input type="submit" name="submit" class="btn" value="" />
						</fieldset>
					</form>
				</div>
				<br class="clear" />
			</div>
			
			<div id="content">
				<?= $content_for_layout; ?>
				<br class="clear" />
			</div>
			
			<div id="footer">
				<p>
					FERROTEC GmbH<br />
					Stahl- und Sicherheitstechnik<br />
					Friedrich-Ebert-Str. 3 A<br />
					D-23858 Reinfeld
 				</p>
 				<p>
					Fon: +49 (0) 45 33 / 39 65<br />
					Fax: +49 (0) 45 33 / 44 58<br />
					Mail: <a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#105;&#110;&#102;&#111;&#064;&#102;&#101;&#114;&#114;&#111;&#116;&#101;&#099;&#045;&#103;&#109;&#098;&#104;&#046;&#099;&#111;&#109;">&#105;&#110;&#102;&#111;&#064;&#102;&#101;&#114;&#114;&#111;&#116;&#101;&#099;&#045;&#103;&#109;&#098;&#104;&#046;&#099;&#111;&#109;</a><br />
					Web: <a href="http://ferrotec-gmbh.com">ferrotec-gmbh.com</a>
				</p>
				<p>
					© 2008 FERROTEC GmbH<br />
					All rights reserved
				</p>
				<br class="clear" />
			</div>
		</div>
	</body>

</html>