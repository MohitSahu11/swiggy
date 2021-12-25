<?php
 session_start();
 if (!isset($_SESSION['id'])) {
   header("location:login.php");
 }
include "conn.php";
$message="";
// --------------------------------------Save-------------------------------------------------------------
if (isset($_POST['save-address'])) {
$addressid = $_POST['addressId'];

$userid = $_SESSION['id'];
$name = $_POST['name'];
$mnumber = $_POST['mnumber'];
$email = $_POST['email'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];
$city = $_POST['city'];
$pincode = $_POST['pincode'];


$update = "UPDATE address SET FullName = '$name',MobileNumber = '$mnumber',Email = '$email',Address = '$address',Landmark = '$landmark',City = '$city',Pincode = '$pincode' WHERE UserId = '$userid' And Address_Id = '$addressid'";
$upd_que = mysqli_query($con,$update);
if ($upd_que) {
  $message = "<div class='alert alert-success'>Update Address Successfully !!</div>";
  header("Refresh: 1");
}
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart</title>
    <link rel="stylesheet" href="css/lightslider.css?v=<?php echo time(); ?>">
    <?php include 'links.php' ?>
    <link rel="stylesheet" href="css/cart.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="js/index.js"></script>
  </head>
  <body>
    <div class="header">
      <?php
      include 'header.php';
      $page = 'cart';
      ?>
    </div>



    <div class="container-fluid address-main-div">
      <div class="row">
        <div class="col-lg-7 mx-auto" id="cart-data">

        </div>
        <div class="col-lg-3 mx-auto">
          <div class="row address-data bg-white">
            <?php
              include 'conn.php';
              $userid = $_SESSION['id'];
              $addr_sel = "SELECT * FROM address Where UserId = '$userid'";
              $addr_que = mysqli_query($con,$addr_sel) or die('query failed');
              $row = mysqli_num_rows($addr_que);
              if ($row > 0) {
                $fetch = mysqli_fetch_assoc($addr_que);
                ?>
                <div class="col-12">
                  <h4 class="ml-3 mt-3 mb-n2">Your Delivery Address</h4>
                  <hr>
                </div>
                <div class="col-11 mx-auto">
                  <form class="address-form mb-4" action="" method="post">
                    <input type="text" class="form-control" disabled id="name" required name="name" value="<?php echo $fetch['FullName']; ?>" placeholder="Enter Full Name" >
                    <input type="tel" class="form-control" disabled id="mnumber" required name="mnumber" value="<?php echo $fetch['MobileNumber']; ?>" placeholder="Enter Mobile Number">
                    <input type="mail" class="form-control" disabled id="email" required name="email" value="<?php echo $fetch['Email']; ?>" placeholder="Enter Email Id">
                    <input type="text" class="form-control" disabled id="address" required name="address" value="<?php echo $fetch['Address']; ?>" placeholder="Enter Address">
                    <input type="text" hidden class="form-control" disabled id="addressid" required name="addressId" value="<?php echo $fetch['Address_Id']; ?>">
                    <input type="text" class="form-control" disabled id="landmark" required name="landmark" value="<?php echo $fetch['Landmark']; ?>" placeholder="Enter Landmark">
                    <input type="text" class="form-control" disabled id="city" required name="city" value="<?php echo $fetch['City']; ?>" placeholder="Enter City">
                    <input type="text" class="form-control" disabled id="pincode" required name="pincode" value="<?php echo $fetch['Pincode']; ?>" placeholder="Enter Pincode">
                    <p ><?php echo "$message"; ?></p>
                      <button type="submit"  class="btn btn-outline-danger add" name="save-address"><a href="id=<?php echo $fetch['UserId'];?>"></a>Save Address</button>
                      <input type="button" class="btn btn-outline-danger edit " value="Change Address">
                </form>
                </div>
            <?php }else{ ?>
              <div class="col-12">
                <h4 class="ml-3 mt-3 mb-n2">Enter Delivery Address</h4>
                <hr>
              </div>
              <div class="col-11 mx-auto">
                <form class="address-form mb-4" action="" method="post">
                  <input type="text" class="form-control" id="name" required name="name" placeholder="Enter Full Name">
                  <input type="tel" class="form-control" id="mnumber" required name="mnumber" placeholder="Enter Mobile Number">
                  <input type="mail" class="form-control" id="email" required name="email" placeholder="Enter Email Id">
                  <input type="text" class="form-control" id="address" required name="address" placeholder="Enter Address">
                  <input type="text" class="form-control" id="landmark" required name="landmark" placeholder="Enter Landmark">
                  <input type="text" class="form-control" id="city" required name="city" placeholder="Enter City">
                  <input type="text" class="form-control" id="pincode" required name="pincode" placeholder="Enter Pincode">
                  <input type="button" class="btn btn-outline-info save-address"value="Save Address">
              </form>
              </div>
            <?php } ?>
          </div>
          <div class="row">
          <div class="col-lg-12 bg-white mt-3 rounded p-4">
            <h4>Order Summary</h4><hr>
            <h6>Total Amount<span class="float-right gtotal" id="gtotal"></span><span class="float-right" >₹</span></h6>
              <!-- <div class="input-group mb-3 mt-3">
             <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="Enter coupon code">
             <div class="input-group-prepend">
            <button type="button" class="input-group-text" name="button">Apply</button>
             </div>
           </div> -->
           <h6>Order Summary<h6>
           <p class="text-center my-3 text-danger" id="minimum"></p>
             <form class="" method="post">
             <div class="row text-center mb-4 mt-4 ">

             <div class="col-6  border rounded p-2">
               <div class="form-check form-check-inline ">
                <input class="form-check-input" disabled  type="radio" required name="pay-type" id="inlineRadio1" value="Payonline">
                <label class="form-check-label" for="inlineRadio1">Pay Online</label>
              </div>
             </div>
             <div class="col-6  border rounded p-2">
               <div class="form-check form-check-inline">
                 <input class="form-check-input" type="radio" required name="pay-type" id="inlineRadio2" value="COD">
                 <label class="form-check-label" for="inlineRadio2">COD</label>
               </div>
             </div>
           </div>


            <button type="submit" id="placeorder" name="placeorder" class="btn btn-block text-white" style="  background-color: rgb(254,86,52)!important;" name="button">Check Out</button>
            </form>
          </div>
          </div>
        </div>
      </div>
    </div>
    <!-- ================================load product=============================== -->
    <script type="text/javascript">
      $(document).ready(function(){
        function load1(){
          $.post(
            "cart-data.php",
              function(data){
                $('#cart-data').html(data);
              });
        };
        load1();
        function load(){
          $.post(
            "header.php",
              function(data){
                $('.header').html(data);
              });
        };
        load();

        $(document).on("click","#remove-cart",function(){
          var product_id = $(this).data("pid");
          $.post(
            "manage-cart.php",
            {product_id:product_id},
            function(data){
              if (data == 1) {
                  load1();
                load();
              }else {
                alert('failed');
              }
              }
          );
        });
      });
    </script>
    <!-- ======================update quantity================= -->
    <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('change','#qty',function(){
        var qty = $(this).val();
        var product_id = $(this).data('id');
        $.post(
          "update-quantity.php",
          {product_id:product_id,qty:qty},
          function(data){
            if (data==1) {
              load();
            }
          }
        );
      });
    });
    </script>
    <!-- ========================================toggle address button======================= -->
    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on("click",".edit",function(){
          var input = $(this).parents(".address-form").find("input[type='text'],input[type='mail'],input[type='tel']");
          input.each(function(){
            $(this).removeAttr('disabled');
          });
          $(this).parents(".address-form").find('.add,.edit').toggle();
        });
      });
    </script>
    <!-- =======================================ajax insert address================== -->
    <script type="text/javascript">
      $(document).ready(function(){
        function load(){
          $.post(
            "header.php",
              function(data){
                $('.header').html(data);
              });
        };
        load();
        $(document).on("click",".save-address",function(){
          $.post(
            "insert-address.php",
            $('.address-form').serialize(),
            function(data){
              if(data == 1){

                $('#alert').fadeIn();
                $('#alert').html('Insert Successfull');
                setTimeout(function(){
                  $('#alert').fadeOut();
                },3000);
              }
            }
          );
        });
      });
    </script>
     <!-- =====================Place order========================= -->
     <?php
        include 'conn.php';
        if(isset($_POST['placeorder'])){
          $answer = $_POST['pay-type'];
          if ($answe == '') {
            // code...
          }
          if ($answer == 'Payonline') {
              echo "<script>alert('pay online');</script>";
          }else{
            $userid = $_SESSION['id'];
            $sel = "SELECT * FROM addtocart WHERE userid = '$userid'";
            $que = mysqli_query($con,$sel);
            $i = 1;
            $orderId = uniqid();
            while($fetch = mysqli_fetch_assoc($que)){
              $product_id = $fetch['ProductId'];
              $sel2 = "SELECT * FROM tbl_food WHERE id = '$product_id'";
              $que2 = mysqli_query($con,$sel2);
              $fetch2 = mysqli_fetch_assoc($que2);
              $sel3 = "SELECT * FROM address WHERE UserId = '$userid'";
              $que3 = mysqli_query($con,$sel3);
              $fetch3 = mysqli_fetch_assoc($que3);
              $food = $fetch2['title'];
              $price = $fetch2['price'];
              $qty = $fetch['quantity'];
              $total = ($price*$qty);
              date_default_timezone_set("Asia/Kolkata");
              $orderDate =date('Y-m-d-h:i:sa');
              $status = "Waiting for Confirmation";
              $customerName = $fetch3['FullName'];
              $customerContact = $fetch3['MobileNumber'];
              $customerEmail = $fetch3['Email'];
              $customerAddress = $fetch3['Address'];
              $city = $fetch3['City'];


              $ins_order = "INSERT INTO tbl_order (id,user_id,food,price,qty,total,order_date,status,customer_name,customer_contact,customer_email,customer_address,city) VALUES ('$orderId','$userid','$food','$price','$qty','$total','$orderDate','$status','$customerName','$customerContact','$customerEmail',
                '$customerAddress','$city')";
              $que_order = mysqli_query($con,$ins_order);

              if ($que_order) {
                $del_cart = "DELETE FROM addtocart WHERE userid = '$userid'";
                $que_cart = mysqli_query($con,$del_cart);
                if ($i==1) {
                  echo "<script>alert('Your Order Is Successfull')</script>";
                }
                $i++;
              }
            }
          }
        }
      ?>
  </body>
  </html>
