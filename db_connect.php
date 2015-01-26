<?php // db_connect.php ?>
<?php
  // Create connection
  //$con = mysqli_connect("localhost","rls2014ss","rls2014ss","roomlinkDB");
  $con=mysqli_connect("ap-cdbr-azure-southeast-a.cloudapp.net","bd85030ab08427","3921d497","RoomlinkDBMySql");

  mysqli_set_charset($con , "UTF8");

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    $json_result = array();
    $json_result["result"] = "unsuccess";
    $json_result["error"] = "".mysqli_connect_error();
    echo json_encode($json_result);
    exit;
  } else {
    //echo "Success: connected to MySQL";
  }

  // mysqli_close($con);

?>
