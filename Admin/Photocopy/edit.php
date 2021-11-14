<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../../login.php");
  }
?>
<?php

include('../../config.php');

if (isset($_POST['submit']))
{
$id=$_POST['id'];
$print_type=mysqli_real_escape_string($db, $_POST['print_type']);
$page_price=mysqli_real_escape_string($db, $_POST['page_price']);

mysqli_query($db,"UPDATE photocopy_pricing SET page_price='$page_price' WHERE id='$id'" );

header("Location:pricing.php");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM photocopy_pricing WHERE id='$id'");

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['id'];
$price = $row['page_price'];
$type = $row['type'];

}
else
{
echo "No results!";
}
}
?>
<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Update Printing Prices</h4>
                <form method="post" action="edit.php">
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Print Type</th>
                                                    <th scope="col">Price</th>
                                                     

                                                </tr>
                                            </thead>
                                            <tbody>
              
                   <tr class="database-data" style="background-color: #2196f3;">
                    
                      <th> <input type="hidden" name="id" value="<?php echo $id; ?>"/><?php echo $type; ?></th></th>
                      
                      <th><input type="number" name="page_price" value="<?php echo $price ?>"></th>
                      
                      
                    </tr>
           
                 <tr class="database-data"><th colspan="6" >
               <input type="submit" name="submit" value="Save Changes" style="" class="purchase-button"> 
                </th></tr>
                <tr class="database-data"><th colspan="6" >
               <button><a href="pricing.php" style="text-decoration: none;" class="purchase-button">Cancel</a></button> 
                </th></tr>
                 </tbody>
                                        </table>
           
                                    </div>
                                </div>
                            


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