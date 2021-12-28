<?php
include_once __DIR__ . '/core/db/tb_tftp.php';
$tftpstat = TableTFTP::get_stat($sid);
$tftpfilestat = TableTFTP::get_stat_files($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="TFTPChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_tftp.php"
        class="btn btn-primary col-md-6 mr-3 my-1">Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The TFTP protocol uses random UDP ports to transfer data between client and server. It makes TFTP transfer impossible when the traffic goes through a firewall.</small></p>
    </div>
  </div>

<script>
function showtftpchart(dataArray,dataArray2) {

var tftpConnectionUploadDataPoints = [];
var tftpConnectionDownloadDataPoints = [];
var tftpFilesUploadDataPoints = [];
var tftpFilesDownloadDataPoints = [];

for (var key in dataArray) {

  if(dataArray[key]['download_num']==0) {
	    tftpConnectionUploadDataPoints.push({ x: new Date(dataArray[key]['dt']), y: parseInt(dataArray[key]['cnt']) });
   }
  else {
      tftpConnectionDownloadDataPoints.push({ x: new Date(dataArray[key]['dt']), y: parseInt(dataArray[key]['cnt']) });
  }
}

for (var key in dataArray2) {

  if(dataArray2[key]['dowloaded']==0) {
	    tftpFilesUploadDataPoints.push({ x: new Date(dataArray2[key]['dt']), y: parseInt(dataArray2[key]['cnt']) });
   }
  else {
      tftpFilesDownloadDataPoints.push({ x: new Date(dataArray2[key]['dt']), y: parseInt(dataArray2[key]['cnt']) });
  }
}
//dnsDataPoints.push({ y: other, label: 'others' });

var chart = new CanvasJS.Chart("TFTPChartContainer", {
	animationEnabled: true,
	title:{
		text: "TFTP, Last 6 Month"
	},
	axisY :{
		includeZero: false
	},
	toolTip: {
		shared: true
	},
	legend: {
		fontSize: 13
	},
	data: [{
		type: "splineArea",
		showInLegend: true,
		name: "Upload Files",
		yValueFormatString: "#,##0",
		xValueFormatString: "MMM YYYY",
		dataPoints: tftpFilesUploadDataPoints
 	},
	{
		type: "splineArea",
		showInLegend: true,
		name: "Download Files",
		yValueFormatString: "#,##0",
		dataPoints: tftpFilesDownloadDataPoints
 	},
	{
		type: "splineArea",
		showInLegend: true,
		name: "Upload Connections",
		yValueFormatString: "#,##0",
		dataPoints: tftpConnectionUploadDataPoints

 	},
	{
		type: "splineArea",
		showInLegend: true,
		yValueFormatString: "#,##0",
		name: "Download Connections",
		dataPoints: tftpConnectionDownloadDataPoints
	}]
});
chart.render();

}

<?php
echo "var javascript_array_tftp = ". json_encode($tftpstat) . ";\n";
echo "var javascript_array2_tftp = ". json_encode($tftpfilestat) . ";\n";
echo "showtftpchart(javascript_array_tftp,javascript_array2_tftp);";
?>

</script>
