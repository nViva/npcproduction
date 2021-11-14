<?php 
  include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
               <h4 class="heading">Printing Pricing</h4>
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                  <th scope="col">ID</th>
                                                    <th scope="col">Print Type</th>
                                                    <th scope="col">Price</th>
                                                     <th scope="col">Action</th>     
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
                      
            <th><a href="edit.php?id=<?php echo $row["id"] ?>"><font color="red" size="4"> Edit</font></a> </th>
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="6" >
               <a href="photocopy_pricies_print.php" ><font color="blue"> Print</font></a>
                
                </th> </tr>
              <?php
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

  
</body>
</html>