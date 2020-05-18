<?php 

session_start();

$mysqli = new mysqli("localhost","root","","crud") or die(mysqli_error());
$name = "";
$location ="";
$update=false;
$id = "";
// Inserting a new record
if (isset($_POST["save"])) {
	# code...
	$name = $_POST["name"];
	$location = $_POST["location"];
	$mysqli->query("INSERT INTO users (name,location) VALUES ('$name','$location')") or die($mysqli->error);
	$_SESSION['msg'] = "Record Added Successfully";
	$_SESSION['type'] = "success";
	header("location: index.php");
}

// Delete a record
if (isset($_GET["delete"])) {
	# code...
	$id = $_GET["delete"];
	$mysqli->query("DELETE FROM users WHERE id='$id'") or die($mysqli->error);
	$_SESSION['msg'] = "Record Deleted Successfully";
	$_SESSION['type'] = "danger";
}

// editing a record
if (isset($_GET["edit"])) {
	# code...
	$id = $_GET["edit"];
	$result = $mysqli->query("SELECT * FROM users WHERE id='$id'") or die($mysqli->error);
	if (mysqli_num_rows($result)==1) {
		# code...
		$row = $result->fetch_array();
		$name = $row["name"];
		$location = $row["location"];
		$update = true;
	}
}


// update a record
if (isset($_POST["update"])) {
	# code...

	$name = $_POST["name"];
	$location = $_POST["location"];
	$id = $_POST["id"];
	$mysqli->query("UPDATE users SET name='$name', location='$location' WHERE id='$id'") or die($mysqli->error);
	$_SESSION['msg'] = "Record Updated Successfully";
	$_SESSION['type'] = "success";
	header("location: index.php");
}
?>