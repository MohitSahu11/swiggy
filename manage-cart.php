<?php
session_start();
$sn = $_SESSION['id'];
$product_id = $_POST['product_id'];
include "conn.php";



$del = "DELETE FROM addtocart WHERE ProductId = '$product_id' and UserId = '$sn'";
$que = mysqli_query($con,$del);
if($que){
  echo 1;
}else {
  0;
}

mysqli_close($con);
?>
