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
  $client_name=mysqli_real_escape_string($db, $_POST['client_name']);
  $clients_number=mysqli_real_escape_string($db, $_POST['clients_number']);
  $price=mysqli_real_escape_string($db, $_POST['price']);

   $result = mysqli_query($db, "SELECT * FROM clients");
while($row = mysqli_fetch_array($result)) {
if( strtoupper($row["client_name"]) ===strtoupper($client_name))
  $true=1;
}
if($true!=1){
  if($client_name!='Visitors'){
  if(empty($client_name) || empty($clients_number) || empty($price)){
    header('location: faculties1.php?message=msg2');
  }
  else{
if($price<=0 || $clients_number<=0){
header('location: faculties1.php?message=msg5');
      }
      else{
    $query = "INSERT INTO clients (client_name,clients_number,price) 
  			  VALUES('$client_name','$clients_number','$price')";
      if(mysqli_query($db, $query))
      {
      header('location: faculties1.php?message=msg');
				
    }
    else{
         header('location: faculties1.php?message=msg4');
    }
  }
}
  }
    else{
      if(empty($client_name)|| empty($price)){

header('location: faculties1.php?message=msg2');
  
      }
      else{
if($price<=0 ){
header('location: add_print.php?message=msg6');
      }
      else{
    $clients_number=0;
    $query = "INSERT INTO clients (client_name,clients_number,price) 
          VALUES('$client_name','$clients_number','$price')";
      if(mysqli_query($db, $query))
      {
     header('location: faculties1.php?message=msg');
        
    }
    else{
         header('location: faculties1.php?message=msg4');
    }
  }
}
  
  }
  }
  else{
        header('location: faculties1.php?message=msg3');
    }
  	
}
?>