<?php
$content = file_get_contents('push.html');
$doc = new DOMDocument; 
@$doc->loadHTML($content);

$divs = $doc->getElementsByTagName('div');
$output = fopen('php://output', 'w');
foreach ($divs as $div) {
    if ($div->getAttribute('class') != "push") {
        continue;
    }

    $push_obj = array();
    foreach ($div->getElementsByTagName('span') as $span) {
        $span_val = trim($span->nodeValue);
        $class = $span->getAttribute('class');
        $classes = explode(' ', $class);

        if (in_array('push-tag', $classes)) {
            $push_obj['type'] = $span_val;
        } else if (in_array('push-userid', $classes)){
            $push_obj['id'] = $span_val;   
        } else if (in_array('push-content', $classes)) {
            $push_obj['content'] = $span_val;
        } else if (in_array('push-ipdatetime', $classes)) {
            $push_obj['time'] = $span_val;
        }
    }
    fputcsv($output, array(
        $push_obj['type'],
        $push_obj['id'],
        $push_obj['content'],
        $push_obj['time'],
    ));
}
?>
