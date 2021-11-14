<?php 
include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                
                <form method="post" action="editprofile.php">
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase"></thead>
                                           
                                                <tr class="table-active">
                                                    
           
                <th colspan="6" >
               Your Password updated successfully! Your New Password is: <font color="red"><?php echo " ". $_SESSION['newpass']. " "; ?></font>. 
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