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
include('../../config.php');

if (isset($_GET['id']))
{
$id=$_GET['id'];
$true=0;
$true2=0;
$true3=0;
$true4=0;
$true5=0;
$sql = "SELECT * FROM products WHERE productId='$id' AND location='Canteen'";
               $result = $db->query($sql);
                 while ($row = $result->fetch_assoc()) 
         {
         	if ($row['balance']>0) {
         		$true=1;
         		
         	}
            
            }
            
           
$sql2 = "SELECT * FROM purchases WHERE productId='$id' AND location='Canteen'";
               $result = $db->query($sql2);
                 if ($result -> num_rows >  0) {
                 	$true2=1;
            
            }
            $sql3 = "SELECT * FROM sales WHERE productId='$id' AND location='Canteen'";
               $result = $db->query($sql3);
                 if ($result -> num_rows >  0) {
                 	$true3=1;
            
            }
            $sql4 = "SELECT * FROM damages WHERE productId='$id' AND location='Canteen'";
               $result = $db->query($sql4);
                 if ($result -> num_rows >  0) {
                 	$true4=1;
            
            }
            $sql5 = "SELECT * FROM requests WHERE productId='$id' AND location='Canteen'";
               $result = $db->query($sql5);
                 if ($result -> num_rows >  0) {
                 	$true5=1;
            
            }
            if ($true==1) {
            	header("Location:Ourstock.php?message=msg");
            }

 else if ($true2==1||$true3==1||$true4==1||$true5==1) {
            	header("Location:Ourstock.php?message=msg2");
            }
            else{

$result = mysqli_query($db,"DELETE FROM products WHERE productId='$id' AND location='Canteen'");
header("Location:Ourstock.php?message=msg3");
}
}



?>