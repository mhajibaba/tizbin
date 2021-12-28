<?php
if (! isset($_SESSION))
    session_start();

$login = false;
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $login = true;
}

$curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
$host = $_SERVER['HTTP_HOST'];
$hostSubDir = "ui/";

$url = "http://" . $host . "/" . $hostSubDir;

?>

<div class="site-wrap">

	<div class="site-mobile-menu">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close mt-3">
				<span class="icon-close2 js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<header class="site-navbar <?php echo $nav_type;?>" role="banner">

		<div class="container">
			<div class="row align-items-center">

				<div class="col-11 col-xl-4">
					<h3 class="mb-0 site-logo">
						<a href="tizbin.org" class="text-white mb-0">Tiz<span
							class="text-warning">Bin</span></a><span
							style="font-size: 50%"><span class="text-white"> tizbin.org</span></span>
					</h3>
				</div>
				<div class="col-12 col-md-8 d-none d-xl-block">
					<nav class="site-navigation position-relative text-right"
						role="navigation">

						<ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
							<li <?php if($curPageName=="index.php" || $curPageName=="") echo 'class="active"';?>><a
								href="<?php echo $url?>"><span>Home</span></a></li>
							<?php
              if ($_SESSION["userrole"] == 'FULL') {
              ?>
                <li class="<?php if ($curPageName == "users.php") echo 'active'; ?>">
                               <a href="users.php"><span>Users</span></a></li>
                <li class="<?php if ($curPageName == "groups.php") echo 'active'; ?>">
                                <a href="groups.php"><span>Groups</span></a></li>
              <?php
              }
              ?>
              <li class="<?php if ($curPageName == "stages.php") echo 'active'; ?>">
                             <a href="stages.php"><span>Stages</span></a></li>
							<li <?php if($curPageName=="signin.php") echo 'class="active"';?>>
								<a
								href="<?php echo $url?>sign<?php if($login) echo 'out.php'; else echo 'in.php';?>"><span>Sign <?php if($login) echo 'out'; else echo 'in';?></span></a>
							</li>

							<li class="<?php if ($curPageName == "about.php") echo 'active'; ?>">
                             <a href="about.php"><span>About</span></a>
							</li>
						</ul>
					</nav>
				</div>


				<div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3"
					style="position: relative; top: 3px;">
					<a href="#" class="site-menu-toggle js-menu-toggle text-white"><span
						class="icon-menu h3"></span></a>
				</div>

			</div>

		</div>
	</header>
</div>
