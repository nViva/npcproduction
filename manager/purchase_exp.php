<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: ../login.php");
  }
   $usersCount=$_SESSION['productcount'];
?>
<?php
include('../config.php');

for($i=0;$i<$usersCount;$i++) {

    $d=$_POST["datee"];

	$locator='Canteen';
$j=mysqli_query($db,"INSERT INTO purchased_expenses (month, item, quantity, unit_price,location) VALUES('".$d."','" . $_POST["product_id"][$i] . "','" . $_POST["quant"][$i] . "','" . $_POST["unit_price"][$i] . "','".$locator."')");

mysqli_query($db,"UPDATE expenses SET purchased='yes' WHERE item='" . $_POST["product_id"][$i] . "' AND status='approved' ");

header("Location:index1.php");

}
?>