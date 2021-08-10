<?php
  $servername="localhost";
  $username="id7419802_firebird";
  $password="9893622460";

  $dbname="id7419802_firebird";
  
  $conn= new mysqli($servername,$username,$password, $dbname);

  if($conn->connect_error)
  {
    echo "connection fail";
  }
  else
  {
    $query = "SELECT * FROM `fbv` WHERE `patient`='p1' ";
 
    $result=mysqli_query($conn,$query);
 
    $t= mysqli_num_rows($result);
 
    for($m=0; $m<=$t;$m++)
    {
      $arr[]= mysqli_fetch_array($result);
    }
 
  }

  for($m=0; $m<=$t;$m++)
  {
    $dataPoints1[]= array("label"=> $arr[$m]['time'], "y"=> $arr[$m]['heartbeat'] ); 
  } 

  for($m=0; $m<=$t;$m++)
  {
    $dataPoints2[]= array("label"=> $arr[$m]['time'], "y"=> $arr[$m]['temperature'] ); 
  }
?>

<!DOCTYPE HTML>
<html>
<head> 
<script>
window.onload = function () {
var chart = new CanvasJS.Chart("chartContainer", { 
theme: "light2",
title: {
text: "Temperature - Heart Rate monitoring system"
},
subtitles: [{
text: ""
}],

axisY: {
includeZero: false
},
legend:{
cursor: "pointer",
itemclick: toggleDataSeries
},
toolTip: {
shared: true
},
data: [{
type: "stackedArea",
name: "Temperature",
showInLegend: true,
visible: false,
yValueFormatString: "### Centigrade",
dataPoints: <?php echo json_encode($dataPoints1, 
JSON_NUMERIC_CHECK); ?>
},
{
type: "stackedArea",
name: "heart rate",
showInLegend: true,
yValueFormatString: "### BPM",
dataPoints: <?php echo json_encode($dataPoints2, 
JSON_NUMERIC_CHECK); ?>

},
]
});
chart.render();
function toggleDataSeries(e){
if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
e.dataSeries.visible = false;
}
else{
e.dataSeries.visible = true;
}
chart.render();
}
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> 
</body>
</html>
