<?php
header('Content-Type: application/json');
$url = isset($_GET['url']) ? $_GET['url'] : '';

if (empty($url)) {
    echo json_encode(array('error' => 'URL is empty'));
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$response = curl_exec($ch);
curl_close($ch);
echo $response;
?>
