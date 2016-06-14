<?php
$url = 'http://map.tgos.nat.gov.tw/TGOSCloud/Generic/Project/GHTGOSViewer_Map.ashx?pagekey=HkbSOeJ9973jXIVJwHoYeYaxEnnr0akW';

$road = '中興路';

$params = array();
$params['method'] = 'querymoiaddr';
$params['useoddeven'] = 'false';
$params['sid'] = 'vxrthrxxfqtswe4x4ogbfyg2';
$params['address'] = $road;
$post = http_build_query($params);

$cookie = array(
    'cookie: ASP.NET_SessionId=vxrthrxxfqtswe4x4ogbfyg2; slb_cookie=2495956946.20480.0000; _ga=GA1.3.99057826.1464182641'
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_REFERER, 'http://map.tgos.nat.gov.tw/TGOSCloud/Web/Map/TGOSViewer_Map.aspx?addr=%E5%BF%A0%E5%AD%9D%E6%9D%B1%E8%B7%AF');
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
curl_setopt($curl, CURLOPT_HTTPHEADER, $cookie);
curl_setopt($curl, CURLOPT_POST, true);
$content = curl_exec($curl);
curl_close($curl);

echo 'Content:', $content, "\n";

?>
