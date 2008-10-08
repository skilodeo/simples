<h2>Delete <em>"<?php echo $this->data['Post']['title']; ?>"</em> post?</h2>
<?php 
echo $form->create('Post', array('action' => 'delete'));
    echo $form->hidden('Post.id');
    echo $form->submit('Delete'); ?> or <?php echo $html->link('Back to Posts overview', '/' . Configure::read('Routing.admin') . '/posts'); ?>
<?php
echo $form->end();
?>
