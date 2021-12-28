<?php

require_once 'login.php';

$error = "";

if ($_POST) {
    
    include_once '../db/tb_user.php';
    
    if (isset($_POST['Submit1'])) {
        
        if($_POST['pass1'] != $_POST['pass2']) {
            
            $error = "Swal.fire({
                              title: 'Passwords doe\'s NOT match!',
                			  text: 'Please try again.',
                			  icon: 'error',
                			  confirmButtonText: 'OK'
                			});                    
                       ";
            
        }else {
            $b = TableUser::add($_POST['fname'],$_POST['lname'],$_POST['username'],$_POST['email'],$_POST['pass1'],2);
            if($b) {
                $error = "Swal.fire({
                              title: 'User registered successfully!',
                			  text: '',
                			  icon: 'info',
                			  confirmButtonText: 'OK'
                			});
                       ";
            }else {
                $error = "Swal.fire({
                              title: 'Cannot register user!',
                			  text: 'username must be unique.',
                			  icon: 'error',
                			  confirmButtonText: 'OK'
                			});
                       ";
            }
        }
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>Self Demand</title>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../../fonts/icomoon/style.css">
<link rel="stylesheet" href="../../css/bootstrap4.min.css">
</head>

<style>
.register {
	background: -webkit-linear-gradient(left, #5F9EA0, #00c6ff);
	margin-top: 3%;
	padding: 3%;
}

.register-left {
	text-align: center;
	color: #fff;
	margin-top: 4%;
}

.register-left input {
	border: none;
	border-radius: 1.5rem;
	padding: 2%;
	width: 60%;
	background: #f8f9fa;
	font-weight: bold;
	color: #383d41;
	margin-top: 30%;
	margin-bottom: 3%;
	cursor: pointer;
}

.register-right {
	background: #f8f9fa;
	border-top-left-radius: 10% 50%;
	border-bottom-left-radius: 10% 50%;
}

.register-left img {
	margin-top: 15%;
	margin-bottom: 5%;
	width: 25%;
	-webkit-animation: mover 2s infinite alternate;
	animation: mover 1s infinite alternate;
}

@
-webkit-keyframes mover { 0% {
	transform: translateY(0);
}

100%
{
transform
:
 
translateY
(-20px);
 
}
}
@
keyframes mover { 0% {
	transform: translateY(0);
}

100%
{
transform
:
 
translateY
(-20px);
 
}
}
.register-left p {
	font-weight: lighter;
	padding: 12%;
	margin-top: -9%;
}

.register .register-form {
	padding: 10%;
	margin-top: 10%;
}

.btnRegister {
	float: right;
	margin-top: 10%;
	border: none;
	border-radius: 1.5rem;
	padding: 2%;
	background: #87CEFA;
	color: #fff;
	font-weight: 600;
	width: 50%;
	cursor: pointer;
}

.register .nav-tabs {
	margin-top: 3%;
	border: none;
	background: #87CEFA;
	border-radius: 1.5rem;
	width: 28%;
	float: right;
}

.register .nav-tabs .nav-link {
	padding: 2%;
	height: 34px;
	font-weight: 600;
	color: #fff;
	border-top-right-radius: 1.5rem;
	border-bottom-right-radius: 1.5rem;
}

.register .nav-tabs .nav-link:hover {
	border: none;
}

.register .nav-tabs .nav-link.active {
	width: 100px;
	color: #000000;
	border: 2px solid #87CEFA;
	border-top-left-radius: 1.5rem;
	border-bottom-left-radius: 1.5rem;
}

.register-heading {
	text-align: center;
	margin-top: 8%;
	margin-bottom: -15%;
	color: #495057;
}
</style>

<div class="container register">
	<div class="row">
		
		<div class="col-md-3 register-left">
			<img src="https://image.ibb.co/n7oTvU/logo_white.png" alt="" />
			<h3><a href="../../">Selfdemand.com</a></h3>
			<input type="submit" name="" value="Panel" onclick="window.location='panel';" /><br />
		</div>
		
		<div class="col-md-9 register-right">
			<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
				<li class="nav-item"><a class="nav-link active" id="home-tab"
					data-toggle="tab" href="#home" role="tab" aria-controls="home"
					aria-selected="true">User</a></li>
				<li class="nav-item"><a class="nav-link" id="profile-tab"
					data-toggle="tab" href="#profile" role="tab"
					aria-controls="profile" aria-selected="false">Admin</a></li>
			</ul>
			<form action="users" method="POST">
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade show active" id="home" role="tabpanel"
					aria-labelledby="home-tab">
					<h3 class="register-heading">Set as a User</h3>
					<div class="row register-form">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control"
									name="fname" placeholder="First Name *" value="" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control"
									name="lname" placeholder="Last Name *" value="" />
							</div>
							<div class="form-group">
								<input type="password" class="form-control"
									name="pass1" placeholder="Password *" value="" />
							</div>
							<div class="form-group">
								<input type="password" class="form-control"
									name="pass2" placeholder="Confirm Password *" value="" />
							</div>
						</div>
						<div class="col-md-6">						
							<div class="form-group">
								<input type="text" maxlength="20"
									name="username" class="form-control"
									placeholder="Username *" value="" />
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email"
									name="email" value="" />
							</div>
							<div class="form-group">
								<input type="submit" class="btnRegister" value="Register" name="Submit1" />
							</div>
						</div>
					</div>
				</div>
				<div class="tab-pane fade show" id="profile" role="tabpanel"
					aria-labelledby="profile-tab">
					<h3 class="register-heading">Set as an Admin</h3>
					<div class="row register-form">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control"
									placeholder="First Name *" value="" />
							</div>
							<div class="form-group">
								<input type="text" class="form-control"
									placeholder="Last Name *" value="" />
							</div>
							<div class="form-group">
								<input type="text" maxlength="20"
									class="form-control" placeholder="Username *" value="" />
							</div>
							<div class="form-group">
								<input type="email" class="form-control" placeholder="Email"
									value="" />
							</div>
							

						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="password" class="form-control"
									placeholder="Password *" value="" />
							</div>
							<div class="form-group">
								<input type="password" class="form-control"
									placeholder="Confirm Password *" value="" />
							</div>
							<div class="form-group"></div>
							<input type="submit" class="btnRegister" value="Register" />
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="../../js/jquery-3.3.1.min.js"></script>
<script src="./../js/bootstrap.min.js"></script>

<script type="text/javascript">

    <?php
        if(!empty($error)) {
            echo $error;
        }
	?>
    
</script>
</body>
</html>