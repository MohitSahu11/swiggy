<?php
session_start();
  include "conn.php";
  $addressid = uniqid();
  $id = $_SESSION['id'];
 $name = $_POST['name'];
 $mnumber = $_POST['mnumber'];
 $email = $_POST['email'];
 $address = $_POST['address'];
 $landmark = $_POST['landmark'];
 $city = $_POST['city'];
 $pincode = $_POST['pincode'];

  $insert = "INSERT INTO address (UserId,FullName,MobileNumber,Email,Address,Landmark,City,Pincode,Address_Id) VALUES('$id','$name','$mnumber','$email','$address','$landmark','$city','$pincode','$addressid')";
  if($que1 = mysqli_query($con,$insert)){
      echo 1;
    }else{
      echo 0;
    }

 ?>
