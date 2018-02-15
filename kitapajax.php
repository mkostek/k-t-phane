<?php
require_once "bag.php";

if($_POST)
{
		$isbn=@$_POST["isbn"];
		$kitapad=@$_POST["kitapad"];
		$sayisi=@$_POST["sayisi"];
		$tur=@$_POST["tur"];
		$yazar=@$_POST["yazar"];
		if(!$isbn||!$kitapad||!$sayisi||!$tur||!$yazar)
		{
				echo "bos alanlar mevcut";
		}
		else
		{
$sql = "insert into kitap(isbnno,kitapadi,sayfasayisi,turno,yazarno) values('".$isbn."','".utf8_encode($kitapad)."',".$sayisi.",".$tur.",".$yazar." ) ";

if ($conn->query($sql) === TRUE) {
    echo " başarı ile eklendi...";
} else {
    echo "hata: " . $sql . " " . $conn->error;
}
		}

}

?>