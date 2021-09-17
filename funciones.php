<?php

function DiferenciaDeFechas($fecha1 , $fecha2)
{
    $fechaHora1 = date_create($fecha1);
    $fechaHora2 = date_create($fecha2);
   
    $interval = date_diff($fechaHora1, $fechaHora2);
   
    return $interval->format("%a")*1440 + $interval->format("%H")*60 + $interval->format("%i") ;
}

function cobrar($automovil , $tiempo){
	switch ($automovil) 
	{
		case 'moto':
			if($tiempo<=30) // - media hora
			{
				$precio=$tiempo*3;	
			} 
			else
			{
				if($tiempo<=480) //- 8horas
				{
					$precio=$tiempo*2.50; 
				}
				else
				{
					if($tiempo<=720) // -12 horas
					{
						$precio=$tiempo*2.25; 
					}
					else // estadía + 12 horas
					{
						$precio=2000; 
					}
				}
			}
			
			break;
		case 'auto':
			if($tiempo<=30) // - media hora
			{
				$precio=$tiempo*3.3;	
			} 
			else
			{
				if($tiempo<=480) // - 8 horas
				{
					$precio=$tiempo*2.75; 
				}
				else
				{
					if($tiempo<=720) // - 12 horas
					{
						$precio=$tiempo*2.475; 
					}
					else // estadía + 12 horas
					{
						$precio=2200; 
					}
				}
			}
			break;
		case 'camioneta':
			if($tiempo<=30) // - media hora
			{
				$precio=$tiempo*3.6;	
			} 
			else
			{
				if($tiempo<=480) // - 8 horas
				{
					$precio=$tiempo*3; 
				}
				else
				{
					if($tiempo<=720) // - 12 horas
					{
						$precio=$tiempo*2.7; 
					}
					else // estadía + 12 horas
					{
						$precio=2400; 
					}
				}
			}
			break;
	}

	return $precio; 

}

//la funcion guarda sirve para guardar datos que ingresan como los que salen 
function guardar($renglon, $nombreDeArchivo)
{
	$archivo=fopen($nombreDeArchivo, "a");
	fwrite($archivo, $renglon); 
	fclose($archivo);
}

//funcion de usuario

function quitarCaracter($dato)
{
	$totalCaracteres=strlen($dato);
	if($totalCaracteres==17)
	{
		$totalCaracteres--;
	}
	return substr($dato, 0, $totalCaracteres);// va a sacar un caracter siempre y cuando el total de caracteres sea de 17, ya que si es fin de archivo va a tener 16 caracteres. 

	//para sacar el salto de renglon uso la funcion substr, srtlen me dice la cantidad de caracteres, con esto evito el salto de renglon y me queda todo en uno
}


function leerArchivo($nombreDeArchivo)//lee el archivo que esta en la variable $nombreDeArchivo
{
	$matrizDeRetorno=array();//matriz temporal que guarda todo el contenido del archivo para después de guardarlo
	$archivo=fopen($nombreDeArchivo, "r");

	while (!feof($archivo)) 
	{
		$renglon=fgets($archivo);//lee el renglon y lo asigna a la variable $renglon
		$datosDePatente=explode("=>", $renglon); //subdivide lo que lee en campos que estan separados por el delimitador => 
		if(isset($datosDePatente[1]))
		{
			$matrizDeRetorno[]=$datosDePatente;
		}
	}

	fclose($archivo);
	return $matrizDeRetorno;

}

function crearArchivo($nombreDeArchivo) //crea un archivo en blanco
{
	$archivo=fopen($nombreDeArchivo, "w");
	fwrite($archivo, ""); 
	fclose($archivo);


}

function mostrar ($fechaE , $fechaS , $patente , $valor, $tiempo)//ticket 
{	
		echo "<h3>COMPROBANTE</h3>";
		echo "Patente: " .$patente."<br>";
		echo "Fecha de ingreso: ".$fechaE."<br>Fecha de salida: ".$fechaS."<br>";
		echo "Tiempo de guardado: ". $tiempo. "' <br>";
		echo "Precio a pagar: $". $valor. "<br><br>";
		echo "FIN***";
		
}

function ticket($fechaE , $fechaS , $patente , $valor, $tiempo)
{
    $renglon="";
	$renglon.="COMPROBANTE \n";
	$renglon.="DATOS;VALORES \n";
	$renglon.="Patente;".$patente."\n";
	$renglon.="Fecha de ingreso;".$fechaE."\n";
	$renglon.="Fecha Salida;".$fechaS."\n";
	$renglon.="Tiempo de guardado;".$tiempo."\n";
	$renglon.="Importe;".$valor."\n";

	header("Content-Description: File Transfer");
	header("Content-Type: application/force-download");
	header("Content-Disposition: attachment; filename=ticket.csv");
	echo $renglon;
}


function subirImagen($imagen)//no va
{
	if(isset($imagen) && $imagen!="") // se recolectan datos de la imagen
	{
		$tipo=$_FILES['archivo']['type'];
		$tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name']; //nombre temporal
		
		if(!(strpos($tipo, "jepg") || strpos($tipo, "jpg") || strpos($tipo, "png") || strpos($tipo, "JEPG") || strpos($tipo, "JPG") || strpos($tipo, "PNG") )) //valido que sean esos formatos
		{
			echo"ERROR FORMATO NO DESEADO";
		}else //si es correcta 
		{
			move_uploaded_file($temp, 'upload/'.$imagen);
			echo"Imagen subida exitosamente"; 
		}

	}


}

function marcaAgua()
{
	// Cargar la estampa y la foto para aplicarle la marca de agua
	$estampa = imagecreatefrompng('componente-esparking-APP-PDV.png');
	$im = imagecreatefromjpeg('auto6.jpg');

	// Establecer los márgenes para la estampa y obtener el alto/ancho de la imagen de la estampa
	$margen_dcho = 10;
	$margen_inf = 10;
	$sx = imagesx($estampa);
	$sy = imagesy($estampa);

	// Copiar la imagen de la estampa sobre nuestra foto usando los índices de márgen y el
	// ancho de la foto para calcular la posición de la estampa. 
	imagecopy($im, $estampa, imagesx($im) - $sx - $margen_dcho, imagesy($im) - $sy - $margen_inf, 0, 0, imagesx($estampa), imagesy($estampa));

	// Imprimir y liberar memoria
	header('Content-type: image/png');
	imagepng($im);
	imagedestroy($im);
}




















date_default_timezone_set("America/Argentina/Buenos_Aires");

?>