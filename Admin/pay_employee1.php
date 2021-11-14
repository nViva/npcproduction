<?php 
  include"menu.php";
?>
<?php if(isset($_GET["id"])){
  $id=$_GET["id"];
$_SESSION['id']=$id;
  ?>
<div class="contents">

<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="pay_employee2.php" method="post">
    <h1>Month: </h1>
<input type="month" id="monthly" name="month" value="<?php echo date('Y-m');?>"> 
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="emp_payment">
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
<?php }?>
