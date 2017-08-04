<?php
session_start();


if(isset($_POST['submitted'])){
	include('connect.php');
	
	

  $username = mysqli_real_escape_string($db,$_POST['UserName']);
  $password = mysqli_real_escape_string($db,$_POST['PassWord']); 
  
  $_SESSION["userid"] = $username;
  
  
  
  $sqlget = "SELECT * FROM UserPass WHERE userid = '$username' AND passcode = '$password' ";
  $sqldata = mysqli_query($db, $sqlget ); //or die('Error getting data');
  $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
  $active = $row['active'];
  
  $count = mysqli_num_rows($sqldata);
  
  
  // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['userid'] = $username;
         
         header("location: Home.php");
      }
      else 
         $error = "Your Login Name or Password is invalid";
  }
  
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title>Login Here</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/myStyle.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <img src="images/NPicon.png" style="width:48px;height:48px;">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="Register.php">Register</a></li>
      </ul>
      
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


  </head>
  <body>
    <div id="background"><img src="images/login.jpg"></div>
    
<CENTER> <h1>Log In</h1></CENTER>

<form method="post" action="login.php">
   <input type="hidden" name="submitted" value="true" />
   
      <div class="container-fluid">
             
        <div class="row">
          <div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 ">
              <input type="text" class="form-control text-center" " name="UserName" placeholder= "Please Enter User Name Here..." >
          </div>
        </div>
            
        <div class="row">
          <div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 ">
              <input type="password" class="form-control text-center" name="PassWord" placeholder="Password">
          </div>
              <input type="submit" class=" btn btn-primary btn-primary.raised." value="Log In">
          </div>
        </div>
        
         <div class="row">
              
              <div class="col-sm-4 col-md-offset-4" style="text-align: center">
                  <h5>Not Registered? Register <a href="Register.php">HERE</a></h5>
              </div>
              
            </div>
            
        
      </div>
        
</form>



<div style = "font-size:12px; color:#cc0000; margin-top:10px bg-warning"><center><?php echo  $error; ?></center></div>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>