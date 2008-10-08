<?php
echo $navigation->create(array(
        'Show All' => array('action' => 'index')
    ), array('id' => 'sub-nav', 'class' => 'always-current'));
?>

<div id="category-form">
    <h3>Editing <em><?php echo hsc($this->data['Category']['title']) ?></em> category</h3>
    <?php
        echo 
        $form->create('Category'),
        '<div class="options-left">',
        $form->input('title', array('between' => '<br />'));
        if (!empty($parentCategories)) {
            echo $form->label('parent_id', 'Parent category'), 
                '<br />',
                $form->select('parent_id', $parentCategories);
        }
        echo 
        '</div>',
        '<div class="options-right">',
        $form->input('description', array('between' => '<br />', 'type' => 'textbox')),
        '</div>',
        $form->submit('Save'),
        $form->hidden('id'),
        $form->end();
    ?>
</div>