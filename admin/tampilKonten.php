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
				Data Konten / Tampil Konten Cek
			</div>
			<h2><span class="glyphicon glyphicon-list-alt"></span> Tampil Data Konten Cek</h2><br>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-lg">
				<p class="text">
					<form method="post" action="tampilKontenAcc.php">
						<div class="form-group">
							<input type="text" name="Search" placeholder="Judul atau Deskripsi User" class="form-control" style="width: 30%; float: left">&nbsp; 
							<input type="submit" value="Cari Data" class="btn btn-primary">
						</div>
					</form>
				</p>
				<table class="table table-striped" style="font-size: 12px">
					<tr>
						<th>No</th>
						<th>Judul</th>
						<th>Keterangan</th>
						<th>Gambar</th>
						<th>Tgl Upload</th>
						<th>Pengesahan</th>
						<th>User</th>
						<th>Action</th>
					</tr>
						<?php
							//page
							$halaman = 5;
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
											usr.Nama 
									FROM tbberita be INNER JOIN tbuser usr 
									ON be.IdUser = usr.IdUser WHERE be.Pengesahan = 'CEK' LIMIT $mulai, $halaman");
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
									WHERE WHERE be.Pengesahan = 'CEK' AND be.Judul LIKE '%$cari%' OR be.Keterangan LIKE '%$cari%' LIMIT $mulai, $halaman");
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
									<img src='../img/upload/$Gambar[0]' width='150px'><br><br>
									";
								}
								echo "
								</td>
								<td>".$data[3]."</td>
								<td align='center'>".$data[4]."<br> 
									<a href='accKonten.php?id=$data[0]'>
										<button class='btn btn-success'>Acc Konten</button>
									</a>
								</td>
								<td>".$data[5]."</td>
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

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Tambah Data User</h4>
	      </div>
	      <div class="modal-body">
	      		<form name="formAdmin" method="Post" action="simpanUser.php">
					<div class="input-groups">
						<label>Email</label>
						<input type="text" name="Email" placeholder="example@test.com/.co.id" class="form-control" required>
						<p class="text text-warning">*Email akan digunakan untuk login sebagai user.</p>
					</div>
					<div class="input-groups">
						<label>Password</label>
						<input type="password" name="Password" class="form-control" required>
					</div>
					<div class="input-groups">
						<label>Nama</label>
						<input type="text" name="Nama" placeholder="Masukkan nama lengkap" class="form-control" required>
					</div>
					<div class="input-groups">
						<label>Tanggal Lahir</label>
						<input type="date" name="TglLahir" class="form-control" style="width: 50%">
					</div>
					<div class="input-groups">
						<label>Jenis Kelamin</label>
						<select name="JK" class="form-control" style="width: 50%" required>
							<option value="">Pilih Jenis Kelamin</option>
							<option value="L">Laki - laki</option>
							<option value="P">Perempuan</option>
						</select>
					</div>
					<div class="input-groups">
						<label>Nomer Telepon</label>
						<input type="text" name="NoTelp" placeholder="0896xxxxxxxx" class="form-control" style="width: 50%" required>
					</div>
					<div class="input-groups">
						<label>Alamat</label>
						<textarea name="Alamat" class="form-control" rows="5" required></textarea>
					</div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" value="Tambah Data" class="btn btn-primary">
			<input type="reset" value="Batal" class="btn btn-danger">	
			</form>
	      </div>
	    </div>
	  </div>
	</div>
</body>
</html>