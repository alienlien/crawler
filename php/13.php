<?php
$content = file_get_contents('hotboard.html');
$content = iconv('big5', 'utf-8//IGNORE', $content); 
$content = str_replace('<meta http-equiv="Content-Type" content="text/html; charset=big5" />', '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />', $content);

$pattern = '/最後更新時間 ([^\)]*)/';
preg_match($pattern, $content, $matches);
echo 'Last updated time: ', $matches[1], "\n";

?>
