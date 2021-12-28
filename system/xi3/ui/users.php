<?php

require_once 'core/login.php';

if ($_SESSION["userrole"] != 'FULL') {
	header("location: $url/signin.php");
	exit();
}


include_once __DIR__ . '/core/db/tb_user.php';
include_once __DIR__ . '/core/db/tb_group.php';

$groups = TableGroup::list_groups();

$gid = 0;

if(!empty($_GET['action'])) {

		if($_GET['action'] == 'list') {
				if (!empty($_GET['gid'])) {
						$gid = $_GET['gid'];
				}
		}

		if($_GET['action'] == 'del') {
				if (!empty($_GET['id'])) {
						TableUser::delete($_GET['id']);
				}
		}

		if($_GET['action'] == 'change') {

				if (!empty($_GET['id'])) {

						$ret = TableUser::changePassword($_GET['id'],$_GET['p0'],$_GET['p1']);

						if($ret !== true) {
								$icon = 'error';
								$msg = $ret;
						}

				}
		}
}

if(!empty($_POST['action'])) {

	if($_POST['action'] == 'add') {

				$ret = TableUser::add($_POST['uname'],$_POST['pass'],$_POST['email'],$_POST['fname'],$_POST['lname'],$_POST['gid']);
				if($ret !== true) {
					$icon = 'error';
					$msg = $ret;
				}
	}
}

$users = TableUser::list_users($gid);

if ($users == null) {
    $users = array();
}


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

<title>User Management</title>
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

.table-responsive {
	margin: 30px 0;
}

.table-wrapper {
	min-width: 1000px;
	background: #fff;
	padding: 20px 25px;
	border-radius: 3px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
}

.table-title {
	padding-bottom: 15px;
	background: #299be4;
	color: #fff;
	padding: 16px 30px;
	margin: -20px -25px 10px;
	border-radius: 3px 3px 0 0;
}

.table-title h2 {
	margin: 5px 0 0;
	font-size: 24px;
}

.table-title .btn {
	color: #566787;
	float: right;
	font-size: 13px;
	background: #fff;
	border: none;
	min-width: 50px;
	border-radius: 2px;
	border: none;
	outline: none !important;
	margin-left: 10px;
}

.table-title .btn:hover, .table-title .btn:focus {
	color: #566787;
	background: #f2f2f2;
}

.table-title .btn i {
	float: left;
	font-size: 21px;
	margin-right: 5px;
}

.table-title .btn span {
	float: left;
	margin-top: 2px;
}

table.table tr th, table.table tr td {
	border-color: #e9e9e9;
	padding: 12px 15px;
	vertical-align: middle;
}

table.table tr th:first-child {
	width: 60px;
}

table.table tr th:last-child {
	width: 100px;
}

table.table-striped tbody tr:nth-of-type(odd) {
	background-color: #fcfcfc;
}

table.table-striped.table-hover tbody tr:hover {
	background: #f5f5f5;
}

table.table th i {
	font-size: 13px;
	margin: 0 5px;
	cursor: pointer;
}

table.table td:last-child i {
	opacity: 0.9;
	font-size: 22px;
	margin: 0 5px;
}

table.table td a {
	font-weight: bold;
	color: #566787;
	display: inline-block;
	text-decoration: none;
}

table.table td a:hover {
	color: #2196F3;
}

table.table td a.settings {
	color: #2196F3;
}

table.table td a.delete {
	color: #F44336;
}

table.table td i {
	font-size: 19px;
}

table.table .avatar {
	border-radius: 50%;
	vertical-align: middle;
	margin-right: 10px;
}

.status {
	font-size: 30px;
	margin: 2px 2px 0 0;
	display: inline-block;
	vertical-align: middle;
	line-height: 10px;
}

.text-success {
	color: #10c469;
}

.text-info {
	color: #62c9e8;
}

.text-warning {
	color: #FFC107;
}

.text-danger {
	color: #ff5b5b;
}

.pagination {
	float: right;
	margin: 0 0 5px;
}

.pagination li a {
	border: none;
	font-size: 13px;
	min-width: 30px;
	min-height: 30px;
	color: #999;
	margin: 0 2px;
	line-height: 30px;
	border-radius: 2px !important;
	text-align: center;
	padding: 0 6px;
}

.pagination li a:hover {
	color: #666;
}

.pagination li.active a, .pagination li.active a.page-link {
	background: #03A9F4;
}

.pagination li.active a:hover {
	background: #0397d6;
}

.pagination li.disabled i {
	color: #ccc;
}

.pagination li i {
	font-size: 16px;
	padding-top: 6px
}

