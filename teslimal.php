<head>
<script>
window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "index.php";

    }, 1000);
</script>
</head>
<?php 
require_once("bag.php");
$islemno=$_GET["id"];
$sql="update islem set alindi=1,vtarih=NOW() where islemno=".$islemno."";
if ($conn->query($sql) === TRUE) {
					echo "Kyaıt başarı ile güncellendi...<br>Anasayfaya yönlendiriliyorsunuz...";
				} else {
					echo "hata: " . $sql . "<br>" . $conn->error;
				}	

?>