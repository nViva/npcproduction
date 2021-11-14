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
  $b=  $_SESSION['to'];
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
               <h4 class="header-title">CANTEEN DAMAGES REPORT OF <?php echo $a;?> To <?php echo $b;?> AS ON <?php echo"".date("y-m-d");?></h4><hr>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active">
                                                    <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Quantity Damaged</th>
                                                    <th scope="col">Explanations</th>
                                                    <th scope="col">Purchasing Unit/Price</th>
                                                    <th scope="col">Damages Value</th>
                                                    <th scope="col">Date</th>
                                                     
                                                     

                                                    
                                                </tr><tr><th colspan="8"><br></th></tr>
                                                <tr><hr></tr>
                                            </thead>
                                            
            <?php 
            
            include('../../config.php');
               //mysql_query("insert into product VALUES(,'product_name','price','quant')");

                $sql = "SELECT products.productId,damages.productId,products.productName,damages.quantity,damages.purchasing_price,damages.damagesDate,damages.explanation FROM products JOIN damages ON products.productId=damages.productId WHERE damages.damagesDate BETWEEN '".$a."' AND '".$b."' AND damages.location='Canteen'";
               
               $result = $db->query($sql);
                    $count=0;
               if ($result -> num_rows >  0) {
                  $sum=0;
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                   ?>
                  
                   
                   <tr class="database-data">
                    <th ><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["quantity"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["explanation"] ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["purchasing_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["quantity"]*$row["purchasing_price"] ) ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["damagesDate"]  ."</p>"?></th>
                      
                      
                    
                      
                    </tr>
            <?php
            
                 $sum=$sum+$row["quantity"]*$row["purchasing_price"];    
                 }
                 
                 ?>
                 
                 <tr style='font-size:24px;'><th>Total</th><th></th><th></th><th></th><th></th><th><?php echo number_format($sum); ?></th></tr>
                
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
