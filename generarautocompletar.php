<?php
include_once "estacionamiento.php";

//$ListadoPatentes="  \"asd345\" , \"fff666\" ,\"julieta\"  ";
$ListadoPatentes=estacionamiento::retornarListadoAutocompletar();
$textoDelArchivoJS="$(function(){
			  var patentes = [ 

			  

			   $ListadoPatentes


			  ];
			  
			  // setup autocomplete function pulling from patentes[] array
			  $('#autocomplete').autocomplete({
			    lookup: patentes,
			    onSelect: function (suggestion) {
			      var thehtml = '<strong>patente: </strong> ' + suggestion.value + ' <br> <strong>ingreso: </strong> ' + suggestion.data;
			      $('#outputcontent').html(thehtml);
			         $('#botonIngreso').css('display','none');
      						console.log('aca llego');
			    }
			  });
			  

			});";
$archivoJS=fopen("js/funcionAutocompletar.js","w");

fwrite($archivoJS, $textoDelArchivoJS);

fclose($archivoJS);



















?>