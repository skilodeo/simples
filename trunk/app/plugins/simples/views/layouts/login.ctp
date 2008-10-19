<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">

	<head>
		<title>Simples</title>
		<?php
			echo $html->charset();
			echo $html->css('/simples/css/login');
		?>
	</head>

	<body>
		<div id="box">
			<?php
				echo $flash->createFlashMessage();
				echo $content_for_layout;
			?>
		</div>
		
		<script type="text/javascript">
			document.getElementById("MyUserUsername").focus();
		</script>
	</body>

</html>