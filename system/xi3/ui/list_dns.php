<?php
require_once 'core/login.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<title>DNS List</title>

<link rel="stylesheet" href="css/aos.css">
<link rel="stylesheet" href="css/bootstrap4.min.css" />
<link rel="stylesheet" href="css/dataTables.bootstrap4.min.css" />
<link rel="stylesheet" href="css/responsive.bootstrap4.min.css" />
<link rel="stylesheet" href="fonts/googleapis.css">
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- main css -->
<link rel="stylesheet" href="css/style3.css" />


<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/responsive.bootstrap4.min.js"></script>
<script src="js/canvasjs.min.js"></script>

<!--sweet alert Js-->
<script src="js/sweetalert2.js"></script>

<?php
//-------------- Set Stage ID -------------------//
session_start();
$sid = 0;
if (isset($_SESSION['sid']) && $_SESSION['sid'] > 0) {
    $sid = $_SESSION['sid'];
}

include_once __DIR__ . '/core/db/tb_dns.php';
$list = TableDNS::list($sid);
?>
</head>
<body>

  <!--================ Start Header Menu Area =================-->
  <?php $nav_type="absolute";  include 'header_nav.php';?>

  <div class="site-section bg-image overlay"
    style="height: 15vmin; background-image: url(images/banner.jpg); " >
    <div class="container mt-5 pt-5">
      <div
        class="row align-items-center justify-content-center text-center">
        <div class="col-md-10">
          <div class="row justify-content-center mb-4">
            <div class="col-md-12 text-center">

              <h1 data-aos="fade-up" class="mb-5"
                style="font-size: calc(1.525rem + 3.0vw);">
                <span class="typed-words small text-white"></span>
              </h1>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!--================ End Header Menu Area =================-->
  <!--================Home Banner Area =================-->
  <section class="banner_area_little">
    <div class="banner_inner d-flex align-items-center">
      <div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <div class="banner_content text-center"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--================End Home Banner Area =================-->

<div class="container mt-5">
	<h2 class="mb-4 text-center">DNS Messages</h2>
  <table id="listtelnet" class="table table-striped table-bordered  nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Capture Date</th>
                <th>HostName</th>
                <th>Cname</th>
								<th>IP</th>
                <th>Flow file</th>
            </tr>
        </thead>
        <tbody>
              <?php foreach ($list as $row) {
                  echo "<tr>";
                  echo "<td class='font-weight-bold' style='color:#fd7e14'>".$row['capture_date']."</td>";
                  echo "<td><strong>".$row['hostname']."</strong></td>";
                  echo "<td><strong>".$row['cname']."</strong></td>";
									echo "<td><strong>".$row['ip']."</strong></td>";
                  echo "<td><a target=\"_blank\" href=flow.php?file=".$row['flow_info'].">".basename($row['flow_info'])."</a></td>";
                  echo "</tr>";
              }
              ?>
        </tbody>
    </table>
</div>

<?php $copyright = false; include 'footer.php';?>

<footer class="site-footer">
  <?php include 'footer_links.php';?>
</footer>

<script type="text/javascript">
$(document).ready(function() {
    $('#listtelnet').DataTable({
			 "scrollX": true
    });
} );
</script>
</body>
</html>
