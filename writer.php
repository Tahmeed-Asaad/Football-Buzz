<?php

session_start();
$value = $_POST['writerName'];
//echo $value;
//echo $writer;

$usernameGlob = "";
$_SESSION['cidGlob']="";

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'projectf';

$link = mysqli_connect($host, $user, $password, $db);

$full_name = "";
$email = "";
$country = "";
$r_date = "";
$extError = "";

if(isset($_COOKIE["signInUserName"])){
    $usernameGlob = $_COOKIE["signInUserName"];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
    $full_name = $row[2]." ".$row[3];
    $email = $row[4];
    $country = $row[6];
    $r_date = $row[8];
    $path = $row[9];
}
else if (!isset($_SESSION['signInUserName']) && !isset($_SESSION['signUpUserName'])) {
//    echo '<script>alert("Please log in first to view this page.")</script>';
//    header('location: homepagewithoutlogin.php');
}
else if (isset($_SESSION['signUpUserName'])) {
    $usernameGlob = $_SESSION['signUpUserName'];
	$_SESSION["username"]=$usernameGlob;

    $sql = "Select * From user_info Where username='$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
//    $full_name = $row[2]." ".$row[3];
//    $email = $row[4];
//    $country = $row[6];
///    $r_date = $row[8];
}
else if (isset($_SESSION['signInUserName'])) {
    $usernameGlob = $_SESSION['signInUserName'];
	$_SESSION["username"]=$usernameGlob;
    $sql = "Select * from user_info Where username = '$usernameGlob' Or email = '$usernameGlob'";
    $result = mysqli_query($link, $sql);
    $noOfData = mysqli_num_rows($result);

    $row = mysqli_fetch_row($result);
    $usernameGlob = $row[1];
//    $full_name = $row[2]." ".$row[3];
//    $email = $row[4];
//    $country = $row[6];
//    $r_date = $row[8];
    $path = $row[9];
//    print_r($row);
}


$sql = "Select * From user_info Where username = '$value'";
$result = mysqli_query($link, $sql);
$noOfData = mysqli_num_rows($result);
$row = mysqli_fetch_row($result);
$writernameGlob = $row[1];
$full_name = $row[2]." ".$row[3];
$email = $row[4];
$country = $row[6];
$r_date = $row[8];

if (isset($_GET['logout'])) {
    session_destroy();
    setcookie("signInUserName", $_POST["signInUserName"], time()-3600);
	setcookie("signInPassword", $_POST["signInPassword"], time()-3600);
    unset($_SESSION['signUpUserName']);
    unset($_SESSION['signInUserName']);
    header("location: homepage.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>

  <?php
   echo $writernameGlob;
   ?>

  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="css/customStyle.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css?family=Graduate" rel="stylesheet"/>
  <style>
     .fa {
         padding: 15px;
         font-size: 15px;
         width: 40px;
         text-align: center;
         text-decoration: none;
         margin: 5px 2px;
         border-radius: 50%;
     }

     .fa:hover {
         opacity: 0.7;
     }

     .fa-facebook {
       background: #3B5998;
       color: white;
     }

     .fa-twitter {
       background: #55ACEE;
       color: white;
     }
     .fa-youtube {
       background: #bb0000;
       color: white;
     }

     .fa-instagram {
       background: #125688;
       color: white;
     }
     .hr1{
         margin-left: 30px;
         margin-right: 30px;
     }
     .cls{
         margin-left: 30px;
         color: white;
         font-size: 15px;
     }

 </style>

</head>
<body style="background-color: #dbdcdd">

 <div class="container-fluid">
      <div class="row" style="height: auto">
          <div class="col-md-8 col-lg-8 col-sm-8 col-xs-7 topRowF">Football</div>
          <div class="col-md-4 col-lg-4 col-sm-4 col-xs-5 topRowS">BUZZ</div>
      </div>
  </div>
  <div class="navbar navbar-inverse navbar-static-top navbar-expand-md mb-5">
      <div class="container naigation">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse navHeaderCollapse">
              <ul class="nav navbar-nav navbar-left">
                  <li class="nav-item"><a class="nav-link" href="homepage.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                  <li class="nav-item"><a href="about.php">About</a></li>
              </ul>
              <ul class="nav navbar-nav navbar-right">

                  <?php if($usernameGlob != "") : ?>
                      <li class="nav-item">
                          <img src="<?php echo $path ?>" class="img-circle" alt="User" width="40px" height="40px">
                      </li>
                      <li class="nav-item" style="margin-left: -10px">
                           <a href="privatepage.php"style="color: white;"><?php echo $usernameGlob ?></a>
                      </li>
                     <li class="nav-item">
                         <a class="nav-link" href="login.php?logout='1'" style="color: white;">Log Out</a>
                     </li>
                     <li class="nav-item">
                         <form method='post' action='sort.php'>
                               &nbsp;
                               <input type='text'  placeholder='Search..' name='search' style='width: 100px; margin-top: 10px'>
                               <button type='submit' name='searchButton'><span class='glyphicon glyphicon-search'></span></button>
                         </form>
                     </li>
                  <?php else : ?>
                      <li class="nav-item">
            			    <a class="nav-link" href="login.php?logout='1'" style="color: white;">Log In</a>
            		    </li>
                  <?php endif; ?>
              </ul>
          </div>
      </div>
  </div>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-6 col-xs-6" style = "font-size: 18px; color: black">
            <label>Username: <?php echo $writernameGlob?></label><br>
            <label>Full Name: <?php echo $full_name ?></label><br>
            <label>Country: <?php echo $country ?></label><br>
            <label>Registered: <?php echo $r_date ?></label><br>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-0 col-xs-0"></div>
    	<div class="col-md-4 col-lg-4 col-sm-6 col-xs-6">
            <form method="post" enctype="multipart/form-data">
                 <img src="<?php echo $row['9'] ?>" class="img-circle" alt="User" width="304" height="236">
                 <label><?php echo $extError ?></label>
            </form>
        </div>
    </div>
</div>
<br><br>
<div style="background-color: #181818; color: white">
    <br>
    <div style="text-align: center; font-size: 20px">Follow us:</div>
    <div style="text-align: center">
        <a href="#" class="fa fa-facebook"></a>
        <a href="#" class="fa fa-twitter"></a>
        <a href="#" class="fa fa-youtube"></a>
        <a href="#" class="fa fa-instagram"></a>
    </div>
    <hr/ class="hr1">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">FAQ</a>
                <a href="#" class="cls">Privacy Policy</a>
                <a href="#" class="cls">Cookies</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">Support</a>
                <a href="#" class="cls">Work with us</a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center">
                <a href="#" class="cls">Request a Feature</a>
                <a href="#" class="cls">Terms and Conditions</a>
            </div>
        </div><br>
        <div style="text-align: center">Copyright &copy; 2018 Football BUZZ</div><br>
    </div>
</div>

</body>
</html>
