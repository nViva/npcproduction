<?php
session_start();

// initializing variables
$username = "";
$email    = "";

$errors = array(); 

// connect to the database
include('config.php');
// LOGIN USER
if(isset($_POST['submit']))
{
  
  //mysql_select_db($dbDatabase, $db)or die("Couldn't select the database."); 
  
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = md5(mysqli_real_escape_string($db, $_POST['password']));
  
    if (empty($username)) {
      array_push($errors, "Username is required");
    }
    if (empty($password)) {
      array_push($errors, "Password is required");
    }
    
    if (count($errors) == 0) 
    {
      
      $query = "SELECT * FROM users WHERE userName='$username' AND password ='$password'";
    
    
    
    
    $sql="SELECT userType,location,firstName,lastName,status FROM users WHERE userName='$username' AND password ='$password'";
    $result=mysqli_query($db,$sql);  
    $row=mysqli_fetch_assoc($result);
   
   
   
      $results = mysqli_query($db, $query);
      $res=mysqli_num_rows($results);
      if ($res) 
      {
        if($row['status']!='Blocked'){


        $_SESSION['username'] = $username;
        $_SESSION['first_name'] =$row["firstName"];
        $_SESSION['role'] =$row["userType"];
    
    $_SESSION['last_name'] =$row["lastName"];
        if($row['userType']=='Seller'){
        
        if($row['location']=='Canteen'){
header('location: seller/Canteen/index.php');
        }
        else if($row['location']=='VIP'){
          header('location: seller/VIP/index.php');
        }
        else if($row['location']=='Photocopy'){
          header('location: seller/Photocopy/index.php');
        }
        
      }
      else if($row['userType']=='Manager'){
        
        header('location: manager/index1.php');
      }
      else if($row['userType']=='Admin'){
        
        header('location: Admin/index1.php');
      }
    }
      else{
        array_push($errors, "<b style='color:red'>Your Account has been blocked. For more information ask Admin</b>");
      }
    }
      else 
      {
        array_push($errors, "<b style='color:red'>Wrong username/password combination</b>");
      }
    }

    

   
  }
  
  ?>
  