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
$true2=0;
$true3=0;
$true4=0;
// connect to the database
include('../../config.php');
// Add item
if (isset($_POST['pay'])) {
  // receive all input values from the form
  $client_name=mysqli_real_escape_string($db, $_POST['client_name']);
  $month=mysqli_real_escape_string($db, $_POST['month']);
  $amount_paid=mysqli_real_escape_string($db, $_POST['amount_paid']);
if($amount_paid>=500){

 if($client_name!='Visitors'){
 $result = mysqli_query($db, "SELECT * FROM clients WHERE client_name='$client_name'");
              while($row1 = mysqli_fetch_array($result)) {
  $clients_number=$row1['clients_number'];
   $price=$row1["price"];

                 }

$result = mysqli_query($db, "SELECT * FROM payments WHERE client_name='$client_name'");
              while($row = mysqli_fetch_array($result)) {
              
            $dbmonth=$row["month"];
            $dbdebit=$row["debit"];
            $dbamount_paid=$row['amount_paid'];
            if($row["month"]==$month)
           $true=1;
         if($row["month"]==$month&&$row["debit"]>0){
$true2=1;
         }
          }
              
if($true==1){

  if ($true2>0) {
    if ($amount_paid<=$dbdebit){
 mysqli_query($db, "UPDATE payments set amount_paid=amount_paid+$amount_paid, debit=debit-$amount_paid WHERE client_name='$client_name' AND month='$month'");
 header('location: paying1.php?message=msg1');
     $_SESSION['debit']=$dbdebit-$amount_paid;
 
    }
    else{
     
     header('location: paying1.php?message=msg2');
     $_SESSION['debit3']=$dbdebit;
    }
}
else{
      header('location: paying1.php?message=msg');
    }
  }
  else{
if ($clients_number*$price>=$amount_paid) {
$debit=$clients_number*$price-$amount_paid+$dbdebit;
$_SESSION['debit2']=$debit;
mysqli_query($db, "UPDATE payments set debit=0 WHERE client_name='$client_name'");
$true3=1;
}
if ($clients_number*$price<$amount_paid && ($dbdebit>=($amount_paid-($clients_number*$price)))) {
$recovery=$amount_paid-$clients_number*$price;
$debit=$dbdebit-$recovery;
$_SESSION['debit2']=$debit;
mysqli_query($db, "UPDATE payments set debit=0 WHERE client_name='$client_name'");
$true4=1;
}
if($true3>0 || $true4>0){
    $query = "INSERT INTO payments (client_name,amount_paid,debit,recovery,month) 
  			  VALUES('$client_name','$amount_paid','$debit','$recovery','$month')";
      if(mysqli_query($db, $query))
      {
    header('location: paying1.php?message=msg3');
    
    }
    else{
 header('location: paying1.php?message=msg4');
  
    }
  }
  else{
header('location: paying1.php?message=msg8');
$_SESSION['number']=$clients_number;
$_SESSION['payment']=$clients_number*$price;
$_SESSION['pricee']=$price;
  }
  }

}else{

                 $today_month=date("Y-m");
                 if ($today_month==$month) {
                  $pay = mysqli_query($db, "SELECT * FROM payments WHERE client_name='$client_name' AND month='$month'");
                if(mysqli_num_rows($pay) > 0){
                  mysqli_query($db, "UPDATE payments set amount_paid=amount_paid+$amount_paid WHERE client_name='$client_name'");
                  header('location: paying1.php?message=msg6');
                 }
                 else{
                  $debit=0;
                  $recovery=0;

                $query = "INSERT INTO payments (client_name,amount_paid,debit,recovery,month) 
          VALUES('$client_name','$amount_paid','$debit','$recovery','$month')";
      if(mysqli_query($db, $query))
      {
    header('location: paying1.php?message=msg6');
    
    }
    else{
 header('location: paying1.php?message=msg4');
  
    }
               }
               }
               else{
                header('location: paying1.php?message=msg5');
                $_SESSION['today_month']=$today_month;

                 
               }

}
}
else{

header('location: paying1.php?message=msg7');
}
}

  
?>