<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kitap Ekleme Sayfası</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" type="text/css" href="si.css">
   <style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
	  
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "bütün itemleri göster" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " isimli item yok" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( ".combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( ".combobox" ).toggle();
    });
    $( "#datepicker" ).datepicker();


  $.kitapekle=function(){
var isbn=$("input[name=isbn]").val();
var kitapad=$("input[name=kitapad]").val();
var sayisi=$("input[name=sayisi]").val();
var tur=$("#tur").val();
var yazar=$("#yazar").val();
if(!isbn||!kitapad||!sayisi||!tur||!yazar)
{
alert("bos alanlar mevcut");
}
else{
var degerler="isbn="+isbn+"&kitapad="+kitapad+"&sayisi="+sayisi+"&tur="+tur+"&yazar="+yazar;
$.ajax({
type:"POST",
url:"kitapajax.php",
data:degerler,
success:function(cevap){alert(cevap);}
});
}
  }
  
  } ); 	
  </script>
</head>
<?php include "linkler.html"; ?>
<form action="" method="post" onclick="return false;">
<div>
<p>isbn no:<input type="text" name="isbn"><br>
kitap adi:<input type="text" name="kitapad"><br>
sayfa sayisi:<input type="text" name="sayisi"><br>

<?php

include 'bag.php'; 	
$sql = "SELECT * FROM  tur";
$result = $conn->query($sql);
echo 'kitap türünü seçiniz:<select id="tur" class="combobox" name="tur">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row["turno"].">".$row["turadi"]."</option>";
    }
} 
    echo "</select><br>";
	
	$sql = "SELECT * FROM  yazar";
$result = $conn->query($sql);
echo 'yazarı seçiniz:<select id="yazar" class="combobox" name="yazar">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row["yazarno"].">".utf8_decode($row["yazarad"])." ".utf8_decode($row["yazarsoyad"])."</option>";
    }
} 
    echo "</select><br>";
	
	?>
<br>
<button onclick="$.kitapekle()">kitap ekle</button></div>
</form>
<form action="yazarekle.php" method="post">
<div><h3>Yazar listede yoksa buradan ekeleyebilirsiniz...</h3>
yazar adı:<input type="text" name="yazarad"><br>
yazar soyadi:<input type="text" name="yazarsoyad">
<input type="submit" value="yazar ekle" /></div>
</form>

