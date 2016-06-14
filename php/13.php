<?php
$content = file_get_contents('hotboard.html');
$content = iconv('big5', 'utf-8//IGNORE', $content); 
$content = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=big5" />', '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', $content);

$pattern = '!最後更新時間 ([^\)]*)!';
preg_match($pattern, $content, $matches);
echo 'Last updated time: ', $matches[1], "\n";

$pattern = '!<td width=\"100\">([^(/td)]*)</td>\s<td width=\"120\"><a href=\"([^\"]*)\">([^<]*)</a></td>\s<td width="400"><a href="([^\"]*)">([^\<]*)</a></td>!';
preg_match_all($pattern, $content, $items);

$output = fopen('php://output', 'w');
$hots = $items[1];
$links = $items[2];
$names = $items[3];
$articles = $items[5];
for ($i = 0; $i < count($items[0]); $i ++) {
    fputcsv($output, array(
        $hots[$i],
        $names[$i],
        $articles[$i],
        $links[$i],
    )); 
}

?>
