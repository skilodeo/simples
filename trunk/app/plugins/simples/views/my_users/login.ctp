<?php

	echo $form->create('User', array('url' => '/simples/my_users/login'));
	$clear = '<br class="clear" />';
	
	echo $form->input('username', array('label' => 'Benutzer:', 'maxLength' => 30, 'after' => $clear));
	echo $form->input('password', array('label' => 'Passwort:', 'maxLength' => 30, 'after' => $clear));
	
	echo $form->end('Anmelden');
	echo $clear;

?>