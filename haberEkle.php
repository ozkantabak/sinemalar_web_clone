<?php 
include 'vt_baglanti.php';
global $baglan;
if(!$baglan){
	die("Connection failed: " . mysqli_connect_error());
}
else{
	$haber_dizi=array();
	$i=0;
	$sql = "SELECT * FROM haberler";
	$result = $baglan->query($sql);
	if($result->num_rows>0) {
		while($row=$result->fetch_assoc()) {
			$haber_dizi[$i]["id"]=$row["id"];
			$haber_dizi[$i]["haber_baslik"]=$row["haber_baslik"];
			$haber_dizi[$i]["haber_icerik"]=$row["haber_icerik"];
			$haber_dizi[$i]["haber_resim"]=$row["haber_resim"];
			$i++;
			}
	}else{
		echo "0 results";
	}
	if(isset($_POST["haber_ekle"])) {
		include 'resim_yukle.php';
		$haber_resim=resim_yukle($_FILES["resim"]);
		if($baglan){
			$sql = "INSERT INTO haberler (haber_baslik, haber_icerik, haber_resim)
			VALUES ('".$_POST['haber_baslik']."', '".$_POST['haber_icerik']."', '".$haber_resim."')";

			if (mysqli_query($baglan, $sql)) {
				echo "Haber başarıyla eklendi.";
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
			$sql = "DELETE FROM haberler WHERE id=".$_POST["haber_id"];

			if (mysqli_query($baglan, $sql)) {
				echo "Haber başarıyla silindi.";
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
		<label>Haber Başlık</label>
		<input type="text" name="haber_baslik">
	</div>

	<div class="form-element">
		<label>Haber çerik</label>
		<textarea name="haber_icerik"></textarea>
	</div>
	
	<div class="form-element">
		<label>Haber Resim</label>
		<input type="file" name="resim" id="resim">
	</div>
	
	<div class="form-element">
		<input type="submit" name="haber_ekle" value="Ekle">
	</div>
</form>
<table border="1" cellpadding="5">
	<tr>
		<td>Id</td>
		<td>Başlık</td>
		<td>içerik</td>
		<td>Resim</td>
		<td>işlem</td>
	</tr>
	<?php 
	for($i=0;$i<count($haber_dizi);$i++){
	echo "<tr>
		<td>".$haber_dizi[$i]['id']."</td>
		<td>".$haber_dizi[$i]['haber_baslik']."</td>
		<td>".$haber_dizi[$i]['haber_icerik']."</td>
		<td>".$haber_dizi[$i]['haber_resim']."</td>
		<td>
		<form method='post'>
		<input type='hidden' name='haber_id' value='".$haber_dizi[$i]['id']."'>
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