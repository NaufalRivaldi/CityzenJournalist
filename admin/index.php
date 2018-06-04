<?php 
	session_start(); 
	include 'koneksi.php';

	if(empty($_SESSION['NamaAdmin'])){
		echo "<script>location.href='loginPage.php'</script>";
	}else{
		$NamaAdmin = $_SESSION['NamaAdmin'];
		$Level = $_SESSION['Level'];
	}

	$queryUser = mysqli_query($koneksi, "SELECT * FROM tbuser");
	$jmlUser = mysqli_num_rows($queryUser);

	$queryAdmin = mysqli_query($koneksi, "SELECT * FROM tbadmin");
	$jmlAdmin = mysqli_num_rows($queryAdmin);

	$queryBerita1 = mysqli_query($koneksi, "SELECT * FROM tbberita where Pengesahan='OK'");
	$jmlBerita1 = mysqli_num_rows($queryBerita1);

	$queryBerita2 = mysqli_query($koneksi, "SELECT * FROM tbberita where Pengesahan='Cek'");
	$jmlBerita2 = mysqli_num_rows($queryBerita2);
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
				Dashboard /
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<!-- Alert -->
			<div class="alert alert-info alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Selamat datang di web admin Cityzen Journalist!</strong> Admin <?php echo $NamaAdmin; ?>
			</div>
			<!-- Alert -->

			<div class="col col-md-3">
				<div class="panel panel-primary">
				  <div class="panel-heading">User Terdaftar</div>
				  <div class="panel-body">
				    <?php echo $jmlUser; ?> Orang
				  </div>
				</div>
			</div>
			<div class="col col-md-3">
				<div class="panel panel-primary">
				  <div class="panel-heading">Admin terdaftar</div>
				  <div class="panel-body">
				    <?php echo $jmlAdmin; ?> Orang
				  </div>
				</div>
			</div>
			<div class="col col-md-3">
				<div class="panel panel-primary">
				  <div class="panel-heading">Konten yang harus diAcc</div>
				  <div class="panel-body">
				    <?php echo $jmlBerita2; ?> Konten	
				  </div>
				</div>
			</div>
			<div class="col col-md-3">
				<div class="panel panel-primary">
				  <div class="panel-heading">Konten Terpost</div>
				  <div class="panel-body">
				    <?php echo $jmlBerita1; ?> Konten
				  </div>
				</div>
			</div>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-lg" style="height: 500px">
				
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
</body>
</html>