<?php
echo $navigation->create(array(
        'Show All' => array('action' => 'index')
    ), array('id' => 'sub-nav', 'class' => 'always-current'));
?>

<div class="box">
    <h3>Change password for user <?php echo $this->data['User']['name']; ?></h3>
    <?php echo 
        $form->create('User', array('action' => 'update_password')),
        $form->input('password', array('between' => '<br />', 'label' => 'New password', 'tabindex' => '1')),
        $form->input('confirm_password', array('between' => '<br />', 'label' => 'New password again', 'type' => 'password', 'tabindex' => '2')),
        $form->hidden('name'),
        $form->hidden('id'),
        $form->end('Save');
    ?>
</div>
