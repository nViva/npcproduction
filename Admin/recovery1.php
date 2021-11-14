<?php 
  include"menu.php";
?>
<div class="contents">


                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="recover.php" method="post">
    <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:18px;'>Password recovered successfully. User password is: ". $_SESSION['passs']."</p>";
     }
     if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>Useranme does not exists in our database</p>";
     }
    }
    ?>
    <h1>Recover password</h1>
    <div class="add">
      <div class="col-25">
        <label for="user_name">Username</label>
      </div>
      <div class="col-75">
        <input type="text" id="user_name" name="user_name" placeholder="Username..">
      </div>
   
    </div>
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="add">
    </div>
  </form>
</div>

</body>
</html>