<?php
include_once __DIR__ . '/core/db/tb_syslog.php';
$syslogstat = TableSyslog::get_stat($sid);
//var_dump($telnetstat);
?>
<style>
#myDIV {
  width: 8px;
  height: 8px;
  background: red;
  position: relative;
  animation: mymove 5s infinite;
}

@keyframes mymove {
  from {left: -85px;}
  to {left: 85px;}
}
</style>

<div class="card" data-aos="flip-left" data-aos-delay="150">
    <div class="card-body">
      <h6 class="card-title text-center"><strong>Top Syslog Connection</strong></h6>
      <?php if (count($syslogstat)>0) {
    $hostpieces = explode("-", $syslogstat[0]['hosts']); ?>
        <div class="">
          <div class="d-flex justify-content-around">
            <div>
        			<span class="icon  icon-desktop_mac mt-1"></span>
            </div>
          <div id="myDIV" class="mt-2"></div>
            <div>
              <span class="icon icon-desktop_mac mt-1"></span>
            </div>
          </div>
          <div class="d-flex justify-content-between">
            <div>
              <span>
        				<?php echo $hostpieces[0]; ?>
              </span>
            </div>
            <div>
              <span>
        				<?php echo $hostpieces[1]; ?>
              </span>
            </div>
          </div>
        </div>
    <?php
} ?>
    <div class="row mt-3">
    <a href="list_syslog.php" 
      class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
    </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The syslog protocol provides a transport to allow
        a device to send event notification messages across IP networks to event message
        collectors, also known as syslog servers.</small></p>
    </div>
</div>
