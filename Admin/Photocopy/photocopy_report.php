<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">PHOTOCOPY MACHINE REPORT of <?php echo $_POST["from"]; ?> to <?php echo $_POST["to"]; ?></h4>
                <form method="post" action="">
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Starting index</th>
                                                    <th scope="col">Copies</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Ending index</th>
                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');
               if(isset($_POST['reporting']))
               {
              
                $from=$_POST["from"];
                 $to=$_POST["to"];
               $_SESSION['from']=$from;
                $_SESSION['to']=$to;
              
            $sql = "SELECT * FROM photocopy WHERE datee BETWEEN '".$from."' AND '".$to."'";
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                      $start=$row['indxe']-$row['copies_nber'];

                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["datee"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$start ."</p>"?></th>
                       <th><?php echo "<p style='text-align:center;color:black;'>".$row['copies_nber'] ."</p>" ?></th>
                       <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row['amount']) ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row['indxe'] ."</p>" ?></th>
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["amount"];    
                 }
                 
                 ?>

    <?php
                   $sql = "SELECT * FROM expenses WHERE purchased='yes' and location='Berbershop' AND month BETWEEN '$from' AND '$to'";
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

$dateee = $from;
$dateeee=$to;
$aa=date('Y-m', strtotime($dateee));
$bb=date('Y-m', strtotime($dateeee));

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Canteen' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
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
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th colspan="4">Total</th><th><?php echo number_format($sum); ?></th><th></th></tr>
                 

<tr style='font-size:24px;font-weight: bold;color: black;background-color: white;'><th colspan="4">Salaries and Bonuses</th><th><?php echo number_format($salaries); ?></th><th></th></tr>

<tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th colspan="4">Expenses</th><th><?php echo number_format($exp); ?></th><th></th></tr>
<tr style='font-size:24px;font-weight: bold;color: black;background-color: white;'><th colspan="4">Net Profit</th><th><?php echo number_format($sum-$salaries-$exp); ?></th><th></th></tr>
                 <tr><th>

               <a href="photocopy_report_print.php" >Print</a>
                </th></tr>
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