<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" /><meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Kitap Alma Sayfası</title>
  <link rel="stylesheet" type="text/css" href="sitil.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
  });
  </script>
  </head>
 
<?php include "linkler.html";?>
<form action="" method="post">

<div><h3>Kitap arama sayfası...</h3>
<p>
kitap adı:<input type="text" name="kitapad"><br>
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
	echo "<option value=0>enson</option> </select><br>";
}
    
	
	$sql = "SELECT * FROM  yazar";
$result = $conn->query($sql);
echo 'yazarı seçiniz:<select id="yazar" class="combobox" name="yazar">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row["yazarno"].">".utf8_decode($row["yazarad"])." ".utf8_decode($row["yazarsoyad"])."</option>";
    }
	echo "<option value=0>enson</option></select><br>";
} 
   
	
	?>
<input type="submit"  value="ara" /></p></div>
</form>
 <?php
  	
  if($_POST)	{
echo '<div><h3>Arama Sonucu</h3>
<table style="width:100%">
  <tr>
    <th>Kitap adı</th>
    <th>Sayfa sayısı</th> 
    <th>isbn</th>
	<th>ödünç al</th>
	<th></th>
  </tr>';

//if($_POST['turno']==0 && $_POST['yazarno']==0) {//ikiside boşsa
 $sql = "select *from kitap where kitapadi like '%".utf8_encode($_POST['kitapad'])."%' and kitapno not in(select kitapno from islem where alindi=0)";
/*}	
else if($_POST['turno']==0){//turno boşsa
 $sql = "select *from kitap where kitapadi like '%".$_POST['kitapad']."%'  and yazarno=".$_POST['yazar']." ";
}
else if($_POST['yazarno']==0){//yazarno boşsa
 $sql = "select *from kitap where kitapadi like '%".$_POST['kitapad']."%' and turno=".$_POST['tur']." ";
}
else
	 $sql = "select *from kitap where kitapadi like '%".$_POST['kitapad']."%' and turno=".$_POST['tur']." and yazarno=".$_POST['yazar']." ";
*/
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {  
		echo	"<tr><th>".utf8_decode($row["kitapadi"])."</th>
    <th>".$row["sayfasayisi"]."</th> 
    <th>".$row["isbnno"]."</th>
	<th><a  href=ogrenciata.php?no=".$row["kitapno"].">al</button></th></tr>";    
	}
	echo "<tr><th></th>
    <th></th> 
    <th></th>
	<th></th></tr>";
	echo "</table><div>";
}
}

?>

