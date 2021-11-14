<?php 
  include("menu.php");
?>
<div class="contents">


                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="add_client.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>Client registered successfully.</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Please fill all fields.</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>This client already exists in database!!!</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Something wrong!!!</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid clients number and price!!!</p>";
     }
     if ($_GET['message']=='msg6') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid price!!!</p>";
     }
    }
    ?>
    <h1>Register Clients</h1>
    <div class="add">
      <div class="col-25">
        <label for="client_name">Client Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="client_name" name="client_name" placeholder="Client name..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="clients_number">Number of Clents</label>
      </div>
      <div class="col-75">
        <input type="number" id="clients_number" name="clients_number" placeholder="Number of Clients..">
      </div>
    </div>
    
    <div class="add">
      <div class="col-25">
        <label for="price">Price</label>
      </div>
      <div class="col-75">
        <input type="number" id="price" name="price" placeholder="Price..">
      </div>
    </div>
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="add">
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