<?php
require_once 'core/browser.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Self Demand</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="fonts/googleapis.css">
<link rel="stylesheet" href="fonts/icomoon/style.css">
<link rel="stylesheet" href="css/bootstrap4.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/style2.css">

</head>
<body>

	<?php $nav_type="absolute";  include 'header_nav.php';?>

	<div class="site-section bg-image overlay"
		style="height: 85vmin; background-image: url(images/banner.jpg); " >
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

	<div class="site-section bg-light">
		<div class="container" style="margin-top: -10vh;">
			<div class="row py-3">
				<div class="col-md-12 ml-auto">
					<h2 class="text-primary mb-3">Introduction</h2>
					<p class="lead">Network Forensic Analysis Tool (NFAT)!</p>
					<p class="mb-4">Security administrators need to actively monitor
					 their networks in order to be proactive in their security posture.  
						Network Forensic Analysis Tools (NFATs) help administrators monitor 
						their environment for anomalous traffic, perform forensic analysis and 
						get a clear picture of their environment. With this tool, traffic is categorized 
						into types based on content, destination server IP addresses, ports used, 
						and measurement of the total and relative volumes of traffic for each type. 
						This empowers you to identify excessive levels of non-business traffic 
						(such as social media and external web surfing) that may need to be filtered or 
						otherwise eliminated.</p>

					<ul class="ul-check list-unstyled success">
						<li>Low cost</li>
						<li>Fast and easy</li>
						<li>Network traffic analysis</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-5 ml-auto">
					

						<div class="p-4 mb-3 bg-white rounded-lg">
							<p class="mb-0 font-weight-bold">Address</p>
							<p class="mb-4">1585 62nd St., P.O. Box 8786 tehran, Tehran, Iran</p>

							<p class="mb-0 font-weight-bold">Phone</p>
							<p class="mb-4">
								<a href="tel:+98-912-768-7532">+98-912-768-7532</a>
							</p>

							<p class="mb-0 font-weight-bold">Email Address</p>
							<p class="mb-0">
								<a href="mailto:info@tizbin.org">info@tizbin.org</a>
							</p>

						</div>

						<div class="p-4 mb-3 bg-white rounded-lg">
							<h3 class="h5 text-black mb-3">More Info</h3>
							<p>Analysis of the individual traffic flows and 
								their content is essential to a complete understanding of network usage. 
								Our services help people to understand their network with more ease.</p>
							<p>
								<a href="https://www.tizbin.org"
									class="btn btn-primary px-4 py-2 text-white btn-pill btn-sm">Learn More</a>
							</p>
						</div>

					</div>
					<div class="col-md-6 ">
						<!-- <img src="images/hero_bg_1.jpg" alt="Image"
						class="img-fluid rounded mb-3">  -->
						<img src="images/robot_lawyer.webp" alt="robot lawyer"
							onerror="this.onerror=null; this.src='images/robot_lawyer.jpg'"
							class="img-fluid rounded">
					</div>
				</div>
			</div>
		</div>
	

	<?php $copyright = false; include 'footer.php';?>

	<footer class="site-footer">
		<?php include 'footer_links.php';?>
	</footer>

		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/typed.js"></script>

		<script>
		var typed = new Typed('.typed-words', {
			strings : [ "Check what happens on your network" ],
			typeSpeed : 80,
			backSpeed : 80,
			backDelay : 4000,
			startDelay : 1000,
			loop : true,
			showCursor : true
		});
	</script>

		<script src="js/main.js"></script>

</body>
</html>
