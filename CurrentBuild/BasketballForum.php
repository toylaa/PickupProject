
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
            <li><a href="MiscellaniousForum.php">Miscellanious</a></li>
          </ul>
        </li>
        <li><a href="Home.php">Home</a></li>
        <li><a href="NewEvent.php">NewEvent</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>

      
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


		<?php 
		session_start();
		include('connect.php');
		$name = $_SESSION["userid"];
		
		
		
		if(isset($_POST['submitted'])){
			{
			//	$_POST['submitted']=false;
				$event_id= trim($_POST['id'],"> ");
				$time = trim($_POST['time'],"> ");
				$date = trim($_POST['date'],"> ");
				$location = trim($_POST['location'],"> ");
				$additional = trim($_POST['additional'],"> ");
				$sport = trim($_POST['sport'],"> ");
				$eventName = trim($_POST['name'],"> ");//<--here
				
				 
				
			//select	echo "$event_id + $time + $vi"
			
			
			$sqlget = "SELECT * FROM interested WHERE event_id = '$event_id' and user = '$name'  ";
			$sqldata = mysqli_query($db, $sqlget ); //or die('Error getting data');
			$row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
			$count = mysqli_num_rows($sqldata);
			
			if ($count==0)
			{
				
				$sql = "INSERT INTO interested (event_id, user, name, time, date, location, sport, additional) VALUES ('$event_id ','$name','$eventName', '$time', '$date', '$location', '$sport', '$additional')";
					
				mysqli_query($db, $sql )or die('ERROR:(duplicate interest)');
				
				
				
				
			//	$sport = trim($sport,"> ");
			//	$sportsql = "DELETE FROM $sport WHERE event_id ='$eventid' ";
			//	mysqli_query($db, $sportsql )or die( "$sport" );
				echo "
								<div class='alert alert-success'>
						  		<strong>Success!</strong>
						  		
						  		You are Now Subscribed to a NEW EVENT.
								</div>
								";	
			}
			}
		}
		?>


    <title>BasketballForum</title>
</head>
  
<body>  
<div id="background"><img src="images/basketball.jpg"></div>
    <center><h1>Basketball Events</h1></center>
    <div class="container">
        <div class="row clearfix">
		    <div class="col-md-12 column">
			    <table class="table table-bordered table-hover" id="tab_logic">
				    <thead>
					    <tr >
						    <th class="text-left">
							    Posted By
						    </th>
						    <th class="text-left">
							    Event Name
						    </th>
						    <th class="text-left">
						      Event Time
						    </th>
						    <th class="text-left">
						      Event Date
						    </th>
						    <th class="text-left">
						      Event Location
						    </th>
						    <th class="text-left">
							    Additional Information
						    </th>
						     <th class="text-left">
							    Participants
						    </th>
					    </tr>
				    </thead>
<?php

include('connect.php');

$sqlget = "SELECT * FROM basketball";
$sqldata = mysqli_query($db, $sqlget) or die('error getting data.');

while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)){
	
	$user =  $row['user'];
	$event_id = $row['event_id'];
	$event_name =  $row['name'];      //<--here
	$time = $row['time'];
	$date = $row['date'];
	$location = $row['location'];
	$additional = $row['additional'];
	$sport = "basketball";
	
	
	$sqlGetInterested = "SELECT count(*) as viewers from interested WHERE event_id = '$event_id' ";
	$sqlInterestedData = mysqli_query($db, $sqlGetInterested) or die('error getting data.');

	$row2 = $sqlInterestedData->fetch_assoc();

	
	
	echo '<form method = "post" action = "BasketballForum.php" >';
	echo "<tr><td>";
	echo $row['user'];
	echo "</td><td>";
	echo $row['name'];
	echo "</td><td>";
	echo $row['time'];
	echo "</td><td>";
	echo $row['date'];
	echo "</td><td>";
	echo $row['location'];
	echo "</td><td>";
	echo $row['additional'];
	echo "</td><td>";
	echo $row2['viewers'];
	echo "</td>";
	echo '<input type="hidden" name="submitted" value="true" />';
	
	echo "<p><input type=\"hidden\" value=\"$event_id>\" name=\"id\" /></p>";
	echo "<p><input type=\"hidden\" value=\"$event_name>\" name=\"name\" /></p>";  // <--here
	echo "<p><input type=\"hidden\" value=\"$time>\" name=\"time\" /></p>";
	echo "<p><input type=\"hidden\" value=\"$date>\" name=\"date\" /></p>";
	echo "<p><input type=\"hidden\" value=\"$location>\" name=\"location\" /></p>";
	echo "<p><input type=\"hidden\" value=\"$additional>\" name=\"additional\" /></p>";
	echo "<p><input type=\"hidden\" value=\"$sport>\" name=\"sport\" /></p>";

				
	echo '<td><input type="submit" value="Interested" class="btn btn-primary btn-primary.raised"></td></tr>';
	echo "</form>";
}
/*<button type="button" class="btn btn-primary btn-primary.raised">Interested</button>*/
?>
			</table>
		</div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
</body>
    
</html>