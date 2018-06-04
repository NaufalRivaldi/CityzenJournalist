<?php 
	include 'koneksi.php';

	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Nama = $_POST['Nama'];
	$NoTelp = $_POST['NoTelp'];
	$Alamat = $_POST['Alamat'];
	$Level = $_POST['Level'];

	$query = mysqli_query($koneksi, "insert into tbadmin values('','$Email','$Password','$Nama','$NoTelp','$Alamat','$Level')");

	if($query){
		echo "<script>location.href='tampilAdmin.php'</script>";
	}else{
		echo "<script>alert('Input Data Gagal!');location.href='tampilAdmin.php'</script>";
	}
?>