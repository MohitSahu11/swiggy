<?php
 session_start();
 $page = 'cart';
 include "conn.php";
 $sel = "SELECT * FROM addtocart WHERE userid ='$_SESSION[id]'";
 $que = mysqli_query($con,$sel) or die('hatbe');
  if(mysqli_num_rows($que) > 0){
    while($fetch = mysqli_fetch_assoc($que)){
     $pi = $fetch['ProductId'];
     $qnt = $fetch['quantity'];

     $sel1 = "SELECT * FROM tbl_food WHERE id='$pi'";
     $que1 = mysqli_query($con,$sel1) or die('hatbe');
      mysqli_num_rows($que1);
        while($fetch1 = mysqli_fetch_assoc($que1)){
   ?>
   <input type="hidden" name="productid" value="<?php echo $pi ?>">
<div class="card bg-light mb-3" style="border:none!important">
  <div class="row bg-white border">
    <div class="col-4 my-auto">
      <div class="cart-img">
          <img src="../../food-order/<?php echo $fetch1['image_name']?>" class="img-fluid" alt="...">
      </div>

    </div>
    <div class="col-8">
      <div class="card-body">
        <h5 class="card-title mt-3"><?php echo $fetch1['title']?></h5>
         <h6>RS. <?php echo $fetch1['price']?></h6> <input type="hidden" class="iprice mt-3" value="<?php echo $fetch1['price']?>">
          <label for="">Qnt:</label>
         <select class="form-control iquantity" style="width:60px;" onchange='subTotal()' id="qty" name="sellist1" value="" <?php echo "data-id='{$fetch1["id"]}'" ?>>
           <?php
            $option = 5;
            $i=1;
            while ($i <= $option) { ?>
               <option <?php if($fetch['quantity'] == $i){echo "selected";} ?>><?php echo $i; ?></option>
          <?php $i++; }?>
         </select>
         <h5 class="card-title itotal" hidden></h5>
         <form id="remove-form" action="" method='post'>
          <button type='button' id='remove-cart' <?php echo "data-pid='{$fetch1["id"]}'"?> style="position:absolute;bottom:25px;right:25px;" class='btn btn-small btn-outline-danger mt-3' name='remove_item'><i class="fa fa-times" aria-hidden="true"></i></button>
         </form>
    </div>
  </div>
</div>
</div>
<?php  }  } }else{ ?>
  <div class="container text-center">
    <h6>Your Basket is empty</h6>
  </div>
<?php } ?>



<script type="text/javascript">
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    function subTotal()
    {
      gt=0;
      for(i=0;i<iprice.length;i++)
      {
        itotal[i].innerText = (iprice[i].value)*(iquantity[i].value);
        gt = gt + (iprice[i].value)*(iquantity[i].value);

      }
        gtotal.innerText = gt;
    }


    subTotal();
</script>
<!-- =====================minimum order========================= -->
 <script type="text/javascript">
    $('body').mouseover(function(){
      var grandTotal = $('.gtotal').text();
      if (grandTotal <= 150) {
        $('#minimum').html("*Minimum order value Rs 150*");
        $('#placeorder').attr('disabled','true');

      }
      else if(grandTotal >= 150) {
        $('#minimum').html("");
        $('#placeorder').removeAttr('disabled');
      }
    });

 </script>
