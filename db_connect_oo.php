<?php // db_connect_oo.php ?>
<?php
  // Create connection

  // $server = "ap-cdbr-azure-southeast-a.cloudapp.net";
  // $username = "bd85030ab08427";
  // $password = "3921d497";
  // $dbname = "RoomlinkDBMySql";

  // localhost
  // $server = "localhost";
  // $username = "rls2014ss";
  // $password = "rls2014ss";
  // $dbname = "roomlinkDB";

  // digital ocean 128.199.133.166
  $server = "128.199.133.166";
  // $server = "localhost";
  $username = "rls2014ss";
  $password = "rls2014ss";
  $dbname = "roomlinkdbmysql";

  // $con = mysqli_connect("localhost","rls2014ss","rls2014ss","roomlinkDB");
  // $con=mysqli_connect($servername,$username,$password,$dbname);
  $con = new mysqli($server, $username, $password, $dbname);

  // Check connection
  if ($con->connect_error) {
    // echo "Failed to connect to MySQL: " . $con->connect_error;
    $json_result = array();
    $json_result["result"] = "unsuccess";
    $json_result["error"] = "".$con->connect_error;
    echo json_encode($json_result);
    exit;
  } else {
    //echo "Success: connected to MySQL";
  }

  // mysqli_set_charset($con , "UTF8");
  /* change character set to utf8 */
  if ( !$con->set_charset("utf8") ) {
      // printf("Error loading character set utf8: %s\n", $con->error);
      $json_result["charset"] = "Error loading character set utf8:".$con->error;
  } else {
      // printf("Current character set: %s\n", $con->character_set_name());
      $json_result["charset"] = "Current character set:".$con->character_set_name();
  }

  // $con->close();

?>
