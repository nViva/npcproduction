<?php 
  include"menu.php";
?>
<div class="contents">

<div>
            
            <div class="main-content-inner" >
                <br>
                <h4 class="heading">Expenses Requests</h4>
                
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Item </th>
                              
                                                    <th scope="col">Requested Quantity</th>
                                                    <th scope="col">unit Price</th>
                                                    <th scope="col" colspan="2">Action</th>
                           
                           
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
            include('../config.php');

               $sql = "SELECT * FROM expenses WHERE status !='rejected' AND status!='approved'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   <form method="post" action="approve.php">
                   <tr class="database-data">
                  <th><input type="hidden" name="id" value='<?php echo $row["id"]  ?>'><?php echo $count ?></th>
                      <th><?php echo $row["item"] ?></th>
        
                      <th><input type="number" name="requested_quantity" value='<?php echo $row["req_quantity"]  ?>'></th>
                      <th><?php echo number_format($row["unit_price"])  ?></th>
            <th><input type="submit" name="approve" value="Approve"></th><th><input type="submit" name="reject" value="Reject"></th>
                      
                    </tr>
                    </form>
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="8" >
               <a href="requests_print.php" ><font color="blue"> Print</font></a>
              
                </th> </tr>

                 <?php
               }
               else{

            ?>
            <tr><th colspan="8"><font color="red" size="18"> No request </font></th></tr>
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