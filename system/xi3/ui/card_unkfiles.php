<?php
include_once __DIR__ . '/core/db/tb_unkfiles.php';
$unkfstat = TableUnkFiles::get_stat($sid);
//var_dump($telnetstat);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="unkFilesChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_unkfiles.php" target="_blank"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Undecoded files; to view all the File informations visits,
        here you can see their file name, flow file, size, timings and file types.
        If it will show some Unknown file type it hence could be malicious.</small></p>
    </div>
  </div>

<script>
function showunkfileschart(dataArray) {

  var unkfDataPoints = [];
  var other=0;
  for (var key in dataArray) {
    if(key<5) {
  	   unkfDataPoints.push({ y: parseInt(dataArray[key]['cnt']), label: dataArray[key]['file_type'] });
     }
    else {
      other+= dataArray[key]['cnt'];
    }
  }


  var chart = new CanvasJS.Chart("unkFilesChartContainer", {
  	animationEnabled: true,
  	title:{
  		text: "Top 5 Undecoded files"
  	},
  	data: [{
  		type: "doughnut",
  		startAngle: 60,
  		//innerRadius: 60,
  		indexLabelFontSize: 17,
  		indexLabel: "{label} - #percent%",
  		toolTipContent: "<b>{label}:</b> {y} (#percent%)",
  		dataPoints: unkfDataPoints
  	}]
  });

chart.render();

}

<?php
echo "var javascript_array_unkf = ". json_encode($unkfstat) . ";\n";
echo "showunkfileschart(javascript_array_unkf);";
?>

</script>
