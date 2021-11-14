<?php 
  include"menu.php";
?>
<div class="contents">


                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="create.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>Client registered successfully. User password is: ". $_SESSION['passs']."</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Useranme already exists in our database</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Please fill required field!</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Please assign role to the user!</p>";
     }
    }
    ?>
    <h1>Create a User account</h1>
    <div class="add">
      <div class="col-25">
        <label for="user_name">Username</label>
      </div>
      <div class="col-75">
        <input type="text" id="user_name" name="user_name" placeholder="Username..">
      </div>
    </div>
        <div class="add">
      <div class="col-25">
        <label for="role">User Role</label>
      </div>
      <div class="col-75">
        <select name="role">
  <option value="Manager">Manager</option>
  <option value="Seller">Seller</option>
</select>
      </div>
    </div>
     <div class="add">
      <div class="col-25">
        <label for="location">Location</label>
      </div>
      <div class="col-75">
        <select name="location">
  <option value=""></option>
  <option value="Canteen">Canteen</option>
  <option value="VIP">VIP</option>
  <option value="Photocopy">Photocopy</option>
</select>
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