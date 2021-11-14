<?php 
 include("menu.php");
?>
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
               $mysearch=$_POST["search"];

               $sql = "SELECT * FROM products WHERE productName LIKE '%$mysearch%' AND location='Canteen'";
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
            
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="5" >
               <a href="stock_print.php" ><font color="#fff">Print</font></a>
                </th></tr>
                 <?php
               }
               else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">The product you searched is not found!</th></tr>
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