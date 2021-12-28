<?php

require_once 'core/login.php';

include_once __DIR__ . '/core/db/tb_stage.php';
session_start();

if (!empty($_GET['action'])) {
    if ($_GET['action'] == 'list') {
        if (!empty($_GET['sid'])) {
            $_SESSION['sid']=$_GET['sid'];
        }
    }

    if ($_GET['action'] == 'del') {
        if (!empty($_GET['id'])) {
            $ret = TableStage::delete($_GET['id']);
            if ($ret !== true) {
                $icon = 'error';
                $msg = $ret;
            } else {
                $sol_dir = '/opt/tizbin/pol_1/sol_'.$_GET['id'];
                $sol_rm = '/opt/tizbin/pol_1/sol_rm';
                system('mv '.$sol_dir.'  '.$sol_rm);
                do {
                    sleep(1);
                } while (file_exists($sol_rm));
            }
        }
    }

    if ($_GET['action'] == 'change') {
        if (!empty($_GET['id'])) {
            $ret = TableUser::changePassword($_GET['id'], $_GET['p0'], $_GET['p1']);

            if ($ret !== true) {
                $icon = 'error';
                $msg = $ret;
            }
        }
    }
}

//-------------- Set Stage ID -------------------//
$sid = 0;
if (isset($_SESSION['sid']) && $_SESSION['sid'] > 0) {
    $sid = $_SESSION['sid'];
}

if (!empty($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $file = $_FILES['pcap'];
        if (is_uploaded_file($file['tmp_name'])) {
            if (preg_match("/[^A-Za-z0-9.-_]/", $file['name'])) {
                $icon = 'error';
                $msg = 'Filename must be contain only a-zA-Z0-9 or dot and underline. Do NOT use quotes and other characters';
            } elseif (filesize($file['tmp_name']) > 10 * 1024 * 1024) {
                $icon = 'error';
                $msg = 'File Size limit exceeded. Maximum 10MB';
            } else {
                if ($sid > 0) {
                    $filedec = '/opt/tizbin/pol_1/sol_'.$sid.'/new/'.$file['name'];
                    move_uploaded_file($file['tmp_name'], $filedec);
                }
            }
        } else {
            $icon = 'error';
            $msg = 'file is not uploaded';
        }
    }
}

//---------------------------------------------------//


?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8" />
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no" />

<title>Stages</title>
<link rel="stylesheet" href="css/aos.css">
<link rel="stylesheet" href="css/bootstrap4.min.css" />
<link rel="stylesheet" href="fonts/googleapis.css">
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/font-awesome.min.css">
<!-- main css -->
<link rel="stylesheet" href="css/style2.css" />
<style>
body {
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
}


</style>
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
<!-- Optional JavaScript -->

<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap-4.5.2.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/canvasjs.min.js"></script>

<!--sweet alert Js-->
<script src="js/sweetalert2.js"></script>

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

	<!--================ Start Upload Area =================-->
	<section class="about_area pt-5">
		<div class="container">
			<!-- Search form -->
			<form method="post" action="dashboard.php" enctype="multipart/form-data">
				<input type="hidden" name="action" value="add">
				<div class="alert alert-warning w-50 text-center mx-auto"
					role="alert">Please add/select a file for analyse. <a href="list_files.php" target="_blank" class="small"> Show files </a>
				</div>
				<div class="row justify-content-center text-center mt-3">
					<div class="col-md-8">
						<div class="input-group mb-3">
							<input type="hidden" name="id" value="1">
							<div class="custom-file" id="customFile" lang="es">
				        <input type="file" class="custom-file-input" name="pcap" id="exampleInputFile" aria-describedby="fileHelp">
				        <label class="custom-file-label" for="exampleInputFile">
				           Select file...
				        </label>
							</div>
						</div>
					</div>
				</div>
				<div class="row" >
					<button class="btn btn-primary col-md-2 py-2" type="submit">Upload</button>
				</div>
			</form>
			<!-- Search form -->
		</div>
	</section>
	<!--================ End Upload Area =================-->

	<section class="about_area section_gap">
	<div class="container">

	<div class="card-deck mt-3 mb-3">

		<?php include 'card_arp.php' ?>

		<?php include 'card_dns.php' ?>

		<?php include 'card_icmpv6.php' ?>

	</div>

	<div class="card-deck mt-3 mb-3">

		<?php include 'card_emails.php' ?>

    <?php include 'card_feed.php' ?>

    <?php include 'card_ftp.php' ?>


	</div>

  <div class="card-deck mt-3 mb-3">

		<?php include 'card_telnet.php' ?>

    <?php include 'card_tftp.php' ?>

    <?php include 'card_http.php' ?>

	</div>

  <div class="card-deck mt-3 mb-3">

		<?php include 'card_web.php' ?>

	  <?php include 'card_nntp.php' ?>

  	<?php include 'card_kml.php' ?>

	</div>

  <div class="card-deck mt-3 mb-3">

    <?php include 'card_unkfiles.php' ?>

    <?php include 'card_unknows.php' ?>

    <?php include 'card_filecloud.php' ?>

  </div>

  <div class="card-deck mt-3 mb-3">

    <?php include 'card_msn.php' ?>

	  <?php include 'card_syslog.php' ?>

    <?php include 'card_sip.php' ?>

  </div>

		<!-- ---------- Modal Area ---------- -->

		<!-- The Modal -->
		<div class="modal" id="addStage">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add an Stage</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form method="post" action="stages.php" name="formu1">
							<input type="hidden" name="action" value="add">
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-th-large"></i>
									</span>
								</div>
								<input name="name" class="form-control" placeholder="Name"
									type="text" pattern="[a-z]{1}[a-z0-9_]{2,20}" required="required">
							</div>
							<!-- form-group end.// -->
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Add</button>
							</div>
							<!-- form-group// -->
							<!-- <p class="text-center">
							Have an account? <a href="">Log In</a>
						</p> -->
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					</div>

				</div>
			</div>
		</div>

		<!-- ------------ End Modal Area -------------- -->
	</div>
</section>

<?php $copyright = false; include 'footer.php';?>

<footer class="site-footer">
  <?php include 'footer_links.php';?>
</footer>

	<script type="text/javascript">
	AOS.init();
			<?php
            if (isset($msg)) {
                echo "
                    	    Swal.fire({
                    	        icon: '$icon',
                    	        text: '$msg'
                    	    });";
            }
            //echo "window.history.pushState({}, 'Stages', 'stages.php');";
        ?>

				$('.custom-file-input').on('change', function() {
				   let fileName = $(this).val().split('\\').pop();
				   $(this).next('.custom-file-label').addClass("selected").html(fileName);
				});

	    function AskToDelete(id,name) {
	    	return Swal.fire({
	    		  title: 'Are you sure you want to delete?',
	    		  text: "session : " + name,
	    		  icon: 'warning',
	    		  showCancelButton: true,
	    		  confirmButtonColor: '#d33',
	    		  cancelButtonColor: '#3085d6',
	    		  confirmButtonText: 'Yes, delete it!'
	    		}).then((result) => {
    			  if (result.isConfirmed) {
    				    window.location.replace("stages.php?action=del&id="+id);
    				}
    			});
	    }

	</script>
</body>
</html>
