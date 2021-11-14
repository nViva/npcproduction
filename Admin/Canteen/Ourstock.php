<?php 
  include("menu.php");
?>
<div class="topnav" id="myTopnav">
 <form method="post" action="Ourstock_Search.php">
      <input type="text" placeholder="Search.." name="search" style="margin-top: 10px;" class="search">
      
    </form>
</div>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Our Products</h4>
                <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:24px;'>You can not delete the product that have quantity in stock.</p>";
     }
    if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:24px;'>You can not delete the product with information that is being used else where.</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:24px;'>Product deleted successfully.</p>";
     }
    }
    ?>
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col">Action</th>
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $sql = "SELECT * FROM products WHERE location='Canteen'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php echo number_format($row["purchasingPrice"])  ?></th>
                      <th><?php if($row["balance"]=='0'){ echo"<p style='color:red'>" .$row["balance"]."</p>";} else{echo $row["balance"];}  ?></th>
                      <th><?php echo number_format($row["sellingPrice"])  ?></th>
            <th><a href="edit.php?id=<?php echo $row["productId"] ?>"><font color="red"> Edit</font></a> ||<a href="delete.php?id=<?php echo $row["productId"] ?>"><font color="red"> Delete</font></a></th>
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="6" >
               <a href="Stock_Print.php" ><font color="blue"> Print</font></a>
                
                </th> </tr>
              
                <?php
               }
               else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No productin Stock!</th></tr>
                <?php
}
            ?>

                                            </tbody>
                                        </table>
           
                                    </div>
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