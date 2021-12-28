<?php
include_once __DIR__ . '/core/db/tb_sip.php';
$sipstat = TableSIP::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">
<!--  <div class="card-header bg-success"><p class="font-weight-bold">
    Address Resolution Protocol</p>
  </div> -->
    <div class="card-body">
      <h6 class="card-title text-center"><strong>SIP sessions</strong></h6>
      <div class="row">
        <div class="d-flex quick-info-2 mr-3">
    			<span class="icon icon-timer m-1"></span>
          <span>&nbsp;
    				<strong><?php echo $sipstat[0]['total_duration']; ?></strong>&nbsp;seconds
          </span>
        </div>
        <div class="d-flex quick-info-2">
    			<span class="icon icon-people_outline m-1"></span>
          <span>&nbsp;
    				<strong><?php echo $sipstat[0]['count']; ?></strong>&nbsp;connections
          </span>
        </div>
      </div>
      <div class="row mt-3">
      <a href="list_sip.php"
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The Session Initiation Protocol (SIP) is a signaling protocol used for initiating, maintaining, and terminating real-time sessions that include voice, video and messaging applications.</small></p>
    </div>
  </div>
