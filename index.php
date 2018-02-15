<head>
<title>Ödünç Listesi</title>
</head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
	  <link rel="stylesheet" type="text/css" href="sitil.css">
<?php include "linkler.html"; ?>

<form method="post" action=""><div>
Kitap numarası giriniz:<input type="text" name="numara"> 
<input type="submit" value="ara">
</form>
</div>
<?php 

include "bag.php";
if($_POST&&strlen($_POST["numara"])!=0)
$sql = "SELECT
 k.kitapno,k.kitapadi,o.ograd,o.ogrsoyad,o.sinif,i.atarih,i.islemno 
 FROM kitap k,islem i,ogrenci o 
 WHERE k.kitapno=i.kitapno and o.ogrno=i.ogrno and i.alindi=0 and k.kitapno=".$_POST["numara"]."
 order by i.vtarih asc";
else 
$sql = "SELECT
 k.kitapno,k.kitapadi,o.ograd,o.ogrsoyad,o.sinif,i.atarih,i.islemno 
 FROM kitap k,islem i,ogrenci o 
 WHERE k.kitapno=i.kitapno and o.ogrno=i.ogrno and i.alindi=0 
 order by i.vtarih asc";

 $result = $conn->query($sql);

echo "<h1>Dışarıdakiler</h1><div style='overflow-x:auto;'>


<table style='width:75%'>
  <tr>
  <th>kitap numarası</th>
    <th>kitap ad</th>
    <th>ad soyad</th> 
    <th>sınıf</th>
	 <th>alış </th>
    <th>teslim al</th> 
  </tr>";
  
  

  
  
  
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
  echo "<tr>
	<td>" . $row["kitapno"]. "</td>
    <td>" . utf8_decode($row["kitapadi"]). "</td>
    <td>" . utf8_decode($row["ograd"]." ".$row["ogrsoyad"]). " </td> 
    <td>".$row["sinif"]. " </td> 
    <td>".$row["atarih"]." </td>
    <td><a href=teslimal.php?id=".$row["islemno"].">guncelle</a></td>
  </tr>";
    }
} else {
    echo "0 sonuç";
}
echo "</table></div>";
$conn->close();
?>