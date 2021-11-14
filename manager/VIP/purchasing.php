
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
$result=mysqli_query($db, "SELECT * FROM products WHERE productName='" . $_POST["product_id"][$i] . "' AND location='VIP'");
$row[$i]= mysqli_fetch_array($result);
$id=$row[$i]["productId"];

$purchased=mysqli_query($db, "UPDATE products set balance=balance+'" . $_POST["quant"][$i] . "' WHERE productName='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0 AND location='VIP'");
$sd=1;
if($sd)
{
    $d=$_POST["datee"];
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
	



	$locator='VIP';
$j=mysqli_query($db,"INSERT INTO purchases ( productId, quantity, price, purchaseDate,location) VALUES('" . $id . "','" . $_POST["quant"][$i] . "','" . $_POST["price"][$i] . "','".$d."','".$locator."')");


mysqli_query($db,"UPDATE requests SET purchased='yes' WHERE productName='" . $_POST["product_id"][$i] . "' AND location='VIP' AND status='approved'");
}
}
   
    header("Location:Ourstock.php");
}
?>