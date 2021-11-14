<?php 
include("menu.php");
?>
 <?php include('changepassword.php'); ?>

<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Change Password</h4>
                <form method="post" action="change_password1.php">
               <?php include('errors2.php'); ?>
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Old Password</th>
                                                    <th scope="col">New Password</th>
                                                    <th scope="col">Re-enter New Password</th>
                                                   
                                                    
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../config.php');
               $username=$_SESSION['username'];
$result = mysqli_query($db, "SELECT * FROM users WHERE username='$username'");
$row= mysqli_fetch_array($result);
?>
                
                   <tr class="database-data" style="background-color: #2196f3;">
                    
                      <th> <input type="hidden" name="user_id" value="<?php echo $row["userID"]  ?>"><input type="password" name="oldPassword" placeholder="Enter Old Password"></th>
                      <th><input type="password" name="newPassword1" placeholder="Enter New Password"></th>
                      <th><input type="password" name="newPassword2" placeholder="Re-enter New Password"></th>
                      
                      
                    
                      
                    </tr>
           
                 <tr class="database-data"><th colspan="6" >
               <!-- <button id="PrintButton" onclick="printy()">Print</button> -->
               <input type="submit" name="change_password" value="Submit" style="" class="purchase-button">
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