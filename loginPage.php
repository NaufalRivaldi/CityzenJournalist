<?php
	session_start(); 
	include 'admin/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login | Cityzen Journalist</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/styleAdmin.css">
	<link rel="icon" href="img/icon/icon.png">
</head>
<body>
	<div class="col-md-4"></div>
	<div class="col-md-4">
		<div class="loginPage" style="padding-top: 15%">
			<center>
				<img src="img/icon/logo.png" width="300px">
			</center>
			<form action="login.php" method="post">
				<div class="form-groups">
					<label>Email</label>
				<input type="text" name="Email" class="form-control" required>
					</div>
				<div class="form-groups">
					<label>Password</label>
					<input type="password" name="Password" class="form-control" required>
				</div><br>
				<div class="form-groups">
					<input type="submit" value="Login" class="btn btn-primary btn-block">
				</div>
			</form><br>
			<p align="center">&copy; Copyright - 2018 | Cityzen Journalist</p>
		</div>
	</div>
	<div class="col-md-4"></div>

	<!-- JS Script -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/validasiDelete.js"></script>
</body>
</html>