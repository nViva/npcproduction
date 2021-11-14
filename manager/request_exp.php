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

include('../config.php');

if (isset($_POST['request_exp']))
{
  
   $action="not_deleted";
   $status="requested";

$item=mysqli_real_escape_string($db, $_POST['item']);
$qty=mysqli_real_escape_string($db, $_POST['qty']);
$unit_price=mysqli_real_escape_string($db, $_POST['unit_price']);
$location=mysqli_real_escape_string($db, $_POST['location']);
$month=mysqli_real_escape_string($db, $_POST['month']);

if(empty($item) || empty($unit_price) || empty($qty)){
  header('location: expenses.php?message=msg2');
}
else{
      if($unit_price<=0 || $qty<=0){
header('location: expenses.php?message=msg3');
      }
      else{
$total_price=$qty*$unit_price;
$sql2 = "INSERT INTO expenses (month,item,req_quantity,unit_price,total_price,location,status,action) VALUES ('$month', '$item','$qty','$unit_price','$total_price','$location','$status','$action')";
    
            $result = mysqli_query($db, $sql2);

   header("Location:expenses.php?message=msg"); 
}
}
}

?>