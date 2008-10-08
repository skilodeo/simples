<?php 
    if (!empty($revisions)) {
        echo 
        '<ul id="revisions" class="list revision-list">';
        
        $first = '<span class="current-revision">&mdash;current version</span>';
        foreach ($revisions as $version) {
            $attr = '';
            if (ListHelper::isOdd()) {
                $attr = ' class="odd"';
            }
            echo 
            "<li$attr>",
            '<div class="list-item">',
            $html->link("Revision {$version['Revision']['revision_number']}",
                array('action' => 'edit', 'rev' => $first ? null : $version['Revision']['revision_number'], $version['Revision']['node_id']), null, null, false),
            "<small>$first, saved {$time->niceShort($version['Revision']['created'])} by {$version['User']['name']}</small>",
            '</div>',
            '</li>';
            $first = '';
        }
        echo '</ul>';
    }
?>