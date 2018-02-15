<?php
require_once "bag.php";

if($_POST)
{
		$ograd=@$_POST["ograd"];
		$ogrsoyad=@$_POST["ogrsoyad"];
		$dtarih=@$_POST["dtarih"];
		$sinif=@$_POST["sınıf"];
		if(!$ograd||!$ogrsoyad||!$dtarih||!$sinif)
		{
				echo "bos alanlar mevcut";
		}
		else
		{
$sql = "insert into ogrenci(ograd,ogrsoyad,dtarih,sinif,puan) values('".utf8_encode($ograd)."','".utf8_encode($ogrsoyad)."','".$dtarih."',".$sinif.",0) ";

if ($conn->query($sql) === TRUE) {
    echo " başarı ile eklendi...<br>";
} else {
    echo "hata: " . $sql . "<br>" . $conn->error;
}
}

}

?>