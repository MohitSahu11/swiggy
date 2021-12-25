<?php @session_start();?>
<style media="screen">
  .navbar {
    padding: 15px;
  }
  .navbar .navbar-brand{
    margin-left: 40px;
    font-weight: bolder;
  }
  .navbar .navbar-nav{
    margin-right: 40px;
  }
  .navbar .navbar-nav .nav-item{
    margin-left: 30px;
    font-weight: bold;
  }
  .navbar .navbar-nav .active{
    font-weight: bold;
  }
  .navbar .navbar-nav .btn{
    margin-top: 1px!important;
    margin-left: -10px!important;
    padding-top: 4px;
    padding-bottom: 6px;
   padding-left: 20px;
   padding-right: 20px;
   font-weight: 600;
   border-radius:15px;
  }
  #signup{
  background: rgb(254,86,52);
  }
  #signin{
    background: rgb(255,185,53);
  }
  @media screen and (max-width:990px){
    .navbar .navbar-brand{
    margin-left: 0px;
    font-weight: bolder;
  }
    .navbar .navbar-nav .btn{
      padding: 0;
      background: none;
    }
    #signup,#signin{
      color: rgb(127,127,127)!important;
    background:none;
    border: none;
    margin-left: 0px!important;
    padding-top: 0px;
    padding-bottom: 0px;
   padding-left: 0px;
   padding-right: 0px;
   font-weight: bold;
   border-radius:0px;
   line-height: 30px;
    }
    #signup{
    margin-top:10px!important;
    }
  }
</style>
<nav class="navbar navbar-expand-lg bg-white navbar-light fixed-top">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><img src="assets/logo.png" height="30px" alt=""></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse " id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link <?php if($page == 'home'){echo 'active';} ?>" href="index.php">Home <span class="sr-only">Home</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($page == 'food-menu'){echo 'active';} ?>" href="food-menu.php">Food Menu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($page == 'my-order'){echo 'active';} ?>" href="my-order.php">My Order</a>
      </li>
      <?php
      include "conn.php";
      @$userid = $_SESSION['id'];
       $sel = "SELECT * FROM addtocart WHERE userid = '$userid'";
       $que = mysqli_query($con,$sel) or die('hatbe');
        $fetch = mysqli_num_rows($que);
        ?>
      <?php if(isset($_SESSION['id'])){ ?>
      <li class="nav-item">
        <a class="nav-link <?php if(!$page == 'cart'){echo 'active';} ?>" id='cart-link' href="cart.php">Cart<span class="text-danger ml-1"><?php  echo $fetch;?></span></a>
      </li>
    <?php } ?>
      <li class="nav-item">
        <a class="nav-link <?php if($page == 'order-status'){echo 'active';} ?>" href="#">Order Status</a>
      </li>
      <?php if(!isset($_SESSION['id'])){ ?>
      <li class="nav-item">
        <a class="nav-link btn btn-lg-warning text-left text-white " id="signin" href="login.php">Sign in</a>
      </li>
      <li class="nav-item">
        <a class="nav-link btn btn-lg-danger text-left text-white " id="signup" href="signup.php">Sign up</a>
      </li>
    <?php } ?>
    </ul>
  </div>
</nav>
