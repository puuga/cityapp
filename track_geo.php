<?php
  //register_user.php
  header('Content-Type: application/json');
?>
<?php include "db_connect_oo.php" ?>
<?php
  // get location id from location name
  $location_id = $_POST["location_id"];
  $user_id = $_POST["user_id"];
  $app_id = $_POST["app_id"];
  $action = $_POST["action"];

  $sql = "INSERT INTO geo_tracks (location_id, user_id, app_id, action, created_at)
    VALUES ($location_id, $user_id, $app_id, '$action', NOW())";

  if ($con->query($sql) === TRUE) {
      $json_result['result'] = "success";
      $json_result['result_detail'] = "New record created successfully";
      $json_result['last_id'] = $con->insert_id;
  } else {
      $json_result['result'] = "Error: " . $sql . " -- " . $con->error;
  }

  $con->close();

  echo json_encode($json_result);
?>
