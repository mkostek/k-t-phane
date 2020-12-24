<head>
<meta http-equiv="Content-Type" content="text/HTML; charset=utf-8" />
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	  <link rel="stylesheet" type="text/css" href="si.css">
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.12.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <title>Kitabı Kim Alacak?</title>
</head>
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
  <script>
  
 	function sinifi()
			{
				var str=document.getElementById("sinif").value;
				if(str=="")
			{
			document.getElementById("ogrenci").innerHTML="";
			return;
			}else
			{
			if(window.XMLHttpRequest)
			{
			xmlhttp=new XMLHttpRequest();
			}
			else{
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange=function()
			{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			document.getElementById("ogrenci").innerHTML=xmlhttp.responseText;
			}
			};
			xmlhttp.open("GET","ogrencicek.php?q="+str,true);
			xmlhttp.send();
			}
			}
  
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
  <form action="islemekle.php" method="post">
<?php
include "linkler.html";
include "bag.php";
$no=$_GET["no"]; 
$sql = "select DISTINCT(sinif) as 'sin' from ogrenci ";
$result = $conn->query($sql);

echo '<div><p>sinifi seçiniz:<select id="sinif"  name="sinif" onchange="sinifi()">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row['sin'].">".$row['sin']."</option>";
    }
	echo "</select><br>";
}

$sql = "select *from ogrenci ";
$result = $conn->query($sql);

echo 'ogrenci seçiniz:<select id="ogrenci" class="combobox"  name="ogrenci" >';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {  
		echo	"<option value=".$row['ogrno'].">".utf8_decode($row['ograd'])." ".utf8_decode($row['ogrsoyad'])."</option>";
    }
	echo "</select><br>";
}


?>
<input type="hidden" name="kitap" value="<?php echo $no; ?>"></p></div>
<input type="submit" value="gönder"/>
</form>
