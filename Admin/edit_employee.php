<?php 
  include"menu.php";
?>

<?php

include('../config.php');

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM employees WHERE id='$id' ");

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['id'];
$emp_name = $row['emp_name'];
$job_name = $row['job_name'];
$location = $row['location'];
$salary=$row['salary'];
$bonus=$row['bonus'];
}
else
{
echo "No results!";
}
}
?>

<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Update Employees Information</h4>
                <form method="post" action="editemployee.php">
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Names</th>
                                                    <th scope="col">Job Name</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Salary</th>
                                                    <th scope="col">Bonus</th>
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
              
                   <tr class="database-data" style="background-color: #2196f3;">
                    
                      <th> <input type="hidden" name="id" value="<?php echo $id; ?>"/><input type="text" name="emp_name" value="<?php echo $emp_name; ?>"></th>
                      
                      <th><input type="text" name="job_name" value="<?php echo $job_name ?>"></th>
                      <th> <input type="text" name="location" value="<?php echo $location ?>"></th>
                      
                    <th> <input type="text" name="salary" value="<?php echo $salary ?>"></th>
                    <th> <input type="text" name="bonus" value="<?php echo $bonus ?>"></th>
                      
                    </tr>
           
                 <tr class="database-data"><th colspan="6" >
               <input type="submit" name="submit" value="Save Changes" style="" class="purchase-button"> 
                </th></tr>
                <tr class="database-data"><th colspan="7" >
               <button><a href="employees.php" style="text-decoration: none;" class="purchase-button">Cancel</a></button> 
                </th></tr>
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