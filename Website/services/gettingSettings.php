<?php
	// Make connection
include "../includes/connection.php";
$query = "SELECT `settemp` FROM `setting`";
$result=mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($result);
echo json_encode($row);
?>
