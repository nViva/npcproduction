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
      <link rel="stylesheet" type="text/css" href="../../reportscss">
</head>
<center>
<body  onload="window.print()">

            <div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="header-title">NPC PRODUCTION REPORT</h4>
                <h4 class="header-title">VIP STOCK BALANCE REPORT AS ON <?php echo"".date("y-m-d");?></h4><hr>
                
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active">
                             <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Initial Stock</th>
                                                  
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col">Sold Today</th>
                           

                                                    
                                                </tr><tr><th colspan="6"><br></th></tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');
               
               $sql = "SELECT * FROM products WHERE location='VIP'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
                   ?>
                  
                   
                   <tr>
                    <th><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php echo number_format($row["purchasingPrice"])  ?></th>
                      <th><?php if($row["balance"]=='0'){ echo"<p style='color:red'>" .$row["balance"]."</p>";} else{echo $row["balance"];}  ?></th>
                     
                      <th><?php echo number_format($row["sellingPrice"])  ?></th>
                      
                      
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
                    <!-- Contextual Classes end -->
                   
        <!-- main content area end -->
      






    </div>
    <br>
    <hr>
    Prepared by:<?php  if (isset($_SESSION['first_name']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seller at VIP</strong>

</body></center>

</html>
