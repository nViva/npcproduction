<?php 
  include"menu.php";
?>
<body>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Users</h4>
                <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:24px;'>You have successfully blocked ".$_SESSION['userName']." from accessing NPC Inventory System</p>";
     }
    if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:24px;'>You have successfully reassigned ".$_SESSION['userName']." access to NPC Inventory System.</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:24px;'>You have successfully deleted ".$_SESSION['userName']." from users of NPC Inventory System. </p>";
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
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Username</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Mobile</th>
                                                    <th scope="col">User Type</th>
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Action</th>
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../config.php');

               $sql = "SELECT * FROM users WHERE userType!='Admin' AND userType!='Comndt'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                      <th><?php echo $row["firstName"]." ".$row["lastName"] ?></th>
                      <th><center><?php echo $row["userName"]  ?></th>
                      <th><center><?php echo $row["email"]  ?></center></th>
                      <th><center><?php echo $row["mobile"]  ?></center></th>
                      <th><center><?php echo $row["userType"]  ?></center></th>
                      <th><center><?php echo $row["location"]  ?></center></th>
            <th><center><?php if($row['status']=='Blocked'){?><a href="unblock.php?id=<?php echo $row["userID"] ?>"> Unblock</a>||<a href="delete.php?id=<?php echo $row["userID"] ?>"> Delete</a><?php } else{?><a href="block.php?id=<?php echo $row["userID"] ?>"> Block</a>||<a href="delete.php?id=<?php echo $row["userID"] ?>"> Delete</a><?php } ?></center></th>
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 
                
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