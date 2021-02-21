<!DOCTYPE html>
<html lang="en">
<head>
  <title>Temp page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 </head>
<body background="images/clouds.jpg">

<div class="container">
  <h2>Welcome to Login page</h2>
  <form>
    <div class="form-group">
      <label for="Username">Username:</label>
      <input type="text" class="form-control" id="username" placeholder="Enter Username">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="pwd">
    </div>
    <br>
    <button type="button" class="btn btn-default" onclick="login()">Submit</button>
  </form>
</div>
	<script>
				function login() {
					var user = $("#username").val();				// Jquery
					var pass = document.getElementById("password").value;		// Javascript
					if(user == 0 && pass == 0){
						alert("No username and password entered");
					}
					else{
					$.ajax({
						url: "services/login.php",
						method: "POST",
						data: { username: user, password: pass},
						success: function(response){
							if(response == "login successful") {
								console.log("successful");
								document.location.href = "dashboard.php";
							}
							else {
								alert("Login was unsuccessful");
							}
						}
					});
				}
			}
	</script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

