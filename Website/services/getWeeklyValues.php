<?php
	// Make connection
include "../includes/connection.php";

	//Executing SQL query
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=2";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[0]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=3";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[1]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=4";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[2]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=5";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[3]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=6";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[4]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=7";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[5]=$row;
$query="SELECT AVG(`temperature`), AVG(`humidity`) FROM tempdata WHERE DAYOFWEEK(Date(time))=1";
$result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc($result);
$data[6]=$row;
print json_encode($data);
?>