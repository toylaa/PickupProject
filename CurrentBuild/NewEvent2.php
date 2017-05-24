<?php
session_start();
if(isset($_POST['submitted'])){
	include('connect.php');
	$user = $_SESSION['userid'];
	$name = $_POST['name'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$location = $_POST['location'];
	$sport = $_POST['sport'];
	$additional = $_POST['additional'];
	if($sport=="football"){
		$insert = "INSERT INTO football (name, time, date, location, additional) VALUES ('$name', '$time', '$date', '$location', '$additional')";
	
		if(!mysqli_query($db, $insert)){
			die('error creating new event.');
		}
	}
	if($sport=="baseball"){
		$insert = "INSERT INTO baseball (name, time, date, location, additional) VALUES ('$name', '$time', '$date', '$location', '$additional')";
	
		if(!mysqli_query($db, $insert)){
			die('error creating new event.');
		}
	}
	if($sport=="basketball"){
		$insert = "INSERT INTO basketball (name, time, date, location, additional) VALUES ('$name', '$time', '$date', '$location', '$additional')";
	
		if(!mysqli_query($db, $insert)){
			die('error creating new event.');
		}
	}
	if($sport=="soccer"){
		$insert = "INSERT INTO soccer (name, time, date, location, additional) VALUES ('$name', '$time', '$date', '$location', '$additional')";
	
		if(!mysqli_query($db, $insert)){
			die('error creating new event.');
		}
	}
	if($sport=="other"){
		$insert = "INSERT INTO other (name, time, date, location, additional) VALUES ('$name', '$time', '$date', '$location', '$additional')";
	
		if(!mysqli_query($db, $insert)){
			die('error creating new event.');
		}
	}
	
	$newevent = "New event successfully created!";
}

?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Forums <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="FootballForum.php">Football</a></li>
            <li><a href="BaseballForum.php">Baseball</a></li>
            <li><a href="BasketballForum.php">Basketball</a></li>
            <li><a href="MiscellaniousForum.php">Miscellanious</a></li>
          </ul>
        </li>
        <li><a href="Home.php">Home</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>

      
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
	<title>NewEvent</title>
</head>

<center><body>
	
	<h1>New Event</h1>
	
	<form method="post" action="NewEvent2.php">
	<input type="hidden" name="submitted" value="true" />
	<fieldset>
		<legend>New Event</legend>
		<label>Name: <input type="text" name="name" /></label>
		<label>Time: <input type="text" name="time" /></label>
		<label>Date: <input type="text" name="date" /></label>
		<label>Location: <input type="text" name="location" /></label>
		<label>Sport: <select name="sport">
  						<option value="">Select...</option>
  						<option value="basketball">Basketball</option>
  						<option value="baseball">Baseball</option>
  						<option value="soccer">Soccer</option>
  						<option value="football">Football</option>
  						<option value="other">Other</option>
						</select>
		</label>
		<label>Additional Information:(255 char max) <input type="text" name="additional" /></label>
	</fieldset>
	<br />
	<input type="submit" value="add new event" />
</form>
<?php
echo $newevent;
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></center>
</html>