<?php require_once 'controllers/authController.php';

if (isset($_SESSION['id'])) {
  header('location: Home/dashboard.php');
}

else if (isset($_GET['passwordreset'])) {
  if(($_GET['passwordreset']) == "successful") {
    ?>
    <!DOCTYPE html>
    <html lang="en" >
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="refresh" content="5;url=http://192.168.64.2/MyPHP/login.php" />
      <link rel="icon" type="image/png" href="assets/img/favicon.png">
      <title>Reset Password</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
    <link rel="stylesheet" href="./styleme.css">
    </head>
    <body>
    <!-- partial:index.partial.html -->
    <h2>SRM PLACEMENTS FORUM</h2>
    <div class="container" id="container">
      <div class="form-container">
        <form id="resetform" autocomplete="off" action="resetpassword.php"  method="post">
          <?php if(isset($_SESSION['message'])): ?>
            <div class="alert <?php echo $_SESSION['alert-class']; ?>" style="font-size:large;width: 500px;">
              <?php
              echo $_SESSION['message'];
              unset($_SESSION['message']);
              unset($_SESSION['alert-class']);
              ?>
            </div>
          <?php endif;?>
          <h2>Redirecting you in 5 seconds...</h2>
        </form>
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
    <?php
    }

  }

else if (!isset($_GET['selector'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en" >
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=http://192.168.64.2/MyPHP/login.php" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
  <link rel="stylesheet" href="./styleme.css">
  </head>
  <body>
  <!-- partial:index.partial.html -->
  <h2>SRM PLACEMENTS FORUM</h2>
  <div class="container" id="container">
    <div class="form-container">
      <form id="resetform" autocomplete="off" action="resetpassword.php"  method="post">
        <h2 style="color:red;">Could not validate your request!</h2>
        <h2>Redirecting you in 3 seconds...</h2>
      </form>
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
  <?php
  }

else if (!isset($_GET['validator'])) {
  ?>
  <!DOCTYPE html>
  <html lang="en" >
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=http://192.168.64.2/MyPHP/login.php" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
  <link rel="stylesheet" href="./styleme.css">
  </head>
  <body>
  <!-- partial:index.partial.html -->
  <h2>SRM PLACEMENTS FORUM</h2>
  <div class="container" id="container">
    <div class="form-container">
      <form id="resetform" autocomplete="off" action="resetpassword.php"  method="post">
        <h2 style="color:red;">Could not validate your request!</h2>
        <h2>Redirecting you in 3 seconds...</h2>
      </form>
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
<?php
}

else {
  $selector = $_GET['selector'];
  $validator = $_GET['validator'];
  if (empty($selector) || empty($validator)) {
    ?>
        <!DOCTYPE html>
        <html lang="en" >
        <head>
          <meta charset="UTF-8">
          <meta http-equiv="refresh" content="3;url=http://192.168.64.2/MyPHP/login.php" />
          <link rel="icon" type="image/png" href="assets/img/favicon.png">
          <title>Reset Password</title>
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
        <link rel="stylesheet" href="./styleme.css">
        </head>
        <body>
        <!-- partial:index.partial.html -->
        <h2>SRM PLACEMENTS FORUM</h2>
        <div class="container" id="container">
          <div class="form-container">
            <form id="resetform" autocomplete="off" action="resetpassword.php"  method="post">
              <h2 style="color:red;">Could not validate your request!</h2>
              <h2>Redirecting you in 3 seconds...</h2>
            </form>
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
  <?php
  }
  else {
    if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) !== false ) {
      ?>
          <!DOCTYPE html>
          <html lang="en" >
          <head>
            <meta charset="UTF-8">
            <link rel="icon" type="image/png" href="assets/img/favicon.png">
            <title>Reset Password</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'>
          <link rel="stylesheet" href="./styleme.css">
          </head>
          <body>
          <!-- partial:index.partial.html -->
          <h2>SRM PLACEMENTS FORUM</h2>
          <div class="container" id="container">
            <div class="form-container">
              <form id="resetform" autocomplete="off" action="resetpassword.php?selector=<?php echo $selector ?>&validator=<?php echo $validator ?>"  method="post">
                <h1>Reset Password</h1>
                <?php if(count($errors) > 0): ?>
                  <div id="reset-danger" class ="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                      <li><?php echo $error; ?></li>
                      <?php endforeach; ?>
                  </div>
                <?php endif; ?>
                <input type="hidden" name="selector" value="<?php echo $selector ?>">
                <input type="hidden" name="validator" value="<?php echo $validator ?>">
                <input type="password" name="password" autocomplete="new-password" style="position:relative; top:25px;" placeholder="New Password" />
                <input type="password" name="password-cnf" autocomplete="new-password" style="position:relative; top:25px;" placeholder="Confirm Password" />
                <button id="reset-btn" type="submit" name="reset-btn" style="position:relative; top:50px;">Reset Password</button>
              </form>
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
  <?php
    }
  }
}
