<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">VIP Sales Report</h4>
                <form method="post" action="">
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Purchasing Unit/Price</th>
                                                    <th scope="col">Quantity Sold</th>
                                                    <th scope="col">Purchases Value</th>
                                                    <th scope="col">Selling Unit/Price</th>
                                                    <th scope="col">Sales Value</th>
                                                    <th scope="col">Selling Date</th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');
               if(isset($_POST['reporting']))
               {
                $a=$_POST["from_date"];
                $b=$_POST["to_date"];
               $_SESSION['from']=$a;
               $_SESSION['to']=$b;
               //mysql_query("insert into product VALUES(,'product_name','price','quant')");

               $sql = "SELECT products.productId,sales.productId,products.productName,sales.quantity,sales.purchasing_price,sales.selling_price,sales.salesDate FROM products JOIN sales ON products.productId=sales.productId WHERE sales.salesDate BETWEEN '".$a."' AND '".$b."' AND sales.location='VIP'";
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                  $sum2=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["purchasing_price"]) ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["quantity"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["quantity"]*$row["purchasing_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["selling_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["quantity"]*$row["selling_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["salesDate"]  ."</p>"?></th>
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["quantity"]*$row["selling_price"];  
                 $sum2=$sum2+$row["quantity"]*$row["purchasing_price"];   
                 }
                 
                 ?>
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99'><th>Total</th><th></th><th><th></th><th><?php echo ($sum2); ?></th><th></th><th><?php echo number_format($sum); ?></th><th></th></tr>
                 <tr><th>
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               <a href="Sales_Report_Print.php" >Print</a>
                </th>
                 <?php
               }
               else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No Record Found for the selected dates!!!</th></tr>
                <?php
}
}
            ?>
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