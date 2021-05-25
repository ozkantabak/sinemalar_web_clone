<?php 
function resim_yukle($resim){
	$target_dir = "resim/";
	$target_file = $target_dir . basename($resim["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	if(isset($_POST["submit"])) {
		$check = getimagesize($resim["tmp_name"]);
		if($check !== false) {
			echo "Bu bir resim dosyası. - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "Bu bir resim dosyası değil.";
			$uploadOk = 0;
		}
	}
	if (file_exists($target_file)) {
		echo "Üzgünüz, dosya zaten var.";
		$uploadOk = 0;
			return $target_file;
	}
	if ($resim["size"] > 500000) {
		echo "Üzgünüz, dosyanız çok büyük.";
		$uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Üzgünüz, sadece JPG, JPEG, PNG & GIF dosyalarına izin veriliyor.";
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo "Üzgünüz, dosyanız yüklenmedi.";
	} else {
		if (move_uploaded_file($resim["tmp_name"], $target_file)) {
			echo "Dosyanız ". basename( $resim["name"]). " yüklendi.";
			return $target_file;
		} else {
			echo "Maalesef, dosyanızı yüklerken bir hata oluştu.";
		}
	}
}
 ?>