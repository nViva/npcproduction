<?php 
  session_start(); 

  $product_count=$_SESSION['productcount'];
?>
<?php
include('../../config.php');
	   $d=$_POST["date"];
	   $counter=0;
for($i=0;$i<$product_count;$i++) {
if(!empty($_POST["quant"][$i])){

$counter = $counter + 1;
}

if($counter===0){
		 header("Location:Sales.php?message=msg");
	}
	else{
$result = mysqli_query($db, "SELECT * FROM products WHERE productId='" . $_POST["product_id"][$i] . "' AND location='VIP' ");

$row[$i]= mysqli_fetch_array($result);
            
if ($row[$i]["balance"]>=$_POST["quant"][$i]) {

$selling=mysqli_query($db, "UPDATE products set balance=balance-'" . $_POST["quant"][$i] . "' WHERE productId='" . $_POST["product_id"][$i] . "' AND  " .$_POST["quant"][$i]."!=0 AND location='VIP' ");
$sd=1;
if($sd)
{
  
if(empty($_POST["quant"][$i]))
{
    continue;
}
else{
	$locator='VIP';
$j=mysqli_query($db,"INSERT INTO sales ( productId, purchasing_price,quantity, selling_price, salesDate,location) VALUES('" . $_POST["product_id"][$i] . "','" . $_POST["price"][$i] . "','" . $_POST["quant"][$i] . "','" . $_POST["selling_price"][$i] . "','".$d."','".$locator."')");

}
}
header("Location:Ourstock.php?message=msg2");
}
else{
	header("Location:Sales.php?message=msg3");
}
}
  
  } 
    

?>