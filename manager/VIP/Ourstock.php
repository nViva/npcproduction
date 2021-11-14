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
                
                <div>
                   
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
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $sql = "SELECT * FROM products WHERE location='VIP'";
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
                      <th><?php if($row["balance"]=='0'){ echo"<p style='color:red'>" .$row["balance"]."</p>";} else{echo number_format($row["balance"]);}  ?></th>
                      <th><?php echo number_format($row["sellingPrice"])  ?></th>
            
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="5" >
               <a href="Stock_Print.php" ><font color="blue"> Print</font></a>
              
                </th> </tr>
                <?php
               }
else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="8">No products in stock</th></tr>
                <?php
}

            ?>

                                            </tbody>
                                        </table>
           
                                    </div>
                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="additem.php" method="post">
    <?php if(isset($_GET['message'])){
     
     if ($_GET['message']=='msg1') {
       echo "<p style='color:red;font-size:18px;'>Product added successfully</p>";
     }
      if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>This product already exists</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Something wrong. Please try again</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Please fill all fields!</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid prices!</p>";
     }
    }
    ?>
    <h1>Add New Product</h1>
    <div class="add">
      <div class="col-25">
        <label for="product_name">Product Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="product_name" name="product_name" placeholder="Product name..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="price">Purchasing price</label>
      </div>
      <div class="col-75">
        <input type="number" id="price" name="price" placeholder="Purchasing Price..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="selling_price">Selling price</label>
      </div>
      <div class="col-75">
        <input type="number" id="selling_price" name="selling_price" placeholder="Selling Price..">
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