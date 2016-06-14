<?php
$page_first = 1;
$page_last = 12;
$total_items = array();
for ($i = (int)$page_first; $i <= (int)$page_last; $i ++) {
    $url = 'http://axe-level-1.herokuapp.com/lv2/?page=' . $i;

    error_log($url); 
    $content = file_get_contents($url);
    $doc = new DOMDocument;
    libxml_use_internal_errors(true);
    $doc->loadHTML($content);

    $data = $doc->getElementsByTagName('tr');
    for ($j = 1; $j < $data->length; $j ++) {
        $dom_item = $data->item($j)->getElementsByTagName('td');
        $item = array();
        $item['town'] = $dom_item->item(0)->nodeValue;
        $item['village'] = $dom_item->item(1)->nodeValue;
        $item['name'] = $dom_item->item(2)->nodeValue;
        $total_items[] = $item;
    }
}
echo json_encode($total_items, JSON_UNESCAPED_UNICODE);
?>
