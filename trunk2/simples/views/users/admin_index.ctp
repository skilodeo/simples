<?php
    // The list node
    function listItemCallback($node, $html) {
        $editLink = $html->link($node['User']['name'], 
           array('action' => 'edit', 'id' => $node['User']['id']),
           array('title' => 'Edit'));
        
        return '<div class="list-item">' . $editLink . '</div>';
    }

    echo
	$navigation->create(array(
	        'Delete' => '#Delete', 
	    ), array('id' => 'list-toolbar')),	
	$list->create($users, array('model' => 'User', 'class' => 'list selectable-list'));
?>

<div id="new-user">
    <h3>Add a new user account</h3>
    <?php echo 
        $form->create('User', array('action' => 'create')),
        $form->input('name', array('between' => '<br />', 'tabindex' => '1')),
        $form->input('email', array('between' => '<br />', 'tabindex' => '2')),
        $form->input('login', array('between' => '<br />', 'tabindex' => '3')),
        $form->input('password', array('between' => '<br />', 'tabindex' => '4')),
        $form->input('confirm_password', array('between' => '<br />', 'type' => 'password', 'tabindex' => '5')),
        $cms->submit('Create'),
        $form->end();
    ?>
</div>
    