<?php
session_start();


$set = false;

if(isset($_POST['submitted'])){
	include('connect.php');
	$user = $_SESSION['userid'];
	$name = $_POST['name'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$location = $_POST['location'];
	$sport = $_POST['sport'];
	$additional = $_POST['additional'];
	
	$set = true; 
		if(empty($name) )
		{
		   $newevent= "Event Name is a REQUIRED FIELD and must not be NULL.";
		   $created = false;
		}
		elseif(empty($sport) )
		{
			$newevent= "Please SELECT a sport FORUM to POST IN.";
			 $created = false;
		}
			elseif(empty($location) )
		{
			$newevent= "Please designate a LOCATION for your New Event.";
			 $created = false;
		}
			elseif(empty($time) || empty($date))
		{
			 $newevent= "TIME and DATE are REQUIRED to create a New Event.";
			 $created = false;
		}
		
	else
	{
		//Insert event into events table
		$insertEvent = "INSERT INTO events (name, time, date, location, sport, additional, user) VALUES ('$name', '$time', '$date', '$location', '$sport', '$additional', '$user')";
			if(!mysqli_query($db, $insertEvent)){			die('error creating new event.');	}

		$getEvent_id = "select * from events order by id desc limit 1";
		$eventData = mysqli_query($db, $getEvent_id) or die('error getting data.');
			$row = mysqli_fetch_array($eventData, MYSQLI_ASSOC);
			
			$event_id= $row['id'];
				
			
			
		
		/*Insert event into individual sports tables*/
		
		if($sport=="other")
		{
			$insert = "INSERT INTO other (event_id, name, time, date, location, additional, user) VALUES ('$event_id ','$name', '$time', '$date', '$location', '$additional', '$user')";
			
			//$myNewEvent = "INSERT INTO hosting (time, date, location, sport, additional, name) VALUES ($time', '$date', '$location', '$sport', '$additional', '$name')";
			
			if(!mysqli_query($db, $insert)){
				die('error creating new event here.');
			}
		}
		elseif($sport=="football")
		{
			$insert = "INSERT INTO football (event_id, name, time, date, location, additional, user) VALUES ('$event_id ','$name', '$time', '$date', '$location', '$additional', '$user')";
			
			//$myNewEvent = "INSERT INTO hosting (time, date, location, sport, additional, name) VALUES ($time', '$date', '$location', '$sport', '$additional', '$name')";
		
			if(!mysqli_query($db, $insert)){
				die('error creating new event.');
			}
		}
		
		elseif($sport=="baseball")
		{
			$insert = "INSERT INTO baseball (event_id, name, time, date, location, additional, user) VALUES ('$event_id ','$name', '$time', '$date', '$location', '$additional', '$user')";
			
			//$myNewEvent = "INSERT INTO hosting (time, date, location, sport, additional, name) VALUES ($time', '$date', '$location', '$sport', '$additional', '$name')";
		
			if(!mysqli_query($db, $insert)){
				die('error creating new event.');
			}
		}
		
		elseif($sport=="basketball")
		{
			$insert = "INSERT INTO basketball (event_id, name, time, date, location, additional, user) VALUES ('$event_id ','$name', '$time', '$date', '$location', '$additional', '$user')";
			
			//$myNewEvent = "INSERT INTO hosting (time, date, location, sport, additional, name) VALUES ($time', '$date', '$location', '$sport', '$additional', '$name')";
		
			if(!mysqli_query($db, $insert)){
				die('error creating new event.');
			}
		}
		
		elseif($sport=="soccer")
		{
			$insert = "INSERT INTO soccer (event_id, name, time, date, location, additional, user) VALUES ('$event_id ','$name', '$time', '$date', '$location', '$additional', '$user')";
			
			//$myNewEvent = "INSERT INTO hosting (time, date, location, sport, additional, name) VALUES ($time', '$date', '$location', '$sport', '$additional', '$name')";
		
			if(!mysqli_query($db, $insert)){
				die('error creating new event.');
			}
		}
		
		
	$newevent = "New event successfully created!";
	$created = true;
}
}

?>
<html>
<head>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/myStyle.css">
    <nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <img src="images/NPicon.png" style="width:48px;height:48px;">
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Forums <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="FootballForum.php">Football</a></li>
            <li><a href="SoccerForum.php">Soccer</a></li>
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
	<div id="background"><img src="images/grass.jpg"></div>
	
	<h1>New Event</h1>
	<div class="container container-fluid ">
		<?php
		
			if($set){
					if ($created)
				{
				
				echo "
						<div class='alert alert-success'>
				  		<strong>Success!</strong> $newevent.
						</div>
						";
				}
				
				
				if (!$created)
				{
				
				echo "
						<div class='alert alert-danger'>
				  		<strong>Oops!</strong> $newevent.
						</div>
						";
				}
			}
		
		?>

		
			<form method="post" action="NewEvent.php">
				<input type="hidden" name="submitted" value="true" />
				  
				  
					 
					 	<div class="row ">
					 		<legend></legend>
						<div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 ">
						 <h4>Please NAME your Event :	 	<input type="text" name="name" class="form-control text-center" placeholder="Event Name "/></h4>
						</div>
					</div>
					 
					<div class="row">
					 <div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 text-center">
						 <h4>Sport: <select name="sport" class="form-control text-align-center">
			  						<option value="">Please Select One...</option>
			  						<option value="basketball">Basketball</option>
			  						<option value="baseball">Baseball</option>
			  						<option value="soccer">Soccer</option>
			  						<option value="football">Football</option>
			  						<option value="other">Other</option>
									</select>
					</h4>
					</div>
					 
				
					
				
					<div class="row ">
						<div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 ">
						 <h4>Location: <input type="text" name="location" class="form-control text-center" placeholder="Street Address/Park name/Location"/></h4>
						</div>
					</div>
					
					
					<div class="row ">
						<div class=" col-xs-6 col-xs-offset-3 col-xl-6 col-xl-offset-3 ">
						 <h4>Date: <input type="date" name="date" class="form-control text-center"/></h4>
						 <h4>Time: <input type="time" name="time" class="form-control text-center" /></h4>
					</div>
					</div>
					
				
							
							
					<h4>(Optional)Additional Information:
					<textarea type="text" name="additional" class="form-control text-center" rows="5" placeholder="Age range, skill level, scheduled duration, etc..(255 char max) " /></textarea>	</h4>
				
				<br />
				<input type="submit" class="btn btn-primary btn-primary.raised." value="add new event" />	
			</form>
		</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body></center>
</html>