<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="sitil.css">
<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "islem.php";

    }, 1000);
</script>
</head>
<?php
require_once "bag.php";
if($_POST)
{
		$kitap=$_POST["kitap"];
		$ogrenci=$_POST["ogrenci"];
		if(!$kitap||!$ogrenci)
		{
				echo "bos alanlar mevcut";
		}
		else
		{
			$date=date("Y-m-d");
			$date=date_parse($date);
			if($date["day"]+20>28)
			{
				$date["month"]++;
				$date["day"]=($date["day"]+20)%27+1;
			}
			else $date["day"]=$date["day"]+20;
			$string=$date["year"]."-".$date["month"]."-".$date["day"];
			echo $string;
				$sql = "INSERT INTO islem(ogrno,kitapno,atarih,vtarih,alindi) VALUES (".$ogrenci.",".$kitap.",NOW(),'".$string."',0)";

				if ($conn->query($sql) === TRUE) {
					echo "islem başarı ile gerçekleşti...<br>İşlem sayfasına yönledirliyorsunuz....";
				} else {
					echo "hata: " . $sql . "<br>" . $conn->error;
				}	
}
}