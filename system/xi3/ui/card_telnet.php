<?php
include_once __DIR__ . '/core/db/tb_telnet.php';
$telnetstat = TableTelnet::get_stat($sid);
//var_dump($telnetstat);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="TelnetchartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_telnet.php" 
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Telnet is a network protocol used to virtually access a computer and to provide a two-way, collaborative and text-based communication channel between two machines.</small></p>
    </div>
  </div>

<script>
function showtelnetchart(dataArray) {

var telnetDataPoints = [];
var telnetdata=0;
var other=0;
for (var key in dataArray) {
  if(key<5) {
	   telnetDataPoints.push({ y: parseInt(dataArray[key]['cnt']), label: dataArray[key]['site'] });
   }
  else {
    other+= dataArray[key]['cnt'];
  }
}
//telnetDataPoints.push({ y: other, label: 'others' });
//alert(telnetDataPoints.length);


  var chart = new CanvasJS.Chart("TelnetchartContainer", {
  	animationEnabled: true,
  	title: {
  		text: "Top 5 Telnet HostName"
  	},
  	data: [{
  		type: "pyramid",
      indexLabelPlacement: "inside",
      indexLabel: "{label} - {y}",
      yValueFormatString: "#,##0",
  		dataPoints: telnetDataPoints
  	}]
  });
  chart.render();

}

<?php
echo "var javascript_array_telnet = ". json_encode($telnetstat) . ";\n";
echo "showtelnetchart(javascript_array_telnet);";
?>

</script>
