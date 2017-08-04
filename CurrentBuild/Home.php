<?php 
session_start();
include('connect.php');
$name = $_SESSION["userid"];

//$_SESSION["favcolor"] = "yellow";
//print_r($_SESSION['userid']); '.$row['id'].','.$row['sport'].'

if(isset($_POST['submitted'])){
	{
	//	$_POST['submitted']=false;
		$eventid=$_POST['id'];
		$sport= $_POST['sport'];
		
		$sql = "DELETE FROM events WHERE id = '$eventid' ";
		mysqli_query($db, $sql )or die('error deleting event.');
		
		$sport = trim($sport,"> ");
		$sportsql = "DELETE FROM $sport WHERE event_id ='$eventid' ";
		mysqli_query($db, $sportsql )or die( "$sport" );
		
		$interestedsql = "DELETE FROM interested WHERE event_id ='$eventid' ";
		mysqli_query($db, $interestedsql )or die( "$sport" );
		
		
	}
	
}

	if(isset($_POST['wantToRemove']))
{
	{
	//	$_POST['submitted']=false;
		$event_id= trim($_POST['deleteId'],"> ");
		$sport= trim($_POST['deleteSport'],"> ");
	
		 
		
	//select	echo "$event_id + $time + $vi"
															//<--here
		$sql = "Delete from interested where event_id = '$event_id ' and user = '$name'";
		
		mysqli_query($db, $sql )or die('ERROR');
		
		
		$sql = "SELECT from interested where event_id = '$event_id ' and user = '$name'";
		
		mysqli_query($db, $sql )or die('ERROR');
		
		
			$sql = "update events set viewers = viewers - 1 where id = '$event_id'";
		mysqli_query($db, $sql )or die('error2');
		
		$sql = "update $sport set viewers = viewers - 1 where event_id = '$event_id'";

		mysqli_query($db, $sql )or die('error3');
		
		
		
		header( 'Home.php' ) ;

		
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
          	<li><a href="AllEvents.php">All Events</a></li>
            <li><a href="FootballForum.php">Football</a></li>
            <li><a href="SoccerForum.php">Soccer</a></li>
            <li><a href="BaseballForum.php">Baseball</a></li>
            <li><a href="BasketballForum.php">Basketball</a></li>
            <li><a href="MiscellaniousForum.php">Miscellanious</a></li>
          </ul>
        </li>
        <li><a href="NewEvent.php">NewEvent</a></li>
        <li><a href="login.php">Logout</a></li>
      </ul>

     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
    <title>Home</title>
    </head>
    
    <body>
      <center><h1>Welcome back <?php print_r( strtoupper ( $name ) ); ?></h1></center>
      
      <div id="background"><img src="images/sportsballs.jpg"></div>
      
      <div class="container">
        <h3>Interested Events</h3>
        <div class="row clearfix">
		    <div class="col-md-12 column">
			    <table class="table table-bordered table-hover" id="tab_logic">
				    <thead>
					    <tr >
						    
						    <th class="text-left">
							    Event Name
						    </th>
						    <th class="text-left">
							    Event Type
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
							    Posted By
						    </th>
					    </tr>
				    </thead>
			<?php 
				 
				 $sqlget="SELECT * FROM interested where user = '$name' ";
				 $sqldata = mysqli_query($db, $sqlget) or die('error getting data.');
				  
				while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC))
				{
					$id = $row['event_id'];
					$sport = $row['sport'];
					
					echo '<form method = "post" action = "Home.php" >';
					
					echo "<tr>";
				
					
					echo "<td>";
					
					echo $row['name'];
					echo "</td><td>";
					echo $row['sport'];
					echo "</td><td>";
					echo $row['time'];
					echo "</td><td>";
					echo $row['date'];
					echo "</td><td>";
					echo $row['location'];
					echo "</td><td>";
					echo $row['additional'];
					echo "</td><td>";
					
					$eventId = $row['event_id'];
					$sqlPostUserReq = "Select user from events where id = '$eventId' ";
					$sqlData = mysqli_query($db, $sqlPostUserReq) or die('Error finding Event Host UserName.');
					$postUser = mysqli_fetch_array($sqlData, MYSQLI_ASSOC);
					
					echo $postUser['user'];
					
					echo '</td>';
					
					echo '<input type="hidden" name="wantToRemove" value="true" />';
					
					echo "<p><input type=\"hidden\" value=\"$id\" name=\"deleteId\" /></p>";
					echo "<p><input type=\"hidden\" value=\"$sport\" name=\"deleteSport\" /></p>";
					
					echo '<td><input type="submit" value="X" class="btn btn-primary btn-primary.raised"></td></tr>';
					
					echo "</form>";
					
				}
				  
				  
				  
				  
				 ?>
				    
				    
				    
				    
				    
				    
				    
				    
				  </table>
		</div>
	</div>
</div>
	  
  	<div class="container">
  	  <h3>Events You Are Hosting</h3>
        <div class="row clearfix">
		    <div class="col-md-12 column">
			    <table class="table table-bordered table-hover" id="tab_logic">
				    <thead>
					    <tr>
					    	<th class="text-left">
							    Event ID#
						    </th>
						    <th class="text-left">
							    Event Name
						    </th>
						    <th class="text-left">
						      Sport Type
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
				 
				 $sqlget="SELECT * FROM events where user = '$name' ";
				 $sqldata = mysqli_query($db, $sqlget) or die('error getting data.');
				  
				while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC))
				{
					$id = $row['id'];
					$sport = $row['sport'];
					
					echo '<form method = "post" action = "Home.php" >';
					
					echo "<tr><td>";
					echo $row['id'];
					echo "</td><td>";
					echo $row['name'];
					echo "</td><td>";
					echo $row['sport'];
					echo "</td><td>";
					echo $row['time'];
					echo "</td><td>";
					echo $row['date'];
					echo "</td><td>";
					echo $row['location'];
					echo "</td><td>";
					echo $row['additional'];
					echo "</td><td>";
					echo $row['viewers'];
					echo "</td>";
					echo '<input type="hidden" name="submitted" value="true" />';
					echo "<p><input type=\"hidden\" value=\"$id>\" name=\"id\" /></p>";
					echo "<p><input type=\"hidden\" value=\"$sport>\" name=\"sport\" /></p>";
					echo '<td><input type="submit" value="Delete Event" class="btn btn-primary btn-primary.raised " ></td></tr>';
					echo "</form>";
					
				}
				  
				 ?>
			  
				  </table>
		</div>
	</div>
		
	
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>