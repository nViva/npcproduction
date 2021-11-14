
<?php
include('../config.php');
$id=$_POST['id'];
if (isset($_POST['approve']))
{
	$req_quant=$_POST['requested_quantity'];
$status='approved';
$action='deleted';
$result = mysqli_query($db,"UPDATE expenses SET approved_quantity='$req_quant',status='$status',action='$action' WHERE id='$id'");

header("Location:requested_exp.php");
}
else if(isset($_POST['reject'])){
$status='rejected';
$action='deleted';
$result = mysqli_query($db,"UPDATE expenses SET status='$status',action='$action' WHERE id='$id'");
header("Location:requested_exp.php");
}

?>