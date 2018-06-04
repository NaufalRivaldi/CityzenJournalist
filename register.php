<?php
	session_start(); 
	include 'admin/koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Register | Cityzen Journalist</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/styleAdmin.css">
	<link rel="icon" href="img/icon/icon.png">
	<style type="text/css">
		.form-groups{
			padding-top: 1%;
			padding-bottom: 1%;
		}
	</style>
</head>
<body>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="loginPage" style="padding-top: 5%">
			<center>
				<img src="img/icon/logo.png" width="300px">
			</center>
			<fieldset>
				<legend>Form Registrasi User</legend>
				<form action="registrasi.php" method="post">
					<div class="form-groups">
						<label>Email</label>
						<input type="text" name="Email" class="form-control" required>
					</div>
					<div class="form-groups">
						<label>Password</label>
						<input type="password" name="Password" class="form-control" required>
					</div>
					<div class="form-groups">
						<label>Nama</label>
						<input type="text" name="Nama" class="form-control" placeholder="Nama Lengkap" required>
					</div>
					<div class="form-groups">
						<label>Tanggal Lahir</label>
						<input type="date" name="TglLahir" class="form-control" required style="width: 50%;">
					</div>
					<div class="form-groups">
						<label>Jenis Kelamin</label><br>
						<input type="radio" name="JK" value="L" checked required> Laki - Laki 
						<input type="radio" name="JK" value="P" required> Perempuan
					</div>
					<div class="form-groups">
						<label>No Telepon</label>
						<input type="text" name="NoTelp" class="form-control" placeholder="08xxxxxxxxxx" required style="width: 50%;">
					</div>
					<div class="form-groups">
						<label>Alamat</label>
						<textarea name="Alamat" class="form-control" required rows="5"></textarea>
					</div>
					<br>
					<div class="form-groups">
						<input type="submit" value="Login" class="btn btn-primary btn-block">
					</div>
				</form><br>
			</fieldset>
			<p align="center">&copy; Copyright - 2018 | Cityzen Journalist</p>
		</div>
	</div>
	<div class="col-md-3"></div>

	<!-- JS Script -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/validasiDelete.js"></script>
</body>
</html>