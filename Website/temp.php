<html>
<body>
<h1> Site to get temperature and humidity</h1>
<form method="get" action="temp.php">
                 <input type="submit" value="ON" name="gettemp">
</form>
<?php
if(isset($_GET[ 'gettemp' ])){
$out=shell_exec("sudo /home/pi/Adafruit_Python_DHT/examples/AdafruitDHT.py 11 27");
echo "<pre>$out</pre>";
}
?>
</body>
</html>
