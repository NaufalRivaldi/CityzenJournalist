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
				Data Admin / Tampil Data
			</div>
			<h2><span class="glyphicon glyphicon-user"></span> Tampil Data Admin</h2><br>
		</div>
		<div class="col-md-1"></div>
	</div>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<div class="well well-lg">
				<p class="text">
					<a href="#" data-toggle="modal" data-target="#myModal">
						<span class="glyphicon glyphicon-plus"></span> Tambah Data
					</a>
					<form method="post" action="tampilAdmin.php">
						<div class="form-group">
							<input type="text" name="Search" placeholder="Nama atau email Admin" class="form-control" style="width: 30%; float: left">&nbsp; 
							<input type="submit" value="Cari Data" class="btn btn-primary">
						</div>
					</form>
				</p>
				<table class="table table-striped" style="font-size: 12px">
					<tr>
						<th>No</th>
						<th>Email</th>
						<th>Nama</th>
						<th>No Telepon</th>
						<th>Alamat</th>
						<th>Level</th>
						<th>Action</th>
					</tr>
						<?php
							function Level($data){
								if($data == 1){
									$data = "Super User";
								}else{
									$data = "Admin";
								}
								return $data;
							}

							//page
							$halaman = 5;
							$page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
							$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
							$result = mysqli_query($koneksi, "SELECT * FROM tbadmin");
							$total = mysqli_num_rows($result);
							$pages = ceil($total/$halaman);

							//search
							if(!isset($_POST["Search"])){
								$query = mysqli_query($koneksi, "select Email, Nama, NoTelp, Alamat, Level, IdAdmin from tbadmin LIMIT $mulai, $halaman");
							}else{
								$cari = $_POST["Search"];
								$query = mysqli_query($koneksi, "select Email, Nama, NoTelp, Alamat, Level, IdAdmin from tbadmin where Nama LIKE '%$cari%' or Email LIKE '%$cari%' LIMIT $mulai, $halaman");
							}

							$no = $mulai+1;
							while($data = mysqli_fetch_array($query)){
								echo "
								<tr>
								<td>".$no."</td>
								<td>".$data[0]."</td>
								<td>".$data[1]."</td>
								<td>".$data[2]."</td>
								<td>".$data[3]."</td>
								<td>".Level($data[4])."</td>
								<td>
									<a href='editAdmin.php?id=$data[5]'>
										<span class='glyphicon glyphicon-cog'></span>
									</a> | 
									<a href='hapusAdmin.php?id=$data[5]' onclick='return valDelete();'>
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
	        <h4 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-user"></span> Tambah Data Admin</h4>
	      </div>
	      <div class="modal-body">
	      		<form name="formAdmin" method="Post" action="simpanAdmin.php">
					<div class="input-groups">
						<label>Email</label>
						<input type="text" name="Email" placeholder="example@test.com/.co.id" class="form-control" required>
						<p class="text text-warning">*Email akan digunakan untuk login sebagai admin.</p>
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
						<label>Nomer Telepon</label>
						<input type="text" name="NoTelp" placeholder="0896xxxxxxxx" class="form-control" style="width: 50%" required>
					</div>
					<div class="input-groups">
						<label>Alamat</label>
						<textarea name="Alamat" class="form-control" rows="5" required></textarea>
					</div>
					<div class="input-groups">
						<label>Level</label>
						<select name="Level" class="form-control" style="width: 50%" required>
							<option value="">Pilih Level</option>
							<option value="1">Super User</option>
							<option value="2">Admin</option>
						</select>
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