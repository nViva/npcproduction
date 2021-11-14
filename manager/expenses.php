<?php 
include("menu.php");
?>
<div class="contents">


                                </div>
<!-- Add Item  Form -->
    
<div class="add-item">
  <form action="request_exp.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>Request sent successfully. Wait for Admin to approve</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Please fill all fields!</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid price and quantity!</p>";
     }
    }
    ?>
    <h1>Requests</h1>
    <div class="add">
      <div class="col-25">
        <label for="month">Date</label>
      </div>
      <div class="col-75">
  <input type="date" readonly="" id="month" name="month" value="<?php echo date('Y-m-d');?>">
      </div>
    </div>
    
    <div class="add">
      <div class="col-25">
        <label for="item">Item</label>
      </div>
      <div class="col-75">

        <input type="text" id="item" name="item" placeholder="Item to purchase..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="qty">Quantity</label>
      </div>
      <div class="col-75">

        <input type="number" id="qty" name="qty" placeholder="Quantity..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="unit_price">Unit Price </label>
      </div>
      <div class="col-75">

        <input type="number" id="unit_price" name="unit_price" placeholder="Unit Price..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="locatoion">Where item will be used</label>
      </div>
      <div class="col-75">

        <select id="location" name="location" style="width: 100%;border-radius: 2px;height: 36px;">
          
  <option value="Canteen">Canteen</option>
  <option value="VIP">VIP</option>
  <option value="Berbershop">Berbershop</option>
  <option value="Photocopying Machine">Photocopying Machine</option>
</select>
 
      </div>
    </div>
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="request_exp">
    </div>
  </form>
</div>
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.menu-toggle').click(function(){
        $('nav').toggleClass('active')

      })
    })
    
  </script>
  
</body>
</html>