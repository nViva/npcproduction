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


$true=0;

// connect to the database
include('../config.php');

if (isset($_POST['emp_payment'])) {
  $id=$_SESSION['id'];
  $month=mysqli_real_escape_string($db, $_POST['month']);

 $result = mysqli_query($db, "SELECT * FROM employees WHERE id='$id'");
              while($row1 = mysqli_fetch_array($result)) {
  $dbsalary=$row1['salary'];
   $dbbonus=$row1['bonus'];
        $person=$row1["emp_name"];

$_SESSION['person']=$person;
                 }

$result = mysqli_query($db, "SELECT * FROM salaries WHERE emp_id='$id'");
              while($row = mysqli_fetch_array($result)) {
              
            $dbmonth=$row["month"];
       
            if($row["month"]==$month)
           $true=1;

          }
              
if($true==1){
header('location: pay_employee.php?message=msg3');

  }
  else{

    $query = "INSERT INTO salaries (emp_id,salary_amount,bonuses,month) 
  			  VALUES('$id','$dbsalary','$dbbonus','$month')";
      if(mysqli_query($db, $query))
      {
    header('location: pay_employee.php?message=msg4');
    
    }
    else{
 header('location: pay_employee.php?message=msg5');
  
    }
  }



}

  
?>