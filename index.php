
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Swiggy</title>
    <link rel="stylesheet" href="css/lightslider.css?v=<?php echo time(); ?>">
    <?php include 'links.php' ?>
    <link rel="stylesheet" href="css/index.css?v=<?php echo time(); ?>">
    <script type="text/javascript" src="js/index.js"></script>
  </head>
  <body>
    <div class="header">
      <?php
      $page = 'home';
      include 'header.php'?>
    </div>
    <section id="home">
      <!-- ===========================landing page start====================== -->
    <div class="landing-page mx-auto">
      <div class="row">
        <div class="col-lg-6">
          <div class="l-col">
            <h1 class="landing-head">Your Favourite Food Delivered Hot & Fresh</h1>
            <p class="landing-para"><span>Hey Foodies,</span> Our Delicious Food is waiting for you !!!</p>
            <div class="search-box">
              <input type="text" name="" id="search-val"  placeholder="I would like to eat....">
              <button type="button" id="search-btn" class="btn btn-danger" name="button">Search</button>
            </div>
          </div>
        </div>
        <div class="col-lg-6 r-col ">
          <img  class="mx-auto d-block" src="assets/landing2.png" height="550px;" alt="">
        </div>
      </div>
      </div>
    </section>

    <!-- =================================menu start================================== -->
    <section id="menu">
      <h1 class="text-center">Our Menu</h1>
      <ul id="autoWidth" class="cs-hidden">
        <!-- slider1 -->
        <?php
        include 'conn.php';
        $menu_sel = "SELECT * FROM tbl_category where active = 'yes'";
        $que1 = mysqli_query($con,$menu_sel);
        if(mysqli_num_rows($que1)>0){
          while($fetch_menu = mysqli_fetch_assoc($que1)){
           ?>
      <li class="item-a">
        <div class="menu-box" id="menu-click" <?php echo "data-id='{$fetch_menu["id"]}'"; ?>>
          <div class="menu-img-box">
            <img src="../../food-order/<?php echo $fetch_menu['image_name']; ?>" alt="menu" height="100%" width="100%">
            <h2><?php echo $fetch_menu['title']; ?></h2>
          </div>
        </div>
      </li>
    <?php } } ?>

    </ul>
    </section>
    <!-- =================================food item start ============================ -->
    <section id="food-item">
      <h1 class="text-center">Bestsellers</h1>
      <div class="row">
        <?php
        include 'conn.php';
        $food_sel = "SELECT * FROM tbl_food ";
        $que2 = mysqli_query($con,$food_sel);
        if(mysqli_num_rows($que2)>0){
          while($fetch_food = mysqli_fetch_assoc($que2)){
           ?>
        <div class="col-lg-3 col-md-4 col-6">
          <form class="" action="index.php"  method="post">
            <div class="item-card">
              <div class="item-img">
                <img src="../../food-order/<?php echo $fetch_food['image_name']; ?>" alt="">
              </div>
              <h3 class="text-center"><?php echo $fetch_food['title']; ?></h3>
              <p><?php echo $fetch_food['description']; ?></p>
              <h1><?php echo $fetch_food['price']; ?></h1>
              <input type="button"   id="cart" <?php echo "data-id='{$fetch_food["id"]}'"?>  value="Add">
            </div>
          </form>
        </div>
      <?php } } ?>
        </div>
    </section>
    <script type="text/javascript">

      $(document).ready(function(){
        // ================== load header =====================
        function load(){
          $.post(
            "header.php",
              function(data){
                $('.header').html(data);
              });
        };
        // load();
        // ======================insert add to cart===================
        $(document).on("click","#cart",function(e){
          e.preventDefault();
          var Product_Id = $(this).data("id");
          <?php if(!isset($_SESSION['id'])){?>
          location.replace("login.php")
          <?php }else{ ?>
        $.post(
          "insert-cart.php",
          {Product_Id:Product_Id},
          function(data){
            if(data == 3){
            alert("Item Already Added");
            }
            else if (data == 1) {
              load();
              alert("Item Added Succesfull Check The Cart");
              
            }
          }
        );
        <?php } ?>
      });

      // ===================== menu click =======================
      $(document).on('click','#menu-click',function(){
        var cat_id = $(this).data('id');
        location.replace("food-menu.php?cat_id="+cat_id)
      })
      // ===========================food search =====================
      $(document).on('click','#search-btn',function(){
      var search_val =  $('#search-val').val();
      location.replace("food-menu.php?search="+search_val)
      });
      });
      // ===============

    </script>
  </body>
  </html>
