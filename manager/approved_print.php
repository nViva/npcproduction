<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../../login.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">

<head>
    <title>NPC PRODUCTION REPORT</title>
    <style type="text/css">
      @page {
    size: auto;
    margin: 0;
}
    </style>
    <link rel="stylesheet" type="text/css" href="../reportscss">
</head>
<center>
<body  onload="window.print()">

            <div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="header-title">NPC PRODUCTION REPORT</h4>
                <h4 class="header-title"> APPROVED REQUESTS FOR EXPENSES TO BE PURCHASED</h4><hr>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active">
                                               <th scope="col">SN</th>
                                                      <th scope="col">Month </th>
                                                    <th scope="col">Item </th>
                                                    <th scope="col">Requested Quantity</th>
                                                      <th scope="col">Approved Quantity</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Total Price</th>
                                                   <th>Location</th>


                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
              include('../config.php');

               $sql = "SELECT * FROM expenses WHERE status='approved' AND purchased!='yes'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   <form method="post" action="">
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                  <th><?php echo $row["month"] ?></th>
                      <th><?php echo $row["item"] ?></th>
                      <th><?php echo $row["req_quantity"]  ?></th>
                      <th><?php echo $row["approved_quantity"] ?></th>
                      <th><?php echo number_format($row["unit_price"])  ?></th>
           
                      <th><?php echo number_format($row["unit_price"]*$row['approved_quantity'])  ?></th>
                      <th><?php echo $row["location"] ?></th>
                      
                    </tr>
            <?php
                 
                 }
                } 

            ?>

                                            
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   
                    </div>

    </div>
    <br>
    <hr>
    Prepared by:<?php  if (isset($_SESSION['first_name']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NPC ADMIN</strong>

</body></center>

</html>
