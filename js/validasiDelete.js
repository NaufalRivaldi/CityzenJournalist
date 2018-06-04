function valDelete(){
	var msg;
	msg = "Apakah anda yakin ingin menghapus data?";
	var ok = confirm(msg);
	if(ok){
		return true;
	}else{
		return false;
	}
}
