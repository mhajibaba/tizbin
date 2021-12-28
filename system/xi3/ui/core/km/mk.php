<?php
require_once 'login.php';

?>
<!DOCTYPE html>
<html>
<head>
<title>Messages - Self Demand</title>
<meta charset="utf-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="../../fonts/icomoon/style.css">
<link rel="stylesheet" href="../../css/bootstrap4.min.css">
<link rel="stylesheet" href="../../css/jquery-ui.css">
<link rel="stylesheet" href="../../css/style2.css">
</head>
<body>

	<?php $nav_type="bg-dark"; include '../../header_nav.php';?>
	
	<div class="site-section p-3 mt-5">
		<h3 class="text-center mb-3">User Messages</h3>
		<div class="table-responsive">
			<table class="table table-sm table-bordered table-hover">
				<thead class="thead-dark">
					<tr>
						<th>Id</th>
						<th>name</th>
						<th>email</th>
						<th>subject</th>
						<th>message</th>
						<th>date</th>
						<th></th>
						<th></th>
					</tr>
				</thead>

<?php
include_once '../db/tb_message.php';

if (isset($_GET["read"])) {
    $id = $_GET["read"];
    if (is_numeric($id)) {
        TableMessage::setState($id, 2);
    }
}

if (isset($_GET["del"])) {
    $id = $_GET["del"];
    if (is_numeric($id)) {
        TableMessage::delete($id);
    }
}

try {

    $database = new Connection();

    $db = $database->openConnection();

    if ($db == NULL) {
        echo "Connection is null";
        exit();
    }

    $stmt = $db->prepare("SELECT `id`, `name`, `email`, `subject`, `message`, `date` FROM `message` WHERE `state`=1 ORDER BY id DESC LIMIT 100");

    // set the resulting array to associative
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->execute();

    if ($stmt->rowCount() != 0) {

        echo "<tbody>";

        while ($row = $stmt->fetch()) {
            echo "<tr>";
            echo "<th scope='row'>" . $row['id'] . "</th>";
            echo "<td >" . $row['name'] . "</td>";
            echo "<td >" . $row['email'] . "</td>";
            echo "<td >" . $row['subject'] . "</td>";
            echo "<td >" . $row['message'] . "</td>";
            echo "<td >" . $row['date'] . "</td>";

            echo "<td >
                <input type='button' value='Read' onclick='markAsRead(" . $row['id'] . ");'/></td>
              <td >
                <input type='button' value='Delete'	onclick='deleteRecord(" . $row['id'] . ");' class='dsgnmoo' /></td>";
            echo "</tr>";
        }
        echo "</tbody>";
    }

    $database->closeConnection();
} catch (Exception $e) {

    if ($database != null) {
        $database->closeConnection();
    }

    echo "Error: " . $e->getMessage();
}

?>
			</table>
		</div>
		<div class="row align-items-center mt-3">
			<a class="btn btn-outline-info" href="panel" role="button"><i class="icon-th-large"></i> Panel</a>
		</div>
	</div>

	<script src="../../js/jquery-3.3.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

	<script>
    function markAsRead(id){   
        var url = 'mk.php?read=' + id;
        window.location.href = url;
    };

    function deleteRecord(id){   
    	Swal.fire({
  		  title: 'Are you sure to delete this record?',
  		  showCancelButton: true,
  		  confirmButtonColor: '#d33',
  		  cancelButtonColor: '#3085d6',
  		  confirmButtonText: 'Yes, delete it!'
  		}).then((result) => {
  		  if (result.value) {
  			  var url = 'mk.php?del=' + id;
  		      window.location.href = url;
  		  }
  		});        
    };
   
    </script>
	<script src="../../js/main.js"></script>

</body>
</html>
