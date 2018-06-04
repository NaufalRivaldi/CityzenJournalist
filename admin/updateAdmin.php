<?php 
	include 'koneksi.php';

	$IdAdmin = $_POST['IdAdmin'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Nama = $_POST['Nama'];
	$NoTelp = $_POST['NoTelp'];
	$Alamat = $_POST['Alamat'];
	$Level = $_POST['Level'];

	$query = mysqli_query($koneksi, "UPDATE tbadmin SET Email = '$Email', Password = '$Password', Nama = '$Nama', NoTelp = '$NoTelp', Alamat = '$Alamat', Level = '$Level' WHERE IdAdmin = '$IdAdmin'");

	if($query){
		echo "<script>location.href='tampilAdmin.php'</script>";
	}else{
		echo "<script>alert('Update Data Gagal!');location.href='tampilAdmin.php'</script>";
	}
?>