<?php
require_once('getRemoteFileSize.php');
$url = $_POST['url'];
$size = getRemoteFileSize($url);
$urlHeaders = @get_headers($url);
$state = array();
if(strpos($urlHeaders[0], '200')) {
    $state["robot_exist"] = 1;
    $state["request_code"] = 200;
    $string = file_get_contents($url);
    if(substr_count($string, 'Host') == 1) {
      $state["host_count"] = 1;
      $state["host_exist"] = 1;
    } elseif(substr_count($string, 'Host') > 1) {
      $state["host_exist"] = 1;
      $state["host_count"] = 2;
    } else {
      $state["host_exist"] = 0;
      $state["host_count"] = 0;
    }
    if(substr_count($string, 'Sitemap') >= 1) {
      $state["site_map_exist"] = 1;
    }else {
      $state["site_map_exist"] = 0;
    }

} else {
    $state["robot_exist"] = 0;
    $state["request_code"] = $size;
}

$state["file_size"] = $size;
if($size > 32000) {
  $state['is_correct_size'] = 0;
}
else {
  $state['is_correct_size'] = 1;
}
session_start();
$_SESSION["data"] = $state;
require_once('result.php');


?>