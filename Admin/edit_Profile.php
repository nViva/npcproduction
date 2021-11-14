<?php 
  include"menu.php";
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Edit Profile</h4>
                <form method="post" action="editprofile.php">
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">User Name</th>
                                                    <th scope="col">First Name</th>
                                                    <th scope="col">Last Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Mobile</th>
          
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
                    
                      <th> <input type="hidden" name="user_id" value="<?php echo $row["userID"]  ?>"><input type="text" name="userName" value="<?php echo $row["userName"]  ?>"></th>
                      <th><input type="text" name="firstName" value="<?php echo $row["firstName"]  ?>"></th>
                      <th><input type="text" name="lastName" value="<?php echo $row["lastName"]  ?>"></th>
                      <th><input type="text" name="email" value="<?php echo $row["email"]  ?>"></th>
                      <th> <input type="text" name="mobile" value="<?php echo $row["mobile"]  ?>"></th>
                      
                    
                      
                    </tr>
           
                 <tr class="database-data"><th colspan="6" >
               <input type="submit" name="edit_profile" value="Submit" style="" class="purchase-button">
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