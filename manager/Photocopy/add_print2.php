<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: ../../login.php");
  }
?>
<?php


// initializing variables
$print_type = "";
$price     = "";
$true=0;

// connect to the database
include('../../config.php');
// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  $print_type=mysqli_real_escape_string($db, $_POST['print_type']);
  $price=mysqli_real_escape_string($db, $_POST['price']);
  if(empty($print_type) || empty($price) ){
  header('location: add_print.php?message=msg4');
}
else{
      if($price<=0 ){
header('location: add_print.php?message=msg5');
      }
      else{
   $result = mysqli_query($db, "SELECT * FROM photocopy_pricing");
while($row = mysqli_fetch_array($result)) {
if( strtoupper($row["type"]) ===strtoupper($print_type))
  $true=1;
}
if($true!=1){

    $query = "INSERT INTO photocopy_pricing (type,page_price) 
  			  VALUES('$print_type','$price')";
     if(mysqli_query($db, $query))
      {
    header('location: add_print.php?message=msg1');
        
    }
    else{
       header('location: add_print.php?message=msg3');
    }
  }
  else{
        header('location: add_print.php?message=msg2');
    }
    }
  }
}
?>