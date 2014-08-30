<?php
  function checkFacebookToken($token, $con) {

    // setup sql
    $sql = "SELECT * FROM facebook_token
      WHERE facebook_token LIKE '$token'";
    $results = mysqli_query($con, $sql);

    if ( mysqli_num_rows($results)==1 ) {
      return true;

    }
    return false;
  }

?>
