<?php

	include "funciones.php";

	function generarEstacionados() {
		$arrayTemporal=leerArchivo("patentes.txt");
		$renglones="";
		$renglones.="PATENTE;FECHA Y HORA;GNC;TIPO\n";
		foreach ($arrayTemporal as $datos){
			$renglones.=$datos[0].";".$datos[1].";".$datos[2].";".$datos[3]."\n";
		}
		header("Content-Description: File Transfer");
		header("Content-Type: application/force-download");
		header("Content-Disposition: attachment; filename=patentes.csv");
		echo $renglones;
	}

	generarEstacionados();
?>