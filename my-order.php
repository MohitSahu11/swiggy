<?php include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="20; url="<?php echo $_SERVER['PHP_SELF']; ?>" ">
    <title>Food Menu</title>
    <link rel="stylesheet" href="css/lightslider.css?v=<?php echo time(); ?>">
    <?php include 'links.php' ?>
    <link rel="stylesheet" href="css/food-menu.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="js/index.js"></script>
    <style media="screen">
      .table td{
        vertical-align: middle;
      }
    </style>
  </head>
  <body onresize="resizeFunction()" onload="resizeFunction()" >
    <?php
      $page = 'my-order'?>
     <div class="header">
       <?php include "header.php" ?>
     </div>
      <div class="landing-img">
      </div>
      <div class="food-menu">
        <h5 class="text-center "><?php if(isset($_GET['search'])){ echo 'Result against "'.$_GET['search'].'" Keyword'; }else{echo "Find Your Delicious Foods Here..";} ?> </h5>
        <div class="row pl-lg-5">
<!-- ==================================food-menu ================================== -->
          <div class="col-lg-3 col-md-5 col-sm-5 menu-bx bg-light">
            <div class="menu-div">
              <div class="search-box-title">
                <p class="">Search Food</p><i class="fa fa-cutlery" aria-hidden="true"></i>
              </div>
              <div class="search-box">
                <input type="text" id="search-val"  name="" placeholder="Search your favourite food" value=""><i id="search-btn" class="fa fa-search" aria-hidden="true"></i>
              </div>
              <div class="search-box-title menu-hide mt-4" id="category-click">
                <p class="">Food Categories</p><i class="fa fa-cutlery " aria-hidden="true"></i>
              </div>
              <?php include "conn.php";
              $sel_cat = " SELECT * FROM tbl_category WHERE active = 'yes'";
              $que = mysqli_query($con,$sel_cat);
              while($fetch_cat = mysqli_fetch_assoc($que)){
              ?>
              <a href="food-menu.php?cat_id=<?php echo $fetch_cat['id']; ?>" <?php if(@$_GET['cat_id'] == $fetch_cat['id']){ echo "class='active-cat'";} ?> <?php echo "data-id='{$fetch_cat["id"]}'" ?> id="food-cat"><?php echo $fetch_cat['title'] ?></a>
            <?php } ?>
            </div>
          </div>

          <!-- =============================== order ========================== -->
          <?php if(!isset($_GET['order_id'])) {?>
          <div class="col-lg-9 col-md-7 col-sm-7">
            <div class="row food table-responsive">
              <table class="table table-striped  text-center table-bordered">
              <thead style="background:rgb(255,51,0);color:#fff">
                <tr>
                  <th>Order Id</th>
                  <th>Order Date</th>
                  <th>status</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  @$userid = $_SESSION['id'];
                  $sel_order = "SELECT DISTINCT id,order_date,status FROM tbl_order where user_id = '$userid' ORDER BY id";
                  $order_que = mysqli_query($con,$sel_order);
                  if (mysqli_num_rows($order_que)>0) {
                  while ($fetch_order = mysqli_fetch_assoc($order_que)) {
                 ?>
                <tr>
                  <td><?php echo $fetch_order['id']; ?></td>
                  <td><?php echo $fetch_order['order_date']; ?></td>
                  <td><?php echo $fetch_order['status']; ?></td>
                  <td><a href="my-order.php?order_id=<?php echo $fetch_order['id'];?>"  class="btn btn-danger">View Detail</a></td>
                </tr>
              <?php } }
              else {
                echo "<tr><td colspan='4'>No order found</td></tr>";
              }
               ?>
              </tbody>
            </table>
          </div>
            </div>
          <?php }else { ?>
            <div class="col-lg-9 col-md-7 col-sm-7">
              <div class="row food table-responsive pr-lg-5">
                <table class="table table-striped  text-center table-bordered">
                <thead style="background:rgb(255,51,0);color:#fff">
                  <tr>
                    <th>Title</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    @$userid = $_SESSION['id'];
                    $id = $_GET['order_id'];
                    $sel_order = "SELECT * FROM tbl_order where user_id = '$userid' and id = '$id'";
                    $order_que = mysqli_query($con,$sel_order);
                    if (mysqli_num_rows($order_que)>0) {
                      $i = 0;
                    while ($fetch_order = mysqli_fetch_assoc($order_que)) {
                   ?>
                  <tr>
                    <td><?php echo  $fetch_order['food']; ?></td>
                    <td><?php echo $fetch_order['qty']; ?></td>
                    <td><?php echo $fetch_order['price'];?></td>
                    <td><?php echo $fetch_order['price']*$fetch_order['qty'];echo ".00";?></td>
                  </tr>
                  <?php $i = $i + ($fetch_order['price']*$fetch_order['qty']);
                     $address = $fetch_order['customer_address'];
                     $city = $fetch_order['city'];
                     $status = $fetch_order['status'];
                  ?>
                <?php } ?>
                 <tr class="order-bottom-td">
                   <td class="bg-dark text-white"><?php echo $address; ?></td>
                   <td class="text-white bg-secondary"><?php echo $city; ?></td>
                   <td class="bg-danger text-white"><?php echo $status; ?></td>
                   <td class="bg-secondary text-white"><?php echo "Total : ". @$i.".00"; ?></td>
                 </tr>
               <?php }
               else {
                 echo "<tr><td colspan='4'>No order found</td></tr>";
               }
               ?>
                </tbody>
              </table>
            </div>
            </div>
          <?php } ?>
          </div>
        </div>
      </div>

      <script type="text/javascript">
        $(document).ready(function(){
          function load(){
            $.post(
              "header.php",
              function(data){
                $('.header').html(data);
              });
          };
        // ===========================food search =====================
        $(document).on('click','#search-btn',function(){
        var search_val =  $('#search-val').val();
        location.replace("food-menu.php?search="+search_val)
        });
        });
      </script>
      <script type="text/javascript">
        function resizeFunction(){
          var iwidth = window.innerWidth;
          if(iwidth <= 600){
            $('.menu-hide i').addClass('fa-chevron-circle-down');
            $('.menu-div a').hide();
          }
          else {
            $('.menu-hide i').removeClass('fa-chevron-circle-down');
            $('.menu-div a').show();
          }
        }
      </script>
      <script type="text/javascript">
        $(document).on('click','#category-click',function(){
          $('.menu-div a').toggle();
          $('.menu-hide i').toggleClass("menu-icon-color")
        });
      </script>
      <!-- ===========================cancel order================= -->
  </body>
  </html>
