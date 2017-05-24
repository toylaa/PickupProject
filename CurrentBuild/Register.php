<?php
//Start session
session_start();

if(isset($_POST['submitted'])){
	include('connect.php');
	
	$userid = $_POST['UserName'];
	$passcode = $_POST['PassWord'];
	
	
 
  
	//Compile SQL INSERT statement
	$insert = "INSERT INTO UserPass (userid, passcode) VALUES ('$userid', '$passcode')";
	
	if(!mysqli_query($db, $insert)){
		die('error creating user id.');
		$_SESSION["isReg"] = false;
	}
	else{
	$_SESSION["isReg"] = true;
	
	header('Location: SuccessfulRegister.html');
	}
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
    <link href="css/myStyle.css" rel="stylesheet">

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
          <li class="active"><a href="login.php">Login</a></li>
        </ul>
        
       
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>


  </head>
  <body>
     <div id="background"><img src="images/sunset.jpg"></div>
<CENTER><h1> Register</h1></CENTER>

<form method="post" action="Register.php">
   <input type="hidden" name="submitted" value="true" />
           <div class="container-fluid">
             
            <div class="row">
              <div class="col-sm-1 col-md-offset-3">
                <h4>UserName: </h4>
              </div>
             <div class="col-sm-4">
                  <input type="text" class="form-control " name="UserName">
              </div>
            </div>
            
            <div class="row">
              
              <div class="col-sm-1 col-md-offset-3">
                <h4>PassWord:</h4>
              </div>
              
              <div class="col-sm-4">
                  <input type="password" class="form-control" name="PassWord">
              </div>
              <div class="col-sm-4">
                  <input type="submit" class="btn btn-primary" value="Register">
              </div>
            </div>
            
          </div>
        </div>

</form>










    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>