<?php 
	include 'admin/koneksi.php';

	$Email = $_POST['Email'];
	$Password = $_POST['Password'];
	$Nama = $_POST['Nama'];
	$TglLahir = $_POST['TglLahir'];
	$JK = $_POST['JK'];
	$NoTelp = $_POST['NoTelp'];
	$Alamat = $_POST['Alamat'];

	$sql = "INSERT INTO tbuser VALUES('','$Email','$Password','$Nama', '$TglLahir', '$JK', '$NoTelp','$Alamat')";
	$query = $koneksi->query($sql);

	if($query){
		echo "<script>alert('Email : ".$Email." | Password : ".$Password." anda untuk melakukan login.');location.href='loginPage.php'</script>";
	}else{
		echo "<script>alert('Registrasi gagal!');location.href='index.php.php'</script>";
	}
?>