
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
   $usersCount=$_SESSION['productcount'];
?>
<?php
include('../../config.php');

for($i=0;$i<$usersCount;$i++) {
$result=mysqli_query($db, "SELECT * FROM products WHERE productName='" . $_POST["product_id"][$i] . "' AND location='Canteen'");
$row[$i]= mysqli_fetch_array($result);
$id=$row[$i]["productId"];

$purchased=mysqli_query($db, "UPDATE products set balance=balance+'" . $_POST["quant"][$i] . "' WHERE productName='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0 AND location='Canteen'");
$sd=1;
if($sd)
{
    $d=$_POST["datee"];
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
	



	$locator='Canteen';
$j=mysqli_query($db,"INSERT INTO purchases ( productId, quantity, price, purchaseDate,location) VALUES('" . $id . "','" . $_POST["quant"][$i] . "','" . $_POST["price"][$i] . "','".$d."','".$locator."')");
//new
//SELECT * FROM products LEFT JOIN purchases ON products.productId=purchases.productId LEFT JOIN sales ON products.productId=sales.productId LEFT JOIN damages ON products.productId=damages.productId WHERE products.location='Canteen';
/*$result3 = mysqli_query($db, "SELECT * FROM historical WHERE product_name='" . $_POST["product_id"][$i] . "'");
              while($row3 = mysqli_fetch_array($result3)) {
              
            $initial_stock=$row3["initial"];
       }
       $new_stock=$initial_stock+$_POST["quant"][$i];
       $sales=0;
       $damages=0;
       $closing=$initial_stock+$_POST["quant"][$i];

$hist=mysqli_query($db,"INSERT INTO historical (datee, product_name,purchasing_price,initial,purchases,total_stock,selling_price,sales,damages,closing,location) VALUES('" . $d . "','" . $_POST["product_id"][$i] . "','" . $_POST["price"][$i] . "','" . $initial_stock . "','" . $_POST["quant"][$i] . "','".$new_stock."','" . $_POST["selling_price"][$i] . "','".$sales."','".$damages."','".$closing."','".$locator."')");*/

//end here

mysqli_query($db,"UPDATE requests SET purchased='yes' WHERE productName='" . $_POST["product_id"][$i] . "' AND location='Canteen' AND status='approved'");
}
}
   
    header("Location:Ourstock.php");
}
?>