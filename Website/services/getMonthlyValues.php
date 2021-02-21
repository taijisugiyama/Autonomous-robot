<?php
	// Make connection
include "../includes/connection.php";

	//Executing SQL query
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='January'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[0]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='February'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[1]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='March'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[2]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='April'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[3]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='May'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[4]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='June'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[5]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='July'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[6]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='August'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[7]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='September'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[8]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='October'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[9]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='November'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[10]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE MONTHNAME(time)='December'";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[11]=$row;
print json_encode($data);
?>