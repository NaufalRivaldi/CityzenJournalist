<?php 
	include 'koneksi.php';

	$id = $_GET['id'];

	$queryNamaG = mysqli_query($koneksi, "SELECT NamaGambar FROM tbgambar WHERE IdBerita = '$id'");
	while($data = mysqli_fetch_array($queryNamaG)){
		unlink("../img/upload/$data[0]");
	}

	$queryb = mysqli_query($koneksi, "DELETE FROM tbberita WHERE IdBerita = '$id'");
	$queryg = mysqli_query($koneksi, "DELETE FROM tbgambar WHERE IdBerita = '$id'");

	if($queryb && $queryg){
		echo "<script>location.href='tampilKontenAcc.php'</script>";
	}else{
		echo "<script>alert('Delete Data Gagal!');location.href='tampilKontenAcc.php'</script>";
	}
?>