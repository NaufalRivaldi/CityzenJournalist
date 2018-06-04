<?php 
	include 'koneksi.php';

	$id = $_GET['id'];
	$query = mysqli_query($koneksi, "UPDATE tbberita set Pengesahan = 'OK' WHERE IdBerita = '$id'");

	if($query){
		echo "
		<script>alert('Konten di Acc.'); location.href='tampilKonten.php'</script>
		";
	}else{
		echo "
		<script>alert('Gagal.'); location.href='tampilKonten.php'</script>
		";
	}
?>