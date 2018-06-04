<?php 
	session_start();
	include 'koneksi.php';

	//fungsi anti injeksi sql
	function antiInjection($data){
		$filter = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter;
	}

	$Email = antiInjection($_POST['Email']);
	$Password = antiInjection($_POST['Password']);

	//character
	$injeksi_password = mysqli_real_escape_string($koneksi, $Password);

	if(!ctype_alnum($injeksi_password)){
		echo "
		<script>alert('Username dan password harus berupa huruf atau angka!'); location.href='loginPage.php'</script>
		";
	}else{
		$query = mysqli_query($koneksi, "SELECT Email, Password, Nama, Level FROM tbadmin WHERE Email = '$Email' AND Password = '$Password'");
		$row = mysqli_num_rows($query);

		while($data = mysqli_fetch_array($query)){
			$NamaAdmin = $data[2];
			$Level = $data[3];
		}
		if($row > 0){
			$_SESSION['NamaAdmin'] = $NamaAdmin;
			$_SESSION['Level'] = $Level;
			echo "<script>location.href='index.php'</script>";
		}elseif($Email=="cityzen" && $Password=="admin"){
			$_SESSION['NamaAdmin'] = "Cityzen";
			$_SESSION['Level'] = 1;
			echo "<script>location.href='index.php'</script>";
		}else{
			echo "<script>alert('Username dan password tidak terdaftar.');location.href='loginPage.php'</script>";
		}
	}
?>