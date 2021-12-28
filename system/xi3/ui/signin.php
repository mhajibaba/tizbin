<?php

// Starting session
if (! isset($_SESSION))
    session_start();

    $host = $_SERVER['HTTP_HOST'];
    $hostSubDir = "ui";
    $url = "http://".$host."/".$hostSubDir;

    // Check if the user is already logged in, if yes then redirect him to welcome page
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        header("location: $url/index.php");
        exit();
    }

    include_once 'core/db/tb_user.php';

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        unset($username_err);
        unset($password_err);

        unset($username);
        unset($password);

        // Check if username is empty
        if (empty(trim($_POST["username"]))) {
            $username_err = "Please enter username.";
        } else {
            $username = trim($_POST["username"]);
        }

        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Validate credentials
        if (empty($username_err) && empty($password_err)) {

            $row = TableUser::checkUser($username, $password);

            if (!is_null($row)) {

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["userid"] = $row['id'];
                $_SESSION["userrole"] = $row['user_type'];
                $_SESSION["username"] = $username;
                $_SESSION["logintime"] = time();

                TableUser::updateLoginInfo($row['id']);

                header("location: $url/index.php");

                exit();
            } else {
                // Display an error message if password is not valid
                $password_err = "The username or password you entered was not valid.";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Page</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="fonts/googleapis.css">
<link rel="stylesheet" href="fonts/icomoon/style.css">

<link rel="stylesheet" href="css/bootstrap4.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<link rel="stylesheet" href="css/aos.css">
<link rel="stylesheet" href="css/style2.css">
</head>
<body>

	<?php $nav_type="absolute";  include 'header_nav.php';?>

	<div class="site-section"
		style="background-image: url(images/robot_lawyer.jpg); background-repeat: no-repeat; background-size: 100%; background-position: left top;">
		<div class="container mt-5 pt-5">
			<div
				class="row align-items-center justify-content-center text-center">

					<div class="d-flex justify-content-center h-100">
						<div class="card" data-aos="zoom-in" data-aos-duration="750"
							data-aos-delay="150">
							<div class="card-header">
								<h3>Sign In</h3>
								<div class="d-flex justify-content-end social_icon">
									<span><i class="fab fa-facebook-square"></i></span> <span><i
										class="fab fa-google-plus-square"></i></span> <span><i
										class="fab fa-twitter-square"></i></span>
								</div>
							</div>
							<div class="card-body">
								<form
									action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
									method="post">
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-user"></i></span>
										</div>
										<input type="text" class="form-control" placeholder="username"
											required name="username">
									</div>
									<div class="input-group form-group">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="icon-key"></i></span>
										</div>
										<input type="password" class="form-control" required
											placeholder="password" name="password">

									</div>
									<!-- <div class="row align-items-center remember">
										<input type="checkbox">Remember Me
									</div> -->
									<div
										class="invalid-feedback <?php echo (!empty($username_err) || !empty($password_err)) ? 'd-block' : ''; ?>">
										Username and/or Password was invalid.</div>
									<div class="form-group">
										<input type="submit" value="Login"
											class="btn btn-pill btn-primary btn-md text-white">
									</div>
								</form>
							</div>
							<div class="card-footer">
								<div class="d-flex justify-content-center links small">
									Don't have an account?<a href="#">Sign Up</a>
								</div>
								<div class="d-flex justify-content-center small">
									<a href="#">Forgot your password?</a>
								</div>
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>

	<footer class="site-footer">
	<?php include 'footer_links.php';?>
	</footer>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/aos.js"></script>
	<script src="js/main.js"></script>

</body>
</html>
