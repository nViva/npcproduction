<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../login.php");
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
    <link rel="stylesheet" type="text/css" href="../reportscss">
</head>
<center>
<body  onload="window.print()">

            <div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="header-title">NPC PRODUCTION REPORT</h4>
                <h4 class="header-title">SALARIES REPORT AS ON <?php echo"".date("y-m-d");?></h4><hr>
                
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active">
                                                     <th scope="col">SN</th>
                                                     <th scope="col">Month</th>
                                                    <th scope="col">Names</th>
                                                    <th scope="col">ID No</th>
                                                    <th scope="col">Job Name</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Salary</th>
                                                    <th scope="col">Bonus</th>
                                      
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../config.php');
$month=$_SESSION['month'];
              $sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE salaries.month='$month' ";
               $result = $db->query($sql);
          $count=0;
          $sum=0;
          $sum2=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
            $sum=$sum+$row["salary_amount"]; 
            $sum2=$sum2+$row["bonuses"]; 
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                  <th><?php echo $row["month"] ?></th>
                      <th><?php echo $row["emp_name"] ?></th>
                      <th><?php echo $row["emp_id"] ?></th>
                      <th><?php echo $row["job_name"] ?></th>
                      <th><?php echo $row["location"] ?></th>
                      <th><?php echo number_format($row["salary_amount"])  ?></th>
                      <th><?php echo number_format($row["bonuses"])  ?></th>
          
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr><th colspan="2">Total</th><th></th><th></th><th></th><th></th><th><?php echo number_format($sum)  ?></th><th><?php echo number_format($sum2)  ?></th></tr>
                 <?php
                } 

            ?>

                                            
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   
                    </div>

    </div>
    <br>
    <hr>
    Prepared by:<?php  if (isset($_SESSION['first_name']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPC ADMIN</strong>

</body></center>

</html>
