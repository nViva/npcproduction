<?php 
  include("menu.php");
?>
<div class="topnav" id="myTopnav">
 <form method="post" action="Purchases_Search.php">
      <input type="text" placeholder="Search.." name="search" style="margin-top: 10px;" class="search">
      
    </form>
  </div>
  
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Purchases</h4>
                <form method="post" action="purchasing.php">
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Quantity in stock</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Quantity to purchase</th>
                                                    <th scope="col">Selling Price</th>
                           <th scope="col">Date:<input type="date" readonly="" id="monthly" name="datee" value="<?php echo date('Y-m-d');?>"></th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
              include('../../config.php');

               $result = mysqli_query($db, "SELECT * FROM requests WHERE location='VIP' AND status='approved' AND purchased!='yes'");
if ($result -> num_rows >  0) {
              while($row = mysqli_fetch_array($result)) {
$products[]=$row["id"];
$productName[]=$row["productName"];
$usersCount = count($productName);
$rowCount = count($products);
}
$_SESSION['productcount'] = $usersCount;
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($db, "SELECT * FROM requests WHERE id='" . $products[$i] . "' AND location='VIP' AND status='approved' AND purchased!='yes'");
$row[$i]= mysqli_fetch_array($result);
?>
                
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th><?php echo $i+1 ?></th>
                      <th> <input type="hidden" name="product_id[]" value="<?php echo $row[$i]["productName"]  ?>"><?php echo $row[$i]["productName"] ?></th>
                      <th><?php echo $row[$i]["quantity_in_stock"]  ?></th>
                      <th><input type="text" readonly="" name="price[]" value="<?php echo $row[$i]["purchasing_price"]  ?>"></th>
                      <th> <input type="text" readonly name="quant[]" value="<?php echo $row[$i]["approved_quantity"]  ?>"></th>
                      <th> <input type="text" readonly="" name="selling_price[]" value="<?php echo $row[$i]["selling_price"]  ?>"></th><th></th>
                    
                      
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