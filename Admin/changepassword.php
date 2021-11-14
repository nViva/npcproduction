<?php


// initializing variables
$username = "";
$email    = "";

$errors = array(); 

// connect to the database
include('../config.php');

// LOGIN USER
if(isset($_POST['change_password']))
{
  
  //mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
  
   
    $oldpassword = md5(mysqli_real_escape_string($db, $_POST['oldPassword']));
    $newpassword1 = md5(mysqli_real_escape_string($db, $_POST['newPassword1']));
    $newpassword2 = md5(mysqli_real_escape_string($db, $_POST['newPassword2']));
     $newpass = mysqli_real_escape_string($db, $_POST['newPassword1']);
  
    
    if (empty($oldpassword)) {
      array_push($errors, "Old Password is required");
    }
    if (empty($newpassword1)) {
      array_push($errors, "New Password is required");
    }
    if (empty($newpassword2)) {
      array_push($errors, "Comfirm Password is required");
    }
    if ($newpassword1!=$newpassword2) {
      array_push($errors, "The two passwords for New password and Comfirm password do not match");
    }
    if (count($errors) == 0) 
    {
      
      $query = "SELECT * FROM users WHERE userID='" . $_POST["user_id"] . "' AND password ='$oldpassword'";
    
   
      $results = mysqli_query($db, $query);
      $res=mysqli_num_rows($results);
      if ($res) 
      {
        $_SESSION['newpass'] = $newpass;
      
    mysqli_query($db, "UPDATE users set password='" . $newpassword1 . "' WHERE userID='" . $_POST["user_id"] . "'");
  array_push($errors, "Password changed successfully! Your password is ".$newpass);
      }
      else 
      {
        array_push($errors, "Wrong Old Password");
        
      }
    }

    

   
  }
  
  ?>
  