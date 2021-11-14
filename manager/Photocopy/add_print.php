<?php 
include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 style="margin-right: 360px;"> Printing types we offer</h4>
                
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Print type</th>
                                                    <th scope="col"> Price</th>
                                                
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $sql = "SELECT * FROM photocopy_pricing";
              $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><font color="black" size="4"><?php echo $count ?><font></th>
                      <th><font color="black" size="4"><?php echo $row["type"] ?></font></th>
                      <th><font color="black" size="4"><?php echo number_format($row["page_price"])  ?></font></th>
            <?php
                 
                 }
               
               }

            ?>

                                            </tbody>
                                        </table>
           
                                    </div>
                                </div>
<!-- Add Item  Form -->
        
<div class="add-item">
  <form action="add_print2.php" method="post">
    <?php if(isset($_GET['message'])){
     
     if ($_GET['message']=='msg1') {
       echo "<p style='color:red;font-size:18px;'>Print type  added successfully</p>";
     }
      if ($_GET['message']=='msg2') {
       echo "<p style='color:red;font-size:18px;'>This print type already exists</p>";
     }
     if ($_GET['message']=='msg3') {
       echo "<p style='color:red;font-size:18px;'>Something wrong. Please try again</p>";
     }
     if ($_GET['message']=='msg4') {
       echo "<p style='color:red;font-size:18px;'>Please fill all fields!</p>";
     }
     if ($_GET['message']=='msg5') {
       echo "<p style='color:red;font-size:18px;'>Please enter valid price!</p>";
     }
    }
    ?>
    <h4 >Add Printing type</h4>
    <div class="add">
      <div class="col-25">
        <label for="print_type">Print type</label>
      </div>
      <div class="col-75">
        <input type="text" id="print_type" name="print_type" placeholder="Print type..">
      </div>
    </div>
    <div class="add">
      <div class="col-25">
        <label for="price">Price</label>
      </div>
      <div class="col-75">
        <input type="text" id="price" name="price" placeholder="Purchasing Price..">
      </div>
    </div>
    
    
    <div class="add">
      <input type="submit" value="Submit" class="form-submit" style="margin-top: 20px;" name="add">
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