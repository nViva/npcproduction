<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
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

if (isset($_POST['submit']))
{
   $datee=date("Y-m-d");
   $locator="VIP";
   $mode="not_deleted";
   $status="requested";
$id=$_POST['id'];
$name=mysqli_real_escape_string($db, $_POST['product_name']);
$price=mysqli_real_escape_string($db, $_POST['price']);
$selling_price=mysqli_real_escape_string($db, $_POST['selling_price']);
$stock=mysqli_real_escape_string($db, $_POST['stock']);
$quant=mysqli_real_escape_string($db, $_POST['quant']);

$sql2 = "INSERT INTO requests (productName,quantity_in_stock,purchasing_price,requested_quantity,selling_price,date,location,status,action) VALUES ('$name', '$stock','$price','$quant','$selling_price','$datee','$locator','$status','$mode')";
    
            $result = mysqli_query($db, $sql2);

   header("Location:request1.php?message=msg"); 
}


if (isset($_GET['id']))
{

$id = $_GET['id'];
$result = mysqli_query($db,"SELECT * FROM products WHERE productName='$id' AND location='VIP'");

$row = mysqli_fetch_array($result);

if($row)
{

$id = $row['productName'];
$name = $row['productName'];
$price = $row['purchasingPrice'];
$selling_price = $row['sellingPrice'];
$stock=$row['balance'];
}
else
{
echo "No results!";
}
}
?>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
  <title>NPC Production Inventory System</title>
  <link rel="stylesheet" type="text/css" href="../../css/css/style2.css">
  <link rel="stylesheet" type="text/css" href="../../newcss.css">
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
      <li><a href="Ourstock.php" class="active">Our Stock</a></li>
      <li><a href="Purchases.php">Purchases</a></li>
      <li>
  <div class="subnav">
    <button class="subnavbtn">Reports <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="Purchases_Report1.php">Purchases</a>
   <a href="Sales_Report1.php">Sales</a>
      <a href="Damages_Report1.php">Damages</a>
      <a href="Profit_Analysis_Report1.php">Income Statement</a>
      <a href="general1.php">General</a>
    </div>
 </div></li>
 <li>
  <div class="subnav">
    <button class="subnavbtn">Requests <i class="fa fa-caret-down"></i></button>
    <div class="subnav-content">
      <a href="request1.php">New requests</a>
       <a href="rejected.php">Rejected requests</a>
      <a href="approved.php">Approved requests</a>
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
                <h4 class="heading">Update Products</h4>
                <form method="post" action="requesting1.php">
                <div >
                   
                    <!-- Contextual Classes start -->
                    
                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Product Name</th>
                                                    <th scope="col">Purchasing Price</th>
                                                    <th scope="col">Quantity in stock</th>
                                                    <th scope="col">Quantity to purchase</th>
                                                    <th scope="col">Selling Price</th>
                                                    
                           
                           

                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
              
                   <tr class="database-data" style="background-color: #2196f3;">
                    
                      <th> <input type="hidden" name="id" value="<?php echo $id; ?>"/><input type="hidden" name="product_name" value="<?php echo $name; ?>"><?php echo $name; ?></th>
                      
                      <th><input type="hidden" name="price" value="<?php echo $price?>"><?php echo number_format($price) ?></th>
                      <th><input type="hidden" name="stock" value="<?php echo $stock ?>"><?php echo $stock;?></th>
                      <th><input type="text" name="quant"></th>
                      <th> <input type="hidden" name="selling_price" value="<?php echo $selling_price ?>"><?php echo number_format($selling_price) ?></th>
                      
                    
                      
                    </tr>
           
                 <tr class="database-data"><th colspan="6" >
               <input type="submit" name="submit" value="Send" style="" class="purchase-button"> 
                </th></tr>
                <tr class="database-data"><th colspan="6" >
               <button><a href="request1.php" style="text-decoration: none;" class="purchase-button">Cancel</a></button> 
                </th></tr>
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