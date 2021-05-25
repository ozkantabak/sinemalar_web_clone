<?php
include 'vt_baglanti.php';
global $baglan;
    if(isset($_POST["btnKayit"])){
        $kadi = $_POST['kadi'];
        $pass = $_POST['pass'];
        $mail = $_POST['mail'];
        $repass = $_POST['repass'];	
		
        if($pass != $repass){
			
			echo "<script>alert('Şifreler eşleşmiyor!')</script>"; 
		}
		
        else if($kadi == "" || $pass == "" || $mail == ""){
			    
			echo "<script>alert('Lütfen boş alan bırakmayınız!')</script>"; 
        }
		else if(!((strlen($pass)>=6)&&(strlen($pass)<=10))){
			echo "<script>alert('Şifreniz 6 ile 10 karakter uzunluğunda olmalı!')</script>"; 
		}
        else{
			$sql = "SELECT * FROM uyeler where mail='".$mail."'";
			$result1 = mysqli_query($baglan,$sql);
			$sql = "SELECT * FROM uyeler where kadi='".$kadi."'";
			$result2 = mysqli_query($baglan,$sql);
			if($result1->num_rows>0){
				echo "<script>alert('Bu email kullanılıyor')</script>"; 
			}
			else if($result2->num_rows>0){
				echo "<script>alert('Bu kullanıcı adı kullanılıyor')</script>"; 
			}
			else{
				
				$sql = "INSERT INTO uyeler (kadi,pass,mail) VALUES('$kadi','$pass','$mail')";

				if (mysqli_query($baglan, $sql)) {
					
					echo "<script>alert('Yeni kayıt başarıyla oluşturuldu.')</script>"; 
					
				} else {
					
					echo "Error: " . $sql . "<br>" . mysqli_error($baglan);
				}
				mysqli_close($baglan);
			}
        }
    }
	
    if(isset($_POST["btnGiris"])){
        $kadi = $_POST['kadi'];
        $pass = $_POST['pass'];
		
		if($kadi == "" || $pass == "") {
			echo "<script>alert('Lütfen boş alan bırakmayınız!')</script>"; 
		}else{
			
			$kontrol = mysqli_query($baglan,"SELECT * FROM uyeler WHERE kadi = '".$kadi."'and pass='".$pass."'");
			  
			if($par=mysqli_fetch_array($kontrol)){
				
				$gSifre = $par['pass'];
				$gkadi = $par['kadi'];
				$kId = $par['id'];
				if($gSifre == $pass){
				if (session_status() == PHP_SESSION_NONE)
					session_start();
					$_SESSION["kId"] = $kId;
					echo "<script>alert('Giriş başarılı.')</script>"; 
				}
				
				}
				else{ 
					echo "<script>alert('Kullanıcı Adınızı veya Şifrenizi Yanlış Girdiniz!')</script>";
				}
					
				
		}
	}
	
	if(isset($_POST["btnCikis"])){
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		unset($_SESSION["kId"]);
	}
echo '
<html>
<head>
    <title>Home</title>
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="ust">
        <div class="ustPanel">
            <div>
                <a href="index.php">
                    <img src="sinemalarlogo.png">
                </a>
            </div>
            <div>
                <form>
                    <input type="text" placeholder="Ara...">
                    <input type="submit">
                </form>
            </div>
            <div>';
			if (session_status() == PHP_SESSION_NONE)
				session_start();
			if(isset($_SESSION["kId"])){
				echo '<form method="POST"><input type="submit" name="btnCikis" style="border:0; background-color: transparent; color:white;" value="Çıkış"/></form>';
			}
			else {
                echo '<button id="btnGiris" style="border:0; background-color: transparent; color:white;">Giriş</button>
                <button id="btnKayit" style="border:0; background-color: transparent; color:white;">Kayıt Ol</button>';
			}
        echo '</div>
		</div>
    </div>
    <div class="ust">
        <div class="ustPanel">
            <ul>
                <li>
                    <a href="#">Filmler</a>
                </li>
                <li>
                    <a href="#">Yakında</a>
                </li>
                <li>
                    <a href="#">Salonlar</a>
                </li>
                <li>
                    <a href="#">En İyi Filmler</a>
                </li>
                <li>
                    <a href="#">Fragmanlar</a>
                </li>
                <li>
                    <a href="#">Haberler</a>
                </li>
                <li>
                    <a href="#">Listeler</a>
                </li>
                <li>
                    <a href="#">Sinepedi</a>
                </li>
            </ul>
        </div>
    </div>
	
	
	

        <!-- The Modal -->
        <div id="modalGiris" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Üye Girişi</h2>
                </div>
                <div class="modal-body">
                    <form method = "post">
                        <div class="form-element">
                            <label>Kullanıcı Adı</label>
                            <input type="text" name="kadi">
                        </div>
                        <div class="form-element">
                            <label>Parola</label>
                            <input type="password" name="pass">
                        </div>
                        <div class="form-element">
                            <input type="submit" value="Giriş" name="btnGiris">
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div id="modalKayit" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Kayıt Ol</h2>
                </div>
                <div class="modal-body">
                    <form method="post">
                        <div class="form-element">
                            <label>Kullanıcı Adı</label>
                            <input type="text" name="kadi">
                        </div>
                        <div class="form-element">
                            <label>Email</label>
                            <input type="email" name="mail">
                        </div>
                        <div class="form-element">
                            <label>Şifre</label>
                            <input type="password" name="pass">
                        </div>
                        <div class="form-element">
                            <label>Şifre Tekrar</label>
                            <input type="password" name="repass">
                        </div>
                        <div class="form-element">
                            <input type="submit" name="btnKayit" value="Kayıt Ol">
                        </div>
                    </form>
                </div>
            </div>

        </div>
	';

 ?>