<?php
  //register_user.php
  header('Content-Type: application/json');
?>
<?php include "db_connect_oo.php" ?>
<?php
  /*
    check facebook_id and facebook_token if exist return success

    check facebook_id if exist update facebook_token return success

    check facebook_id if not exist insert accounttd and facebook_token
  */
  $json_result = array();

  // get post input
  $post_facebook_id = isset($_POST["facebook_id"]) ? $_POST["facebook_id"] : "" ;
  $post_facebook_token = isset($_POST["facebook_token"]) ? $_POST["facebook_token"] : "" ;
  $post_firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "" ;
  $post_lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "" ;
  $post_email = isset($_POST["email"]) ? $_POST["email"] : "" ;
  $post_birthday = isset($_POST["birthday"]) ? $_POST["birthday"] : "" ;
  //$post_birthdays = explode( "/" , $post_birthday);
  //$post_birthday = $post_birthdays[2]."/".$post_birthdays[0]."/".$post_birthdays[1];
  $post_gender = isset($_POST["gender"]) ? $_POST["gender"] : "" ;
  $post_app_id = isset($_POST["app_id"]) ? $_POST["app_id"] : "0" ;


  // escape variables for security
  $post_facebook_id = mysqli_real_escape_string($con, $post_facebook_id);
  // $post_facebook_token = mysqli_real_escape_string($con, $post_facebook_token);
  $post_firstname = mysqli_real_escape_string($con, $post_firstname);
  $post_lastname = mysqli_real_escape_string($con, $post_lastname);
  $post_email = mysqli_real_escape_string($con, $post_email);
  $post_gender = mysqli_real_escape_string($con, $post_gender);
  //$post_birthday = mysqli_real_escape_string($con, $post_birthday);
  $post_app_id = mysqli_real_escape_string($con, $post_app_id);



