<?php 
  session_start(); 

  $product_count=$_SESSION['productcount'];
?>
<?php
include('../../config.php');
	 $d=$_POST["date"];
for($i=0;$i<$product_count;$i++) {
$damaging=mysqli_query($db, "UPDATE products set balance=balance-'" . $_POST["quant"][$i] . "' WHERE productId='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0 AND location='VIP'");
$sd=1;
if($sd)
{
    
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
	if(empty($_POST["explanations"][$i])){
		 header("Location:Damages.php?message=msg");
	}
	else{
	$locator='VIP';
$j=mysqli_query($db,"INSERT INTO damages ( productId, quantity, purchasing_price,damagesDate,location,explanation) VALUES('" . $_POST["product_id"][$i] . "','" . $_POST["quant"][$i] . "','" . $_POST["price"][$i] . "','".$d."','".$locator."','" . $_POST["explanations"][$i] . "')");
header("Location:Ourstock.php");
}
}
}
}
   
    

?>