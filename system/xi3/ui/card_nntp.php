<?php
include_once __DIR__ . '/core/db/tb_nntp.php';
$nntpstat = TableNNTP::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="NNTPchartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_nntp.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The Network News Transfer Protocol (NNTP) is an application protocol used for
        transporting Usenet news articles (netnews) between news servers and for reading and posting articles
        by end user client applications. </small></p>
    </div>
  </div>

<script>
function shownntpchart(dataArray) {

var nntpDataPoints = [];
var nntpdata=0;
var other=0;
for (var key in dataArray) {
    var innerArray = [];
	   innerArray.push({ y: parseInt(dataArray[key]['cnt']), label: ' ' });
     nntpDataPoints.push({
   		type: "stackedBar100",
      toolTipContent: "<b>{name}:</b> {y} (#percent%)",
   		name: dataArray[key]['nn'],
   		dataPoints: innerArray
   		});

}

var chart = new CanvasJS.Chart("NNTPchartContainer", {
	animationEnabled: true,
	theme: "light2", //"light1", "dark1", "dark2"
	title:{
		text: "Division of NNTPs"
	},
	axisY:{
		interval: 20,
		suffix: "%"
	},
	toolTip:{
		shared: true
	},
	data:nntpDataPoints
});
chart.render();

}

<?php
echo "var javascript_array_nntp = ". json_encode($nntpstat) . ";\n";
echo "shownntpchart(javascript_array_nntp);";
?>

</script>
