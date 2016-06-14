<?php
$content = file_get_contents('grade.html');
$doc = new DOMDocument;
libxml_use_internal_errors(true);
$doc->loadHTML($content);

$table = $doc->getElementsByTagName('table')->item(0);
$tagsAndData = $table->getElementsByTagName('tr');
// $tags = $tagsAndData->item(0);
$array = array();
for ($i = 1; $i < $tagsAndData->length; $i ++) {
    $data = $tagsAndData->item($i)->getElementsByTagName('td');
    $array[] = array(
        'name' => $data->item(0)->nodeValue,
        'grade' => array(
            '國語' => $data->item(1)->nodeValue,
            '數學' => $data->item(2)->nodeValue,
            '自然' => $data->item(3)->nodeValue,
            '社會' => $data->item(4)->nodeValue,
            '健康教育' => $data->item(5)->nodeValue,
        ),
    );
}
echo json_encode($array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT); 
?>
