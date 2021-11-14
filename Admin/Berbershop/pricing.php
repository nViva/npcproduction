<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Berbershop Pricing</h4>
                
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                  <th scope="col">ID</th>
                                                    <th scope="col">Client Name</th>
                                                    <th scope="col">Price</th>
                                                     <th scope="col">Action</th>     
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $sql = "SELECT * FROM clients";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><font color="black" size="4"><?php echo $count ?><font></th>
                      <th><font color="black" size="4"><?php echo $row["client_name"] ?></font></th>
                      <th><font color="black" size="4"><?php echo number_format($row["price"])  ?></font></th>
                      
            <th><a href="edit.php?id=<?php echo $row["client_name"] ?>"><font color="red" size="4"> Edit</font></a> </th>
                      
                    </tr>
                    
            <?php
                 
                 }

               }
               else{

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No Record Found!!!</th></tr>
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