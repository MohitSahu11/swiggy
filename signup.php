<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "links.php";
  include "conn.php";
  ?>
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body>
  <div class="header mb-5">
    <?php include 'header.php'; ?>
  </div>
  <center><img src="img/logo.png" id="logo" alt=""></center>
  <div class="login-box bg-light mx-auto mb-5">
    <h3 class="ml-4 mt-2">Create Account</h3>
    <form class="mx-4" action="insert-login.php" method="post">
    <div class="form-group">
      <label for="name">Your name</label>
      <input type="text" class="form-control" id="name" required name="name">
    </div>
    <div class="form-group">
      <label for="mnumber">Mobile number</label>
      <input type="text" class="form-control" id="mnumber" required name="mnumber">
    </div>
    <div class="form-group">
      <label for="email">Email(optional)</label>
      <input type="email" class="form-control" id="email" required name="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" required name="password">
      <span id="pass-warn">!  Passwords must be at least 6 characters.</span>
    </div>
      <p id="verify-number-text">We will send you a text to verify your phone. Message and Data rates may apply.</p>
      <button type="submit" name="submit" class="btn  btn-md btn-block">Continue</button>
      <hr>
      <p>Already have an account? <a href="login.php">Sign in</a></p>
  </form>
  </div>
</body>
</html>
