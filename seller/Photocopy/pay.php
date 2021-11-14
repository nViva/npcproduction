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


$true=0;
// connect to the database
include('../../config.php');
// Add item
if (isset($_POST['pay'])) {
  // receive all input values from the form
  $datee=mysqli_real_escape_string($db, $_POST['datee']);
  $indxe=mysqli_real_escape_string($db, $_POST['indxe']);
  $type=mysqli_real_escape_string($db, $_POST['type']);
if(empty($indxe)||$indxe<=0){
header('location: paying1.php?message=msg3');
}
else{
$result = mysqli_query($db, "SELECT * FROM photocopy ");
$rows=mysqli_num_rows($result);
              while($row = mysqli_fetch_array($result)) {
              
            $dbindxe=$row["indxe"];
           
         if($row["indxe"]>=$indxe){
$true=1;
         }
       }
            
if($true==1){
header('location: paying1.php?message=msg1');
  
}
else{
  $result3 = mysqli_query($db, "SELECT * FROM photocopy");
              while($row3 = mysqli_fetch_array($result3)) {
              
            $dbindxee=$row3["indxe"];
       }

  $copies_number=$indxe-$dbindxee;
  $result = mysqli_query($db, "SELECT * FROM photocopy_pricing WHERE type='$type'");
              while($row2 = mysqli_fetch_array($result)) {
              
            $page_price=$row2["page_price"];
   
       }

       $amount=$copies_number*$page_price;
 $query = "INSERT INTO photocopy (datee,indxe,copies_nber,amount,type) 
          VALUES('$datee','$indxe','$copies_number','$amount','$type')";
      if(mysqli_query($db, $query))
      {
    header('location: paying1.php?message=msg2');
    
    }
    }
  }
}
  
?>