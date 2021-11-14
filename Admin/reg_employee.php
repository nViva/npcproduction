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


// connect to the database
include('../config.php');
// Add item
if (isset($_POST['add'])) {
  // receive all input values from the form
  $emp_name=mysqli_real_escape_string($db, $_POST['emp_name']);
  $emp_id=mysqli_real_escape_string($db, $_POST['emp_id']);
  $job_name=mysqli_real_escape_string($db, $_POST['job_name']);
  $location=mysqli_real_escape_string($db, $_POST['location']);
  $s_salary=mysqli_real_escape_string($db, $_POST['s_salary']);
if(empty($emp_name) || empty($emp_id)){
  header('location: new_employee.php?message=msg3');
}
else{
              if($job_name!='Manager' && (empty($location) || empty($s_salary))){
                 header('location: new_employee.php?message=msg4');
                }
            
            else{
                    if($job_name=='Other' && $location!='Other'){

                        header('location: new_employee.php?message=msg5');

                    }
                    else{
                            if($job_name!='Other' && $location=='Other'){
                                header('location: new_employee.php?message=msg6');
                            }
                            else{

    $sql = "Select * from employees where emp_id='$emp_id'";
    
    $result = mysqli_query($db, $sql);
    
    $num = mysqli_num_rows($result); 
    
    // This sql query is use to check if
    // the username is already present 
    // or not in our Database
    if($num == 0) {
    
           
            // Password Hashing is used here. 
            $sql2 = "INSERT INTO employees (emp_id, 
                emp_name,job_name,location,salary) VALUES ('$emp_id', 
                '$emp_name','$job_name','$location','$s_salary')";
    
            $result = mysqli_query($db, $sql2);
 header('Location:new_employee.php?message=msg');
 
           
    }
    
   if($num>0) 
   {
    header('Location:new_employee.php?message=msg2');
      
   } 
 }
}
}
}
}

    
?>