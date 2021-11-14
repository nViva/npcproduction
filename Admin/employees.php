<?php 
  include"menu.php";
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Employees Information</h4>
                
                <div >
                   <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:24px;'>Information updated successfully.</p>";
     }
    if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:24px;'>Employee deleted successfully.</p>";
     }
     
    }
    ?>
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Names</th>
                                                     <th scope="col">ID No</th>
                                                    <th scope="col">Job Name</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Salary</th>
                                                    <th scope="col">Bonus</th>
                                                    <th scope="col">Action</th>
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../config.php');

               $sql = "SELECT * FROM employees";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                      <th><?php echo $row["emp_name"] ?></th>
                      <th><?php echo $row["emp_id"] ?></th>
                      <th><?php echo $row["job_name"] ?></th>
                      <th><?php echo $row["location"] ?></th>
                      <th><?php echo number_format($row["salary"])  ?></th>
                      <th><?php echo number_format($row["bonus"])  ?></th>
            <th><a href="edit_employee.php?id=<?php echo $row["id"] ?>"><font color="red"> Edit</font></a> ||<a href="delete_employee.php?id=<?php echo $row["id"] ?>"><font color="red"> Delete</font></a></th>
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="8" >
               <a href="emp_print.php" ><font color="blue"> Print</font></a>
                
                </th> </tr>
              
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