<?php
  //survey_add.php
  header('Content-Type: application/json');
?>
<?php include "db_connect.php" ?>
<?php include "php_function.php" ?>
<?php
  $json_result = array();

  // get post input
  $post_accountid = isset($_POST["accountid"]) ? $_POST["accountid"] : "" ;
  $post_lat = isset($_POST["lat"]) ? $_POST["lat"] : "" ;
  $post_lng = isset($_POST["lng"]) ? $_POST["lng"] : "" ;
  $post_macaddress1 = isset($_POST["macaddress1"]) ? $_POST["macaddress1"] : "" ;
  $post_macaddress2 = isset($_POST["macaddress2"]) ? $_POST["macaddress2"] : "" ;
  $post_macaddress3 = isset($_POST["macaddress3"]) ? $_POST["macaddress3"] : "" ;
  $post_rss1 = isset($_POST["rss1"]) ? $_POST["rss1"] : "" ;
  $post_rss2 = isset($_POST["rss2"]) ? $_POST["rss2"] : "" ;
  $post_rss3 = isset($_POST["rss3"]) ? $_POST["rss3"] : "" ;
  $post_facebook_token = isset($_POST["facebook_token"]) ? $_POST["facebook_token"] : "" ;

  // escape variables for security
  $post_accountid = mysqli_real_escape_string($con, $post_accountid);
  $post_lat = mysqli_real_escape_string($con, $post_lat);
  $post_lng = mysqli_real_escape_string($con, $post_lng);
  $post_macaddress1 = mysqli_real_escape_string($con, $post_macaddress1);
  $post_macaddress2 = mysqli_real_escape_string($con, $post_macaddress2);
  $post_macaddress3 = mysqli_real_escape_string($con, $post_macaddress3);
  $post_rss1 = mysqli_real_escape_string($con, $post_rss1);
  $post_rss2 = mysqli_real_escape_string($con, $post_rss2);
  $post_rss3 = mysqli_real_escape_string($con, $post_rss3);
  $post_facebook_token = mysqli_real_escape_string($con, $post_facebook_token);

  if ( checkFacebookToken($post_facebook_token, $con) ) {
    // setup sql
    $sql = "INSERT INTO Survey (accountid, lat, lng, datetime, macaddress1, macaddress2, macaddress3, rss1, rss2, rss3)
      VALUES ($post_accountid, '$post_lat', '$post_lng', Now(), '$post_macaddress1', '$post_macaddress2', '$post_macaddress3', '$post_rss1', '$post_rss2', '$post_rss3')";

    if (!mysqli_query($con,$sql)) {
      $json_result["result"] = 'Error: ' . mysqli_error($con);

    } else {
      $json_result["result"] = "add Survey success";

    }

  } else {
    $json_result["result"] = "unsuccess: invalid token";
  }

  // Return the data result as json
  echo json_encode($json_result);
  mysqli_close($con);
?>
