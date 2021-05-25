<?php
	include 'vt_baglanti.php';
	global $baglan;

if (!$baglan) {
    die("Kayıt başarısız: " . mysqli_connect_error());
}

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
}
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
		$i++;
		}
}
$baglan->close();
?>
<?php include "header.php"; ?>
<div class="container">
    <div class="orta">
        <div class="vizyon">
            <div class="vizyonBaslik">Vizyondaki Filmler</div>
            <div class="slider">
			
			<?php 
				for($i=0;$i<count($film_dizi);$i++) {
					echo '
                <div class="item">
                    <a href="film.php?id='.$film_dizi[$i]["id"].'">
                        <img src="'.$film_dizi[$i]["film_resim"].'" width="150" height="200">
                    </a>
                </div>';
			}?>
            </div>
        </div>
        <div class="haber">
            <div class="haberBaslik">Sinema Haberleri</div>
            <div class="haber1">
			<?php 
			echo '
                <div>'.$haber_dizi[0]["haber_baslik"].'</div>
                <a href="haber.php?id='.$haber_dizi[0]["id"].'">
                    <img src="'.$haber_dizi[0]["haber_resim"].'">
                </a>';
			?>
            </div> 
            <div class="haber2">	
			<?php 
				for($i=1;$i<count($haber_dizi);$i++) {
					echo '
                <div class="item">
                    <div>
                        <a href="haber.php?id='.$haber_dizi[$i]["id"].'">
                            <img src="'.$haber_dizi[$i]["haber_resim"].'">
                        </a>
                    </div>
                    <div>'.$haber_dizi[$i]["haber_baslik"].'</div>
                </div>';
				}
			?>
            </div>
        </div>
        <div class="liste">
            <div class="listeBaslik">Listeler</div>
            <div class="item">
                <div>
                    <a href="#">
                        <img src="infinity.jpg">
                    </a>
                </div>
                <div></div>
            </div>
            <div class="item">
                <div>
                    <a href="#">
                        <img src="infinity.jpg">
                    </a>
                </div>
                <div></div>
            </div>
            <div class="item">
                <div>
                    <a href="#">
                        <img src="infinity.jpg">
                    </a>
                </div>
                <div></div>
            </div>
            <div class="item">
                <div>
                    <a href="#">
                        <img src="infinity.jpg">
                    </a>
                </div>
                <div></div>
            </div>
        </div>
        <div class="fragman">
            <div class="fragmanBaslik">Fragmanlar</div>
            <div class="item">
                <div>Resim Üzerinde Yazı</div>
                <a href="#">
                    <img src="infinity.jpg">
                </a>
            </div>
            <div class="item">
                <div>Resim Üzerinde Yazı</div>
                <a href="#">
                    <img src="infinity.jpg">
                </a>
            </div>
            <div class="item">
                <div>Resim Üzerinde Yazı</div>
                <a href="#">
                    <img src="infinity.jpg">
                </a>
            </div>
            <div class="item">
                <div>Resim Üzerinde Yazı</div>
                <a href="#">
                    <img src="infinity.jpg">
                </a>
            </div>
        </div>
    </div> 
</div>
<?php include "footer.php"?>