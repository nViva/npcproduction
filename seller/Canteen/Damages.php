<?php 
  include("menu.php");
?>
 <div class="topnav" id="myTopnav"><form method="post" action="Damages_Search.php">
      <input type="text" placeholder="Search.." name="search" style="margin-top: 10px;" class="search">
      
    </form>
 </div>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Damages</h4>
                <form method="post" action="damage.php">
                  <?php if(isset($_GET['message'])){
     if ($_GET['message']=='msg') {
       echo "<p style='color:red;font-size:24px;'>Please explain the cause of the damage.</p>";
     }
   
    }
    ?>
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
                                                   
                                                    <th scope="col">Quantity Damaged</th>
                                                    <th scope="col">Explanations</th>
                           <th scope="col">Date:<input type="date" id="monthly" name="date" value="<?php echo date('Y-m-d');?>"></th>
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $result = mysqli_query($db, "SELECT * FROM products WHERE balance!='0' AND location='Canteen'");
                 if ($result -> num_rows >  0) {
              while($row = mysqli_fetch_array($result)) {
$products[]=$row["productId"];
$productName[]=$row["productName"];
$usersCount = count($productName);
$rowCount = count($products);
}
$_SESSION['productcount'] = $usersCount;
for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($db, "SELECT * FROM products WHERE productId='" . $products[$i] . "'AND location='Canteen'");
$row[$i]= mysqli_fetch_array($result);
?>
                
                   <tr class="database-data" style="background-color: #2196f3;">
                    <th><?php echo $i+1 ?></th>
                      <th> <input type="hidden" name="product_id[]" value="<?php echo $row[$i]["productId"]  ?>"><?php echo $row[$i]["productName"] ?></th>
                      <th><?php echo $row[$i]["balance"]  ?></th>
                      <th><input type="hidden" name="price[]" value="<?php echo $row[$i]["purchasingPrice"]  ?>">
                     <input type="number" name="quant[]"></th>
                      <th> <textarea  name="explanations[]" ></textarea></th><th></th>
                      
                      
                    </tr>
                    
            <?php
                 
                 }
                 ?>
                 <tr class="database-data"><th colspan="6" >
               <input type="submit" name="damage" value="Submit" style="" class="purchase-button">
                </th></tr>
                <?php
                 } 
                 else{ ?>
                <tr class="database-data" style='font-size:24px;font-weight: bold;color: red;'> <th colspan="8">No product in our stock !!!</th></tr>
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