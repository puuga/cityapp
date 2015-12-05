<?php
require 'autoload.php';
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseClient;


$app_id = "CCZqrKAmkckpA6gUFgVUtZBCIjDCgO1Tf5087DVc";
$rest_key = "mwUbd44QGaErlC5BR6YwurJBrDmls3I0ThQspyqZ";
$master_key = "BdtRlF4rA1GsZ0gRKHeT7EmiqK1Zv90P4dW6rhLA";

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
    $channels = [$_GET["channel"]];
  } else {
    $channels = [""];
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
