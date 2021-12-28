<?php
include_once __DIR__ . '/core/db/tb_msn.php';
$msnstat = TableMSN::get_stat($sid);
?>

<div class="card" data-aos="flip-left" data-aos-delay="150">
<!--  <div class="card-header bg-success"><p class="font-weight-bold">
    Address Resolution Protocol</p>
  </div> -->
    <div class="card-body">
      <h6 class="card-title text-center"><strong>MSN Chats</strong></h6>
      <div class="row">
        <div class="d-flex quick-info-2 mr-3">
    			<span class="icon icon-timer m-1"></span>
          <span>&nbsp;
    				<strong><?php echo $msnstat[0]['total_duration']; ?></strong>&nbsp;seconds
          </span>
        </div>
        <div class="d-flex quick-info-2">
    			<span class="icon icon-users m-1"></span>
          <span>&nbsp;
    				<strong><?php echo $msnstat[0]['count']; ?></strong>&nbsp;times
          </span>
        </div>
      </div>
      <div class="row mt-3">
      <a href="list_msn.php" 
        class="btn btn-primary col-md-6 mr-3 my-1" >Details</a>
      </div>
    </div>
    <div class="card-footer">
      <p class="card-text"><small>The MSN Messenger protocol consists of a series of commands sent between the client and the server.
        Commands are represented with a three letter, all-caps, command code.</small></p>
    </div>
  </div>
