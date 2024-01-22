<?php
error_reporting(-1);

$q = 10;
$limit = 25;
$key = "AIzaSyDtkLuVTXRFQlFJucTK9hjMhnFSJ8hj-vw"; //
$cacheFolder =  'cached/';


$msg = "not cached";


echo '<pre>';
$gdata = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . urlencode(str_replace("-", "+", $q)) . '&maxResults=' . $limit . '&key=' . $key);


$result = json_decode($gdata, true);
$vResult = array();
foreach ($result['items'] as $res) {
    print_r($res);
    $vData['videoId'] = $res['id']['videoId'];
    $vData['channelId'] = $res['snippet']['channelId'];
    $vData['channelTitle'] = addslashes($res['snippet']['channelTitle']);
    $vData['title'] = addslashes($res['snippet']['title']);
    $vData['description'] = addslashes($res['snippet']['description']);
    $vData['created'] = date('Y-m-d h:i:s');
    if ($vData['videoId']) {
        array_push($vResult, $vData);
    }
}

exit;

//echo $msg;
