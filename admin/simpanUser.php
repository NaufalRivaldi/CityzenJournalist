<?php 
	include 'koneksi.php';

	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Nama = $_POST['Nama'];
	$TglLahir = $_POST['TglLahir'];
	$JK = $_POST['JK'];
	$NoTelp = $_POST['NoTelp'];
	$Alamat = $_POST['Alamat'];

	$query = mysqli_query($koneksi, "INSERT INTO tbuser VALUES('','$Email','$Password','$Nama', '$TglLahir', '$JK', '$NoTelp','$Alamat')");

	if($query){
		echo "<script>location.href='tampilUser.php'</script>";
	}else{
		echo "<script>alert('Input Data Gagal!');location.href='tampilUser.php'</script>";
	}
?>