<?php

Header("Cache-Control: max-age=3600, must-revalidate");
require_once 'core/browser.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>TizBin - Network Forensic Analysis</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="fonts/googleapis.css">
<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/bootstrap4.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">

<link rel="stylesheet" href="css/owl.carousel.min.css" media="none" onload="if(media!=='all')media='all'" >
<link rel="stylesheet" href="css/owl.theme.default.min.css" media="none" onload="if(media!=='all')media='all'" >

<link rel="stylesheet" href="css/aos.css">

<link rel="stylesheet" href="css/style2.css">

</head>
<body>

	<?php $nav_type="absolute";  include 'header_nav.php';?>

	<div class="site-section bg-image "
		style="background-image:  url(images/bg.png); background-size: 100%; background-position: top center;" >
		<div class="container mt-5 pt-3">
			<div
				class="row align-items-center justify-content-center text-center">
				<div class="col-md-10">
					<div class="row justify-content-center mb-1 mb-md-3 mt-3 mt-md-0">
						<div class="col-md-12 text-center">
							<h2 class="mb-3 mt-5 pt-3 pt-md-0 text-warning"
								style="font-size: calc(1.2rem + 1.5vw);">Network Forensic Analyser</h2>
							<h3 data-aos="fade-up" style="Display: none; font-size: calc(0.5rem + 1.2vw);">Prepare
								a settlement letter on your own!</h3>
							<h3 data-aos="fade-up" class="mb-5"
								style="font-size: calc(.85rem + 1.2vw);">
								<br /> <span class="typed-words"></span>
							</h3>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="block-services-1 py-md-5">
		<div class="container">
			<div class="row">
				<div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
					<h3 class="mb-3">What We Offer</h3>
					<p>Analyzing network traffic is very important to understand what is happening over the wire.
						Companies have a number of detection and automation tools at their disposal, but when analysts need to get involved,
						having acess to the raw packet captures saves analysts valuable time and helps them accomplish the goal of network security operations: protecting the business.
						Our tool can take pre-recorded pcap files and provide a broad, high-level overview of the traffic saved in the capture.
						We also offer multiple applications, including those for network statistics collection, security monitoring, and network debugging.
					</p>
					<p>
						<a href="#"
							class="d-inline-flex align-items-center block-service-1-more"><span>See
								all services</span> <span class="icon-keyboard_arrow_right icon"></span></a>
					</p>
				</div>
				<div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
					<div class="block-service-1-card">
						<a href="hints" class="thumbnail-link d-block mb-4"><img
							src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
							data-src="images/ps.jpg" alt="claim" class="img-fluid"></a>
						<h3 class="block-service-1-heading mb-3">
							<a href="hints">Packet Capture</a>
						</h3>
						<div class="block-service-1-excerpt">
							<p>One of the most powerful tools a network administrator can use is a packet capture program. This can help shed light on the exact bit-for-bit composition of traffic.
								Performing packet capture is both processor and memory intensive, so for simple experimentation and demonstration almost any modern platform will due.</p>
						</div>
						<p>
							<a href="hints"
								class="d-inline-flex align-items-center block-service-1-more"><span>Find
									out more</span> <span class="icon-keyboard_arrow_right icon"></span></a>
						</p>
					</div>
				</div>
				<div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
					<div class="block-service-1-card">
						<a href="doctors" class="thumbnail-link d-block mb-4"><img
							src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
							data-src="images/ids.jpg" alt="doctor" class="img-fluid"></a>
						<h3 class="block-service-1-heading mb-3">
							<a href="doctors"> Intrusion Detection System</a>
						</h3>
						<div class="block-service-1-excerpt">
							<p>An intrusion detection system (IDS) is a device or software application that monitors a network for malicious activity or policy violations. Any malicious activity or violation is typically reported or collected centrally using a security information and event management system.</p>
						</div>
						<p>
							<a href="doctors"
								class="d-inline-flex align-items-center block-service-1-more"><span>Find
									out more</span> <span class="icon-keyboard_arrow_right icon"></span></a>
						</p>
					</div>
				</div>
				<div class="mb-4 mb-lg-0 col-sm-6 col-md-6 col-lg-3">
					<div class="block-service-1-card">
						<a href="#" class="thumbnail-link d-block mb-4"><img
							src="data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs="
							data-src="images/lawyer.jpg" alt="lawyer" class="img-fluid"></a>
						<h3 class="block-service-1-heading mb-3">
							<a href="#">Need a SOC team?</a>
						</h3>
						<div class="block-service-1-excerpt">
							<p>Sometimes it's not enough to analyse your network.
								The SOC team’s goal is to detect, analyze, and respond to cybersecurity incidents using a combination of technology solutions and a strong set of processes. Security operations centers are typically staffed with security analysts and engineers as well as managers who oversee security operations.</p>
						</div>
						<p>
							<a href="#"
								class="d-inline-flex align-items-center block-service-1-more"><span>Find
									out more</span> <span class="icon-keyboard_arrow_right icon"></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="site-section pt-1">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12 text-center">
					<h2 class="site-section-heading text-center font-secondary">What
						you need to do</h2>
				</div>
			</div>
			<div class="row">

				<div class="col-12">

					<div class="owl-carousel-2 owl-carousel">

						<div class="d-block block-testimony mx-auto text-center">
							<div class="person w-25 mx-auto mb-4"></div>
							<div>
								<h2 class="h5 mb-4">Detect an anomaly</h2>
								<blockquote>By the shore of Gitchie Gumee, By the shining Big-Sea-Water, At the doorway of his wigwam,
									In the pleasant Summer morning, Hiawatha stood and waited ….</blockquote>
							</div>
						</div>

						<div class="d-block block-testimony mx-auto text-center">
							<div class="person w-25 mx-auto mb-4"></div>
							<div>
								<h2 class="h5 mb-4">Make your claim</h2>
								<blockquote>After the Sea-Ship—after the whistling winds; After the white-gray sails, taut to their spars and ropes,
									Below, a myriad, myriad waves, hastening, ….</blockquote>
							</div>
						</div>

						<div class="d-block block-testimony mx-auto text-center">
							<div class="person w-25 mx-auto mb-4"></div>
							<div>
								<h2 class="h5 mb-4">Collect Evidence</h2>
								<blockquote>what can ail thee, knight-at-arms, Alone and palely loitering?
									The sedge has wither’d from the lake, And no birds sing … .</blockquote>
							</div>
						</div>

						<div class="d-block block-testimony mx-auto text-center">
							<div class="person w-25 mx-auto mb-4"></div>
							<div>
								<h2 class="h5 mb-4">Visit your manager</h2>
								<blockquote>And this is why I sojourn here, Alone and palely loitering,
									Though the sedge is wither’d from the lake, And no birds sing..</blockquote>
							</div>
						</div>

					</div>
				</div>


			</div>
		</div>
	</div>

	<?php $copyright = false; include 'footer.php';?>

	<footer class="site-footer">
		<?php include 'footer_links.php';?>
	</footer>

	<!-- Placing scripts at the bottom of the <body> element improves the display speed, because script interpretation slows down the display. -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/typed.js"></script>
	<script src="js/main.js"></script>

	<script>
		var typed = new Typed('.typed-words',
				{
					strings : [ "Network Data Probing", "Network Packets Analyser"],
					typeSpeed : 70,
					backSpeed : 30,
					backDelay : 4000,
					startDelay : 1000,
					loop : true,
					showCursor : true
				});
	</script>
</body>
</html>