/*
  // ------------------------------------------------------------
  // check facebook_id and facebook_token if exist return success

  // setup sql
  $sql = "SELECT accountid,firstname,lastname,email,facebook_id,birthday,gender FROM accounttd
    inner join facebook_token on accounttd.accountid = facebook_token.account_id
    where facebook_id = '$post_facebook_id' and facebook_token = '$post_facebook_token'";
  // $results = mysqli_query($con, $sql);
  $results = $con->query($sql);

  if ( mysqli_num_rows($results)==1 ) {
    while($row = mysqli_fetch_array($results)) {
      $json_result["result"] = "read success";
      $json_result["accountid"] = $row['accountid'];
      $json_result["firstname"] = $row['firstname'];
      $json_result["lastname"] = $row['lastname'];
      $json_result["email"] = $row['email'];
      $json_result["birthday"] = $row['birthday'];
      $json_result["facebook_id"] = $row['facebook_id'];
      $json_result["facebook_token"] = $row['facebook_token'];
      $json_result["gender"] = $row['gender'];
    }

  }
  // ---------------------------------------------------------------
  // check facebook_id if exist update facebook_token return success
  else if ( mysqli_num_rows($results)==0 ) {

    $sql = "SELECT accountid,firstname,lastname,email,facebook_id,birthday,gender FROM accounttd
      inner join facebook_token on accounttd.accountid = facebook_token.account_id
      where facebook_id = '$post_facebook_id'";
    $results = mysqli_query($con, $sql);

    if ( mysqli_num_rows($results)==1 ) {
      $db_accountid = "";

      while($row = mysqli_fetch_array($results)) {
        $json_result["result"] = "read success: update facebook_token";
        $json_result["accountid"] = $row['accountid'];
        $json_result["firstname"] = $row['firstname'];
        $json_result["lastname"] = $row['lastname'];
        $json_result["email"] = $row['email'];
        $json_result["facebook_id"] = $row['facebook_id'];
        $json_result["birthday"] = $row['birthday'];
        $json_result["gender"] = $row['gender'];
        $db_accountid = $row['accountid'];
      }

      //update facebook_token to table facebook_token
      // setup sql
      $sql = "UPDATE facebook_token set facebook_token='$post_facebook_token', update_at=SYSDATE()
        where account_id = $db_accountid";
      mysqli_query($con,$sql);
      $json_result["facebook_token"] = $post_facebook_token;
    }
    // ------------------------------------------------------------------
    // check facebook_id if not exist insert accounttd and facebook_token
    else {
      // setup sql
      // $sql = "INSERT INTO accounttd (firstname, lastname, email, facebook_id, birthday)
      //   VALUES ('$post_firstname', '$post_lastname','$post_email','$post_facebook_id','$post_birthday')";
      $sql = "INSERT INTO accounttd (firstname, lastname, email, facebook_id, birthday, gender)
        VALUES ('$post_firstname', '$post_lastname','$post_email','$post_facebook_id','$post_birthday','$post_gender')";

      if (!mysqli_query($con,$sql)) {
        $json_result["result"] = 'Error: ' . mysqli_error($con);
        $json_result["where"] = 'insert sql: ' . $sql;
        $json_result["firstname"] = $post_firstname;
        $json_result["lastname"] = $post_lastname;
        $json_result["email"] = $post_email;
        $json_result["facebook_id"] = $post_facebook_id;
        $json_result["birthday"] = $post_birthday;
        $json_result["gender"] = $post_gender;
        //die('Error: ' . mysqli_error($con));

      } else {
        $sql = "SELECT accountid,firstname,lastname,email,facebook_id,birthday,gender FROM accounttd
          where facebook_id = '$post_facebook_id'
          ORDER BY accountid DESC
          LIMIT 1";

        $results = mysqli_query($con, $sql);
        $db_accountid = "";

        while($row = mysqli_fetch_array($results)) {
          $json_result["result"] = "register success: new user";
          $json_result["accountid"] = $row['accountid'];
          $json_result["firstname"] = $row['firstname'];
          $json_result["lastname"] = $row['lastname'];
          $json_result["email"] = $row['email'];
          $json_result["facebook_id"] = $row['facebook_id'];
          $json_result["birthday"] = $row['birthday'];
          $json_result["gender"] = $row['gender'];
          $db_accountid = $row['accountid'];
        }

        $sql = "INSERT INTO facebook_token (account_id, facebook_token, create_at, update_at)
          VALUES ($db_accountid, '$post_facebook_token', SYSDATE(), SYSDATE())";
        mysqli_query($con,$sql);
        $json_result["facebook_token"] = $post_facebook_token;


      }

    }



  } else {
    $json_result["result"] = "unsuccess";
  }
*/

  // ------------------------------------------------------------
  // check facebook_id and facebook_token if exist return success

  // setup sql
  $sql = "SELECT accountid,firstname,lastname,email,facebook_id,birthday,gender,facebook_token FROM accounttd a
    inner join facebook_token f on a.accountid = f.account_id
    where a.facebook_id = '$post_facebook_id' and f.facebook_token = '$post_facebook_token'";
  // $results = mysqli_query($con, $sql);
  $results = $con->query($sql);

  if ( $results->num_rows == 1 ) {
    while( $row = $results->fetch_assoc() ) {
      $json_result["result"] = "read success";
      $json_result["accountid"] = $row['accountid'];
      $json_result["firstname"] = $row['firstname'];
      $json_result["lastname"] = $row['lastname'];
      $json_result["email"] = $row['email'];
      $json_result["birthday"] = $row['birthday'];
      $json_result["facebook_id"] = $row['facebook_id'];
      $json_result["facebook_token"] = $row['facebook_token'];
      $json_result["gender"] = $row['gender'];
    }

  }
  // ---------------------------------------------------------------
  // check facebook_id if exist update facebook_token return success
  else if ( $results->num_rows == 0 ) {

    $sql = "SELECT accountid,firstname,lastname,email,facebook_id,birthday,gender,facebook_token FROM accounttd
      inner join facebook_token on accounttd.accountid = facebook_token.account_id
      where facebook_id = '$post_facebook_id'";
    $results = $con->query($sql);

    if ( $results->num_rows==1 ) {
      $db_accountid = "";

      while( $row = $results->fetch_assoc() ) {
        $json_result["result"] = "read success: update facebook_token";
        $json_result["accountid"] = $row['accountid'];
        $json_result["firstname"] = $row['firstname'];
        $json_result["lastname"] = $row['lastname'];
        $json_result["email"] = $row['email'];
        $json_result["facebook_id"] = $row['facebook_id'];
        $json_result["birthday"] = $row['birthday'];
        $json_result["gender"] = $row['gender'];
        $db_accountid = $row['accountid'];
      }

      //update facebook_token to table facebook_token
      // setup sql
      $sql = "UPDATE facebook_token set facebook_token='$post_facebook_token', update_at=SYSDATE()
        where account_id = $db_accountid";
      $con->query($sql);
      $json_result["facebook_token"] = $post_facebook_token;
    }
    // ------------------------------------------------------------------
    // check facebook_id if not exist insert accounttd and facebook_token
    else {
      // setup sql
      // $sql = "INSERT INTO accounttd (firstname, lastname, email, facebook_id, birthday)
      //   VALUES ('$post_firstname', '$post_lastname','$post_email','$post_facebook_id','$post_birthday')";
      $sql = "INSERT INTO accounttd (firstname, lastname, email, facebook_id, birthday, gender, app_id)
        VALUES ('$post_firstname', '$post_lastname','$post_email','$post_facebook_id','$post_birthday','$post_gender', $post_app_id)";

      if ( $con->query($sql) === true ) {
        // $json_result["result"] = 'Error: ' . $con->error;
        // $json_result["where"] = 'insert sql: ' . $sql;
        // $json_result["firstname"] = $post_firstname;
        // $json_result["lastname"] = $post_lastname;
        // $json_result["email"] = $post_email;
        // $json_result["facebook_id"] = $post_facebook_id;
        // $json_result["birthday"] = $post_birthday;
        // $json_result["gender"] = $post_gender;
        // //die('Error: ' . mysqli_error($con));

        $last_id = $con->insert_id;

        $json_result["result"] = "register success: new user";
        $json_result["accountid"] = $last_id;
        $json_result["firstname"] = $post_firstname;
        $json_result["lastname"] = $post_lastname;
        $json_result["email"] = $post_email;
        $json_result["facebook_id"] = $post_facebook_id;
        $json_result["birthday"] = $post_birthday;
        $json_result["gender"] = $post_gender;
        $db_accountid = $last_id;

        $sql = "INSERT INTO facebook_token (account_id, facebook_token, create_at, update_at)
          VALUES ($db_accountid, '$post_facebook_token', SYSDATE(), SYSDATE())";
        //$con->query($sql);
        if ( $con->query($sql) === true ) {
          $json_result["facebook_token"] = $post_facebook_token;
        } else {
          $json_result["facebook_token"] = "sql error: ".$sql;
        }


      } else {
        $json_result["result"] = 'Error: ' . $con->error;
        $json_result["where"] = 'insert sql: ' . $sql;
        $json_result["firstname"] = $post_firstname;
        $json_result["lastname"] = $post_lastname;
        $json_result["email"] = $post_email;
        $json_result["facebook_id"] = $post_facebook_id;
        $json_result["birthday"] = $post_birthday;
        $json_result["gender"] = $post_gender;
        //die('Error: ' . mysqli_error($con));
      }

    }



  } else {
    $json_result["result"] = "error";
  }

  // Return the data result as json
  echo json_encode($json_result);
  // mysqli_close($con);
  $con->close();
?>
