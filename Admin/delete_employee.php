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
?>
<?php
include('../config.php');

if (isset($_GET['id']))
{
$id=$_GET['id'];


$result = mysqli_query($db,"DELETE FROM employees WHERE id='$id' ");
header("Location:employees.php?message=msg2");

}



?>