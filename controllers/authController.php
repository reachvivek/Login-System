<?php

session_start();

require 'config/db.php';
require_once 'emailController.php';

$errors = array();
$email = "";

// if user clicks on the sign up buttton
if (isset($_POST['signup-btn'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // validation
  if (empty($name)) {
    $errors['name'] = "Name Required!";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "E-mail Address is Invalid! ";
  }
  if (empty($email)) {
    $errors['email'] = "E-Mail Required!";
  }
  if (empty($password)) {
    $errors['password'] = "Password Required!";
  }

  $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
  $stmt = $conn->prepare($emailQuery);
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $userCount = $result->num_rows;

  if ($userCount > 0) {
    $errors['email'] = "An account for the specified email address already exists.";
  }

  if (count($errors) ===0) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(50));
    $verified = False;

    $sql = "INSERT INTO users (name, email, token, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssss', $name, $email, $token, $password);
    if ($stmt->execute()) {
    // login user
      $user_id = $conn->insert_id;
      $_SESSION['id'] = $user_id;
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['verified'] = $verified;
      $_SESSION['token'] = $token;

      sendVerificationEmail($email, $token);
      // set flash message
      $_SESSION['message'] = "You're now logged in!";
      $_SESSION['alert-class'] = "alert-success";
      header('location: Home/dashboard.php');
      exit();
    } else {
      $errors['db_error'] = mysqli_error($conn);
    }
  }
}

// if user clicks on the sign in buttton
if (isset($_POST['signin-btn'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "E-mail Address is Invalid! ";
  }
  if (empty($email)) {
    $errors['email'] = "E-Mail Required!";
  }
  if (empty($password)) {
    $errors['password'] = "Password Required!";
  }

  if (count($errors) ===0) {
    $sql = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      //login success
      $_SESSION['id'] = $user['user_id'];
      $_SESSION['name'] = $user['name'];
      $_SESSION['email'] = $user['email'];
      $_SESSION['verified'] = $user['verified'];
      $_SESSION['token'] = $user['token'];
      // set flash message
      $_SESSION['message'] = "You're now logged in!";
      $_SESSION['alert-class'] = "alert-success";
      header('location: Home/dashboard.php');
      exit();
    }
    else {
      // login failed
      $errors['login_err'] = "Wrong Credentials!";
    }
  }
}

if (isset($_POST['forgotpswd-btn'])) {
  $email = $_POST['email'];
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "E-mail Address is Invalid! ";
  }
  if (empty($email)) {
    $errors['email'] = "E-Mail Required!";
  }
  if (count($errors) ===0) {
    $emailQuery = "SELECT * FROM users WHERE email=? LIMIT 1";
    $stmt = $conn->prepare($emailQuery);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $user = $result->fetch_assoc();

    if ($userCount === 0) {
      $errors['email'] = "Account does not exist!";
    }
    else {
      $token = $user['token'];
      $selector = bin2hex(random_bytes(8));

      $url = "http://192.168.64.2/MyPHP/resetpassword.php?selector=" . $selector . "&validator=" . $token;
      $expires = date("U") + 1800;
      // delete previous entries
      $sql = "DELETE FROM resetpwd WHERE resetEmail = ?";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $email);
      $stmt->execute();

      //insert a new entry for reset request
      $sql = "INSERT INTO resetpwd (resetEmail, resetSelector, resetToken, resetExpires) VALUES (?, ?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('ssss', $email, $selector, $token, $expires);
      $stmt->execute();

      mysqli_stmt_close($stmt);
      mysqli_close();

      sendResetLink($email, $url);
      $_SESSION['message'] = "Password Reset Link Successfully Sent!<br>Check Your Email And Follow The Instructions To Recover Your Password.";
      $_SESSION['alert-class'] = "alert-success";
      header('location: forgotpassword.php?resetlinksent=successful');
      exit();
    }
  }
}

if (isset($_POST['reset-btn'])) {
  $selector = $_POST['selector'];
  $validator = $_POST['validator'];
  $password = $_POST['password'];
  $passwordRepeat = $_POST['password-cnf'];

  if (empty($password) || empty($passwordRepeat)) {
    $errors['empty-pwd']="Password Required!";
  }
  else if ($password != $passwordRepeat) {
    $errors['match-pwd']="Passwords do not match!";
  }
  else {
    $currentDate = date("U");

    $sql = "SELECT * FROM resetpwd WHERE resetSelector = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $selector);
    $stmt->execute();

    $result = $stmt->get_result();
    $userCount = $result->num_rows;
    $user = $result->fetch_assoc();

    if ($userCount === 0) {
      $errors['query_0'] = "You need to resubmit your reset request!";
    }

    else {
      $resetemail = $user['resetEmail'];

      $sql = "SELECT * FROM users WHERE email = ?;";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param('s', $resetemail);
      $stmt->execute();

      $result = $stmt->get_result();
      $userCount = $result->num_rows;

      if ($userCount === 0) {
        $errors['query_0'] = "You need to resubmit your reset request!";
      }
      else {
        $sql = "UPDATE users SET password = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $newpwdhash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ss', $newpwdhash, $resetemail);
        $stmt->execute();

        $sql = "DELETE FROM resetpwd WHERE resetEmail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $resetemail);
        $stmt->execute();
        $_SESSION['message'] = "Password Reset Successful!";
        $_SESSION['alert-class'] = "alert-success";
        header("location: resetpassword.php?passwordreset=successful");
        exit();
      }
    }
  }
}
?>
