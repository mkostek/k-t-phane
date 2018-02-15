<head>

<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />

</head>
<?php
include 'bag.php';

$q=$_REQUEST["q"];

$sql = "select *from ogrenci where sinif=".$q." ";
$result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row["ogrno"].">".utf8_decode($row["ograd"])." ".utf8_decode($row["ogrsoyad"])."</option>";
    }
	echo "</select>";
	
} 

?>