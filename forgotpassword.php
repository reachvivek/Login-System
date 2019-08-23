<?php require_once 'controllers/authController.php';

if (isset($_SESSION['id'])) {
  header('location: Home/dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
<link rel="stylesheet" href="./styleme.css">
</head>
<body>
<!-- partial:index.partial.html -->
<div class="container" id="container">
  <div class="form-container">
    <?php if(count($errors) > 0): ?>
      <div class ="alert alert-danger" style="position:relative; top:150px; left:50px; width:637px; text-align: center;">
        <?php foreach($errors as $error): ?>
          <li><?php echo $error; ?></li>
          <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['message'])): ?>
      <div class="alert <?php echo $_SESSION['alert-class']; ?>" style="font-size:large;position:relative; top:150px; left:50px; width:637px; text-align: left;">
        <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
        unset($_SESSION['alert-class']);
        ?>
      </div>
    <?php endif;?>
    <form action="forgotpassword.php"  method="post">
      <h1>Forgot Password</h1>
      <h5 style="position: relative; top:10px; text-align:left;">Please Enter The Email Associated With Your Account.</h5>
      <input type="email" name="email" style="position:relative; top:25px;" placeholder="Email" />
      <button id="forgot-btn" type="submit" name="forgotpswd-btn" style="position:relative; top:50px; left:190px;">Forgot Password</button>
    </form>
    <button id="signin-btn" onclick="window.location.href='login.php';" type="submit" name="signin-back-btn"  style="position:relative; bottom:140px; left:50px;">Sign In</button>
	</div>

</div>

<footer>
	<p>
		Created with <i class="fa fa-heart"></i> by
		<a target="_blank" href="https://github.com/reachvivek">Vivek Kumar Singh</a>.
	</p>
</footer>
<!-- partial -->
  <script  src="./script.js"></script>

</body>
</html>
