<?php
include_once __DIR__ . '/core/db/tb_emails.php';
$emailstat = TableEmail::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">

    <div class="card-body">
      <div id="emailChartContainer" style="height: 200px; width: 300px;"></div>
      <div class="row mt-3">
      <a href="list_email.php"
        class="btn btn-primary col-md-6 mr-3 my-1">Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>E-mail Protocols such as SMTP, POP, and IMAP are set of rules that help the client to properly transmit the information to or from the mail server.</small></p>
    </div>
  </div>

<script>
function showemailchart(dataArray) {

  var emailDataPoints = [];
  var min = 0;
  var max = 1000000;

  for (var key in dataArray) {
    emailDataPoints.push({  x: new Date(dataArray[key]['dt']) , y: parseInt(dataArray[key]['cnt']) });
  }

  var chart = new CanvasJS.Chart("emailChartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Email Traffic"
	},
	data: [{
		type: "scatter",
    indexLabelFontSize: 10,
		dataPoints:  emailDataPoints
	}]
});
chart.render();

}

<?php
$js_array = json_encode($emailstat);
echo "var javascript_array = ". $js_array . ";\n";
echo "showemailchart(javascript_array);";
?>

</script>
