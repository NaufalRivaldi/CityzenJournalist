<?php 
	include 'koneksi.php';

	$id = $_GET['id'];

	$query = mysqli_query($koneksi, "DELETE FROM tbuser WHERE IdUser = '$id'");

	if($query){
		echo "<script>location.href='tampilUser.php'</script>";
	}else{
		echo "<script>alert('Delete Data Gagal!');location.href='tampilUser.php'</script>";
	}
?>