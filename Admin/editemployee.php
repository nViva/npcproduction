<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../login.php");
  }
?>
<?php
if (isset($_POST['submit']))
{
	include('../config.php');
$id=$_POST['id'];
$emp_name=mysqli_real_escape_string($db, $_POST['emp_name']);
$job_name=mysqli_real_escape_string($db, $_POST['job_name']);
$location=mysqli_real_escape_string($db, $_POST['location']);
$salary=mysqli_real_escape_string($db, $_POST['salary']);
$bonus=mysqli_real_escape_string($db, $_POST['bonus']);

mysqli_query($db,"UPDATE employees SET emp_name='$emp_name',job_name='$job_name',location='$location',salary='$salary',bonus='$bonus' WHERE id='$id' " );

header("Location:employees.php?message=msg");
}
?>