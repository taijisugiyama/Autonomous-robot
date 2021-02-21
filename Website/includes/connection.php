<?php

$servername = "localhost";
$username = "Tayyab";
$password = "something";
$database = "user";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
