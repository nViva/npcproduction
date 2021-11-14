<?php 
  include("menu.php");
?>

<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Canteen Approved Requests</h4>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Requested Quantity</th>
                                                    <th scope="col">Approved Quantity</th>
                                                    <th scope="col">Selling Price</th>
                             
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
             include('../../config.php');

               $sql = "SELECT * FROM requests WHERE location='Canteen' AND status='approved' AND purchased!='yes'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   <form method="post" action="approve.php">
                   <tr class="database-data">
                  <th><input type="hidden" name="id" value='<?php echo $row["id"]  ?>'><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php echo $row["date"] ?></th>
                      <th><?php if($row["quantity_in_stock"]=='0'){ echo"<p style='color:red'>" .$row["quantity_in_stock"]."</p>";} else{echo $row["quantity_in_stock"];}  ?></th>
                      <th><?php echo number_format($row["purchasing_price"])  ?></th>
                      <th><?php echo $row["requested_quantity"]  ?></th>
                      <th><?php echo $row["approved_quantity"]  ?></th>
                      <th><?php echo number_format($row["selling_price"])  ?></th>
            
                      
                    </tr>
                    </form>
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="8" >
               <a href="approved_print.php" ><font color="blue"> Print</font></a>
              
                </th> </tr>
                <?php
               }
               else{

            ?>
            <tr><th colspan="8"><font color="red" size="18px"> No approved requests for Canteen!</font></</th></tr>
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