function jmlGambar(){
	var jml = document.formBerita.Jml.value();
	var i = 1;
	var data = "";
	
	for(i; i<=jml; i++){
		data = "<input type='file' name='Gambar"+i+"' class='form-control'>";
		document.getElementById('#Gambar').innerHTML = data;
	}
}