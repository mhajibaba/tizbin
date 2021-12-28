<?php
include_once __DIR__ . '/core/db/tb_ftp.php';
$ftpstat = TableFTP::get_stat($sid);
$ftpfilestat = TableFTP::get_stat_files($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="FTPChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_ftp.php"
        class="btn btn-primary col-md-6 mr-3 my-1" target="_blank">Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The File Transfer Protocol (FTP) is a standard network protocol used for the transfer of computer files from a server to a client on a computer network.</small></p>
    </div>
  </div>

<script>
function showftpchart(dataArray,dataArray2) {

var ftpConnectionUploadDataPoints = [];
var ftpConnectionDownloadDataPoints = [];
var ftpFilesUploadDataPoints = [];
var ftpFilesDownloadDataPoints = [];

for (var key in dataArray) {

  if(dataArray[key]['download_num']==0) {
	    ftpConnectionUploadDataPoints.push({ x: new Date(dataArray[key]['dt']), y: parseInt(dataArray[key]['cnt']) });
   }
  else {
      ftpConnectionDownloadDataPoints.push({ x: new Date(dataArray[key]['dt']), y: parseInt(dataArray[key]['cnt']) });
  }
}

for (var key in dataArray2) {

  if(dataArray2[key]['dowloaded']==0) {
	    ftpFilesUploadDataPoints.push({ x: new Date(dataArray2[key]['dt']), y: parseInt(dataArray2[key]['cnt']) });
   }
  else {
      ftpFilesDownloadDataPoints.push({ x: new Date(dataArray2[key]['dt']), y: parseInt(dataArray2[key]['cnt']) });
  }
}
//dnsDataPoints.push({ y: other, label: 'others' });

var chart = new CanvasJS.Chart("FTPChartContainer", {
	animationEnabled: true,
	title:{
		text: "FTP, Last 6 Month"
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
		type: "area",
		showInLegend: true,
		name: "Upload Files",
		yValueFormatString: "#,##0",
		xValueFormatString: "MMM YYYY",
		dataPoints: ftpFilesUploadDataPoints
 	},
	{
		type: "area",
		showInLegend: true,
		name: "Download Files",
		yValueFormatString: "#,##0",
		dataPoints: ftpFilesDownloadDataPoints
 	},
	{
		type: "area",
		showInLegend: true,
		name: "Upload Connections",
		yValueFormatString: "#,##0",
		dataPoints: ftpConnectionUploadDataPoints

 	},
	{
		type: "area",
		showInLegend: true,
		yValueFormatString: "#,##0",
		name: "Download Connections",
		dataPoints: ftpConnectionDownloadDataPoints
	}]
});
chart.render();

}

<?php
echo "var javascript_array_ftp = ". json_encode($ftpstat) . ";\n";
echo "var javascript_array2_ftp = ". json_encode($ftpfilestat) . ";\n";
echo "showftpchart(javascript_array_ftp,javascript_array2_ftp);";
?>

</script>
