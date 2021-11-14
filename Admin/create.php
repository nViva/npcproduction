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


// initializing variables
$item_name = "";
$item_price    = "";
$true=0;

// connect to the database
include('../config.php');
// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  $user_name=mysqli_real_escape_string($db, $_POST['user_name']);
  $role=mysqli_real_escape_string($db, $_POST['role']);
  $location=mysqli_real_escape_string($db, $_POST['location']);
if(empty($user_name)){
  header('location: new_users.php?message=msg3');
}
else{
      if($role!='Manager' && empty($location)){
           header('location: new_users.php?message=msg4');
}
      
      else{
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
 $password = substr( str_shuffle( $chars ), 0, 8 );
 $_SESSION['passs']=$password;
    $sql = "Select * from users where userName='$user_name'";
    
    $result = mysqli_query($db, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
    
            $hash = md5($password);
                
            // Password Hashing is used here. 
            $sql2 = "INSERT INTO users (userName, 
                password,userType,location) VALUES ('$user_name', 
                '$hash','$role','$location')";
    
            $result = mysqli_query($db, $sql2);
 header('Location:new_users.php?message=msg');
 
           
    }// end if 
    
   if($num>0) 
   {
    header('Location:new_users.php?message=msg2');
      
   } 
 }
}
}

    
?>