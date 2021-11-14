<?php 
 include("menu.php");
?>

<div class="contents">


                                </div>
<!-- Add Item  Form -->
    
<div class="add-item">
  <form action="pay.php" method="post">
    <?php if(isset($_GET['message'])){
     
     if ($_GET['message']=='msg1') {
       echo "<p style='color:red;font-size:18px;'>This index has been used</p>";
     }
      if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Sent successfully</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid index</p>";
     }
    }
    ?>
    <h1>Payments</h1>
    <div class="add">
      <div class="col-25">
        <label for="month">Month</label>
      </div>
      <div class="col-75">
         Date:<input type="date" id="datee" name="datee" value="<?php echo date('Y-m-d');?>">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="client_name">Print type</label>
      </div>
      <div class="col-75">

        <select id="type" name="type" style="width: 100%;border-radius: 2px;height: 36px;">
          <?php 
include('../../config.php');

               $result = mysqli_query($db, "SELECT * FROM photocopy_pricing");
              while($row = mysqli_fetch_array($result)) {
    ?>   
  <option value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option><?php
                 
                 }
                 ?>
</select>
 
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="indxe">Index</label>
      </div>
      <div class="col-75">

        <input type="text" id="indxe" name="indxe" placeholder="Last index..">
      </div>
    </div>
    
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="pay">
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