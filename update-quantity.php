<?php
session_start();
include 'conn.php';
$user_id = $_SESSION['id'];
$product_id = $_POST['product_id'];
$qty = $_POST['qty'];
$update = "UPDATE addtocart SET quantity = '$qty' WHERE userid = '$user_id' and ProductId = '$product_id'";
if($que = mysqli_query($con,$update)){
  echo 1;
}else {
  echo 0;
}
 ?>
