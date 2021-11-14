<?php 
include("menu.php");
?>

<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Purchase Expenses</h4>
                <form method="post" action="purchase_exp.php">
                <div >
                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">SN</th>
                                                    <th scope="col">Item </th>
                                                      <th scope="col">Quantity</th>
                                                    <th scope="col">Unit Price</th>
                                                   <th>Location</th>
                           <th scope="col">Date:<input type="month" id="monthly" name="datee" value="<?php echo date('Y-m');?>"></th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
              include('../config.php');

               $result = mysqli_query($db, "SELECT * FROM expenses WHERE status='approved' AND purchased!='yes'");
if ($result -> num_rows >  0) {
              while($row = mysqli_fetch_array($result)) {
$products[]=$row["id"];
$productName[]=$row["item"];
$usersCount = count($productName);
$rowCount = count($products);
}
$_SESSION['productcount'] = $usersCount;
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($db, "SELECT * FROM expenses WHERE id='" . $products[$i] . "' AND status='approved' AND purchased!='yes'");
$row[$i]= mysqli_fetch_array($result);
?>
                
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th><?php echo $i+1 ?></th>
                      <th> <input type="hidden" name="product_id[]" value="<?php echo $row[$i]["item"]  ?>"><?php echo $row[$i]["item"] ?></th>
                      <th><input type="number" readonly="" name="quant[]" value="<?php echo $row[$i]["approved_quantity"]  ?>"></th>
                      <th><input type="text" readonly="" name="unit_price[]" value="<?php echo $row[$i]["unit_price"] ?>"></th>
                      <th> <input type="text" readonly name="location[]" value="<?php echo $row[$i]["location"]  ?>"></th><th></th>
                      
                      
                    </tr>
                    
            <?php
                 
                 }

                 ?>
                 <tr class="database-data"><th colspan="7" >
               <input type="submit" name="purchase" value="Submit" style="" class="purchase-button">
                </th></tr>
<?php } else{ ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="8">No approved products to purchase !!!</th></tr>
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