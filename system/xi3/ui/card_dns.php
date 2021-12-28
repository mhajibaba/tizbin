<?php
include_once __DIR__ . '/core/db/tb_dns.php';
$dnsstat = TableDNS::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="DNSchartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_dns.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The process of DNS resolution involves converting
        a hostname such as www.example.com, into a computer-friendly IP address such as 192.168.1.1</small></p>
    </div>
  </div>

<script>
function showdnschart(dataArray) {

var dnsDataPoints = [];
var dnsdata=0;
var other=0;
for (var key in dataArray) {

  if(key<5) {
     dnsdata += dataArray[key]['cnt'];
	   dnsDataPoints.push({ y: dataArray[key]['cnt'], label: dataArray[key]['site'] });
   }
  else {
    other+= dataArray[key]['cnt'];
  }
}

//dnsDataPoints.push({ y: other, label: 'others' });


  var chart = new CanvasJS.Chart("DNSchartContainer", {
  	animationEnabled: true,
  	title: {
  		text: "Top 5 Domain Name System"
  	},
  	data: [{
  		type: "pie",
  		startAngle: 240,
  		yValueFormatString: "##0",
  		indexLabel: "{label}",
  		dataPoints: dnsDataPoints
  	}]
  });
  chart.render();

}

<?php
$js_array = json_encode($dnsstat);
echo "var javascript_array = ". $js_array . ";\n";
echo "showdnschart(javascript_array);";
?>

</script>
