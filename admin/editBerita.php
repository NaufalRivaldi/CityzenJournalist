<?php 
	session_start(); 
	include 'koneksi.php';
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$_SESSION['IdBerita'] = $id;
	}else{
		$id = $_SESSION['IdBerita'];
	}

	if(empty($_SESSION['NamaAdmin'])){
		echo "<script>location.href='loginPage.php'</script>";
	}else{
		$NamaAdmin = $_SESSION['NamaAdmin'];
		$Level = $_SESSION['Level'];
	}

	$query = mysqli_query($koneksi, "SELECT * FROM tbberita WHERE IdBerita = '$id'");
	while($data = mysqli_fetch_array($query)){
		$IdBerita = $data[0];
		$Judul = $data[1];
		$Keterangan = $data[2];
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
				<form name="formBerita" method="Post" action="updateBerita.php" enctype="multipart/form-data">
					<input type="hidden" name="IdBerita" value="<?= $IdBerita ?>">
					<div class="input-groups">
						<label>Judul</label>
						<input type="text" name="Judul" placeholder="Judul Berita / Wacana" class="form-control" required value="<?= $Judul ?>">
					</div>
					<div class="input-groups">
						<label>Keterangan</label>
						<textarea name="Keterangan" class="form-control" rows="5"><?= $Keterangan ?></textarea>
					</div>
					<div class="input-groups">
						<label>Gambar</label><br>
						<?php 
							$queryGambar = mysqli_query($koneksi, "SELECT IdGambar, NamaGambar FROM tbgambar WHERE IdBerita = '$id'");
							$no = 1;
							while($Gambar = mysqli_fetch_array($queryGambar)){
								echo "
								<img src='../img/upload/$Gambar[1]' width='150px'><br>
								<a href='hapusGambar.php?id=$Gambar[0]' onclick='return valDelete();'>Hapus Foto ".$no."</a>
								<br>
								";
								$no++;
							}
						?>
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
</body>
</html>