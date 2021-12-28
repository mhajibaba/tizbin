<?php
include_once __DIR__ . '/core/db/tb_http.php';
$httpstat = TableHTTP::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">
<!--  <div class="card-header bg-success"><p class="font-weight-bold">
    Address Resolution Protocol</p>
  </div> -->
    <div class="card-body">
      <div id="httpchartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_http.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Hypertext Transfer Protocol (HTTP) is an application-layer protocol for transmitting hypermedia documents, such as HTML, Images and so on.</small></p>
    </div>
  </div>

<script>
function showhttpchart(dataArray){

  var httpDataPoints = [];
  var i = 0;

  for (var key in dataArray) {

    i++;
    if(i>5) break;

  	httpDataPoints.push({ label: dataArray[key]['content_type'].slice(-4),
          y: parseInt(dataArray[key]['num']),
          z: parseInt(dataArray[key]['size']),
          name: dataArray[key]['content_type']});

  }

var chart = new CanvasJS.Chart("httpchartContainer", {
	animationEnabled: true,
	title:{
		text: "Download Inf. vs Different Contents"
	},
	axisX: {
		title:"Content Type",
    labelAngle: 270,
	},
	axisY: {
		title:"Size/Count",
		includeZero: true
	},

	data: [{
		type: "bubble",
		showInLegend: false,
		legendMarkerType: "circle",
		legendMarkerColor: "grey",
		toolTipContent: "<b>{name}</b><br/> Downloaded: {y} times <br/> Size: {z}KB",
		dataPoints: httpDataPoints
	}]
});

chart.render();

}

<?php

echo "var javascript_array_http = ". json_encode($httpstat) . ";\n";
echo "showhttpchart(javascript_array_http);";
?>

</script>
