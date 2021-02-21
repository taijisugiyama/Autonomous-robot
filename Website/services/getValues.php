<?php
	// Make connection
	include "../includes/connection.php";
	
	//Executing SQL query
	$query="SELECT `time`, `temperature`, `humidity` FROM tempdata ORDER BY id DESC LIMIT 1";
	$result=mysqli_query($conn,$query);

	$rowcount = mysqli_num_rows($result);

	if ($rowcount == 0) {
		echo "no data in database";
	}
	else{
		$row = mysqli_fetch_assoc($result);
		echo json_encode($row);
	}
?>