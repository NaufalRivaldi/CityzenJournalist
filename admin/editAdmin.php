<?php 
	session_start(); 
	include 'koneksi.php';

	if(empty($_SESSION['NamaAdmin'])){
		echo "<script>location.href='loginPage.php'</script>";
	}else{
		$NamaAdmin = $_SESSION['NamaAdmin'];
		$Level = $_SESSION['Level'];
	}

	$id = $_GET['id'];
	$query = mysqli_query($koneksi, "SELECT * FROM tbadmin where IdAdmin = '$id'");
	 while($data = mysqli_fetch_array($query)){
	 	$IdAdmin = $data[0];
	 	$Email = $data[1];
	 	$Password = $data[2];
	 	$Nama = $data[3];
	 	$NoTelp = $data[4];
	 	$Alamat = $data[5];
	 	$LevelAdmin = $data[6];
	 }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin | Cityzen Journalist</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/styleAdmin.css">
	<link rel="icon" href="../img/icon/icon.png">
</head>
<body>
	<!-- Navbar -->
	<?php include 'viewnavbar.php'; ?>

	<div class="row" style="padding-top: 60px;">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-sm">
				Data Admin / Edit Data
			</div>
			<h2><span class="glyphicon glyphicon-user"></span> Edit Data Admin</h2><br>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-lg">
				<form name="formAdmin" method="Post" action="updateAdmin.php">
					<input type="hidden" name="IdAdmin" value="<?php echo $IdAdmin; ?>">
					<div class="input-groups">
						<label>Email</label>
						<input type="text" name="Email" placeholder="example@test.com/.co.id" class="form-control" required value="<?php echo $Email; ?>">
						<p class="text text-warning">*Email akan digunakan untuk login sebagai admin.</p>
					</div>
					<div class="input-groups">
						<label>Password</label>
						<input type="text" name="Password" class="form-control" required value="<?php echo $Password; ?>">
					</div>
					<div class="input-groups">
						<label>Nama</label>
						<input type="text" name="Nama" placeholder="Masukkan nama lengkap" class="form-control" required value="<?php echo $Nama; ?>">
					</div>
					<div class="input-groups">
						<label>Nomer Telepon</label>
						<input type="text" name="NoTelp" placeholder="0896xxxxxxxx" class="form-control" style="width: 50%" required value="<?php echo $NoTelp; ?>">
					</div>
					<div class="input-groups">
						<label>Alamat</label>
						<textarea name="Alamat" class="form-control" rows="5" required><?php echo $Alamat; ?></textarea>
					</div>
					<div class="input-groups">
						<label>Level</label>
						<select name="Level" class="form-control" style="width: 50%" required>
							<?php 
								if($LevelAdmin == 1){
									echo "
									<option value=\"1\" selected>Super User</option>
									<option value=\"2\">Admin</option>
									";
								}else{
									echo "
									<option value=\"1\">Super User</option>
									<option value=\"2\" selected>Admin</option>
									";
								}
							?>
							
						</select>
					</div>
					<br>
					<div class="input-groups">
						<input type="submit" value="Simpan Data" class="btn btn-primary">
						</form>
						<a href="tampilAdmin.php">
							<input type="button" value="Batal" class="btn btn-danger">
						</a>	
					</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="footer">
				&copy; Copyright - 2018 | Cityzen Journalist
			</div>
		</div>
	</div>
	<!-- JS Script -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/validasiDelete.js"></script>
</body>
</html>