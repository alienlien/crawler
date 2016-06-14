<?php
$content = file_get_contents('hotboard.html');
// echo $content;
$doc = new DOMDocument;
libxml_use_internal_errors(true);
$doc->loadHTML($content);

$tables = $doc->getElementsByTagName('table');
$output = fopen('php://output', 'w');
foreach ($tables as $table) {
    $td_doms = $table->getElementsByTagName('td');
    fputcsv($output, array(
        $td_doms->item(0)->nodeValue,
        $td_doms->item(1)->nodeValue,
        $td_doms->item(2)->nodeValue,
    )); 
}
?>
