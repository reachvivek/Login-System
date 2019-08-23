<?php

require_once 'vendor/autoload.php';
require_once 'config/constants.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername(EMAIL)
  ->setPassword(PASSWORD)
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);

function sendVerificationEmail($email, $token) {

  global $mailer;

  $body = '<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Verify Your Email</title>
    </head>
    <body>
      <div class="wrapper">
        <p>
        Thank you for signing up on our website. Please click on the link below to verify your email</p>
        <a href="http://192.168.64.2/MyPHP/Home/dashboard.php?token=' . $token . '">Verify your email address</a>

      </div>
    </body>
  </html>';

  // Create a message
  $message = (new Swift_Message('Verify Your Email Address'))
    ->setFrom([EMAIL=>'SRMIST PLACEMENTS'])
    ->setTo($email)
    ->setBody($body, 'text/html')
    ;

  // Send the message
  $result = $mailer->send($message);
}

function sendResetLink($email, $url) {

  global $mailer;

  $body = '<!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>Verify Your Email</title>
    </head>
    <body>
      <div class="wrapper">
        <p> We received a password reset request. The link to reset your password is below.
        If you did not make this request, you can ignore this email.<br>Here is your password reset link: </p>
        <a href="' . $url . '">Click here to reset your password</a>
        </div>
      </body>
    </html>';

    // Create a message
    $message = (new Swift_Message('Password Reset Request'))
      ->setFrom([EMAIL=>'SRMIST PLACEMENTS'])
      ->setTo($email)
      ->setBody($body, 'text/html')
      ;

    // Send the message
    $result = $mailer->send($message);
}
 ?>
