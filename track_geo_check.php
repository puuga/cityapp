<?php
  //register_user.php
  header('Content-Type: application/json');
?>
<?php include "db_connect_oo.php" ?>
<?php

  $sql = "SELECT * from geo_tracks";

  $result = $con->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    $rows = [];
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    $json_result["rows"] = $rows;
  } else {
    $json_result["rows"] = [];
  }

  $con->close();

  echo json_encode($json_result);
?>
