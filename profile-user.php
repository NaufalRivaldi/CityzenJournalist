<?php 
	session_start();
	include 'admin/koneksi.php';
	if(empty($_SESSION['NamaUser'])){
		echo "<script>location.href='index.php'</script>";
	}else{
		$NamaUser = $_SESSION['NamaUser'];
		$IdUser = $_SESSION['IdUser'];
	}

	$queryUser = mysqli_query($koneksi, "SELECT * FROM tbuser WHERE IdUser = '$IdUser'");
	while($data = mysqli_fetch_array($queryUser)){
		$Id_User = $data[0];
		$Email = $data[1];
		$Nama = $data[3];
		$TglLahir = $data[4];
		$JK = $data[5];
		$NoTelp = $data[6];
		$Alamat = $data[7];
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
			<div class="well well-lg">
				<h3>Profile</h3>
				<table class="table">
					<tr>
						<td align="right" width="150px">ID :</td>
						<td><?= $Id_User ?></td>
					</tr>
					<tr>
						<td align="right">Email :</td>
						<td><?= $Email ?></td>
					</tr>
					<tr>
						<td align="right">Nama :</td>
						<td><?= $Nama ?></td>
					</tr>
					<tr>
						<td align="right">Tanggal Lahir :</td>
						<td><?= $TglLahir ?></td>
					</tr>
					<tr>
						<td align="right">Jenis Kelamin :</td>
						<td><?= $JK ?></td>
					</tr>
					<tr>
						<td align="right">No Telepon :</td>
						<td><?= $NoTelp ?></td>
					</tr>
					<tr>
						<td align="right">Alamat :</td>
						<td><?= $Alamat ?></td>
					</tr>
				</table>	
			</div>
			<h2><span class="glyphicon glyphicon-list-alt"></span> Postingan Berita</h2><br>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<div class="well well-lg">
				<p class="text">
					<form method="post" action="tampilKontenAcc.php">
						<div class="form-group">
							<input type="text" name="Search" placeholder="Judul atau Deskripsi Berita" class="form-control" style="width: 30%; float: left">&nbsp; 
							<input type="submit" value="Cari Data" class="btn btn-primary">
						</div>
					</form>
				</p>
				<p class="text">
					<a href="tambah-konten.php">
						<span class="glyphicon glyphicon-plus"></span> Posting Berita
					</a>
				</p>
				<table class="table table-striped" style="font-size: 12px">
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Keterangan</th>
						<th>Gambar</th>
						<th>Tgl Upload</th>
						<th>Pengesahan</th>
						<th>Action</th>
					</tr>
						<?php
							//page
							$halaman = 5;
							$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
							$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
							$result = mysqli_query($koneksi, "SELECT * FROM tbberita WHERE IdUser = '$IdUser'");
							$total = mysqli_num_rows($result);
							$pages = ceil($total/$halaman);

							//search
							if(!isset($_POST["Search"])){
								$query = mysqli_query($koneksi, "
									SELECT be.IdBerita,
											be.Judul,
											be.Keterangan,
											be.TglUpload,
											be.Pengesahan,
											usr.Nama 
									FROM tbberita be INNER JOIN tbuser usr 
									ON be.IdUser = usr.IdUser WHERE be.IdUser = '$IdUser' LIMIT $mulai, $halaman");
							}else{
								$cari = $_POST["Search"];
								$query = mysqli_query($koneksi, "
								SELECT be.IdBerita,
											be.Judul,
											be.Keterangan,
											be.TglUpload,
											be.Pengesahan,
											usr.Nama 
									FROM tbberita be INNER JOIN tbuser usr 
									ON be.IdUser = usr.IdUser 
									WHERE WHERE be.IdUser = '$IdUser' AND be.Judul LIKE '%$cari%' OR be.Keterangan LIKE '%$cari%' LIMIT $mulai, $halaman");
							}

							$no = $mulai+1;
							while($data = mysqli_fetch_array($query)){
								$queryGambar = mysqli_query($koneksi, "SELECT NamaGambar FROM tbgambar WHERE IdBerita = '$data[0]'");
								
								echo "
								<tr>
								<td>".$no."</td>
								<td>".$data[1]."</td>
								<td>".$data[2]."</td>
								<td>";
								while($Gambar = mysqli_fetch_array($queryGambar)){
									echo "
									<img src='img/upload/$Gambar[0]' width='150px'><br><br>
									";
								}
								echo "
								</td>
								<td>".$data[3]."</td>
								<td align='center'>".$data[4]."</td>
								<td>
									<a href='editBerita.php?id=$data[0]'>
										<span class='glyphicon glyphicon-cog'></span>
									</a> | 
									<a href='hapusBerita.php?id=$data[0]' onclick='return valDelete();'>
										<span class='glyphicon glyphicon-trash'></span>
									</a>
								</td>
								</tr>
								";
								$no++;
							}
						?>
				</table>
				<!-- Pagination -->
				<nav aria-label="Page navigation">
				  <ul class="pagination">
				    <li class="disabled">
				      <a href="#" aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				      </a>
				    </li>
				    <!-- Perulangan page -->
				    <?php 
				    	for ($i=1; $i <= $pages; $i++){
				    		if($page == $i){
				    			echo "
				    			<li class=\"active\"><a href=\"#\">$i</a></li>
				    			";
				    		}else{
				    			echo "
				    			<li><a href=\"?halaman=$i\">$i</a></li>
				    			";
				    		}
				    	}
				    ?>
				    <!-- Perulangan page -->
				    <li class="disabled">
				      <a href="#" aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				      </a>
				    </li>
				  </ul>
				</nav>
			</div>
		</div>
	</div>
		<!-- Script -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script src="js/validasiDelete.js"></script>
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