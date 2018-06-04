<?php 
	session_start();
	include 'admin/koneksi.php';
	if(empty($_SESSION['IdUser'])){
		echo "<script>location.href='index.php'</script>";
	}else{
		$IdUser = $_SESSION['IdUser'];
	}

	//function
	function IdBerita($koneksi){
		$queryall = mysqli_query($koneksi, "SELECT * FROM tbberita");
		$row = mysqli_num_rows($queryall);
		$idxLimit = $row - 1;
		$query = mysqli_query($koneksi, "SELECT IdBerita FROM tbberita LIMIT $idxLimit, 1");
		$data = mysqli_fetch_array($query);

		return $data[0];
	}

	function cekGambar($nFoto, $tFoto, $loc){
		if(isset($nFoto)){
			if(cekExt($nFoto)){
				if(sameFile($loc)){
					echo '
					<script>
						alert("Nama File sama! Ubah nama File Gambar.");
						location.href="uploadKonten.php";
					</script>
					';	
				}
			}else{
				echo '
				<script>
					alert("Jenis file harus JPEG, JPG, atau PNG");
					location.href="uploadKonten.php";
				</script>
				';
			}
		}else{
			//tidak ada
		}
	}

	function cekExt($nFoto){
		$ext = strtolower(pathinfo($nFoto, PATHINFO_EXTENSION));
		$allowed = array('jpg','jpeg','png');
		if(in_array($ext, $allowed)){
			return true;
		}else{
			return false;
		}
	}

	function sameFile($loc){
		if(file_exists($loc)){
			return true;
		}else{
			return false;
		}
	}

	function uploadFoto($nFoto, $tFoto, $loc, $IdBerita, $koneksi){
		move_uploaded_file($tFoto, $loc);
		mysqli_query($koneksi, "INSERT INTO tbgambar values('','$nFoto','$IdBerita')");
	}

	//main
	$Judul =$_POST['Judul'];
	$Keterangan =$_POST['Keterangan'];
	$Gambar = $_FILES['Gambar']['name'];
	$tGambar = $_FILES['Gambar']['tmp_name'];

	$dir = "img/upload/";

	//cek format dan kesamaan nama file
	for($i=0; $i<count($Gambar); $i++){
		$loc = $dir.$Gambar[$i];
		cekGambar($Gambar[$i], $tGambar[$i], $loc);
	}

	//simpan data berita
	$query = mysqli_query($koneksi, "INSERT INTO tbberita VALUES('','$Judul','$Keterangan',NOW(),'Cek','$IdUser')");
	if($query){
		//uploud gambar
		$IdBerita = IdBerita($koneksi);
		for($i=0; $i<count($Gambar); $i++){
			$loc1 = $dir.$Gambar[$i];
			uploadFoto($Gambar[$i], $tGambar[$i], $loc1, $IdBerita, $koneksi);
		}

		echo "<script>location.href='profile-user.php'</script>";
	}else{
		echo "<script>alert('Input Data Gagal');location.href='profile-user.php'</script>";
	}
?>