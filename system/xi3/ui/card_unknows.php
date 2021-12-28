<?php
include_once __DIR__ . '/core/db/tb_unknows.php';
$unknowstat = TableUnknows::get_stat($sid);
//var_dump($telnetstat);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="unknowsChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_unknowns.php" target="_blank"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Undecoded TCP-UDP; to view all the URLs visits, here you can see their port numbers, timings and which protocols were used.
        If it will show some Unknown protocols it hence could be malicious.</small></p>
    </div>
  </div>

<script>
function showunknownschart(dataArray) {

  var unknownDataPoints = [];
  var total=0;
  var count=0;
  for (var key in dataArray) {
    count++;
    if(key<10) {
  	   unknownDataPoints.push({ y: parseInt(dataArray[key]['cnt']), label: dataArray[key]['l7prot'] });
     }

      total+= parseInt(dataArray[key]['cnt']);

  }

  var ave = total / count;

var chart = new CanvasJS.Chart("unknowsChartContainer", {
animationEnabled: true,
title: {
  text: "Top 10 Undecoded protocols"
},
axisX: {
  interval: 1,
  reversed:  true
},
axisY: {
  title: "number of flows",
  includeZero: true,
  scaleBreaks: {
    type: "wavy",
    customBreaks: [{
      startValue: ave-10,
      endValue: ave+15
      }
  ]}
},
data: [{
  type: "bar",
  dataPoints: unknownDataPoints
}]
});

chart.render();

}

<?php
echo "var javascript_array_unknowns = ". json_encode($unknowstat) . ";\n";
echo "showunknownschart(javascript_array_unknowns);";
?>

</script>
