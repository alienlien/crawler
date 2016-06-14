<?php
$content = file_get_contents('mobile.html');
$doc = new DOMDocument;
@$doc->loadHTML($content);

$output = fopen('php://output', 'w');
$divs = $doc->getElementsByTagName('div');
foreach ($divs as $div) {
    if ($div->getAttribute('class') != 'r-ent') {
        continue;
    }

    $divs_inner = $div->getElementsByTagName('div');
    $div_content = array();
    foreach ($divs_inner as $d) {
        $class = $d->getAttribute('class');
        if ($class == 'nrec') {
            $number = $d->getElementsByTagName('span')->item(0)->nodeValue;
            if ($number == '') {
                $number = 0;
            }
            $div_content['number'] = $number;
        } else if ($class == 'title') {
            $a = $div->getElementsByTagName('a');
            if ($a->length > 0) {
                $title = $div->getElementsByTagName('a')->item(0);
                $div_content['title'] = $a->item(0)->nodeValue;
                $div_content['link'] = $a->item(0)->getAttribute('href');
            } else {
                $div_content['title'] = '本文已被刪除';
                $div_content['link'] = '';
            }
        } else if ($class == 'date') {
            $div_content['date'] = trim($d->nodeValue);
        } else if ($class == 'author') {
            $div_content['author'] = $d->nodeValue;
        }
    }
    fputcsv($output, array(
        $div_content['number'],
        $div_content['author'],
        $div_content['date'],
        $div_content['title'],
        $div_content['link'],
    ));

}

?>
