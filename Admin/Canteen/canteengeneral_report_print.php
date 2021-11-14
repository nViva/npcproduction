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
                <h4 class="heading"> GENERAL INCOME STATEMENT REPORT OF <?php echo $_SESSION['from'];?> To <?php echo $_SESSION['to']?> AS ON <?php echo"".date("y-m-d");?></h4></center>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                             <thead class="text-uppercase">
                                               <tr class="table-active" style="background-color: #2196f3;">
                                                    
                                                    <th scope="col">Location</th>
                                                    <th scope="col">Initial Stock (Rwf)</th>
                                                    <th scope="col">Purchases (Rwf)</th>
                                                    <th scope="col">Total Stock (Rwf)</th>
                                                    <th scope="col">Sold Stock (Rwf)</th>
                    
                                                    <th scope="col">SALES (Rwf)</th>
                                                    <th scope="col">Gross Profit (Rwf)</th>
                                                    <th scope="col">Expenses (Rwf)</th>
                                                    <th scope="col">Salaries and Bonuses (Rwf)</th>
                                                    <th scope="col">Net profit (Rwf)</th>
                                                    <th scope="col">Closing Stock (Rwf)</th>
                                             

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
$sql2 ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='Canteen' AND purchaseDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
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
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='Canteen' AND damagesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
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
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='Canteen' AND salesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
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
$sqlb ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='Canteen' AND purchaseDate<'$aa' GROUP BY productId";
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
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='Canteen' AND damagesDate<'$aa' GROUP BY productId";
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
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='Canteen' AND salesDate<'$aa' GROUP BY productId";
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

              $sql = "SELECT products.productId,products.productName,SUM(sales.quantity) AS sold,products.purchasingPrice,sales.selling_price,SUM(sales.quantity)*sales.selling_price as sales_value,(SUM(sales.quantity)*products.purchasingPrice) AS Soldstock_value,(SUM(sales.quantity)*sales.selling_price)-(SUM(sales.quantity)*products.purchasingPrice) AS Profit,purchases.price FROM products LEFT JOIN sales ON products.productId=sales.productId LEFT JOIN purchases ON products.productId=purchases.productId LEFT JOIN damages ON products.productId=damages.productId WHERE sales.salesDate BETWEEN '$aa' AND '$bb' AND sales.location='Canteen' or purchases.purchaseDate BETWEEN '$aa' AND '$bb' AND purchases.location='Canteen' or damages.damagesDate BETWEEN '$aa' AND '$bb' AND damages.location='Canteen' GROUP BY products.productId";


               
               $result = $db->query($sql);
                    $count=0;
                  
                  $purchase_val=0;
                  $sold_stockval=0;
                  $sales_val=0;
                  $damages_val=0;
                  $gross_profit=0;
                   $closing_stock=0;
                   $initial_val=0;
                   $total_stockval=0;
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

                 $purchase_val=$purchase_val+$quantity*$row["purchasingPrice"];
                 $sold_stockval=$sold_stockval+$sale*$row["purchasingPrice"];
                 $sales_val=$sales_val+$sale*$row["selling_price"];
                 $damages_val+=$dama*$row["purchasingPrice"];
                 $gross_profit+=$aaa;
                 $closing_stock+=$row["purchasingPrice"]*(($initial+$quantity)-($sale+$dama));
                 $initial_val+=$initial*$row["purchasingPrice"];
                 $total_stockval+=$row["purchasingPrice"]*($initial+$quantity);

                 }
                 }
                 ?>
               
                 <?php
                   $sql = "SELECT * FROM expenses WHERE purchased='yes' and location='Canteen' AND month BETWEEN '".$aa."' AND '".$bb."'";
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

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Canteen' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
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
                 <tr style='font-size:24px;color:black;background-color: #979A99'><th>Canteen</th><th><?php echo number_format($initial_val); ?></th><th><?php echo number_format($purchase_val); ?></th><th><?php echo number_format($total_stockval); ?></th><th><?php echo number_format($sold_stockval); ?></th><th><?php echo number_format($sales_val); ?></th><th><?php echo number_format($gross_profit) ?></th><th><?php echo number_format($exp) ?></th><th><?php echo number_format($salaries) ?></th><th><?php echo number_format($gross_profit-$exp-$salaries) ?></th><th><?php echo number_format($closing_stock) ?></th></tr>
                 


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
    <br><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NPC ADMIN</strong>

</body>
</center>
</html>