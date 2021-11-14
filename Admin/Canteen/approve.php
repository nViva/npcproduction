
<?php
session_start();
include('../../config.php');
$id=$_POST['id'];
if (isset($_POST['approve']))
{
	$req_quant=$_POST['requested_quantity'];
	
$status='approved';
$action='deleted';


$result = mysqli_query($db,"UPDATE requests SET approved_quantity='$req_quant',status='$status',action='$action' WHERE id='$id' AND location='Canteen'");
	
header("Location:requests.php");
}
else if(isset($_POST['reject'])){
$status='rejected';
$action='deleted';
$result = mysqli_query($db,"UPDATE requests SET status='$status',action='$action' WHERE id='$id' AND location='Canteen'");
header("Location:requests.php");
}

?>