<?php 
	session_start(); 
	include 'koneksi.php';

	if(empty($_SESSION['NamaAdmin'])){
		echo "<script>location.href='loginPage.php'</script>";
	}else{
		$NamaAdmin = $_SESSION['NamaAdmin'];
		$Level = $_SESSION['Level'];
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
				Data Konten / Tambah Konten
			</div>
			<h2><span class="glyphicon glyphicon-camera"></span> Tambah Konten Cityzen Journalist</h2><br>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-lg">
				<form name="formBerita" method="Post" action="simpanBerita2.php" enctype="multipart/form-data">
					<div class="input-groups">
						<label>Judul</label>
						<input type="text" name="Judul" placeholder="Judul Berita / Wacana" class="form-control" required>
					</div>
					<div class="input-groups">
						<label>Keterangan</label>
						<textarea name="Keterangan" class="form-control" rows="5"></textarea>
					</div>
					<div class="input-groups">
						<label>Gambar</label>
						<input type="file" name="Gambar[]" multiple class="form-control" style="width: 50%">
					</div>
					<br>
					<div class="input-groups">
						<input type="submit" value="Simpan Data" class="btn btn-primary">
						<input type="reset" value="Batal" class="btn btn-danger">
						</form>	
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
	<script src="../js/Gambar.js"></script>
</body>
</html>