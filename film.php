<?php 
include "header.php"; 
include 'vt_baglanti.php';
global $baglan;
if(!$baglan){
	die("Connection failed: " . mysqli_connect_error());
}
else{
if (session_status() == PHP_SESSION_NONE)
	session_start();
	$begeni_btn=false;
	$begenenler=array();
	if(isset($_SESSION["kId"])){
		$sql = "SELECT * FROM film_begeni WHERE begenen_id=".$_SESSION["kId"]." and film_id=".$_GET['id'];
		$result = mysqli_query($baglan,$sql);
		if($result->num_rows>0){
			$begeni_btn=true;
		}
		else{
			$begeni_btn=false;
		}
	}
	$sql = "SELECT u.id, u.kadi FROM film_begeni as b left join uyeler as u on u.id=b.begenen_id WHERE film_id=".$_GET['id'];
	$result = mysqli_query($baglan,$sql);
	if($result->num_rows>0){
		$i=0;
		while($row=$result->fetch_assoc()){
			$begenenler[$i]["id"]=$row["id"];
			$begenenler[$i]["kadi"]=$row["kadi"];
			$i++;
		}
	}
	$film_dizi=array();
	$sql = "SELECT * FROM filmler where id=".$_GET["id"];
	$result = $baglan->query($sql);
	if($result->num_rows>0){
		$film_dizi=$result->fetch_assoc();
	}else{
		echo "0 results";
	}
	$yorum_dizi=array();
	$i=0;
	$sql = "SELECT y.id, u.kadi, y.yorum_icerik, y.yorum_tarih FROM film_yorum as y left join uyeler as u on y.yorum_yazan=u.id where yorum_film_id=".$_GET["id"];
	$result = $baglan->query($sql);
	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){
			$yorum_dizi[$i]["id"]=$row["id"];
			$yorum_dizi[$i]["kadi"]=$row["kadi"];
			$yorum_dizi[$i]["yorum_icerik"]=$row["yorum_icerik"];
			$yorum_dizi[$i]["yorum_tarih"]=$row["yorum_tarih"];
			$i++;
		}
	}
	if(isset($_POST["btn_yorum"])){
		
		$dbFormat = date('Y-m-d H:i:s');
		$sql = "INSERT INTO film_yorum (yorum_yazan, yorum_film_id, yorum_icerik, yorum_tarih)
		VALUES (".$_SESSION["kId"].", '".$_GET['id']."', '".$_POST["yorum"]."','".$dbFormat."')";

		if (mysqli_query($baglan, $sql)) {
			echo "<script>alert('Yorumunuz başarıyla eklendi. " .$dbFormat."');</script>";
			
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($baglan);
		}
		mysqli_close($baglan);
	}
	if(isset($_POST["begen"])){
		
		$sql = "INSERT INTO film_begeni (begenen_id, film_id)
		VALUES (".$_SESSION["kId"].", ".$_GET['id'].")";

		if (mysqli_query($baglan, $sql)) {
			echo "<script>alert('Begendin');</script>";
			
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($baglan);
		}
		mysqli_close($baglan);
	}
	if(isset($_POST["begenme"])){
		$sql = "DELETE FROM film_begeni WHERE begenen_id=".$_SESSION["kId"]." and film_id=".$_GET['id'];

		if (mysqli_query($baglan, $sql)) {
			echo "<script>alert('Begeni kaldırıldı');</script>";
		} else {
			echo "Error deleting record: " . mysqli_error($baglan);
		}
		mysqli_close($baglan);
	}
}
?>
    <div class="orta wid50">
        <h1>Film Adı</h1>
        <div class="fragmanVideo">
		<?php echo $film_dizi['film_video']; ?>
        </div>
        <div class="detay">
            <div class="detaySol">
                <img src="<?php echo $film_dizi['film_resim']; ?>">
            </div>
            <div class="detaySag">
                <div>
                    <div>Tür</div>
                    <div><?php echo $film_dizi['film_tur'] ?></div>
                </div>
                <div>
                    <div>Vizyon Tarihi</div>
                    <div><?php echo $film_dizi['vizyon_tarih']; ?></div>
                </div>
            </div>
        </div>
        <div class="konu">
            <div>Film Konusu</div>
            <div><?php echo $film_dizi['film_aciklama']; ?></div>
        </div>
			<div class="begeni">
			<form method="post">
			<?php if(isset($_SESSION["kId"]) && $begeni_btn){
				echo '<input type="submit" class="btnBegen kirmizi" name="begenme" value="Beğen">';
			}else if(isset($_SESSION["kId"])){
				echo '<input type="submit" class="btnBegen" name="begen" value="Beğen">';
			}?>
			</form>
			<?php for($i=0;$i<count($begenenler);$i++){
				if($i==0)
					echo "Beğenenler: ";
				echo $begenenler[$i]["kadi"];
				if($i!=count($begenenler)-1)
					echo ", ";
			}?>
			</div>
            <div class="yorumlar">
                <h2>Yorumlar</h2>
                <form method="POST">
                    <textarea placeholder="Yorum Yap..." name="yorum"></textarea>
                    <input type="submit" name="btn_yorum">
                </form>
                <div class="yorumlarListe">
                    <ul>
					<?php
					for($i=0;$i<count($yorum_dizi);$i++){
						echo '
                        <li>
                            <div>'.$yorum_dizi[$i]["kadi"].'</div>
                            <div>'.$yorum_dizi[$i]["yorum_tarih"].'</div>
                            <div>'.$yorum_dizi[$i]["yorum_icerik"].'</div>
                        </li>';
					}
					?>
                    </ul>
                </div>
            </div>
    </div>
<?php include "footer.php"?>