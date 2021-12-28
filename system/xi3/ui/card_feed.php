<?php
include_once __DIR__ . '/core/db/tb_feeds.php';
$feedstat = TableFeeds::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="FeedsChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_rss.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>An RSS (Really Simple Syndication) feed is an
        online file that contains details about every piece of content a site has published.</small></p>
    </div>
  </div>

<script>
function showfeedchart(dataArray) {

var feedDataPoints = [];
var other=0;
for (var key in dataArray) {
  if(key < 5) {
	   feedDataPoints.push({ y: parseInt(dataArray[key]['cnt']), label: dataArray[key]['name'] });
   }
  else {
    other+= parseInt(dataArray[key]['cnt']);
  }
}

//feedDataPoints.push({ y: other, label: 'others' });


var chart = new CanvasJS.Chart("FeedsChartContainer", {
	animationEnabled: true,
	exportEnabled: false,
	title:{
		text: "Top 5 RSS Feeds"
	},
	data: [{
		type: "funnel",
		reversed: true,
		showInLegend: false,
		legendText: "{label}",
		indexLabel: "{label}",
		toolTipContent: "<b>{label}</b>: {y} <b>({percentage}%)</b>",
		indexLabelFontColor: "black",
		dataPoints:  feedDataPoints
	}]
});
calculatePercentage();
chart.render();

function calculatePercentage() {
	var dataPoint = chart.options.data[0].dataPoints;
	var total = dataPoint[0].y;
	for(var i = 0; i < dataPoint.length; i++) {
		if(i == 0) {
			chart.options.data[0].dataPoints[i].percentage = 100;
		} else {
			chart.options.data[0].dataPoints[i].percentage = ((dataPoint[i].y / total) * 100).toFixed(2);
		}
	}
}

}

<?php
$js_array = json_encode($feedstat);
echo "var javascript_array = ". $js_array . ";\n";
echo "showfeedchart(javascript_array);";
?>

</script>
