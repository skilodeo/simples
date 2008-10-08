<?php 
echo $navigation->create(array(
        'Mark as spam' => '#',
        'Delete' => '#',
        'All messages' => array('action' => 'index'),
    ), array('id' => 'sub-nav'));
?>

<table class="message-view">
    <tbody>
        <?php
            $mailto = '&lt;<a href="mailto:' . $message['Message']['email'] . '">'
                . $message['Message']['email'] . '</a>&gt;';
        ?>
        <tr><th>From</th><td><?php echo hsc($message['Message']['name']), ' ', $mailto; ?></td></tr>
        <tr><th>Received</th><td><?php echo $time->niceShort($message['Message']['created']) ?></td></tr>
        <tr><th>Phone</th><td><?php echo hsc($message['Message']['phone']) ?></td></tr>
        <tr><th>Subject</th><td><?php echo hsc($message['Message']['subject']) ?></td></tr>
        <tr><th>Content</th><td><?php echo hsc($message['Message']['content']) ?></td></tr>
    </tbody>
</table>
