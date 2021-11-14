
<?php
session_start();
include('../config.php');

if (isset($_GET['id']))
{
$id=$_GET['id'];
$result = mysqli_query($db, "SELECT * FROM users WHERE userID='$id'");
while($row= mysqli_fetch_array($result)){
$userName=$row['userName'];
}
$_SESSION['userName']=$userName;
$result = mysqli_query($db,"UPDATE users SET status='' WHERE userID='$id' ");
header("Location:manage.php?message=msg2");
}

?>