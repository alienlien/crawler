<?php

$html = file_get_contents('hotboard.html');
$doc = new DOMDocument;
$doc->loadHTML($html);

$output = fopen('php://output', 'w');
foreach ($doc->getElementsByTagName('tr') as $tr_dom) {
  $td_doms = $tr_dom->getElementsByTagName('td');
  fputcsv($output, array(
    $td_doms->item(1)->nodeValue,
    explode("：", $td_doms->item(0)->nodeValue)[1],
    $td_doms->item(2)->nodeValue,
    ));
}
