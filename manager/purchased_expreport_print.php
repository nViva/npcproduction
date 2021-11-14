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
  $a=$_SESSION['from'];
  $b=$_SESSION['to'];
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
               <h4 class="header-title"> PURCHASED EXPENSES REPORT OF <?php echo $a;?> To <?php echo $b;?> AS ON <?php echo"".date("y-m-d");?></h4><hr>
                
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
                                                      <th scope="col">Quantity</th>
                                                    <th scope="col">Unit Price</th>
                                                    <th scope="col">Total Price</th>
                                                   <th>Location</th>
                                                </tr><tr><th colspan="8"><br></th></tr>
                                                <tr><hr></tr>
                                            </thead>
                                            
            <?php 
            
             include('../config.php');

                $sql = "SELECT * FROM expenses WHERE purchased='yes' and month BETWEEN '".$a."' AND '".$b."'";
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["month"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["item"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["approved_quantity"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["unit_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["approved_quantity"]*$row["unit_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["location"]  ."</p>"?></th>
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["approved_quantity"]*$row["unit_price"];    
                 }
                 
                 ?>
                <tr style='font-size:24px;font-weight: bold;color: black;background-color: #979A99;'><th>Total</th><th></th><th></th><th></th><th></th><th><?php echo number_format( $sum); ?></th><th></th></tr>
            <?php
                 
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
    Prepared by:<?php  if (isset($_SESSION['username']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];?></strong>
    
    <?php endif ?>
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRODUCTION MANAGER</strong>

</body>
</center>
</html>
