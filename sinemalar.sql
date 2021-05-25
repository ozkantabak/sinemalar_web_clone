-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 17 May 2018, 22:33:55
-- Sunucu sürümü: 10.1.31-MariaDB
-- PHP Sürümü: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `sinemalar`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `begeni`
--

CREATE TABLE `begeni` (
  `id` int(11) NOT NULL,
  `haber_id` int(11) NOT NULL,
  `begenen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `begeni`
--

INSERT INTO `begeni` (`id`, `haber_id`, `begenen_id`) VALUES
(6, 9, 30),
(8, 7, 27),
(9, 9, 27),
(10, 7, 30);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filmler`
--

CREATE TABLE `filmler` (
  `id` int(11) NOT NULL,
  `film_adi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `film_aciklama` text COLLATE utf8_turkish_ci NOT NULL,
  `film_resim` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `film_video` varchar(500) COLLATE utf8_turkish_ci NOT NULL,
  `film_tur` varchar(100) COLLATE utf8_turkish_ci NOT NULL,
  `vizyon_tarih` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `filmler`
--

INSERT INTO `filmler` (`id`, `film_adi`, `film_aciklama`, `film_resim`, `film_video`, `film_tur`, `vizyon_tarih`) VALUES
(2, 'infinity war heyyoooo', 'qkwdoıqğwdıqodıw', 'resim/infinity.jpg', '<iframe width=\"854\" height=\"480\" src=\"https://www.youtube.com/embed/gQrkvZeE3Uc\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', '', '0000-00-00'),
(4, 'qwdqwd', 'dqwdqdw', 'resim/taksi-5.jpg', '', '', '0000-00-00'),
(5, 'Kurtlar Vadisi Irak', 'Harika bir film', 'resim/23-nisan-.jpg', '<iframe width=\"854\" height=\"480\" src=\"https://www.youtube.com/embed/_7vyMqD1EmI\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen></iframe>', 'Aksiyon', '2006-01-10');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `film_begeni`
--

CREATE TABLE `film_begeni` (
  `id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `begenen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `film_begeni`
--

INSERT INTO `film_begeni` (`id`, `film_id`, `begenen_id`) VALUES
(1, 2, 30);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `film_yorum`
--

CREATE TABLE `film_yorum` (
  `id` int(11) NOT NULL,
  `yorum_yazan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_film_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_tarih` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `film_yorum`
--

INSERT INTO `film_yorum` (`id`, `yorum_yazan`, `yorum_film_id`, `yorum_icerik`, `yorum_tarih`) VALUES
(1, '30', '2', 'bu bir yourmdur', '2018-05-17 21:56:42');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `haberler`
--

CREATE TABLE `haberler` (
  `id` int(11) NOT NULL,
  `haber_baslik` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `haber_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `haber_resim` varchar(500) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `haberler`
--

INSERT INTO `haberler` (`id`, `haber_baslik`, `haber_icerik`, `haber_resim`) VALUES
(7, 'haber başlık', 'haber içerik', 'resim/infinity.jpg'),
(9, 'haber başlık 2', 'qweqew', 'resim/infinity.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE `uyeler` (
  `id` int(11) NOT NULL,
  `kadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`id`, `kadi`, `pass`, `mail`) VALUES
(30, 'ozkntbk', '123456', 'ozkntbk@gmail.com');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yorumlar`
--

CREATE TABLE `yorumlar` (
  `id` int(11) NOT NULL,
  `yorum_yazan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_konu_id` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `yorum_icerik` text COLLATE utf8_turkish_ci NOT NULL,
  `yorum_tarih` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `yorumlar`
--

INSERT INTO `yorumlar` (`id`, `yorum_yazan`, `yorum_konu_id`, `yorum_icerik`, `yorum_tarih`) VALUES
(15, '30', '9', 'asddqwdqdwqdw', '2018-05-16 23:53:20'),
(16, '30', '7', 'bu bir yorumdur', '2018-05-16 23:54:02'),
(17, '30', '7', 'Yorum deneme', '2018-05-17 17:45:54'),
(18, '30', '7', 'Yorumsuz', '2018-05-17 17:46:38');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `begeni`
--
ALTER TABLE `begeni`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `filmler`
--
ALTER TABLE `filmler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `film_begeni`
--
ALTER TABLE `film_begeni`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `film_yorum`
--
ALTER TABLE `film_yorum`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `haberler`
--
ALTER TABLE `haberler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `yorumlar`
--
ALTER TABLE `yorumlar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `begeni`
--
ALTER TABLE `begeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `filmler`
--
ALTER TABLE `filmler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `film_begeni`
--
ALTER TABLE `film_begeni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `film_yorum`
--
ALTER TABLE `film_yorum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `haberler`
--
ALTER TABLE `haberler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Tablo için AUTO_INCREMENT değeri `yorumlar`
--
ALTER TABLE `yorumlar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
