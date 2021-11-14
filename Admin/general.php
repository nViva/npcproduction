<?php 
  include"menu.php";
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                
              <h4 class="heading">NPC PRODUCTION REPORT</h4><br>
                <h4 class="heading"> GENERAL INCOME STATEMENT REPORT OF <?php echo $_POST['from_date'];?> To <?php echo $_POST['to_date']?> AS ON <?php echo"".date("y-m-d");?></h4>
                <div>
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div  class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                  <th scope="col">SN</th>
                                                  <th scope="col">Location</th>
                                                  <th scope="col">Initial Stock (Rwf)</th>
                                                    <th scope="col">Purchases (Rwf)</th>
                                                    <th scope="col">Total Stock (Rwf)</th>
                                                    <th scope="col">Sold Stock (Rwf)</th>
                    
                                                    <th scope="col">Sales (Rwf)</th>
                                                    <th scope="col">Gross Profit (Rwf)</th>
                                                    <th scope="col">Expenses (Rwf)</th>
                                                    <th scope="col">Salaries and Bonuses (Rwf)</th>
                                                    <th scope="col">Net profit (Rwf)</th>
                                                    <th scope="col">Closing Stock (Rwf)</th>
                                             

                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../config.php');
               if(isset($_POST['reporting']))
               {
                $aa=$_POST["from_date"];
                $bb=$_POST["to_date"];
               $_SESSION['from']=$aa;
               $_SESSION['to']=$bb;
               
            function purchase($id,$aa,$bb)
{
 include('../config.php');
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
 include('../config.php');
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
include('../config.php');
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
include('../config.php');
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
include('../config.php');
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
include('../config.php');
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


               
               $resulta = $db->query($sql);
                    $count=0;
                  
                  $purchase_val1=0;
                  $sold_stockval1=0;
                  $sales_val1=0;
                  $damages_val1=0;
                  $gross_profit1=0;
                   $closing_stock1=0;
                   $initial_val1=0;
                   $total_stockval1=0;
               if ($resulta -> num_rows >  0) {
                  
                 while ($row = $resulta->fetch_assoc()) 
                 {
                      $count=$count+1;
                      $ca=$row["productId"];
                     
                     $quantity=purchase($ca,$aa,$bb);
                     $dama=damages($ca,$aa,$bb);
                     $sale=sales($ca,$aa,$bb);
                     $initial=initial($ca,$aa);

                     $aaa=$sale*$row["selling_price"]-($sale*$row["purchasingPrice"]+$dama*$row["purchasingPrice"]);

                 $purchase_val1=$purchase_val1+$quantity*$row["purchasingPrice"];
                 $sold_stockval1=$sold_stockval1+$sale*$row["purchasingPrice"];
                 $sales_val1=$sales_val1+$sale*$row["selling_price"];
                 $damages_val1+=$dama*$row["purchasingPrice"];
                 $gross_profit1+=$aaa;
                 $closing_stock1+=$row["purchasingPrice"]*(($initial+$quantity)-($sale+$dama));
                 $initial_val1+=$initial*$row["purchasingPrice"];
                 $total_stockval1+=$row["purchasingPrice"]*($initial+$quantity);

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
               $aa=$_POST["from_date"];
                $bb=$_POST["to_date"];
              
                      function purchase2($id,$aa,$bb)
{
include('../config.php');
$sql2 ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='VIP' AND purchaseDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql2);
               if ($res -> num_rows >  0) {
                  
                 while ($row2 = $res->fetch_assoc()) 
                 {
return $row2['total'];
}
}
}
function damages2($id,$aa,$bb)
{
  include('../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='VIP' AND damagesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}
function sales2($id,$aa,$bb)
{
 include('../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='VIP' AND salesDate BETWEEN '$aa' AND '$bb' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}

function beforePurchase2($id,$aa)
{
 include('../config.php');
$sqlb ="SELECT SUM(quantity) as total  FROM purchases where productId='$id' and location='VIP' AND purchaseDate<'$aa' GROUP BY productId";
$res = $db->query($sqlb);
               if ($res -> num_rows >  0) {
                  
                 while ($row2 = $res->fetch_assoc()) 
                 {
return $row2['total'];
}
}
}
function beforeDamages2($id,$aa)
{
include('../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM damages where productId='$id' and location='VIP' AND damagesDate<'$aa' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}
function beforeSales2($id,$aa)
{
  include('../config.php');
$sql3 ="SELECT SUM(quantity) as total  FROM sales where productId='$id' and location='VIP' AND salesDate<'$aa' GROUP BY productId";
$res = $db->query($sql3);
               if ($res -> num_rows >  0) {
                  
                 while ($row3 = $res->fetch_assoc()) 
                 {
return $row3['total'];
}
}
}

function initial2($id,$aa)
{
 $purchase=beforePurchase2($id,$aa);
 $damages=beforeDamages2($id,$aa);
  $sales=beforeSales2($id,$aa);
  $total=$purchase-($damages+$sales);
return $total;

}

              $sqlb = "SELECT products.productId,products.productName,SUM(sales.quantity) AS sold,products.purchasingPrice,sales.selling_price,SUM(sales.quantity)*sales.selling_price as sales_value,(SUM(sales.quantity)*products.purchasingPrice) AS Soldstock_value,(SUM(sales.quantity)*sales.selling_price)-(SUM(sales.quantity)*products.purchasingPrice) AS Profit,purchases.price FROM products LEFT JOIN sales ON products.productId=sales.productId LEFT JOIN purchases ON products.productId=purchases.productId LEFT JOIN damages ON products.productId=damages.productId WHERE sales.salesDate BETWEEN '$aa' AND '$bb' AND sales.location='VIP' or purchases.purchaseDate BETWEEN '$aa' AND '$bb' AND purchases.location='VIP' or damages.damagesDate BETWEEN '$aa' AND '$bb' AND damages.location='VIP' GROUP BY products.productId";


               
               $resultb = $db->query($sqlb);
                    $count=0;
                  
                  $purchase_val2=0;
                  $sold_stockval2=0;
                  $sales_val2=0;
                  $damages_val2=0;
                  $gross_profit2=0;
                   $closing_stock2=0;
                   $initial_val2=0;
                   $total_stockval2=0;
               if ($resultb -> num_rows >  0) {
                  
                 while ($row = $resultb->fetch_assoc()) 
                 {
                      $count=$count+1;
                      $ca=$row["productId"];
                     
                     $quantity=purchase2($ca,$aa,$bb);
                     $dama=damages2($ca,$aa,$bb);
                     $sale=sales2($ca,$aa,$bb);
                     $initial=initial2($ca,$aa);

                     $aaa=$sale*$row["selling_price"]-($sale*$row["purchasingPrice"]+$dama*$row["purchasingPrice"]);

                 $purchase_val2=$purchase_val2+$quantity*$row["purchasingPrice"];
                 $sold_stockval2=$sold_stockval2+$sale*$row["purchasingPrice"];
                 $sales_val2=$sales_val2+$sale*$row["selling_price"];
                 $damages_val2+=$dama*$row["purchasingPrice"];
                 $gross_profit2+=$aaa;
                 $closing_stock2+=$row["purchasingPrice"]*(($initial+$quantity)-($sale+$dama));
                 $initial_val2+=$initial*$row["purchasingPrice"];
                 $total_stockval2+=$row["purchasingPrice"]*($initial+$quantity);

                 }
                 }
                 ?>

                 <?php
                   $sqla = "SELECT * FROM expenses WHERE purchased='yes' and location='VIP' AND month BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
               $result7 = $db->query($sqla);
                  $exp2=0;
               if ($result7 -> num_rows >  0) {
                  
                 while ($row = $result7->fetch_assoc()) 
                 {
                  $exp2=$exp2+$row["approved_quantity"]*$row["unit_price"];
                     }
                   }
                   else{
                    $exp2=0;
                   }
                   ?>
                   <?php

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='VIP' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
               $result8 = $db->query($sql);
          $count=0;
          $summmm1=0;
          $summmm2=0;
               if ($result8 -> num_rows >  0) {
          
                 while ($row = $result8->fetch_assoc()) 
         {
  
            $summmm1=$summmm1+$row["salary_amount"]; 
            $summmm2=$summmm2+$row["bonuses"];
            }} 
            $salaries2=$summmm1+$summmm2;
                   ?>
               
<?php
            
$dateee = $_POST["from_date"];
$dateeee=$_POST["to_date"];
$aa=date('Y-m', strtotime($dateee));
$bb=date('Y-m', strtotime($dateeee));

                   $sql = "SELECT clients.client_name,clients.clients_number,payments.amount_paid,payments.recovery,clients.price,payments.debit FROM clients JOIN payments ON clients.client_name=payments.client_name WHERE payments.month BETWEEN '$aa' AND '$bb'";
               $result9 = $db->query($sql);
                    $count=0;
                     $suma=0;
                   $suma2=0;
                    $suma3=0;
                     $suma4=0;
               if ($result9 -> num_rows >  0) {
                 
                 while ($row = $result9->fetch_assoc()) 
                 {
      
                      if(($row['clients_number']*$row['price'])<=$row['amount_paid']&& $row['debit']==0){
              $paid=$row['clients_number'];
              $debitors=0;

            }
            if(($row['clients_number']*$row['price'])<=$row['amount_paid']&& $row['debit']!=0){
              $paid=$row['clients_number'];
              $debitors=round($row['debit']/$row['price']);

            }
                     if(($row['clients_number']*$row['price'])>$row['amount_paid']){
              $debitors=round($row['clients_number']-($row['amount_paid']/$row['price']));
              $paid=$row['amount_paid']/$row['price'];

            }
            if($row['client_name']=='Visitors'){
              $paid=$paid=$row['amount_paid']/$row['price'];
              $row["clients_number"]=$paid;

            }
            

                   ?>
                  
                   
            <?php
            
                 $suma=$suma+$row["amount_paid"];
                 $suma2=$suma2+$row["recovery"]; 
                 $suma3=$suma3+$debitors;
                 $suma4=$suma4+$row["debit"];   
                 }
               }
                 
                 ?>
                 <?php
                   $sqlaa = "SELECT * FROM expenses WHERE purchased='yes' and location='Berbershop' AND month BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
               $result10 = $db->query($sqlaa);
                  $exp3=0;
               if ($result10 -> num_rows >  0) {
                  
                 while ($row = $result10->fetch_assoc()) 
                 {
                  $exp3=$exp3+$row["approved_quantity"]*$row["unit_price"];
                     }
                   }
                   else{
                    $exp3=0;
                   }
                   ?>
                   <?php

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Berbershop' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
               $result11 = $db->query($sql);
          $count=0;
          $suma1=0;
          $suma2=0;
               if ($result11 -> num_rows >  0) {
          
                 while ($row = $result11->fetch_assoc()) 
         {
  
            $suma1=$suma1+$row["salary_amount"]; 
            $suma2=$suma2+$row["bonuses"];
            }} 
            $salaries3=$suma1+$suma2;
                   ?>
               

    <?php


                   $sqlb = "SELECT * FROM photocopy WHERE datee BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
               $result12 = $db->query($sqlb);
                    $count=0;
                      $sumb=0;
               if ($result12 -> num_rows >  0) {
                
                 while ($row = $result12->fetch_assoc()) 
                 {
                    
                      $start=$row['indxe']-$row['copies_nber'];

                 $sumb=$sumb+$row["amount"];    
                 }
               }
                 
                 ?>
                 <?php
                   $sqlaa = "SELECT * FROM expenses WHERE purchased='yes' and location='Photocopying Machine' AND month BETWEEN '".$_POST["from_date"]."' AND '".$_POST["to_date"]."'";
               $result13 = $db->query($sqlaa);
                  $exp4=0;
               if ($result13 -> num_rows >  0) {
                  
                 while ($row = $result13->fetch_assoc()) 
                 {
                  $exp4=$exp4+$row["approved_quantity"]*$row["unit_price"];
                     }
                   }
                   else{
                    $exp4=0;
                   }
                   ?>
                   <?php

$sql = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE employees.location='Photocopying Machine' AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
               $result14 = $db->query($sql);
          $count=0;
          $sumb1=0;
          $sumb2=0;
               if ($result14 -> num_rows >  0) {
          
                 while ($row = $result14->fetch_assoc()) 
         {
  
            $sumb1=$sumb1+$row["salary_amount"]; 
            $sumb2=$sumb2+$row["bonuses"];
            }} 
            $salaries4=$sumb1+$sumb2;
                   ?>


                   <?php
//Other employees
$sqlbb = "SELECT employees.id,employees.emp_name,employees.job_name,employees.location,employees.emp_id,salaries.month,salaries.salary_amount,salaries.bonuses FROM employees JOIN salaries ON employees.id=salaries.emp_id WHERE (employees.location='Other' OR employees.location='') AND salaries.month BETWEEN '".$aa."' AND '".$bb."'";
               $result15 = $db->query($sqlbb);
         
          $sumbb1=0;
          $sumbb2=0;
               if ($result15 -> num_rows >  0) {
          
                 while ($row = $result15->fetch_assoc()) 
         {
  
            $sumbb1=$sumbb1+$row["salary_amount"]; 
            $sumbb2=$sumbb2+$row["bonuses"];
            }} 
            $salaries5=$sumbb1+$sumbb2;
                   ?>

                 <?php
               
               if($resulta -> num_rows>0 || $resultb -> num_rows>0 || $result3 -> num_rows>0 || $result4 -> num_rows>0 || $result7 -> num_rows>0 || $result8 -> num_rows>0 || $result9 -> num_rows>0 || $result10 -> num_rows>0 || $result11 -> num_rows>0 || $result12 -> num_rows>0 || $result13 -> num_rows>0 || $result14 -> num_rows>0 || $result14 -> num_rows>0){

                ?>
                 <tr style='font-size:24px;color:black;background-color: #979A99'><th>1</th><th>Canteen</th><th><?php echo number_format($initial_val1); ?></th><th><?php echo number_format($purchase_val1); ?></th><th><?php echo number_format($total_stockval1); ?></th><th><?php echo number_format($sold_stockval1); ?></th><th><?php echo number_format($sales_val1); ?></th><th><?php echo number_format($gross_profit1) ?></th><th><?php echo number_format($exp) ?></th><th><?php echo number_format($salaries) ?></th><th><?php echo number_format($gross_profit1-$exp-$salaries) ?></th><th><?php echo number_format($closing_stock1) ?></th></tr>


                 <tr style='font-size:24px;color:black;'><th></th><th>VIP</th><th><?php echo number_format($initial_val2); ?></th><th><?php echo number_format($purchase_val2); ?></th><th><?php echo number_format($total_stockval2); ?></th><th><?php echo number_format($sold_stockval2); ?></th><th><?php echo number_format($sales_val2); ?></th><th><?php echo number_format($gross_profit2) ?></th><th><?php echo number_format($exp2) ?></th><th><?php echo number_format($salaries2) ?></th><th><?php echo number_format($gross_profit2-$exp2-$salaries2) ?></th><th><?php echo number_format($closing_stock2) ?></th></tr>

       <tr style='font-size:24px;color:black;background-color: #979A99'><th>3</th><th>Berbershop</th><th>0</th><th>0</th><th>0</th><th>0</th><th><?php echo number_format($suma); ?></th><th><?php echo number_format($suma); ?></th><th><?php echo number_format($exp3); ?></th><th><?php echo number_format($salaries3); ?></th><th><?php echo number_format($suma-$salaries3-$exp3); ?></th><th></th></tr>

<tr style='font-size:24px;color:black;'><th>4</th><th>Photocopying Machine</th><th>0</th><th>0</th><th>0</th><th>0</th><th><?php echo number_format($sumb); ?></th><th><?php echo number_format($sumb); ?></th><th><?php echo number_format($exp4); ?></th><th><?php echo number_format($salaries4); ?></th><th><?php echo number_format($sumb-$salaries4-$exp4); ?></th><th></th></tr> 

<tr style='font-size:24px;color:black;background-color: #979A99'><th colspan="3">Other salaries and bonuses</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><?php echo number_format($salaries5); ?></th><th></th></tr>
<tr style='font-size:24px;color:black;'><th colspan="2">Total Net Profit</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th><?php echo number_format(($gross_profit1-$exp-$salaries)+($gross_profit2-$exp2-$salaries2)+($suma-$salaries3-$exp3)+($sumb-$salaries4-$exp4)-$salaries5); ?></th><th></th></tr>                  
                 




                   <tr><th>
               <a href="general_report_print.php" >Print</a>
                </th></tr>

              <?php }

              else {

                ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="6">No Record Found for the selected dates!!!</th></tr>
                <?php
}


            ?>
                 </tbody>
                                        </table>
           
                                    </div>
                                </div>
                            


</div>   

                    </form> 
                    </div>
                    </body>
</html>

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
  <?php 
}
?>