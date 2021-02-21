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
        <h2 class="text-light">Settings</h2>
      </div>
      <div class="col-md-6">
        <form>
          <label class="font-weight-bold text-light"> Temperature unit </label>
          <div class="something" id="radio">
          <div class="radio" class="form-check-input">
            <label style="color: white"><input type="radio" name="optradio" id="op1" value="Celsius">Celsius</label>
          </div>
          <div class="radio" class="form-check-input">
            <label style="color: white"><input type="radio" name="optradio" id="op2" value="Fehrenheit">Fehrenheit</label>
          </div>
        </div>
          <button type="button" class="btn btn-default" onclick="getOptions()">Apply</button>
          <br>
          <br>
          <div class="alert alert-success" id="temp">
            <strong>Settings have changed</strong>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
      $('#temp').hide();
            $.ajax({
        url: "services/gettingSettings.php",
        success: function(response){
          json=JSON.parse(response);
          if(json.settemp == 0)
          {
            $('#op1').replaceWith('<input type="radio" name="optradio" id="op1" value="Celsius" checked=" ">');
          }
          else
          {
            $('#op2').replaceWith('<input type="radio" name="optradio" id="op2" value="Fehrenheit" checked=" ">')
          }
       }
     });
    });
    var option1;
    function getOptions()
    {
      if (document.getElementById('op1').checked) {
        option1 = document.getElementById('op1').value;
      }    
      if (document.getElementById('op2').checked) {
        option1 = document.getElementById('op2').value;
      }    

      $.ajax({
        url: "services/changeSettings.php",
        method: "POST",
        data: {options: option1},
        success: function(response){
         $('#temp').show();
       }
     });
    }
  </script>
  <?php include"includes/bottom.php" ?>
</body>
</html>