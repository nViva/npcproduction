<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../../login.php");
  }
?>
<?php
include('../../config.php');
$purchased=mysqli_query($db, "UPDATE users set userName='" . $_POST["userName"] . "', firstName='" . $_POST["firstName"] . "', lastName='" . $_POST["lastName"]. "', email='" . $_POST["email"] . "', mobile='" . $_POST["mobile"] . "' WHERE userID='" . $_POST["user_id"] . "'");

  $_SESSION['newusername']=$_POST["userName"];
 
    header("Location:edit_ProfileMessage.php");

?>