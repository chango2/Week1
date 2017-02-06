<?php
  require_once('../private/initialize.php');
  require_once('../private/db_credentials.php');
  // Set default values for all variables the page needs.
  $errors = array();
  if(is_post_request()) {

    $firstName = h($_POST["first_name"]);
    $lastName = h($_POST["last_name"]);
    $email = h($_POST["email"]);
    $userName = h($_POST['username']);

    if(is_blank($firstName) || !has_length($firstName, ['min' => 2, 'max' => 255])) {
      array_push($errors, 'First Name');
    }
    if(is_blank($lastName) || !has_length($lastName, ['min' => 2, 'max' => 255])) {
      array_push($errors, 'Last Name');
    }
    if(!has_valid_email_format($email) || !has_length($email, ['min' => 3, 'max' => 255])) {
      array_push($errors, 'email');
    }
    if(!has_length($userName, ['min' => 8, 'max' => 255])) {
      array_push($errors, 'username');
    }
    $email = u($email);
    if(sizeof($errors) < 1) {
      $db =db_connect();
      $date = date('Y/m/d');
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at) VALUES ('$firstName', '$lastName', '$email', '$userName', '$date')";
      $result = db_query($db, $sql);
      if($result) {
        db_close($db);
        redirect_to('registration_success.php');
      } else {
        echo db_error($db);
        db_close($db);
        exit;
      }
    }

  }
  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    echo display_errors($errors);
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="register.php" method="post">
    <input type="text" name="first_name" placeholder="First Name"> <br>
    <input type="text" name="last_name" placeholder="Last Name"> <br>
    <input type="text" name="email" placeholder="Email"> <br>
    <input type="text" name="username" placeholder="Username"><br>
    <br>
    <input type="submit" name="submit" value="Submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
