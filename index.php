<?php 
	session_start();
	include 'admin/koneksi.php';
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

		<div class="jumbotron">
			<div class="title-center">
				<div class="title-text">
					<h1>Selamat datang di <font color="#3498db">Cityzen Journalist</font></h1>
					<p>Tempat dimana berita terupdate bisa dilihat.</p>
					<p><a class="btn btn-primary btn-lg" href="#konten" role="button">Lihat Berita</a></p>
				</div>
			</div>
		</div>

		<div class="row" style="margin: 0" id="konten">
			<center><h2>Berita Terbaru</h2></center>
			<hr>
			<?php 
				function userShow($id, $NamaUser){
					if($id == 1){
						$NamaUser = "Admin Cityzen";
						return $NamaUser;
					}else{
						return $NamaUser;
					}
				}

				//page
				$halaman = 8;
				$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
				$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
				$result = mysqli_query($koneksi, "SELECT * FROM tbberita");
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
									usr.Nama,
									be.IdUser 
							FROM tbberita be INNER JOIN tbuser usr 
							ON be.IdUser = usr.IdUser WHERE be.Pengesahan = 'OK' LIMIT $mulai, $halaman");
				}else{
					$cari = $_POST["Search"];
					$query = mysqli_query($koneksi, "
							SELECT be.IdBerita,
										be.Judul,
										be.Keterangan,
										be.TglUpload,
										be.Pengesahan,
										usr.Nama,
										be.IdUser 
							FROM tbberita be INNER JOIN tbuser usr 
							ON be.IdUser = usr.IdUser 
							WHERE be.Pengesahan = 'OK' AND be.Judul LIKE '%$cari%' OR be.Keterangan LIKE '%$cari%' LIMIT $mulai, $halaman");
				}
				while($data = mysqli_fetch_array($query)){
					$queryGambar = mysqli_query($koneksi, "SELECT NamaGambar FROM tbgambar WHERE IdBerita = '$data[0]'");
					$no = 1;
					echo "
						<div class=\"col-md-3\">
							<div class=\"thumbnail\">
							    <div id=\"carousel-example-generic\" class=\"carousel slide\" data-ride=\"carousel\">
								  <!-- Wrapper for slides -->
								  <div class=\"carousel-inner\" role=\"listbox\">
								  ";
									    while($Gambar = mysqli_fetch_array($queryGambar)){
											if($no==1){
												echo "
												<div class=\"item active\">
											      <img src='img/upload/$Gambar[0]' width='100%'>
											    </div>
												";
											}else{
												echo "
												<div class=\"item\">
											      <img src='img/upload/$Gambar[0]' width='100%'>
											    </div>
												";
											}
											$no++;
										}
									echo"
								  </div>
								</div>
							    <div class=\"caption\">
							       	<h3>".$data[1]."</h3>
							       	<p>".userShow($data[6], $data[5])."</p>
							       	<p>Tanggal : ".$data[3]."</p>
							       	<p class=\"text-scroll\">".$data[2]."</p>
							    </div>
							</div>			
						</div>
					";
				}
			?>	
		</div>
		<div class="row" style="margin: 0">
			<div class="col-md-12" style="display: flex; justify-content: center; flex-direction: column; align-items: center;">
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
				<p>&copy; Copyright-2018 | Cityzen Journalist</p>
			</div>
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