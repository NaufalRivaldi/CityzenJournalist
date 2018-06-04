<?php 
	include 'koneksi.php';

	$IdUser = $_POST['IdUser'];
	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Nama = $_POST['Nama'];
	$TglLahir = $_POST['TglLahir'];
	$JK = $_POST['JK'];
	$NoTelp = $_POST['NoTelp'];
	$Alamat = $_POST['Alamat'];

	$query = mysqli_query($koneksi, "UPDATE tbuser SET Email = '$Email', Password = '$Password', Nama = '$Nama', TglLahir = '$TglLahir', JK = '$JK', NoTelp = '$NoTelp', Alamat = '$Alamat' WHERE IdUser = '$IdUser'");

	if($query){
		echo "<script>location.href='tampilUser.php'</script>";
	}else{
		echo "<script>alert('Update Data Gagal!');location.href='tampilUser.php'</script>";
	}
?>