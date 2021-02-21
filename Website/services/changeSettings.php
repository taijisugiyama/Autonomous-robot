<?php
	// Make connection
include "../includes/connection.php";
	// Getting POST data

if (isset($_POST['options']))
{
	$option = $_POST['options'];
}
if($option == 'Celsius')
{
	$query ="UPDATE `setting` SET `settemp`=0";
}
else
{
	$query ="UPDATE `setting` SET `settemp`=1";
}
$login=mysqli_query($conn,$query);
echo " settings changed";
?>