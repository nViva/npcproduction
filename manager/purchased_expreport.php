<?php 
include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="header-title" style="color: green">NPC PRODUCTION REPORT</h4>
               <h4 class="header-title" style="color: green"> PURCHASED EXPENSES REPORT OF <?php echo $_POST["from_date"];?> To <?php echo $_POST["to_date"];?> AS ON <?php echo"".date("y-m-d");?></h4><hr>
                <form method="post" action="">
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">SN</th>
                                                    <th scope="col">Month </th>
                                                    <th scope="col">Item </th>
                                                      <th scope="col">Quantity</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Total Price</th>
                                                   <th>Location</th>
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
          include('../config.php');
               if(isset($_POST['reporting']))
               {
                $a=$_POST["from_date"];
                $b=$_POST["to_date"];
               $_SESSION['from']=$a;
               $_SESSION['to']=$b;
               //mysql_query("insert into product VALUES(,'product_name','price','quant')");

               $sql = "SELECT * FROM expenses WHERE purchased='yes' and month BETWEEN '".$a."' AND '".$b."'";
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["month"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["item"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["approved_quantity"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["unit_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["approved_quantity"]*$row["unit_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["location"]  ."</p>"?></th>
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["approved_quantity"]*$row["unit_price"];    
                 }
                 
                 ?>
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th>Total</th><th></th><th></th><th></th><th></th><th><?php echo number_format( $sum); ?></th><th></th></tr>
                 <tr><th>
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               <a href="purchased_expreport_print.php" style="font-size: 24px;">Print</a>
                </th>
                 <?php
               }
               else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No Record Found!!!</th></tr>
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