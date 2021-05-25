<?php 
include 'vt_baglanti.php';
global $baglan;
if(!$baglan){
	die("Connection failed: " . mysqli_connect_error());
}
else{
	$film_dizi=array();
	$i=0;
	$sql = "SELECT * FROM filmler";
	$result = $baglan->query($sql);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
			$film_dizi[$i]["id"]=$row["id"];
			$film_dizi[$i]["film_adi"]=$row["film_adi"];
			$film_dizi[$i]["film_aciklama"]=$row["film_aciklama"];
			$film_dizi[$i]["film_resim"]=$row["film_resim"];
			$film_dizi[$i]["film_video"]=$row["film_video"];
			$film_dizi[$i]["film_tur"]=$row["film_tur"];
			$film_dizi[$i]["vizyon_tarih"]=$row["vizyon_tarih"];
			$i++;
			}
	}else{
		echo "0 results";
	}
	if(isset($_POST["film_ekle"])) {
		include 'resim_yukle.php';
		$film_resim=resim_yukle($_FILES["resim"]);
		if($baglan){
			$sql = "INSERT INTO filmler (film_adi, film_aciklama, film_resim, film_video, film_tur, vizyon_tarih)
			VALUES ('".$_POST['film_adi']."', '".$_POST['film_aciklama']."', '".$film_resim."', '".$_POST['film_video']."', '".$_POST['film_tur']."', '".$_POST['vizyon_tarih']."')";

			if (mysqli_query($baglan, $sql)) {
				echo "Film başarıyla eklendi.";
			} else {
				echo "Error: " . $sql . "<br>" . mysqli_error($baglan);
			}
			mysqli_close($baglan);
		}
		else{
			die("Connection failed: " . mysqli_connect_error());
		}
		
	}
	if(isset($_POST["sil"])){
		if($baglan){
			// sql to delete a record
			$sql = "DELETE FROM filmler WHERE id=".$_POST["film_id"];

			if (mysqli_query($baglan, $sql)) {
				echo "Film başarıyla silindi.";
			} else {
				echo "Error deleting record: " . mysqli_error($baglan);
			}
			mysqli_close($baglan);
		}
		else{
			die("Connection failed: " . mysqli_connect_error());
		}
	}
}
 ?>
<html>
<head>
    <title>Home</title>
    <link href="styles.css" rel="stylesheet">
</head>
<body>
<form method="Post" style="width:500px;" enctype="multipart/form-data">
	<div class="form-element">
		<label>Film Adı</label>
		<input type="text" name="film_adi">
	</div>
	<div class="form-element">
		<label>Film Açıklama</label>
		<textarea name="film_aciklama"></textarea>
	</div>
	<div class="form-element">
		<label>Film Resim</label>
		<input type="file" name="resim" id="resim">
	</div>
	<div class="form-element">
		<label>Film Video Url</label>
		<input type="text" name="film_video">
	</div>
	<div class="form-element">
		<label>Film Türü</label>
		<input type="text" name="film_tur">
	</div>
	<div class="form-element">
		<label>Vizyon Tarihi</label>
		<input type="date" name="vizyon_tarih">
	</div>
	<div class="form-element">
		<input type="submit" name="film_ekle" value="Ekle">
	</div>
</form>
<table border="1" cellpadding="5">
	<tr>
		<td>Id</td>
		<td>Adı</td>
		<td>Açıklama</td>
		<td>Resim</td>
		<td>Video</td>
		<td>Türü</td>
		<td>Tarihi</td>
		<td>işlem</td>
	</tr>
	<?php 
	for($i=0;$i<count($film_dizi);$i++){
	echo "<tr>
		<td>".$film_dizi[$i]['id']."</td>
		<td>".$film_dizi[$i]['film_adi']."</td>
		<td>".$film_dizi[$i]['film_aciklama']."</td>
		<td>".$film_dizi[$i]['film_resim']."</td>
		<td>".$film_dizi[$i]['film_video']."</td>
		<td>".$film_dizi[$i]['film_tur']."</td>
		<td>".$film_dizi[$i]['vizyon_tarih']."</td>
		<td>
		<form method='post'>
		<input type='hidden' name='film_id' value='".$film_dizi[$i]['id']."'>
		<input type='submit' name='sil' value='Sil'>
		</form>
		</td>
	</tr>";
	}
	?>
	
</table>
    <script src="scripts.js"></script>
</body>
</html>