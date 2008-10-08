<?php if ($isLogged) { ?>
<p>You are already logged in. There's no need to do it again. <?php echo $html->link('Go to admin area', '/' . Configure::read('Routing.admin')); ?>.</p>
<?php } ?>
<?php
echo $form->create('User', array('url' => '/login'));
echo $form->input('login', array('between' => '<br />'));
echo $form->input('password',  array('between' => '<br />'));
?>
<div id="remember"><?php echo $form->input('remember', array(
	'type' => 'checkbox',
	'label' => 'Remember me?')); ?></div>
<?php
echo $form->submit('Log in');
echo $form->end();
?>
<p id="gohome"><?php echo $html->link("Back to $siteName", '/'); ?></p>
