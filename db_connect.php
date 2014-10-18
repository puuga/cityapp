<?php // db_connect.php ?>

<?php
  // Create connection
  //$con = mysqli_connect("localhost","rls2014ss","rls2014ss","roomlinkDB");
  $con=mysqli_connect("us-cdbr-azure-west-a.cloudapp.net","b7cd25dab495bd","227b4abe","roomlinkDB");

  mysqli_set_charset($con , "UTF8");

  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
  } else {
    //echo "Success: connected to MySQL";
  }

  // mysqli_close($con);

?>
