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
<?php 
include('../../config.php');

               $sql = "SELECT * FROM balance ";
               $result = $db->query($sql);
               
                 while ($row = $result->fetch_assoc()) 
         {
            $balance=$row['balance'];
            $capital=$row['capital'];
$_SESSION['balance']=$balance;
          $_SESSION['capital']=$capital;
          }
          
          ?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>NPC Production Inventory System</title>
  <link rel="stylesheet" type="text/css" href="../../css/css/style.css">
  <link rel="stylesheet" type="text/css" href="../../newcss.css">
  <link rel="stylesheet" type="text/css" href="../../reportscss">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 <link rel="shortcut icon" type="../../image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../../assets/css/typography.css">
    <link rel="stylesheet" href="../../assets/css/default-css.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>

</head>
<body>
<header>
  <div class="logo"><img src="../../images/logo.jfif" ><p style="font-size: 16px;">NPC Production Inventory System</p></div>
	<nav>
		<ul>
			<li><a href="Ourstock.php" >Our Stock</a></li>
  
      <li>
  <div class="subnav">
    <button class="subnavbtn">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="Purchases_Report1.php">Purchases</a>
      <a href="Sales_Report1.php">Sales</a>
      <a href="Damages_Report1.php">Damages</a>
      <a href="Profit_Analysis_Report1.php">Income Statement</a>
    </div>
 </div></li>
 <li>
  <div class="subnav">
    <button class="subnavbtn">Requests <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="requests.php">Received</a>
       <a href="rejected.php">Rejected</a>
      <a href="approved.php">Approved</a>
    </div>
 </div></li>
 <li><a href="../index1.php">Exit</a></li>
       <li>
  <div class="subnav">
    <button class="subnavbtn">Settings <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="../edit_Profile.php">Edit Profile</a>
      <a href="../change_password1.php">Change Password</a>
      <a href="index.php?logout='1'">Logout</a>
    </div>
 </div></li>
		</ul>
	</nav>
	<div class="menu-toggle"><i class="fa fa-bars"></i></i></div>
</header>
<div class="contents">

<div>
            
            <div class="main-content-inner">
                <br>
                <h4 class="heading">VIP Requests &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="8">Balance: <?php echo number_format($balance) ?> Rwf</font></h4> 

                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center" id="styled-table">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Stock</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Requested Quantity</th>
                                                    <th scope="col">Total Value</th>
                                                    <th scope="col">Selling Price</th>
                                                    <th scope="col" colspan="2">Action</th>
                           
                           
                                                </tr>
                                            </thead>
                                            <tbody>
      <?php 
         

               $sql = "SELECT * FROM requests WHERE location='VIP' AND status !='rejected' AND status!='approved'";
               $result = $db->query($sql);
          $count=0;
          $sum=0;
               if ($result -> num_rows >  0) {
          
                 while ($row = $result->fetch_assoc()) 
         {
            $count=$count+1;
            $sum=$sum+$row["requested_quantity"]*$row["purchasing_price"];
                   ?>
                  
                   <form method="post" action="approve.php">
                   <tr class="database-data">
                  <th><input type="hidden" name="id" value='<?php echo $row["id"]  ?>'><?php echo $count ?></th>
                      <th><?php echo $row["productName"] ?></th>
                      <th><?php if($row["quantity_in_stock"]=='0'){ echo"<p style='color:red'>" .$row["quantity_in_stock"]."</p>";} else{echo $row["quantity_in_stock"];}  ?></th>
                      <th><input type="hidden" name="price" value="<?php echo $row["purchasing_price"]  ?>"><?php echo number_format($row["purchasing_price"])  ?></th>
                      <th><input type="number" name="requested_quantity" value='<?php echo $row["requested_quantity"]  ?>'></th>
                      <th><?php echo number_format($row["requested_quantity"]*$row["purchasing_price"])  ?></th>
                      <th><?php echo number_format($row["selling_price"])  ?></th>
            <th><input type="submit" name="approve" value="Approve"></th><th><input type="submit" name="reject" value="Reject"></th>
                      
                    </tr>
                    
                    </form>
            <?php
                 
                 }
                 ?>
                 <tr style="background-color: skyblue"><td>Total</td><td></td><td></td><td></td><td></td><td><?php echo number_format($sum)  ?></td><td></td><td></td><td></td></tr>
                 <tr class="database-data"><th colspan="9" >
               <a href="requests_print.php" ><font color="blue"> Print</font></a>
              
                </th> </tr>

                 <?php
               }
               else{

            ?>
            <tr><th colspan="8"><font color="red" size="18"> No request for VIP!</font></th></tr>
<?php
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