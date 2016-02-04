<?php
require 'autoload.php';
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseClient;


$app_id = "D38qKiw1l7RnDX5Hs3OfXfcBqIglX8w7YuFlmtg8";
$rest_key = "55smC6K7wAbQKsUXUIq7rXxqy5yIgiLhEZVkG9Sa";
$master_key = "WGJwwIZ1XkadAhbjYuL7uvlDQcyuCy5z91sxBdra";

ParseClient::initialize( $app_id, $rest_key, $master_key );

if ( !isset($_GET["title"]) || !isset($_GET["detail"]) || $_GET["rlskey"]!=="VJwVicd") {
  $result["result"] = "fail";
  $result["reason"] = "invalid key or blank message";
} else {
  // get data from query string
  $rlskey = $_GET["rlskey"];
  $detail = $_GET["detail"];
  if ( isset($_GET["title"]) ) {
    $title = $_GET["title"];
    $data = array("alert"=>$detail, "title"=>$title);
  }
  if ( isset($_GET["def"]) ) {
    $data["def"] = $_GET["def"];
    $result["def"] = $_GET["def"];
  }

  if ( isset($_GET["channel"]) ) {
    if ( $_GET["channel"]=="") {
      $channels = ["GLOBAL"];
    } else {
      $channels = [$_GET["channel"]];
    }

  } else {
    $channels = ["GLOBAL"];
  }

  // send push
  ParsePush::send(array(
    "channels" => $channels,
    "data" => $data
  ));

  $result["result"] = "success";
  $result["title"] = $title;
  $result["detail"] = $detail;
  $result["channels"] = $channels;
}

header('Content-Type: application/json');
echo json_encode($result);

?>
