<?php

require_once 'core/login.php';

if ($_SESSION["userrole"] != 'FULL') {
	header("location: $url/signin.php");
	exit();
}

include_once __DIR__ . '/core/db/tb_group.php';
include_once __DIR__ . '/core/db/tb_user.php';

if(!empty($_GET['action'])) {

	if (!empty($_GET['id'])) {

			if($_GET['action'] == 'del') {
				$ret = TableUser::deleteByGroup($_GET['id']);
				if($ret === true) {
						$ret = TableGroup::delete($_GET['id']);
						if($ret !== true) {
								$msg = $ret;
						}
				}
				else {
						$msg = $ret;
				}
			}
	}
}

if(!empty($_POST['action'])) {

	if (!empty($_POST['gname'])) {

			if($_POST['action'] == 'add') {
				TableGroup::add($_POST['gname']);
			}
	}
}

$users = TableGroup::list_groups();

if ($users == null) {
    header("Location: index.php");
    exit();
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

<title>Group Management</title>
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
							<h2 class="text-white">Group Management</h2>
						</div>
						<div class="col-sm-7">
						<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addUserModal"><i class="icon-plus icon"></i>Add New Group</button>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Users</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                <?php

                $rowid = 1;
                foreach ($users as $row) {

                    echo "<tr>";
                    echo "<td>$rowid</td>";
                    echo "<td class='text-black'>" . $row['name'] . "</td>";
                    echo "<td class='text-black'> <a href='users.php?action=list&gid=".$row['id']."'>Show</a></td>";
                    echo "<td>
														  <a href='#' onclick='AskToDelete(\"" . $row['id'] . "\",\"" . $row['name'] . "\"); return false;' class='delete' title='Delete' data-toggle='tooltip'><i class='icon-delete_forever icon'></i></a>

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
					<h4 class="modal-title">Add a new group</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

					<!-- Modal body -->
					<div class="modal-body">
						<form method="post" action="groups.php" name="formu1">
							<input type="hidden" name="action" value="add">
							<!-- form-group -->
							<div class="form-group input-group">
								<div class="input-group-prepend">
									<span class="input-group-text"> <i class="icon-group"></i>
									</span>
								</div>
								<input name="gname" class="form-control" placeholder="Group Name"
									type="text" pattern="[a-z]{1}[a-z0-9_]{4,8}" required="required">
							</div>
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
            echo "window.history.pushState({}, 'User Panel', 'groups.php');";
        ?>

	    function AskToDelete(id,user) {
	    	return Swal.fire({
	    		  text: 'Are you sure you want to delete this group and all users in this group?',
	    		  title: "group : " + user,
	    		  icon: 'warning',
	    		  showCancelButton: true,
	    		  confirmButtonColor: '#d33',
	    		  cancelButtonColor: '#3085d6',
	    		  confirmButtonText: 'Yes, delete it!'
	    		}).then((result) => {
    			  if (result.isConfirmed) {
    				    window.location.replace("groups.php?action=del&id="+id);
    				}
    			});
	    }

	</script>
</body>
</html>
