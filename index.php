<?php require_once 'dbconnect.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>CRUD</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
	<div class="container">
		<?php if (isset($_SESSION['msg'])) : ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?>">
				<?php
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				 ?>
			</div>
		<?php endif; ?>
		<!-- Table -->
		<div class="row">
			<?php 
				$mysqli = new mysqli("localhost","root","","crud") or die(mysqli_error());
				$result = $mysqli->query("SELECT * FROM users") or die($mysqli->error);
			?>
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Location</th>
						<th>Actions</th>
					</tr>
				</thead>

				<?php while ($row = $result->fetch_array()) : ?>
					<tr>
						<td><?php echo $row["name"]; ?></td>
						<td><?php echo $row["location"]; ?></td>
						<td>
							<a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-secondary">Edit</a>
							<a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>


		<!-- Insert Form -->
		<div class="row justify-content-center">
			<form action="dbconnect.php" method="POST">
				<input type="text" name="id" value="<?php echo $id; ?>" hidden >
				<div class="form-group">
					<label>Enter the Name</label>
					<input class="form-control" value="<?php echo $name; ?>" type="text" name="name" placeholder="Enter the name">
				</div>
				<div class="form-group">
					<label>Enter the location</label>
					<input class="form-control" value="<?php echo $location; ?>" type="text" name="location" placeholder="enter the location">
				</div>
				<div class="form-group">
					<?php if ($update == true) : ?>
					<button class="btn btn-primary" type="submit" name="update">Update</button>
					<?php else : ?>
					<button class="btn btn-primary" name="save" type="submit">Save</button>

				<?php endif; ?>
				</div>
			</form>
		</div>
	</div>

</body>
</html>