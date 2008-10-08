<?php echo $this->element('admin_comments_sub_nav') ?>

<h2 class="top">Approved Comments</h2>

<?php
    echo
    $commentsList->create($comments),
    $navigation->paginator();
?>
