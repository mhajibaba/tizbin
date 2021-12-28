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

<title>Telnets</title>

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
<script src="https://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="/assets/gmap3.js?body=1" type="text/javascript"></script>
<?php
//-------------- Set Stage ID -------------------//
session_start();
$sid = 0;
if (isset($_SESSION['sid']) && $_SESSION['sid'] > 0) {
    $sid = $_SESSION['sid'];
}

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
	<div id="map" style="min-width: 600px; min-height: 460px"></div>
</div>

<?php $copyright = false; include 'footer.php';?>

<footer class="site-footer">
  <?php include 'footer_links.php';?>
</footer>

<script type="text/javascript">
var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 2,
    mapTypeId: google.maps.MapTypeId.TERRAIN,
    center: {
      lat: 41.876,
      lng: -87.624
    }
  });

}

initMap();

var kmlUrl = 'https://developers.google.com/maps/documentation/javascript/examples/kml/westcampus.kml';
var kmlOptions = {
  suppressInfoWindows: true,
  preserveViewport: false,
  map: map
};
var kmlLayer = new google.maps.KmlLayer(kmlUrl, kmlOptions);

</script>
</body>
</html>
