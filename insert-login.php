<?php
  include "conn.php";
 $userid = uniqid();
 $name = $_POST['name'];
 $mnumber = $_POST['mnumber'];
 $email = $_POST['email'];
 $password = $_POST['password'];
if (isset($_POST['submit'])) {
$sel = "SELECT * FROM login WHERE Email = '$email'and MNumber ='$mnumber'";
$que = mysqli_query($con,$sel);
if ($row = mysqli_num_rows($que)>0) {
  echo '<script>
          alert("Email Or Mobile Number Already Exist");
           window.location.href = "signup.php";
        </script>';
      }else{

  $insert = "INSERT INTO user_data (Email,Password,Name,MNumber,UserId) VALUES('$email','$password','$name','$mnumber','$userid')";
  if($que1 = mysqli_query($con,$insert)){
      echo '<script>
              alert("Registered Successfull");
               window.location.href = "login.php";
            </script>';
    }else{
      echo "unsuccessfull";
    }
  }
  }
 ?>
