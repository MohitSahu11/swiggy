<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include "links.php";
  include "conn.php";
 if(isset($_POST['login'])) {
  $numem = $_POST['mnumber'];
  $password = $_POST['password'];
  $sel = "SELECT * FROM user_data WHERE MNumber = '$numem' or Email = '$numem' and Password = '$password'";
  $que = mysqli_query($con,$sel);
  $row = mysqli_num_rows($que);
  if($row)  {
       $fetch= mysqli_fetch_assoc($que);
       $_SESSION['id'] = $fetch['UserId'];

   ?>
          <script>
              location.replace("index.php?id=<?php echo $_SESSION['id'] ?> ")
            </script>
            <?php
}else {
      echo "<script>alert('Invalid Email,Mobile Number or Password')</script>";
    }

 }

  ?>
  <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
</head>
<body>
  <div class="header mb-5">
    <?php include 'header.php'; ?>
  </div>
  <center><img src="img/logo.png" id="logo" alt=""></center>
  <div class="login-box bg-light mx-auto mb-5">
    <h3 class="ml-4 mt-2">Sign-In</h3>
    <form class="mx-4" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="form-group">
      <label for="name">Email or mobile phone number</label>
      <input type="text" class="form-control" id="name" name="mnumber">
    </div>
    <div class="form-group">
      <label for="pass">Password</label>
      <input type="text" class="form-control" id="pass" name="password">
    </div>
      <button type="submit" name="login" class="btn  btn-md btn-block">Continue</button>
      <hr>
      <p class="mb-1" id="verify-number-text">New to Weblipy?</p>
      <p>Create your account <a href="signup.php">click here.</a></p>
  </form>
  </div>
</body>
</html>
