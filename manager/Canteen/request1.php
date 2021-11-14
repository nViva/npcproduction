<?php 
 include("menu.php");
?>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">Our Products</h4>
                
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col">Action</th>
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
               include('../../config.php');

               $sql = "SELECT * FROM products WHERE location='Canteen'";
               $result = $db->query($sql);
          $count=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
             $pname=$row['productName'];
                   ?>
                  
                   
                   <tr class="database-data">
                  <th><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php echo number_format($row["purchasingPrice"])  ?></th>
                      <th><?php if($row["balance"]=='0'){ echo"<p style='color:red'>" .$row["balance"]."</p>";} else{echo $row["balance"];}  ?></th>

                      <th><center><?php echo number_format($row["sellingPrice"])  ?></th>
            <th><?php 
$result2 = mysqli_query($db, "SELECT DISTINCT productName,status FROM requests WHERE location='Canteen' AND productName='$pname' AND action='not_deleted'");
$num = mysqli_num_rows($result2); 
if ($num>0) {
 
$row1= mysqli_fetch_assoc($result2);
?><a href="modify_request.php?id=<?php echo $row["productName"] ?>"><font color="red">Modify Request</font></a><?php ?>
                <?php
                 
                 }
                 else{
                 ?> 
                   <a href="requesting1.php?id=<?php echo $row["productName"] ?>"><font color="red">Request</font></a>
                   </th> </tr>
                    
            <?php
                 }
                 }
                
               }

            ?>

                                            </tbody>
                                        </table>
           
                                    </div>
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