<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Öğrenci Ekleme Sayfası</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="sitil.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();

$.ogrekle=function(){
var ad=$("input[name=ograd]").val();
ad=$.trim(ad);
var soyad=$("input[name=ogrsoyad]").val();
soyad=$.trim(soyad);
 var dateTypeVar = $('#datepicker').datepicker('getDate');
      var tarih= $.datepicker.formatDate('yy-mm-dd', dateTypeVar);
tarih=$.trim(tarih);
var sınıf=$("input[name=sınıf]").val();
sınıf=$.trim(sınıf);
if(!ad||!soyad||!tarih||!sınıf)
{
alert("bos alanlar mevcut");
}
else{
var degerler="ograd="+ad+"&ogrsoyad="+soyad+"&dtarih="+tarih+"&sınıf="+sınıf;
$.ajax({
type:"POST",
url:"ogrenciajax.php",
data:degerler,
success:function(cevap){alert(cevap);}
});
}
  } } ); 	
  </script>
</head>
<?php include "linkler.html";  ?>
<form action="" method="post" onclick="return false;">
<div><p>
<br>ogrenci adi:<input type="text" name="ograd"><br>
ogrenci soyadi:<input type="text" name="ogrsoyad"><br>
sınıfını giriniz:<input type="text" name="sınıf"><br>
doğum tarihini giriniz:<input type="text" name="dtarih"  id="datepicker"><br>
<button onclick="$.ogrekle()">ekle</button></p></div>
</form>

