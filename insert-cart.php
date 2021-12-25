<?php
session_start();
include "conn.php";

$productid = $_POST['Product_Id'];
$userid = $_SESSION['id'];
$sel = "SELECT * FROM addtocart WHERE ProductId = '$productid' and userid = '$userid'";
$que1 = mysqli_query($con,$sel);
if($row = mysqli_num_rows($que1)){
  echo 3;
}else{

$insert = "INSERT INTO addtocart(ProductId,userid,quantity) VALUES('$productid','$userid','1')";
$que = mysqli_query($con,$insert);
 if($que){
  echo 1;
 }else echo 0;
};
 ?>
