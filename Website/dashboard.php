<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body background="images/leaves-pattern.png">

	<?php include"includes/top.php" ?>
	<br>
	<div class="container">
		<div class="card bg-dark">
			<div class="card-header">
				<h2 class="text-light">Welcome</h2>
			</div>
			<div class="col-md-6">
				<label class="font-weight-bold text-light"> Temperature:  </label> <p id="temp">78s</p>
				<br>
				<label class="font-weight-bold text-light"> Humidity: </label> <p id="hum">78s</p>
				<br>
				<label class="font-weight-bold text-light"> Relay: </label>
				<button type="submit" class="btn btn-default">On</button>
				<button type="submit" class="btn btn-default">Off</button>
				<br>
				<label class="font-weight-bold text-light"> PIR status: </label>
			</div>
		</div>
	</div>
	<br>
	<div class="container">
		<div class="row">
			<div class="col"><img src="images/graph.jpg"/></div>
			<div class="col"><img src="images/settings.png"/></div>
		</div>
		<div class="card-deck">
			<div class="card-body">
				<h4 class="card-title">See Graphs</h4>
				<p class="card-text">Want to see data from previous day or week?</p>
				<p class="card-text">Look no further</p>
				<a href="History.php" class="btn btn-primary">Go to History</a>
			</div>
			<div class="card-body">
				<h4 class="card-title">Change settings</h4>
				<p class="card-text">Aren't fimiliar with different units?</p>
				<p class="card-text">Go to settings</p>
				<a href="settings.php" class="btn btn-primary">Go to settings</a>
			</div>
		</div>

	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<?php include"includes/bottom.php" ?>
</body>
<script type="text/javascript">
	$(document).ready(function(){
		get_values();
		setInterval(get_values, 5000);
	});

	function get_values(){
		$.ajax({
			url: "services/getValues.php",
			success: function(response){
				if(response != '')
				{
					if(response == "no data in database")
						alert("no data available")
					else
					{
						var json = JSON.parse(response);
						$.ajax({
							url: "services/gettingSettings.php",
							success: function(response){
								if(response != '')
								{
									if(response == "no data in database")
										alert("no data available")
									else
									{
										var json2 = JSON.parse(response);
										if(json2.settemp == 0)
										{
											var num=json.humidity;
											var str=num.toString() + '%';
											var result=str.fontcolor("white");
											var num1=json.temperature;
											var str1=num1.toString() + 'C';
											var result1=str1.fontcolor("white");
											$('#hum').replaceWith(result);
											$('#temp').replaceWith(result1);
										}
										else
										{
											var num=json.humidity;
											var str=num.toString() + '%';
											var result=str.fontcolor("white");
											var num1=(json.temperature*1.8)+32;
											var str1=num1.toString() + 'F';
											var result1=str1.fontcolor("white");
											$('#hum').replaceWith(result);
											$('#temp').replaceWith(result1);
										}


									}
								}
								else
								{
									alert("empty reponse");
								}
							}
						});

					}
				}
				else
				{
					alert("empty reponse");
				}
			}
		});
	}

</script>
</html>


