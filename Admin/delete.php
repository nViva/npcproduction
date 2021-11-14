
<?php
include('../config.php');

if (isset($_GET['id']))
{
$id=$_GET['id'];

$result = mysqli_query($db,"DELETE FROM users WHERE userID='$id' ");
header("Location:manage.php?message=msg3");
}

?>