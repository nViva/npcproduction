<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">BERBERSHOP REPORT of <?php echo $_POST["month"]; ?></h4>
                <form method="post" action="">
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Client Name</th>
                                                    <th scope="col">Total Clients</th>
                                                    <th scope="col">Clients paid</th>
                                                    <th scope="col">Amount paid</th>
                                                    <th scope="col">Recovery</th>
                                                    <th scope="col">Debtors</th>
                                                    <th scope="col">Debit</th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');
               if(isset($_POST['reporting']))
               {
              
                $month=$_POST["month"];
               $_SESSION['month']=$month;
              
               $sql = "SELECT clients.client_name,clients.clients_number,payments.amount_paid,payments.recovery,clients.price,payments.debit FROM clients JOIN payments ON clients.client_name=payments.client_name WHERE payments.month='$month'";
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                   $sum2=0;
                    $sum3=0;
                     $sum4=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                      if(($row['clients_number']*$row['price'])<=$row['amount_paid']&& $row['debit']==0){
              $paid=$row['clients_number'];
              $debitors=0;

            }
            if(($row['clients_number']*$row['price'])<=$row['amount_paid']&& $row['debit']!=0){
              $paid=$row['clients_number'];
              $debitors=round($row['debit']/$row['price']);

            }
                     if(($row['clients_number']*$row['price'])>$row['amount_paid']){
              $debitors=round($row['clients_number']-($row['amount_paid']/$row['price']));
              $paid=$row['amount_paid']/$row['price'];

            }
            if($row['client_name']=='Visitors'){
              $paid=$paid=$row['amount_paid']/$row['price'];
              $row["clients_number"]=$paid;

            }
            

                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["client_name"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["clients_number"] ."</p>"?></th>
                       <th><?php echo "<p style='text-align:center;color:black;'>".round($paid)."</p>"?></th>
                       <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row['amount_paid']) ."</p>" ?></th>
                       <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row['recovery']) ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$debitors."</p>"?></th>
                      
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["debit"])  ."</p>"?></th>
                      
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["amount_paid"];
                 $sum2=$sum2+$row["recovery"]; 
                 $sum3=$sum3+$debitors;
                 $sum4=$sum4+$row["debit"];   
                 }
                 
                 ?>
                 <?php
                   $sql = "SELECT * FROM expenses WHERE purchased='yes' and location='Berbershop' AND DATE_FORMAT(month, '%Y-%m')='$month'";
               $result3 = $db->query($sql);
                    $count=0;
               if ($result3 -> num_rows >  0) {
                  $exp=0;
                 while ($row = $result3->fetch_assoc()) 
                 {
                  $exp=$exp+$row["approved_quantity"]*$row["unit_price"];
                     }
                   }
                   else{
                    $exp=0;
                   }
                   ?>
                   <?php


$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Berbershop' AND salaries.month='$month'";
               $result4 = $db->query($sql);
          $count=0;
          $summ1=0;
          $summ2=0;
               if ($result4 -> num_rows >  0) {
          
                 while ($row = $result4->fetch_assoc()) 
         {
  
            $summ1=$summ1+$row["salary_amount"]; 
            $summ2=$summ2+$row["bonuses"];
            }} 
            $salaries=$summ1+$summ2;
                   ?>
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th>Total </th><th></th><th></th><th></th><th><?php echo number_format($sum); ?></th><th><?php echo number_format($sum2); ?></th><th><?php echo number_format($sum3); ?></th><th><?php echo number_format($sum4); ?></th></tr>
<tr style='font-size:24px;font-weight: bold;color: black;'><th>Salaries and Bonuses</th><th></th><th></th><th></th><th><?php echo number_format($salaries); ?></th><th></th><th></th><th></th></tr>
<tr style='font-size:24px;font-weight: bold;color: black;'><th>Expenses</th><th></th><th></th><th></th><th><?php echo number_format($exp); ?></th><th></th><th></th><th></th></tr>

<tr style='font-size:24px;font-weight: bold;color: black;'><th>Net Profit</th><th></th><th></th><th></th><th><?php echo number_format($sum-$salaries-$exp); ?></th><th></th><th></th><th></th></tr>

                 <tr><th>
               <a href="berbershop_report_print.php" >Print</a>
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