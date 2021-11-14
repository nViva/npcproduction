<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">VIP Requests </h4> 

                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Requested Quantity</th>
                                                    <th scope="col">Value</th>
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col" colspan="2">Action</th>
                           
                           
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
         include('../../config.php');

               $sql = "SELECT * FROM requests WHERE location='VIP' AND status !='rejected' AND status!='approved'";
               $result = $db->query($sql);
          $count=0;
          $sum=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
            $sum=$sum+$row["requested_quantity"]*$row["purchasing_price"];
                   ?>
                  
                   <form method="post" action="approve.php">
                   <tr class="database-data">
                  <th><input type="hidden" name="id" value='<?php echo $row["id"]  ?>'><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php if($row["quantity_in_stock"]=='0'){ echo"<p style='color:red'>" .$row["quantity_in_stock"]."</p>";} else{echo $row["quantity_in_stock"];}  ?></th>
                      <th><input type="hidden" name="price" value="<?php echo $row["purchasing_price"]  ?>"><?php echo number_format($row["purchasing_price"])  ?></th>
                      <th><input type="number" name="requested_quantity" value='<?php echo $row["requested_quantity"]  ?>'></th>
                      <th><input type="hidden" name="valu" value="<?php echo $row["requested_quantity"]*$row["purchasing_price"]  ?>"><?php echo number_format($row["requested_quantity"]*$row["purchasing_price"])  ?></th>
                      <th><?php echo number_format($row["selling_price"])  ?></th>
            <th><input type="submit" name="approve" value="Approve"></th><th><input type="submit" name="reject" value="Reject"></th>
                      
                    </tr>
                    
                    </form>
            <?php
                 
                 }
                 ?>
                 <tr style="background-color: skyblue"><td>Total</td><td></td><td></td><td></td><td></td><td><?php echo number_format($sum)  ?></td><td></td><td></td><td></td></tr>
                 <tr class="database-data"><th colspan="9" >
               <a href="requests_print.php" ><font color="blue"> Print</font></a>
              
                </th> </tr>

                 <?php
               }
               else{

            ?>
            <tr><th colspan="8"><font color="red" size="18"> No request for VIP!</font></th></tr>
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