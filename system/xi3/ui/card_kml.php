<?php
include_once __DIR__ . '/core/db/tb_msn.php';
$msnstat = TableMSN::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">
<!--  <div class="card-header bg-success"><p class="font-weight-bold">
    Address Resolution Protocol</p>
  </div> -->
    <div class="card-body">
      <h6 class="card-title text-center"><strong>Geographical Maps</strong></h6>
      <div id="map-container-google-1" class="z-depth-1-half map-container" style="height: 150px">
        <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
          style="border:0" allowfullscreen></iframe>
      </div>
      <div class="row mt-3">
      <a href="list_kml.php" target="_blank"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>Keyhole Markup Language is an XML notation for expressing geographic annotation and visualization within two-dimensional maps and three-dimensional Earth browsers.</small></p>
    </div>
  </div>
