<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
</head>
<body background="images/leaves-pattern.png">
  <!-- Navbar -->
  <?php include"includes/top.php" ?>

  <br>

  <div class="container" style="width: 75%">
  <canvas id="chart" ></canvas>
  <button type="button" class="btn btn-outline-danger" onclick="daily();">All data</button>
  <button type="button" class="btn btn-outline-danger" onclick="today();">Today's data</button>
  <button type="button" class="btn btn-outline-success" onclick="weekly();">Weekly data</button>
   <button type="button" class="btn btn-outline-info" onclick="monthly();">Monthly data</button>
  </div>
  
  <!-- Footer -->
  <?php include"includes/bottom.php" ?>
  
  <!-- Javascript for this page -->
  <script src="js/history.js"></script>
</body>
</html>