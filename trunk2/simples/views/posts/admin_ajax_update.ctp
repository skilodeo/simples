<?php
$first = '<span class="current-revision">&mdash;current version</span>';
$revision = '';
foreach ($revisions as $version) {
    $revision .= "<li>" .
    '<div class="list-item">' .
    $html->link("Revision {$version['Revision']['revision_number']}",
        array('action' => 'edit', 'rev' => $first ? null : $version['Revision']['revision_number'], $version['Revision']['node_id']), null, null, false) .
    "<small>$first, saved {$time->niceShort($version['Revision']['created'])} by {$version['User']['name']}</small>" .
    '</div>' .
    '</li>';
    $first = '';
}

$json = array(
    'time' => $time->niceShort($post['Post']['modified']),
    'fullTime' => $time->nice($post['Post']['modified']),
    'revision' => $revision,
    'revNumber' => $version['Revision']['revision_number']
);
echo json_encode($json);
?>