.hint-text {
	float: left;
	margin-top: 10px;
	font-size: 13px;
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
		style="height: 35vmin; background-image: url(images/banner.jpg); " >
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

	<div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-5">
							<h2 class="text-white">User Management</h2>
						</div>
						<div class="col-sm-7">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addUserModal"><i class="icon-plus icon"></i>Add New User</button>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Role</th>
							<th>Email</th>
							<th>Name</th>
							<th>logins</th>
							<th>Last Login</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                <?php

                $rowid = 1;
                foreach ($users as $row) {

                    if ($row['user_type'] == 'FULL')
                        $status = "<span class='status text-success'>&bull;</span> Admin";
                    else if ($row['user_type'] == 'NORMAL')
                        $status = "<span class='status text-warning'>&bull;</span> User";
                    else
                        $status = "<span class='status text-danger'>&bull;</span> Unknown";

                    echo "<tr>";
                    echo "<td>$rowid</td>";
                    echo "<td class='text-black'>" . $row['username'] . "</td>";
										echo "<td>$status</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['first_name']. ' ' . $row['last_name'] . "</td>";
                    echo "<td>" . $row['login_num'] . "</td>";
                    echo "<td>" . $row['last_login'] . "</td>";
                    echo "<td>
														<a href='#' onclick='AskToDelete(\"" . $row['id'] . "\",\"" . $row['username'] . "\"); return false;' class='delete' title='Delete' data-toggle='tooltip'><i class='icon-delete_forever icon'></i></a>\r\n
				  									<a href='#' onclick='ChangePass(\"" . $row['id'] . "\",\"" . $row['username'] . "\"); return false;' class='text-warning' title='Password' data-toggle='tooltip'><i class='icon-settings'></i></a>

                              </td>";
                    echo "</tr>";

                    $rowid ++;
                }
                ?>
                </tbody>
				</table>
			</div>
		</div>

		<!-- ---------- Modal Area ---------- -->

		<!-- The Modal -->
		<div class="modal" id="addUserModal">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Add a new user</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form method="post" action="users.php" name="formu1">
							<input type="hidden" name="action" value="add">
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-user"></i>
									</span>
								</div>
								<input name="uname" class="form-control" placeholder="User Name"
									type="text" pattern="[a-z]{1}[a-z0-9_]{4,8}" required="required">
							</div>
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-key"></i>
									</span>
								</div>
								<input name="pass" class="form-control" placeholder="Password"
									type="password" required="required">
							</div>
							<!-- form-group end.// -->
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-user"></i>
									</span>
								</div>
								<input name="fname" class="form-control" placeholder="First Name"
									type="text" pattern="[a-z ]{4,15}" required="required">
								<input name="lname" class="form-control" placeholder="Last Name"
									type="text" pattern="[a-z ]{4,15}" required="required">
							</div>
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-mail_outline"></i>
									</span>
								</div>
								<input name="email" class="form-control" placeholder="Email"
									type="email" required="required">
							</div>
							<!-- form-group end.// -->
							<!-- form-group end.// -->
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-group"></i>
									</span>
								</div>
								<select name="gid" class="form-control">
									<?php foreach ($groups as $row) {
											echo "<option class='' value='".$row['id']."'>".$row['name']."</option>";
										}
									?>
								</select>
							</div>
							<!-- form-group end.// -->

							<!-- form-group end.// -->
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block">Register</button>
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

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="js/jquery-3.5.1.min.js"></script>
	<script src="js/bootstrap-4.5.2.min.js"></script>

	<!--sweet alert Js-->
	<script src="js/sweetalert2.js"></script>

	<script type="text/javascript">
			<?php
            if (isset($msg)) {
                echo "
                    	    Swal.fire({
                    	        icon: '$icon',
                    	        text: '$msg'
                    	    });";
            }
            echo "window.history.pushState({}, 'User Panel', 'users.php');";
        ?>




			function ChangePass(id,name){
					Swal.fire ({
								title: "Change Password for "+name+" !",
                html: "<div class='row pb-1'> <label class = 'm-md-auto' >Old Password </label><input id = 'p0' name = 'op' type = 'password' class = 'form-control w-50 mx-1' required placeholder = 'Old Password' required /></div>"+
											"<div class='row pb-1'> <label class = 'm-md-auto' >New Password </label><input id = 'p1' name = 'op' type = 'password' class = 'form-control w-50 mx-1' required placeholder = 'New Password' required /></div>"+
											"<div class='row'> <label class = 'm-md-auto' >Repeat Password </label><input id = 'p2' name = 'op' type = 'password' class = 'form-control w-50 mx-1' required placeholder = 'Repeat Password' required /></div>"
								,
								showCancelButton: true,
								cancelButtonColor: '#d33',
           }).then((result) => {
    			  if (result.isConfirmed) {
								var p0 = document.getElementById ('p0'). value;
								var p1 = document.getElementById ('p1'). value;
								var p2 = document.getElementById ('p2'). value;
								if(p1==p2) {
										window.location.replace("users.php?action=change&id="+id+"&p0="+p0+"&p1="+p1+"&p2="+p2);
								}
								else {
										Swal.fire({
											icon: 'error',
											title: 'new passwords does not match to each other!'
										});
								}
    				}
    			});
			}

	    function AskToDelete(id,user) {
	    	return Swal.fire({
	    		  title: 'Are you sure you want to delete?',
	    		  text: "user : " + user,
	    		  icon: 'warning',
	    		  showCancelButton: true,
	    		  confirmButtonColor: '#d33',
	    		  cancelButtonColor: '#3085d6',
	    		  confirmButtonText: 'Yes, delete it!'
	    		}).then((result) => {
    			  if (result.isConfirmed) {
    				    window.location.replace("users.php?action=del&id="+id);
    				}
    			});
	    }

	</script>
</body>
</html>
