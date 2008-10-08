<?php
echo $navigation->create(array(
        'Show All' => array('action' => 'index')
    ), array('id' => 'sub-nav', 'class' => 'always-current'));
?>

<div class="box">
    <h3>Editing user <?php echo $this->data['User']['name']; ?></h3>
    <?php echo 
        $form->create('User', array('action' => 'update')),
        '<div class="options-left">',
        $form->input('name', array('between' => '<br />', 'tabindex' => '1')),
        $form->input('email', array('between' => '<br />', 'tabindex' => '2')),
        '</div>',
        '<div class="options-right">',
        $form->input('login', array('between' => '<br />', 'tabindex' => '3')),
        '<p>', $html->link('Change password', array('action' => 'change_password', $this->data['User']['id'])), '</p>',
        $form->hidden('id'),
        '</div>',
        $form->end('Save');
    ?>
</div>
