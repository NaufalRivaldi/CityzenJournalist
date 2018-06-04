<?php 
	include 'admin/koneksi.php';

	$id = $_GET['id'];

	function unlinkGambar($id, $koneksi){
		$queryNama = mysqli_query($koneksi, "SELECT NamaGambar FROM tbgambar where IdGambar='$id'");
		$data = mysqli_fetch_array($queryNama);
		$namaGambar = $data[0];
		
		unlink("img/upload/$namaGambar");
		return true;
	}

	if(unlinkGambar($id, $koneksi)){
		mysqli_query($koneksi, "DELETE FROM tbgambar where IdGambar = '$id'");
		echo "
		<script>location.href='editBerita.php'</script>
		";
	}
?>