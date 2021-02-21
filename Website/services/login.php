<?php
	// Make connection
	include "../includes/connection.php";

	// Getting POST data
	$user=$_POST['username'];
	$pass=$_POST['password'];

	//Executing SQL query
	$query = "SELECT `name`,`password`  FROM `userdata` WHERE `name` ='$user' AND `password` ='$pass'";
	$login=mysqli_query($conn,$query);

	$rowcount = mysqli_num_rows($login);

	if ($rowcount == 1) {
		echo "login successful";
	}
	else{
		echo "login failed";
	}
?>
