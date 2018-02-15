<head>
<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "kitap.php";

    }, 1000);
</script>
</head>
<?php

require_once "bag.php";
if($_POST)
{
		$ad=$_POST["yazarad"];
		$soyad=$_POST["yazarsoyad"];
		if(!$ad|!$soyad)
		{
				echo "bos alanlar mevcut";
		}
		else
		{
$sql = "INSERT INTO yazar(yazarad,yazarsoyad) VALUES ('".utf8_encode($ad)."','".utf8_encode($soyad)."')";

if ($conn->query($sql) === TRUE) {
    echo " başarı ile eklendi...<br>";
} else {
    echo "hata: " . $sql . "<br>" . $conn->error;
}
}
}

