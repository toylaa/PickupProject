<?php
//Start session
session_start();

if(isset($_POST['submitted'])){
	include('connect.php');
	
	$userid = $_POST['UserName'];
	$passcode = $_POST['PassWord'];
	$passcode2 = $_POST['PassWord2'];
	
	
	//Search databaase for Desired username
	$sqlget = "SELECT * FROM UserPass WHERE userid = '$userid'";
  $sqldata = mysqli_query($db, $sqlget ); //or die('Error getting data');
  $row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
  
  //Check number of rows in query results
  $count = mysqli_num_rows($sqldata);
	
	
	 //CHECK number of rows - Do not continue if username is taken
 if ($count>0){
        //print error if username exists
        $capitalName=strtoupper($userid);
        $error = "
        <div class='alert alert-danger' > 
        <strong>Sorry! </strong> UserName '$capitalName' already taken. Please try again.
        </div>
        ";
      }
   
    //Do not continue if passcodes do not match 
else if ($passcode !==$passcode2)
	{
	  //print error if passcodes DO NOT match 
        $error = "
        <div class='alert alert-danger' > 
        <strong>Whoah! </strong> Passwords do not match. Please try again.
        </div>
        ";
	}
	
	else if (strlen($passcode) < 7 )
	{
	  //print error if passcodes are less than 7 characters long
        $error = "
        <div class='alert alert-danger' > 
        <strong>Sorry! </strong> Password must be longer than 7 characters.
        </div>
        ";
	}
	
	//if all conditions are met, continue to insert new userid and passcode into UserPass Table  
	else // 
      {
          //Compile SQL INSERT statement
      	$insert = "INSERT INTO UserPass (userid, passcode) VALUES ('$userid', '$passcode')";
	
      		//If sql returns FALSE (=fail)
      	if(!mysqli_query($db, $insert)){
      	  
      		//die('error' . mysqli_error($db));
      		//
      		$_SESSION["isReg"] = false;
      		//print error if insert fails
        $error = "Database insert has failed for some reason. Contact Admin.";
      		
      	}
      	else{
      	$_SESSION["isReg"] = true;
      	
      	//Call a separate page rather than replace elements 
      	header('Location: SuccessfulRegister.html');
      	}//end inner else
      	
      }//end outer else
}// end submission action code
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
              
             <div class="col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3">
                  <input type="text" class="form-control text-center" name="UserName" placeholder="Please Choose a UserName">
              </div>
            </div>
            
            <div class="row">
              
              
              
              <div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3">
                  <input type="password" class="form-control text-center" name="PassWord" placeholder="Please choose a Password">
              </div>
            </div>
            
            
            <div class="row">
              
              <div class="col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3">
                  <input type="password" class="form-control text-center" name="PassWord2" placeholder="Please Re-Type Password">
              
              
                     </div>
                      <input type="submit" style="text-align: center" class="btn btn-primary" value="Register">
                     </div>
                
                
             
             <div class="row">
              
              <div class="col-xs-6 col-xs-offset-3 col-xl-6" style="text-align: center">
                
                
                   <div style = "color:#cc0000; margin-top:10px"><center><?php echo  $error; ?></center></div>
              
                  <h5>Already Registered? Login <a href="login.php">HERE</a></h5>
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