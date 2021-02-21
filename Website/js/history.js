var temp =[];
var hum =[];
var time =[];
// Temperature avg in a week
var tempWeekly =[];
// Humidity avg in a week
var humWeekly =[];
// Temperature avg in a month 
var tempMonthly =[];
// Humidity avg in a month
var humMonthly =[];
// Temperature throughout today
var tempToday=[];
// Humidity throughout today
var humToday=[];
// Time variable for Today values
var timeToday=[];
// Count items in the database
var count;
// used to clear interval
var int;
var tempTime=[];
// check for checking the Settings of temperature from database(0 = Celsius,1 = Farenhieght)
var checkSettemp=0;
// check for checking which graph mode it is all,Today,Week or month(1 = all,2 = Week,3 = Month,4 = today)
// Used to check which variables to convert in Farenheight
var checkMode=0;
// Used to check which variables are currently being used (0 = Celsius,1 = Farenhieght)
var checkUnits=0;
//Used to check if there were any values added today
var checkToday=0;

//Configurations for Graphs
var config = {
	type: 'line',
	data: {
		labels: time,
		datasets: [{
			label: "temperature",
			fillColor: "rgba(220,220,220,0.2)",
			strokeColor: "rgba(220,220,220,1)",
			pointColor: "rgba(220,220,220,1)",
			pointStrokeColor: "#fff",
			pointHighlightFill: "#fff",
			pointHighlightStroke: "rgba(220,220,220,1)",
			data: temp
		},
		{
			label: "humidity",
			fillColor: "rgba(151,187,205,0.2)",
			strokeColor: "rgba(151,187,205,1)",
			pointColor: "rgba(151,187,205,1)",
			pointStrokeColor: "#fff",
			pointHighlightFill: "#fff",
			pointHighlightStroke: "rgba(151,187,205,1)",
			data: hum
		}]
	},
};

$(document).ready(function(){
	var ctx = document.getElementById('chart').getContext('2d');
	window.myLine = new Chart(ctx, config);
	get_daily_values();
	int =setInterval(get_daily_values, 5000);
});

