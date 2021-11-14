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
               <center> <h4 class="header-title">NPC PRODUCTION REPORT</h4>
                <h4 class="header-title">VIP INCOME STATEMENT REPORT OF <?php echo $_SESSION['from'];?> To <?php echo $_SESSION['to']?> AS ON <?php echo"".date("y-m-d");?></h4></center><hr>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active" style="background-color: #2196f3;">
                   <th scope="col">S/N</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Purchasing Unit/Price</th><th scope="col">Initial Stock</th>
                                                    <th scope="col">Purchases</th>
                                                    <th scope="col">Purchases value</th>
                                                    <th scope="col">Total Stock</th>
                                                    <th scope="col">Sold Stock</th>
                                                    <th scope="col">Sold Stock Value</th>
                                                    <th scope="col">Selling Unit/Price</th>
                                                    <th scope="col">SALES VALUE</th>
                                                    <th scope="col">Quantity Damaged</th>
                                                    <th scope="col">Damages Value</th>
                                                   
                                                    <th scope="col">GROSS PROFIT</th>
                                                    <th scope="col">Closing stock</th>
                                                 

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');
              
               $aa=$_SESSION['from'];
               $bb=$_SESSION['to'];

function purchase($id,$aa,$bb)
{
  include('../../config.php');
$sql2 ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='VIP' AND purchaseDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql2);
               if ($res -> num_rows >  0) {
                  
                 while ($row2 = $res->fetch_assoc()) 
                 {
return $row2['total'];
}
}
}
function damages($id,$aa,$bb)
{
  include('../../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='VIP' AND damagesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}
function sales($id,$aa,$bb)
{
  include('../../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='VIP' AND salesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}

function beforePurchase($id,$aa)
{
  include('../../config.php');
$sqlb ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='vip' AND purchaseDate<'$aa' GROUP BY productId";
$res = $db->query($sqlb);
               if ($res -> num_rows >  0) {
                  
                 while ($row2 = $res->fetch_assoc()) 
                 {
return $row2['total'];
}
}
}
function beforeDamages($id,$aa)
{
  include('../../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='VIP' AND damagesDate<'$aa' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}
function beforeSales($id,$aa)
{
  include('../../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='VIP' AND salesDate<'$aa' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}

function initial($id,$aa)
{
 $purchase=beforePurchase($id,$aa);
 $damages=beforeDamages($id,$aa);
  $sales=beforeSales($id,$aa);
  $total=$purchase-($damages+$sales);
return $total;

}

              $sql = "SELECT products.productId,products.productName,SUM(sales.quantity) AS sold,products.purchasingPrice,sales.selling_price,SUM(sales.quantity)*sales.selling_price as sales_value,(SUM(sales.quantity)*products.purchasingPrice) AS Soldstock_value,(SUM(sales.quantity)*sales.selling_price)-(SUM(sales.quantity)*products.purchasingPrice) AS Profit,purchases.price FROM products LEFT JOIN sales ON products.productId=sales.productId LEFT JOIN purchases ON products.productId=purchases.productId LEFT JOIN damages ON products.productId=damages.productId WHERE sales.salesDate BETWEEN '$aa' AND '$bb' AND sales.location='VIP' or purchases.purchaseDate BETWEEN '$aa' AND '$bb' AND purchases.location='VIP' or damages.damagesDate BETWEEN '$aa' AND '$bb' AND damages.location='VIP' GROUP BY products.productId";


               
               $result = $db->query($sql);
                    $count=0;
                  
                  $purchase_val=0;
                  $sold_stockval=0;
                  $sales_val=0;
                  $damages_val=0;
                  $gross_profit=0;
               if ($result -> num_rows >  0) {
                  
                 while ($row = $result->fetch_assoc()) 
                 {
                      $count=$count+1;
                      $ca=$row["productId"];
                     
                     $quantity=purchase($ca,$aa,$bb);
                     $dama=damages($ca,$aa,$bb);
                     $sale=sales($ca,$aa,$bb);
                     $initial=initial($ca,$aa);

                     $aaa=$sale*$row["selling_price"]-($sale*$row["purchasingPrice"]+$dama*$row["purchasingPrice"]);

                                       ?>
                
                   
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th><?php echo "<p style='text-align:center;color:black;'>".$count ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$row["productName"] ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["purchasingPrice"]) ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$initial."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$quantity."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$quantity*$row["purchasingPrice"]."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".($initial+$quantity)."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$sale."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($sale*$row["purchasingPrice"]) ."</p>" ?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($row["selling_price"])  ."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".number_format($sale*$row["selling_price"])  ."</p>"?></th>
                      <th><?php if(empty($dama)): echo "<p style='text-align:center;color:black;'>0</p>";endif; echo "<p style='text-align:center;color:black;'>".$dama."</p>"?></th>
                      <th><?php echo "<p style='text-align:center;color:black;'>".$dama*$row["purchasingPrice"]."</p>"?></th>
                      
                      <th><?php if ($aaa<0) { ?>
                        
                       <font color="red"> <?php echo number_format($aaa);} else{?></font> <?php  echo"<font color='black'>" .number_format($aaa)."</font>"; }?></th> 
                      <th><?php echo "<p style='text-align:center;color:black;'>".(($initial+$quantity)-($sale+$dama))."</p>" ?></th>
                    </tr>
            <?php
            
                 $purchase_val=$purchase_val+$quantity*$row["purchasingPrice"];
                 $sold_stockval=$sold_stockval+$sale*$row["purchasingPrice"];
                 $sales_val=$sales_val+$sale*$row["selling_price"];
                 $damages_val+=$dama*$row["purchasingPrice"];
                 $gross_profit+=$aaa;

                 }
                 }
                 ?>
               
                 <?php
                   $sql = "SELECT * FROM expenses WHERE purchased='yes' and location='VIP' AND month BETWEEN '".$aa."' AND '".$bb."'";
               $result3 = $db->query($sql);
                    $count=0;
               if ($result3 -> num_rows >  0) {
                  $exp=0;
                 while ($row = $result3->fetch_assoc()) 
                 {
                  $exp=$exp+$row["approved_quantity"]*$row["unit_price"];
                     }
                   }
                   else{
                    $exp=0;
                   }
                   ?>
                   <?php
$dateee = $aa;
$dateeee=$bb;
$aa=date('Y-m', strtotime($dateee));
$bb=date('Y-m', strtotime($dateeee));

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='VIP' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
               $result4 = $db->query($sql);
          $count=0;
          $summ1=0;
          $summ2=0;
               if ($result4 -> num_rows >  0) {
          
                 while ($row = $result4->fetch_assoc()) 
         {
  
            $summ1=$summ1+$row["salary_amount"]; 
            $summ2=$summ2+$row["bonuses"];
            }} 
            $salaries=$summ1+$summ2;
                   ?>
                 <?php
               
               if($result -> num_rows>0 || $result3 -> num_rows>0 || $result4 -> num_rows>0){

                ?>
                 <tr style='font-size:24px;;color:black;background-color: #979A99'><th>Total</th><th></th><th></th><th></th><th></th><th> <?php echo number_format($purchase_val); ?> </th><th></th><th></th><th><?php echo number_format($sold_stockval); ?></th><th></th><th><?php echo number_format($sales_val); ?></th><th></th><th><?php echo number_format($damages_val); ?></th><th><?php echo number_format($gross_profit) ?></th><th></th></tr>
                 

<tr style='font-size:24px;;color:black;'><th colspan="4">Salaries and Bonuses</th><th></th><th><th></th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><?php echo number_format($salaries) ?></th><th></th></tr>

<tr style='font-size:24px;;color:black;'><th>Expenses</th><th></th><th></th><th></th><th></th><th><th></th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><?php echo number_format($exp) ?></th></tr>
<tr style='font-size:24px;;color:black;'><th>Net Profit</th><th></th><th></th><th></th><th></th><th><th></th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><?php echo number_format($gross_profit-$exp-$salaries) ?></th><th></th></tr>
                
      <?php }

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
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PRODUCTION MANAGER</strong>

</body>
</center>
</html>