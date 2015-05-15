<?php
  echo "Hello City<br/>";
?>
<?php include "db_connect_oo.php" ?>
<?php
  echo json_encode($json_result);

  $con->close();
?>
