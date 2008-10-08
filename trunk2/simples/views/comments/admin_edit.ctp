<h2 class="top">Editing comment #<?php echo $this->data['Comment']['id'] ?></h2>

<?php
    if ($session->check('Message.flash')) {
        $session->flash();
    }

    $postUrl = '/' . SIMPLES_POSTS_INDEX . '/' . $this->data['Post']['slug'];
    echo $form->create('Comment', array('action' => 'update')),
         $form->hidden('Post.slug'), 
         $form->hidden('Post.id'), 
         $form->hidden('Post.permalink', array('value' => $html->url($postUrl, true))), 
         $form->hidden('id'), 
         $form->input('name'), 
         $form->input('email'), 
         $form->input('url'), 
         $form->input('content'), 
         $form->input('spam', array('type' => 'checkbox')),
         $form->end('Save changes'); 
?>

<div id="sidebar">
    <?php echo $html->link('All comments', array('action' => 'index')) ?>
    <?php echo $html->link('Comments marked as spam', array('action' => 'spam')) ?>
    <?php echo $html->link('Delete this comment', array('action' => 'delete_confirmation', 'id' => $this->data['Comment']['id'])) ?>
</div>