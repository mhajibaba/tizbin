<?php

require_once 'core/login.php';

//include_once 'admin_login.php';

include_once __DIR__ . '/core/db/tb_stage.php';

$gid = 0;

if(!empty($_GET['action'])) {


		if($_GET['action'] == 'del') {
				if (!empty($_GET['id'])) {
						$ret = TableStage::delete($_GET['id']);
						if($ret !== true) {
							$icon = 'error';
							$msg = $ret;
						}else {
							$sol_dir = '/opt/tizbin/pol_1/sol_'.$_GET['id'];
        			$sol_rm = '/opt/tizbin/pol_1/sol_rm';
        			system('mv '.$sol_dir.'  '.$sol_rm);
        			do {
            		sleep(1);
        			} while(file_exists($sol_rm));
						}
				}
		}
}

if(!empty($_POST['action'])) {

	if($_POST['action'] == 'add') {

				$ret = TableStage::add($_POST['name']);
				if(is_numeric($ret)) {
					system('cd /opt/tizbin; /opt/tizbin/script/session_mng.py -s -d 1 ' . $ret);
				}else {
					$icon = 'error';
					$msg = $ret;
				}
	}
}

$stages = TableStage::list_stages();

if (isset($_GET['err'])) {
    $icon = 'error';
    $msg = $_GET['err'];
}

if (isset($_GET['success'])) {
    $icon = 'success';
    $msg = 'The operation completed successfully!';
}

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

	<div id="container-floating">

	      <div type="button" class="floating-button"
				data-toggle="modal" data-target="#addStage"  data-placement="left">

	      <i class="icon-plus icon floatting-plus" role="button" ></i>
				</button>
	    </div>

	</div>

	<section class="about_area section_gap">
	<div class="container">
		<?php

$counter = 0;

foreach ($stages as $stage) {

	if ($counter % 3 == 0) {
			echo '<div class="card-deck mt-3 mb-3">';
	}
	?>
	<div class="card col-md-4" data-aos="flip-left" data-aos-delay="150">
			<img src="images/network_<?php echo $counter%4;?>"
				class="card-img-top" alt="<?php echo $stage['name'];?>" height="250px">
			<div class="card-body">
				<h5 class="card-title"><?php echo $stage['name']; /* echo substr($pdfName, strrpos($pdfName,'p')+1); */?></h5>
				<p class="card-text"><?php echo 'Stage ID: '.$stage['id']; ?></p>
				<div class="row mt-3">
				<a href="dashboard.php?action=list&sid=<?php echo $stage["id"] ?>"
					class="btn btn-primary col-md-6 mr-3 my-1" >Click Here to Start</a>
				<a href='#' onclick='<?php echo "AskToDelete(\"".$stage["id"] . "\",\"" . $stage["name"] ."\"); return false;" ?>'
						class="btn btn-danger col-md-4 my-1" target="_blank">Delete</a>
				</div>
			</div>
		</div>
	<?php

	if ($counter % 3 == 2 || $counter == count($stages) - 1) {
			echo '</div>';
	}


	$counter ++;
}
?>


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



	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap-4.5.2.min.js"></script>
	<script src="js/aos.js"></script>

	<!--sweet alert Js-->
	<script src="js/sweetalert2.js"></script>

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
            echo "window.history.pushState({}, 'Stages', 'stages.php');";
        ?>


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
