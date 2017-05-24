<?php

if(isset($_POST['submitted'])){
	include('connect.php');
	$field1 = $_POST['this'];
	$field2 = $_POST['that'];
	$sqlinsert = "INSERT INTO test (field1, field2) VALUES ('$field1', '$field2')";
	
	if(!mysqli_query($db, $sqlinsert)){
		die('error inserting into database');
	}
	
	$newrecord = "1 new item added to the database";
}

?>
<html>
<head>
	<title>dbTest</title>
</head>

<body>
	
	<h1>Data insertion</h1>
	
	<form method="post" action="test.php">
	<input type="hidden" name="submitted" value="true" />
	<fieldset>
		<legend>New stuff</legend>
		<label>this: <input type="text" name="this" /></label>
		<label>that: <input type="text" name="that" /></label>
	</fieldset>
	<br />
	<input type="submit" value="add new thing" />
</form>
<?php
echo $newrecord;
?>
</body>
</html>