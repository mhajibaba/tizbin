<?php
include_once __DIR__ . '/core/db/tb_web.php';
$webgetstat = TableWEB::get_stat_webget($sid);
$webpoststat = TableWEB::get_stat_webpost($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="webChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_web.php"
        class="btn btn-primary col-md-6 mr-3 my-1" target="_blank">Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>A Uniform Resource Locator (URL), colloquially termed a web address,
        is a reference to a web resource that specifies its location on a computer network and a mechanism for retrieving it. </small></p>
    </div>
  </div>

<script>
function showwebchart(dataArray,dataArray2) {
  var getDataPoints = [];
  var postDataPoints = [];

  var i = 0;
  var lastYear = 0;
  for (var key in dataArray) {
      //alert(dataArray[key]['dt']);
      var res = dataArray[key]['dt'].split("-");
      //alert(res[0]);
      if(lastYear == 0) {
        lastYear = res[0];
      }

      if(lastYear - res[0] > 1) {

      }else {
	       getDataPoints.push({ x: new Date(res[0],res[1]), y: parseInt(dataArray[key]['cnt']) });
         postDataPoints.push({ x: new Date(res[0],res[1]), y: 0});
       }
  }

  i = 0;
  lastYear = 0;
  for (var key in dataArray2) {
    //alert(new Date(dataArray2[key]['dt']) + "  "+ parseInt(dataArray2[key]['cnt']));
      var res = dataArray2[key]['dt'].split("-");
      //alert(res[0]);
      if(lastYear == 0) {
        lastYear = res[0];
      }

      if(lastYear - res[0] > 1) {
      }else {
        postDataPoints.push({ x: new Date(res[0],res[1]), y: parseInt(dataArray2[key]['cnt'])});
      }
  }

  console.table(getDataPoints);
  console.table(postDataPoints);

  var chart = new CanvasJS.Chart("webChartContainer", {
  	title:{
  		text: "GET vs POST"
  	},
  	theme: "light2", // "light1", "light2", "dark1", "dark2"
  	animationEnabled: true,
  	axisX: {
  		interval: 1,
  		intervalType: "month"
  	},
  	toolTip: {
  		shared: true
  	},
  	data: [
  	{
  		type: "stackedArea100",
  		name: "POST",
  		xValueFormatString: "MMM, YYYY",
  		showInLegend: "true",
  		dataPoints: postDataPoints
  	},
  	{
  		type: "stackedArea100",
  		name: "GET",
  		showInLegend: "true",
  		dataPoints: getDataPoints
  	}
  	]
  });
  chart.render();

}

<?php
echo "var javascript_array_webGet = ". json_encode($webgetstat) . ";\n";
echo "var javascript_array_webPost = ". json_encode($webpoststat) . ";\n";

echo "showwebchart(javascript_array_webGet,javascript_array_webPost);";
?>

</script>
