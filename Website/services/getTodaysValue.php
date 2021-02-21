<?php
	// Make connection
include "../includes/connection.php";

	//Executing SQL query
$query="SELECT `time`, `temperature`, `humidity` FROM tempdata WHERE DATE(time)=DATE(NOW())";
$result=mysqli_query($conn,$query);
$rowcount=mysqli_num_rows($result);
$data['count']=$rowcount;
foreach ($result as $row) {
	$data[] = $row;
}
print json_encode($data);
?>