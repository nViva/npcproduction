<?php 
  include"menu.php";
?>

<div class="contents">


                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="reg_employee.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>Employee registered successfully.</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Employee ID already exists in our database</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Please fill all required fields!</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Please assign location to the employee and his/her salary!</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:18px;'>Please the Other employee is assigned to Other location!</p>";
     }
     if ($_GET['message']=='msg6') {
       echo "<p style='color:red;font-size:18px;'>Please the job selected is not assigned to Other location!</p>";
     }
    }
    ?>
    <h1>Register new employee</h1>
    <div class="add">
      <div class="col-25">
        <label for="emp_name">Employee Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="emp_name" name="emp_name" placeholder="Employee Name..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="emp_id">Employee ID</label>
      </div>
      <div class="col-75">
        <input type="number" id="emp_id" name="emp_id" placeholder="Employee ID..">
      </div>
    </div>

        <div class="add">
      <div class="col-25">
        <label for="job_name">Job Name</label>
      </div>
      <div class="col-75">
        <select type="text" name="job_name">
  <option value="Manager">Manager</option>
  <option value="Seller">Seller</option>
  <option value="Berber">Berber</option>
  <option value="Other">Other</option>
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
  <option value="Berbershop">Berbershop</option>
  <option value="Other">Other</option>
</select>
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="s_salary">Amount</label>
      </div>
      <div class="col-75">
        <input type="number" id="s_salary" name="s_salary" placeholder="Employee Salary..">
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