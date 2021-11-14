<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../../login.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>NPC PRODUCTION REPORT</title>
    <style type="text/css">
      @page {
    size: auto;
    margin: 0;
}
    </style>
    <link rel="stylesheet" type="text/css" href="../../reportscss">
</head>
<center>
<body  onload="window.print()">

            <div>
            
           <div class="main-content-inner">
                <br>
                <h4 class="heading">PHOTOCOPY MACHINE REPORT of <?php echo $_SESSION['datee1']; ?> to <?php echo $_SESSION['datee2']; ?></h4>
                <form method="post" action="purchasing.php">
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

               $datee1=$_SESSION['datee1'];
               $datee2=$_SESSION['datee2'];
         
               $sql = "SELECT * FROM photocopy WHERE datee BETWEEN '$datee1' AND '$datee2'";
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
                   $sql = "SELECT * FROM expenses WHERE purchased='yes' and location='Photocopying Machine' AND month BETWEEN '$datee1' AND '$datee2'";
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

$dateee = $datee1;
$dateeee=$datee2;
$aa=date('Y-m', strtotime($dateee));
$bb=date('Y-m', strtotime($dateeee));

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Photocopying Machine' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
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
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th>Total</th><th></th><th></th><th></th><th><?php echo number_format($sum); ?></th><th></th></tr>
                 

<tr style='font-size:24px;font-weight: bold;color: black;background-color: white;'><th>Salaries and Bonuses</th><th></th><th></th><th></th><th><?php echo number_format($salaries); ?></th><th></th></tr>

<tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th>Expenses</th><th></th><th></th><th></th><th><?php echo number_format($exp); ?></th><th></th></tr>
<tr style='font-size:24px;font-weight: bold;color: black;background-color: white;'><th>Net Profit</th><th></th><th></th><th></th><th><?php echo number_format($sum-$salaries-$exp); ?></th><th></th></tr>

            <?php
                 
                 }
                 

            ?>

                                            
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   
                    </div>
                    <!-- Contextual Classes end -->
                   
        <!-- main content area end -->
      






    </div>
    <br>
    <hr>
    Prepared by:<?php  if (isset($_SESSION['username']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRODUCTION MANAGER</strong>

</body>
</center>
</html>