// Pushes all the values of temperature and humidity in graph if new values are added
function get_daily_values(){
	$.ajax({
		url:"services/getDailyValues.php",
		success: function(response) {

			if(response != '')
			{
				if(response == "no data in database")
					alert("no data available")
				else
				{
					//Parsing json data
					var json = JSON.parse(response);
					count = json.count;
					//Temporary Variables
					var temp1=[];
					var hum1=[];
					var time1=[];
					var changed=0;
					// Storing data in temporary variables
					for (var i = 0; i < count; i++) {
						temp1[i]=json[i].temperature;
						hum1[i]=json[i].humidity;
						time1[i]=json[i].time;
					}
					//Checking for change in time
					for(var i=0;i<count;i++)
					{
						if(time[i] != time1[i])
						{
							changed=1;
						}
					}
					//If there is change in time(new data has been added)
					if(changed==1)
					{
						time = time1;
						hum = hum1;
						temp = temp1;
						checkMode=1;
						//call function to check units and change values accordingly
						check_settings();

						//push new data
						config.data.labels = time;
						config.data.datasets[0].data = temp;
						config.data.datasets[1].data = hum;

						window.myLine.update();

						changed = 0;
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

//Function used to call to set graph in weekly data
function weekly() {
	config.data.labels=["Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday"];
	time=[];
	clearInterval(int);
	get_weekly_values();
	int =setInterval(get_weekly_values, 5000);
	config.data.datasets[0].data = tempWeekly;
	config.data.datasets[1].data = humWeekly;
	window.myLine.update();
}

//Function used to call to set graph in all data
function daily()
{
	config.data.labels=time;
	clearInterval(int);
	get_daily_values();
	int =setInterval(get_daily_values, 5000);
	window.myLine.update();
}

//Function used to call to set graph in Monthly data
function monthly() {
	
	config.data.labels=["January","February","March","April","May","June","July","September","October","November","December"];
	time=[];
	clearInterval(int);
	get_Monthly_values();
	int =setInterval(get_Monthly_values, 5000);
	config.data.datasets[0].data = tempMonthly;
	config.data.datasets[1].data = humMonthly;
	window.myLine.update();
}

//Function used to call to set graph in Today's data
function today()
{
	get_today_values();
	//Checking whether any values are added today
	if(checkToday == 0)
	{
		config.data.labels=time;
	}
	else // if not alert
	{
		alert("No data stored today");
	}
	time = [];
	timeToday=[];
	clearInterval(int);
	int =setInterval(get_today_values, 5000);
	window.myLine.update();
}

//Pushes the avg Weekly values in the graph whenever new data has been added
function get_weekly_values(){
	$.ajax({
		url:"services/getWeeklyValues.php",
		success: function(response) {

			if(response != '')
			{
				if(response == "no data in database")
					alert("no data available")
				else
				{
					var json = JSON.parse(response);
					var tempWeekly1=[];
					var humWeekly1=[];
					for (var i = 0; i < 7; i++) // Saving avg weekly data in Temporary Variables
					{
						tempWeekly1[i]=json[i]['AVG(`temperature`)'];
						humWeekly1[i]=json[i]['AVG(`humidity`)'];
						if(tempWeekly1[i] == null || humWeekly1[i] == null) // If data is null give it a zero value instead
						{
							tempWeekly1[i]=0;
							humWeekly1[i]=0;
						}
					}
					if(checkUnits==1)//Checking if Units are in Farenhieght or not. if in farenhieght then convert
					{
						for (var i = 0; i < 7; i++)
						{
							tempWeekly1[i]=(tempWeekly1[i]*1.8)+32;
						}
					}
					for(var i=0;i<7;i++)// checking values one by one to see if new data is added or not
					{
						if(tempWeekly[i] != tempWeekly1[i])
						{
							changed=1;
						}
					}				
					if(changed==1)
					{
						humWeekly = humWeekly1;
						tempWeekly = tempWeekly1;
						config.data.datasets[0].data = tempWeekly;
						config.data.datasets[1].data = humWeekly;
						window.myLine.update();
						myLine.update();
						changed = 0;
						checkMode=2;
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

//Pushes the avg Monthly values in the graph whenever new data has been added
function get_Monthly_values(){
	$.ajax({
		url:"services/getMonthlyValues.php",
		success: function(response) {

			if(response != '')
			{
				if(response == "no data in database")
					alert("no data available")
				else
				{
					var json = JSON.parse(response);
					var tempMonthly1=[];
					var humMonthly1=[];
					for (var i = 0; i < 12; i++)
					{
						tempMonthly1[i]=json[i]['AVG(`temperature`)'];
						humMonthly1[i]=json[i]['AVG(`humidity`)'];
						if(tempMonthly1[i] == null || humMonthly1[i] == null)
						{
							tempMonthly1[i]=0;
							humMonthly1[i]=0;
						}
					}
					if(checkUnits==1)
					{
						for (var i = 0; i < 12; i++)
						{
							tempMonthly1[i]=(tempMonthly1[i]*1.8)+32;
						}
					}
					for(var i=0;i<12;i++)
					{
						if(tempMonthly[i] != tempMonthly1[i])
						{
							changed=1;
						}
					}
					if(changed==1)
					{
						humMonthly = humMonthly1;
						tempMonthly = tempMonthly1;
						config.data.datasets[0].data = tempMonthly;
						config.data.datasets[1].data = humMonthly;
						window.myLine.update();
						myLine.update();
						changed = 0;
						checkMode=3;
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

//Pushes Today's Temperature and humidity in the graph along with time whenever new data is added
function get_today_values(){
	$.ajax({
		url:"services/getTodaysValue.php",
		success: function(response) {

			if(response != '')
			{
				if(response == "no data in database")
					alert("no data available")
				else
				{
					var json = JSON.parse(response);
					count = json.count;
					var temp1=[];
					var hum1=[];
					var time1=[];
					var changed=0;
					if(count==0)
					{
						checkToday=1;
					}
					else
					{
						for (var i = 0; i < count; i++) {
							temp1[i]=json[i].temperature;
							hum1[i]=json[i].humidity;
							time1[i]=json[i].time;
						}
						for(var i=0;i<count;i++)
						{
							if(timeToday[i] != time1[i])
							{
								changed=1;
							}
						}
						if(changed==1)
						{
							timeToday = time1;
							humToday = hum1;
							tempToday = temp1;
							for (var i=0;i<count;i++)
							{
								tempTime[i]=String(timeToday[i]).split(" ")[1];
							}
							checkMode=4;
							check_settings();
							config.data.labels = tempTime;
							config.data.datasets[0].data = tempToday;
							config.data.datasets[1].data = humToday;

							window.myLine.update();

							changed = 0;
						}
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

//Function used to check if data should be displayed in celcius or farenhieght 
function check_settings()
{
	$.ajax({
		url: "services/gettingSettings.php",
		success: function(response){
			if(response != '')
			{
				var json2 = JSON.parse(response);
				if(json2.settemp == 0)
				{
					checkSettemp=0;
				}
				else
				{
					checkSettemp=1;
				}
			}
			else
			{
				alert("empty reponse");
			}

			if(checkSettemp ==1)
			{
				checkUnits=1;
				if(checkMode=1)
				{
					for (var i = 0; i < count; i++) {
						temp[i]=(temp[i]*1.8)+32;
					}
					checkSettemp =0;
					myLine.update();
				}
				if(checkMode=2)
				{
					for (var i = 0; i < 7; i++)
					{
						tempWeekly[i]=(tempWeekly[i]*1.8)+32;
					}
					checkSettemp =0;
					myLine.update()
				}
				if(checkMode=3)
				{
					for (var i = 0; i < 12; i++)
					{
						tempMonthly[i]=(tempMonthly[i]*1.8)+32;
					}
					checkSettemp =0;
					myLine.update()
				}
				if(checkMode=4)
				{
					for (var i = 0; i < count; i++)
					{
						tempToday[i]=(tempToday[i]*1.8)+32;
					}
					checkSettemp =0;
					myLine.update()
				}
			}
		}
	});
}