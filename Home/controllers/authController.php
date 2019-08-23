<?php

session_start();

require 'config/db.php';
require_once 'emailController.php';

$errors = array();
$email = "";

// if user clicks on the logout anchor
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['id']);
  unset($_SESSION['name']);
  unset($_SESSION['email']);
  unset($_SESSION['verified']);
  header('location: ../login.php');
  exit();
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  sendVerificationEmail($_SESSION['email'],$_SESSION['token']);
  $_SESSION['message'] = "Verification Email Sent Successfully!";
  $_SESSION['alert-class'] = "alert-success";
  header('location: dashboard.php?sendemail=successful');
  exit();
}

// verify user by token
function verifyUser($token)
{
  global $conn;

  $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result)>0) {
    $user = mysqli_fetch_assoc($result);
    $update_query = "UPDATE users SET verified=1 WHERE token = '$token'";

    if (mysqli_query($conn, $update_query)) {
      // log user in
      $_SESSION['id'] = $user['user_id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['verified'] = 1;
      // set flash message
      $_SESSION['message'] = "Your email address was successfully verified!";
      $_SESSION['alert-class'] = "alert-success";
      header('location: dashboard.php');
      exit();
    }
    else {
      echo mysqli_error($conn);
    }
  }
}
?>
