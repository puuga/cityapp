<?php
  //register_user.php
  header('Content-Type: application/json');
?>
<?php include "db_connect_oo.php" ?>
<?php
  $sql = "SELECT l.id,l.name,l.latitude,l.longitude,l.radius,l.is_test_location,l.enter_message,l.exit_message
          FROM location l INNER JOIN apps a ON l.app_id=a.id
          WHERE is_active=1";
  if ( isset($_GET['app']) ) {
    $sql .= " and app='".$_GET['app']."'";
  }
  if ( isset($_GET['name']) ) {
    $sql .= " and name='".$_GET['name']."'";
  }
  if ( isset($_GET['app_id']) ) {
    $sql .= " and a.id='".$_GET['app_id']."'";
  }
  $result = $con->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $one = null;
      $one['id'] = $row["id"];
      $one['name'] = $row["name"];
      $one['latitude'] = $row["latitude"];
      $one['longitude'] = $row["longitude"];
      $one['radius'] = $row["radius"];
      $one['is_test_location'] = $row["is_test_location"]==="1"?true:false;
      $one['enter_message'] = $row["enter_message"];
      $one['exit_message'] = $row["exit_message"];

      $arr[] = $one;
    }
    $json_result['location'] = $arr;
  }

  $con->close();

  echo json_encode($json_result);
?>
