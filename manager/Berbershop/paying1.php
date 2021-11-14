<?php 
  include("menu.php");
?>
<div class="contents">


                                </div>
<!-- Add Item  Form -->
    
<div class="add-item">
  <form action="pay.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>You have already paid for this month.</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Amount entered is greater than the debit. Your debit is ".$_SESSION['debit3']."</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Paid successfully. Your debit is ".$_SESSION['debit2']."</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Paid failed. Try again</p>";
     }
     if ($_GET['message']=='msg1') {
       echo "<p style='color:red;font-size:18px;'>Your debit is now paid. Debit remains is ".$_SESSION['debit']."</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:18px;'>You have selected wrong month. We are in ".$_SESSION['today_month']."</p>";
     }
     if ($_GET['message']=='msg6') {
       echo "<p style='color:red;font-size:18px;'>Paid successfully. </p>";
     }
     if ($_GET['message']=='msg7') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid amount. </p>";
     }
     if ($_GET['message']=='msg8') {
       echo "<p style='color:red;font-size:18px;'>Amount entered is greater than number of clients ".$_SESSION['number']." This number of clients pay".$_SESSION['payment']." as one pay".$_SESSION['pricee']."</p>";
     }
    }
    ?>
    <h1>Payments</h1>
    <div class="add">
      <div class="col-25">
        <label for="month">Month</label>
      </div>
      <div class="col-75">
 <input type="month" id="month" name="month" value="<?php echo date('Y-m');?>">
      </div>
    </div>
    
    <div class="add">
      <div class="col-25">
        <label for="client_name">Client Name</label>
      </div>
      <div class="col-75">

        <select id="client_name" name="client_name" style="width: 100%;border-radius: 2px;height: 36px;">
          <?php 
include('../../config.php');

               $result = mysqli_query($db, "SELECT * FROM clients");
              while($row = mysqli_fetch_array($result)) {
    ?>   
  <option value="<?php echo $row['client_name'];?>"><?php echo $row['client_name'];?></option><?php
                 
                 }
                 ?>
</select>
 
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="amount_paid">Amount paid</label>
      </div>
      <div class="col-75">

        <input type="number" id="amount_paid" name="amount_paid" placeholder="Amount paid..">
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