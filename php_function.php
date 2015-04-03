<?php
  function checkFacebookToken($token, $con) {

    // setup sql
    $sql = "SELECT * FROM facebook_token
      WHERE facebook_token LIKE '$token'";
    // $results = mysqli_query($con, $sql);
    $results = $con->query($sql);

    // if ( mysqli_num_rows($results)==1 ) {
    //   return true;
    // }
    // return false;
    if ( $results->num_rows == 1 ) {
      return true;
    }
    return false;
  }

?>
