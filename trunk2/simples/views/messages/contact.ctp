<h2><?php echo $page['Page']['title']; ?></h2>
<?php echo $page['Page']['content']; ?>

<?php $session->flash(); ?>

<?php
    echo $form->create('Message', array('url' => '/contact/create', 'class' => 'contact-form'));
    echo "<fieldset>\n";
    echo "<legend>Contact form</legend>\n";
    echo $form->input('name');
    echo $form->input('email');
    echo $form->input('phone');
    echo $form->input('subject');
    echo $form->input('content', array('type' => 'textarea'));
    echo $form->submit('Send my message');
    echo "</fieldset>\n";
    echo $form->end();
?>

<?php echo $this->element('edit_this', array('id' => $page['Page']['id'], 'controller' => 'pages')) ?>
