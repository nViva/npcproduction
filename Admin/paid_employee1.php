<?php 
  include"menu.php";
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Employees Information</h4>
                <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:24px;'>Information updated successfully.</p>";
     }
    if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:24px;'>Employee deleted successfully.</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:24px;'>You have already paid ".$_SESSION['person']." for the selected month</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:24px;'>You have successfully paid ".$_SESSION['person']."</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:24px;'>Something wrong. Try again!</p>";
     }
     
    }
    ?>
                <div>
                   
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
         $month=$_POST['month'];
         $_SESSION['month']=$month;
if(isset($_POST["paid_emp"])){

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
 <tr style="font-size: 24px;font-weight: bold;"><th colspan="2">Total</th><th></th><th></th><th></th><th></th><th><?php echo number_format($sum)  ?></font></th><th><?php echo number_format($sum2)  ?></th></tr>
               <tr class="database-data"><th colspan="8" >
               <a href="paid_print.php" ><font color="blue"> Print</font></a>
                
                </th> </tr>
                 <?php
               }
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