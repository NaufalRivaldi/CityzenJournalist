<?php 
	session_start();
	include 'admin/koneksi.php';
	if(empty($_SESSION['NamaUser'])){
		echo "<script>location.href='index.php'</script>";
	}else{
		$NamaUser = $_SESSION['NamaUser'];
		$IdUser = $_SESSION['IdUser'];
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Cityzen Journalist</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="icon" href="img/icon/icon.png">
	</head>
	<body id="home">
		<!-- Navbar -->	
		<?php include 'navbar.php'; ?>

		<div class="row" style="padding-top: 60px;">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<h2><span class="glyphicon glyphicon-camera"></span> Posting Berita</h2><br>
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
		<!-- Script -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script src="js/navbar-fixed.js"></script>
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-36251023-1']);
		  _gaq.push(['_setDomainName', 'jqueryscript.net']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		<!-- Script -->
	</body>
</html>