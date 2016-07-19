<?php
  //register_user.php
  header('Content-Type: application/json');
?>
<?php include "db_connect_oo.php" ?>
<?php

  $sql = "SELECT * from geo_tracks";
  $sql = "SELECT
    gt.id, gt.location_id, gt.user_id, gt.app_id, gt.action, gt.created_at,
    l.name location_name, l.latitude, l.longitude, l.radius, l.is_active, l.is_test_location,
    a.name app_name,
    ac.firstname, ac.lastname, ac.email, ac.facebook_id
    FROM
    geo_tracks gt
        INNER JOIN
    location l ON gt.location_id = l.id
        INNER JOIN
    apps a ON gt.app_id = a.id
        INNER JOIN
    accounttd ac ON gt.user_id = ac.accountid";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    $rows = [];
    while($row = $result->fetch_assoc()) {
      $entry["id"] = $row["id"];
      $entry["location_id"] = $row["location_id"];
      $entry["user_id"] = $row["user_id"];
      $entry["app_id"] = $row["app_id"];
      $entry["action"] = $row["action"];
      $entry["created_at"] = $row["created_at"];

      $location["id"] = $row["location_id"];
      $location["name"] = $row["location_name"];
      $location["latitude"] = $row["latitude"];
      $location["longitude"] = $row["longitude"];
      $location["radius"] = $row["radius"];
      $location["is_active"] = $row["is_active"];
      $location["is_test_location"] = $row["is_test_location"];
      $entry["location"] = $location;

      $app["id"] = $row["app_id"];
      $app["name"] = $row["app_name"];
      $entry["app"] = $app;

      $user["id"] = $row["user_id"];
      $user["firstname"] = $row["firstname"];
      $user["lastname"] = $row["lastname"];
      $user["email"] = $row["email"];
      $user["facebook_id"] = $row["facebook_id"];
      $entry["user"] = $user;

      $rows[] = $entry;
    }
    $json_result["rows"] = $rows;
  } else {
    $json_result["rows"] = [];
  }

  $con->close();

  echo json_encode($rows);
?>
