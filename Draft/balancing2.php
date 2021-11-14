
<?php
session_start();
include('../../config.php');
$id=$_POST['id'];
if (isset($_POST['approve']))
{
	$req_quant=$_POST['requested_quantity'];
	$valu=$req_quant*$_POST['price'];
$status='approved';
$action='deleted';
$description='Today capital';
$reason='Purchases in VIP';
$balance=$_SESSION['balance'];
$newbal=$balance-$valu;
$capital=$_SESSION['capital'];
$difference=$valu;
$month=date("Y-m");

$result = mysqli_query($db,"UPDATE requests SET approved_quantity='$req_quant',status='$status',action='$action' WHERE id='$id' AND location='VIP'");

$result = mysqli_query($db,"INSERT INTO balance(description,capital,balance,month,reason,difference) VALUES('$description','$capital','$newbal','$month','$reason','$difference')");

	
header("Location:requests.php");
}
else if(isset($_POST['reject'])){
$status='rejected';
$action='deleted';
$result = mysqli_query($db,"UPDATE requests SET status='$status',action='$action' WHERE id='$id' AND location='VIP'");
header("Location:requests.php");
}

?>