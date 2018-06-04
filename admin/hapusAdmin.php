<?php 
	include 'koneksi.php';

	$id = $_GET['id'];

	$query = mysqli_query($koneksi, "delete from tbadmin where IdAdmin = '$id'");

	if($query){
		echo "<script>location.href='tampilAdmin.php'</script>";
	}else{
		echo "<script>alert('Delete Data Gagal!');location.href='tampilAdmin.php'</script>";
	}
?>