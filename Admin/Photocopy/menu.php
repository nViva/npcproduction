<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
    echo "You must log in first";
    header('location: ../../login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
  
  header("location: ../../login.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
body {margin:0;font-family:Arial}

.topnav {
  overflow: hidden;
  background-color: #333;
}

.topnav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.active {
  background-color: #04AA6D;
  color: white;
}

.topnav .icon {
  display: none;
}

.dropdown {
  float: left;
  overflow: hidden;
}

.dropdown .dropbtn {
  font-size: 17px;    
  border: none;
  outline: none;
  color: white;
  padding: 14px 16px;
  background-color: inherit;
  font-family: inherit;
  margin: 0;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  float: none;
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.topnav a:hover, .dropdown:hover .dropbtn {
  background-color: #555;
  color: white;
}

.dropdown-content a:hover {
  background-color: #ddd;
  color: black;
}

.dropdown:hover .dropdown-content {
  display: block;
}
#title{
  height:50px;
  text-align: center; 
  font-weight: bolder;
  font-size: 36px;
  color: white;
  background: #555;
}
#user{
  font-weight: bolder;
  font-size: 18px;
  color: white;
  float: right;
  margin-top: 10px;
}
.footer {
   position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   background-color: #555;;
   color: white;
   text-align: center;
   font-size: 24px;
}

@media screen and (max-width: 768px) {
  .topnav a:not(:first-child), .dropdown .dropbtn {
    display: none;
  }
  .topnav a.icon {
    float: right;
    display: block;
  }
.topnav .head {
    position: fixed;
    
      }
#title{
  font-size: 16px;
}
#user{
   font-size: 14px;
}

}

@media screen and (max-width: 768px) {
  .topnav.responsive {position: relative;}
  .topnav.responsive .icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  .topnav.responsive a {
    float: none;
    display: block;
    text-align: left;
  }
  
  .topnav.responsive .dropdown {float: none;}
  .topnav.responsive .dropdown-content {position: relative;}
  .topnav.responsive .dropdown .dropbtn {
    display: block;
    width: 100%;
    text-align: left;
  }
}
</style>
<title>NPC Production Inventory System</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../css/css/style3.css">
  <link rel="stylesheet" type="text/css" href="../../../newcss.css">
  <link rel="stylesheet" type="text/css" href="../../reportscss">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <link rel="shortcut icon" type="../../image/png" href="assets/images/icon/favicon.ico">
    
    <link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../../assets/css/typography.css">
    <link rel="stylesheet" href="../../assets/css/default-css.css">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>

<div class="topnav" id="myTopnav">
  <div class="head"><div style="float: left"><img src="../../images/logo.jfif" style="width: 100px;height: 100px;"></div><div style="" id="title">NPC Production Inventory System</div></div>
  <a href="../index1.php" class="active">Home</a>
  <a href="report1.php" >Reports</a>
  <a href="pricing.php" >Pricing</a>
  
  <div class="dropdown">
    <button class="dropbtn">Settings 
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
     <a href="../edit_Profile.php">Edit Profile</a>
      <a href="../change_password1.php">Change Password</a>
      <a href="index.php?logout='1'">Logout</a>
    </div>
  </div> 
  <div style="" id="user"><?php  if (isset($_SESSION['username']) ) : ?>
    <strong><?php echo $_SESSION['first_name']; echo " " ;echo $_SESSION['last_name'];echo ": " ;echo $_SESSION['role'];?></strong>
    
    <?php endif ?></div>
  <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
</div>


<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
<div class="footer"><footer>&copy copyRight Viateur 2021</footer></div>
</body>
</html>