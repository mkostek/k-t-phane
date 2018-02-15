-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 15 Şub 2018, 16:42:41
-- Sunucu sürümü: 5.7.17
-- PHP Sürümü: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `kutuphane`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `islem`
--

CREATE TABLE `islem` (
  `islemno` int(11) NOT NULL,
  `atarih` date NOT NULL,
  `vtarih` date NOT NULL,
  `ogrno` int(11) NOT NULL,
  `kitapno` int(11) NOT NULL,
  `alindi` bit(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `islem`
--

INSERT INTO `islem` (`islemno`, `atarih`, `vtarih`, `ogrno`, `kitapno`, `alindi`) VALUES
(1, '2018-02-07', '2018-02-11', 3, 3, b'1'),
(2, '2018-02-08', '2018-02-11', 3, 1, b'1'),
(3, '2018-02-08', '2018-02-27', 5, 5, b'0'),
(4, '2018-02-11', '2018-03-05', 3, 3, b'0'),
(5, '2018-02-11', '2018-03-05', 6, 1, b'0'),
(6, '2018-02-11', '2018-02-11', 7, 10, b'1'),
(7, '2018-02-11', '2018-03-05', 5, 11, b'0'),
(8, '2018-02-11', '2018-03-05', 1, 13, b'0'),
(9, '2018-02-12', '2018-03-06', 8, 47, b'0'),
(10, '2018-02-12', '2018-03-06', 9, 42, b'0');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitap`
--

CREATE TABLE `kitap` (
  `kitapno` int(11) NOT NULL,
  `kitapadi` varchar(50) NOT NULL,
  `isbnno` varchar(30) CHARACTER SET latin5 NOT NULL,
  `sayfasayisi` int(11) NOT NULL,
  `yazarno` int(11) NOT NULL,
  `turno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kitap`
--

INSERT INTO `kitap` (`kitapno`, `kitapadi`, `isbnno`, `sayfasayisi`, `yazarno`, `turno`) VALUES
(14, 'sevginin katÃ„Â±ksÃ„Â±zÃ„Â±', '52654623', 333, 13, 7),
(15, 'arafatta bir ÃƒÂ§ocuk', '68421234354', 155, 14, 7),
(16, 'Bin MuhteÃ…ÂŸem GÃƒÂ¼neÃ…ÂŸ', '4121242335', 451, 15, 7),
(17, 'Metal FÃ„Â±rtÃ„Â±na-1', '446541326', 265, 16, 1),
(18, 'Beyaz DiÃ…ÂŸ', '36521542', 274, 13, 7),
(19, 'Sineklerin tanrÃ„Â±sÃ„Â±', '8934658455', 187, 17, 7),
(20, 'GÃƒÂ¼n olur asra bedel', '84524135432', 487, 18, 7),
(21, 'kassandra damgasÃ„Â±', '5145465451', 321, 18, 7),
(22, 'beyaz gardenya', '486542114', 654, 19, 7),
(23, 'psikopat', '44546874621', 444, 20, 1),
(24, 'SÃ„Â±cak Buz', '342356765', 444, 21, 1),
(25, 'Jerusalem', '453645235', 222, 22, 7),
(26, 'GÃƒÂ¶nÃƒÂ¼l meselesi', '586946554', 198, 23, 1),
(27, 'Kendi kutup yÃ„Â±ldÃ„Â±zÃ„Â±nÃ„Â± bul 1', '89456354536', 444, 24, 1),
(28, 'DÃƒÂ¼nyanÃ„Â±n ilk gÃƒÂ¼nÃƒÂ¼', '56151563468', 555, 25, 1),
(29, 'insan ne ile yaÃ…ÂŸar?', '5452314533', 188, 26, 7),
(30, 'SimyacÃ„Â±', '545254524', 188, 27, 7),
(31, 'beyaz gemi', '545254524', 222, 18, 7),
(32, 'metal fÃ„Â±rtÃ„Â±na 4', '3244354534', 256, 28, 1),
(33, 'metal fÃ„Â±rtÃ„Â±na 3', '56556345', 256, 28, 1),
(34, 'metal fÃ„Â±rtÃ„Â±na 2', '6767445345', 333, 28, 1),
(35, 'Asla vazgecme', '586398498', 456, 29, 7),
(36, 'Asla Arkana bakma', '3435464565', 333, 30, 1),
(37, 'Dava', '46564332453', 244, 31, 7),
(38, 'Veda', '1235465456', 444, 32, 1),
(39, 'KÃƒÂ¶prÃƒÂ¼', '1235465456', 388, 32, 7),
(40, 'bab-Ã„Â± esrar', '321454464', 456, 33, 1),
(41, 'kavim', '321454464', 555, 33, 1),
(42, 'Dijital kale', '5465453', 444, 34, 1),
(43, 'Bir ekonomik tetikÃƒÂ§inin itiraflarÃ„Â±', '45645787', 344, 35, 1),
(44, 'UÃƒÂ§urtma avcÃ„Â±sÃ„Â±', '564564356', 555, 15, 7),
(45, 'olasÃ„Â±lÃ„Â±ksÃ„Â±z', '456345324534', 444, 36, 7),
(46, 'ÃƒÂ§Ã„Â±plak ayaklÃ„Â±ydÃ„Â± gece', '456345324534', 168, 33, 7),
(47, 'bir ses bÃƒÂ¶ler geceyi', '12135454', 155, 33, 7),
(48, 'insan ruhunun haritasÃ„Â±', '546564564565', 188, 33, 7);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ogrenci`
--

CREATE TABLE `ogrenci` (
  `ogrno` int(11) NOT NULL,
  `ograd` varchar(30) NOT NULL,
  `ogrsoyad` varchar(30) NOT NULL,
  `dtarih` date NOT NULL,
  `sinif` tinyint(4) NOT NULL,
  `puan` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ogrenci`
--

INSERT INTO `ogrenci` (`ogrno`, `ograd`, `ogrsoyad`, `dtarih`, `sinif`, `puan`) VALUES
(8, 'mustafa', 'kocacenk', '1993-05-05', 9, 0),
(9, 'mustafa', 'kÃƒÂ¶stek', '1993-05-09', 9, 0),
(10, 'Ã…ÂŸÃƒÂ¼krÃƒÂ¼', 'ergÃƒÂ¼ntop', '1993-06-09', 9, 0),
(11, 'ibrahim ali', 'metin', '1993-07-08', 9, 0),
(12, 'ahmet', 'hamdi', '1993-03-02', 9, 0),
(13, 'ayberk nartan', 'aÃ…ÂŸkÃ„Â±n', '1993-03-02', 9, 0),
(14, 'yusuf', 'borucu', '1993-03-02', 9, 0),
(15, 'yusuf', 'ÃƒÂ¶nder', '1993-03-02', 10, 0),
(16, 'mehmet', 'adÃ„Â±var', '1993-03-02', 10, 0),
(17, 'tayfun', 'tuncay', '1993-03-02', 10, 0),
(18, 'niyazi', 'ÃƒÂ¶zsoy', '1993-03-02', 10, 0),
(19, 'vehbi', 'koÃƒÂ§', '1993-03-02', 10, 0),
(20, 'zinedine', 'zidane', '1993-03-02', 11, 0),
(21, 'zubi', 'zaretta', '1993-03-02', 11, 0),
(22, 'milan', 'rapaic', '1993-03-02', 11, 0),
(23, 'Goran', 'pandev', '1993-03-02', 11, 0),
(24, 'abedi', 'pele', '1993-03-02', 12, 0),
(25, 'johan', 'cruyff', '1993-03-02', 12, 0),
(26, 'Ã…ÂŸÃƒÂ¼krÃƒÂ¼', 'saraÃƒÂ§oÃ„ÂŸlu', '1993-03-02', 12, 0),
(27, 'abdi', 'ipekÃƒÂ§i', '1993-03-02', 12, 0),
(28, 'lefter', 'kÃƒÂ¼ÃƒÂ§ÃƒÂ¼kantonyadis', '1993-03-02', 12, 0),
(29, 'alex', 'de Souza', '1993-03-02', 12, 0),
(30, 'Moussa', 'Sow', '1993-03-02', 12, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `tur`
--

CREATE TABLE `tur` (
  `turno` int(11) NOT NULL,
  `turadi` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `tur`
--

INSERT INTO `tur` (`turno`, `turadi`) VALUES
(1, 'aksiyon polisiye'),
(2, 'bilim kurgu'),
(6, 'fantastik'),
(7, 'roman');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `yazar`
--

CREATE TABLE `yazar` (
  `yazarno` int(11) NOT NULL,
  `yazarad` varchar(30) NOT NULL,
  `yazarsoyad` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `yazar`
--

INSERT INTO `yazar` (`yazarno`, `yazarad`, `yazarsoyad`) VALUES
(13, 'jack ', 'london'),
(14, 'zÃƒÂ¼lfÃƒÂ¼', ' livaneli'),
(15, 'khaled', ' hosseini'),
(16, 'Burak', 'Turna'),
(17, 'William ', 'Golding'),
(18, 'Cengiz', 'Aytmatov'),
(19, 'belinda', 'alexandra'),
(20, 'Keith ', 'ablow'),
(21, 'Nora ', 'Roberts'),
(22, 'Markar', 'Eseyan'),
(23, 'Tuna', 'KiremitÃƒÂ§i'),
(24, 'NÃƒÂ¼vide GÃƒÂ¼ltunca', ' Tulgar'),
(25, 'BeyazÃ„Â±t', 'Akman'),
(26, 'Lev', ' tolstoy'),
(27, 'Paulo', 'Coelho'),
(28, 'Orkun ', 'uÃƒÂ§ar'),
(29, 'Harlan', 'Coben'),
(30, 'Tess ', 'Gerritsen'),
(31, 'Franz', 'Kafka'),
(32, 'AyÃ…ÂŸe ', 'Kulin'),
(33, 'ahmet', 'ÃƒÂ¼mit'),
(34, 'Dan ', 'Brown'),
(35, 'John', 'Perkins'),
(36, 'adam', 'fawer');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `islem`
--
ALTER TABLE `islem`
  ADD PRIMARY KEY (`islemno`);

--
-- Tablo için indeksler `kitap`
--
ALTER TABLE `kitap`
  ADD PRIMARY KEY (`kitapno`);

--
-- Tablo için indeksler `ogrenci`
--
ALTER TABLE `ogrenci`
  ADD PRIMARY KEY (`ogrno`);

--
-- Tablo için indeksler `tur`
--
ALTER TABLE `tur`
  ADD PRIMARY KEY (`turno`);

--
-- Tablo için indeksler `yazar`
--
ALTER TABLE `yazar`
  ADD PRIMARY KEY (`yazarno`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `islem`
--
ALTER TABLE `islem`
  MODIFY `islemno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Tablo için AUTO_INCREMENT değeri `kitap`
--
ALTER TABLE `kitap`
  MODIFY `kitapno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- Tablo için AUTO_INCREMENT değeri `ogrenci`
--
ALTER TABLE `ogrenci`
  MODIFY `ogrno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- Tablo için AUTO_INCREMENT değeri `tur`
--
ALTER TABLE `tur`
  MODIFY `turno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Tablo için AUTO_INCREMENT değeri `yazar`
--
ALTER TABLE `yazar`
  MODIFY `yazarno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
