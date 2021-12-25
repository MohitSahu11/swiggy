<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Menu</title>
    <link rel="stylesheet" href="css/lightslider.css?v=<?php echo time(); ?>">
    <?php include 'links.php' ?>
    <link rel="stylesheet" href="css/food-menu.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="js/index.js"></script>
  </head>
  <body onresize="resizeFunction()" onload="resizeFunction()">
    <?php
      $page = 'food-menu'?>
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
                <p class="category-slide">Food Categories</p><i class="fa fa-cutlery " aria-hidden="true"></i>
              </div>
              <?php include "conn.php";
              $sel_cat = " SELECT * FROM tbl_category WHERE active = 'yes'";
              $que = mysqli_query($con,$sel_cat);
              while($fetch_cat = mysqli_fetch_assoc($que)){
              ?>
              <a href="?cat_id=<?php echo $fetch_cat['id']; ?>" <?php if(@$_GET['cat_id'] == $fetch_cat['id']){ echo "class='active-cat'";} ?> <?php echo "data-id='{$fetch_cat["id"]}'" ?> id="food-cat"><?php echo $fetch_cat['title'] ?></a>
            <?php } ?>
            </div>
          </div>

          <!-- ===============================food item ========================== -->
          <div class="col-lg-9 col-md-7 col-sm-7">
            <div class="row food">
              <?php include 'conn.php';
              if(isset($_GET['search'])){
                $sel_food = "SELECT * FROM tbl_food WHERE  active = 'yes' and title LIKE '%{$_GET["search"]}%'";
              }
              else if (!isset($_GET['cat_id'])) {
              $sel_food = "SELECT * FROM tbl_food WHERE active = 'yes'";
              }else{
              $cat_id = $_GET['cat_id'];
              $sel_food = "SELECT * FROM tbl_food WHERE category_id = '$cat_id' and active = 'yes'";
             }
              $que = mysqli_query($con,$sel_food);
              while($fetch_food = mysqli_fetch_assoc($que)){
               ?>
              <div class="col-lg-4 col-md-6 col-sm-12 col-6">
                <div class="item-card">
                  <div class="item-img">
                    <img src="../../food-order/<?php echo $fetch_food['image_name']; ?>" alt="">
                  </div>
                  <h3 class="text-center"><?php echo $fetch_food['title']; ?></h3>
                  <p><?php echo $fetch_food['description']; ?></p>
                  <h1>RS <?php echo $fetch_food['price']; ?></h1>
                  <input type="button" id="cart" <?php echo "data-id='{$fetch_food["id"]}'" ?> value="Add">
                </div>
              </div>
            <?php } ?>
            </div>
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
        // ======================insert add to cart===================
        $(document).on("click","#cart",function(e){
          e.preventDefault();
          var Product_Id = $(this).data('id');
          <?php if(!isset($_SESSION['id'])){?>
            location.replace("login.php");
        <?php  }else{ ?>
              $.post(
                "insert-cart.php",
                {Product_Id : Product_Id},
                function(data){
                  if (data == 3) {
                    alert('item already added');
                  }
                  else if (data == 1) {
                    load();
                  }
                }
              );
          <?php } ?>
        });
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
  </body>
  </html>
