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
$item_name = "";
$item_price    = "";
$true=0;

// connect to the database
include('../../config.php');
// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  $item_name=mysqli_real_escape_string($db, $_POST['product_name']);
  $item_price=mysqli_real_escape_string($db, $_POST['price']);
  $quant=0;
  $selling_price=mysqli_real_escape_string($db, $_POST['selling_price']);
if(empty($item_name) || empty($item_price) || empty($selling_price)){
  header('location: Ourstock.php?message=msg4');
}
else{
      if($item_price<=0 || $selling_price<=0){
header('location: Ourstock.php?message=msg5');
      }
      else{
       $result = mysqli_query($db, "SELECT * FROM products WHERE location='Canteen'");
      
while($row = mysqli_fetch_array($result)) {
if( strtoupper($row["productName"]) ===strtoupper($item_name))
  $true=1;
}
if($true!=1){
  $locator='Canteen';
    $query = "INSERT INTO products (productName,purchasingPrice,sellingPrice,balance,location) 
  			  VALUES('$item_name','$item_price','$selling_price','$quant','$locator')";
      if(mysqli_query($db, $query))
      {
    header('location: Ourstock.php?message=msg1');
				
    }
    else{
       header('location: Ourstock.php?message=msg3');
    }
  }
  else{
        header('location: Ourstock.php?message=msg2');
    }
  	}
  }
}
?>