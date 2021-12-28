<?php
include_once __DIR__ . '/core/db/tb_arp.php';
$arpstat = TableArp::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">
<!--  <div class="card-header bg-success"><p class="font-weight-bold">
    Address Resolution Protocol</p>
  </div> -->
    <div class="card-body">
      <div id="chartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_arp.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Address Resolution Protocol (ARP) is a procedure
        for mapping a dynamic IP address to a permanent physical machine address in
        a local area network.</small></p>
    </div>
  </div>

<script>
function showarpchart(v1,v2,v3) {

var chart = new CanvasJS.Chart("chartContainer", {
	exportEnabled: true,
	animationEnabled: true,
  title: {
    text: "Address Resolution Protocol"
  },
	axisY: {
		title: "number of",
		titleFontColor: "#4F81BC",
		lineColor: "#4F81BC",
		labelFontColor: "#4F81BC",
		tickColor: "#4F81BC",
		includeZero: true
	},
	toolTip: {
		shared: true
	},
	legend: {
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
    toolTipContent: "<b>{label}</b>: {y}",
		yValueFormatString: "#,##0.#",
		dataPoints: [
			{ label: "Different Ip",  y: v1 },
			{ label: "Different Mac", y: v2 },
			{ label: "Records", y: v3 }
		]
	}]
});
chart.render();

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	} else {
		e.dataSeries.visible = true;
	}
	e.chart.render();
}
}

<?php
echo "showarpchart(".$arpstat[0]['dip'].",".$arpstat[0]['dmac'].", ".$arpstat[0]['rows'].");";
?>

</script>
