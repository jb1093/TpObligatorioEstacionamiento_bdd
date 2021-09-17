<?php
include "estacionamiento.php";


$salida=$_POST['txtPatente'];

//$patenteLista=array();
$patenteLista=leerArchivo("patentes.txt"); //aca va la funcion que busca el auto estacionado y lo vuelca en un array

$guardado= "no guardado";
$precio=0;
foreach ($patenteLista as $dato ) //el foreach es como el mientras pero de los arrays, $dato es el que recorre el foreach es como el a++
{
	if ($dato[0]==$salida) //$dato[0] es el primer campo, no el primer renglon-- campo 0 sería la patente, campo 1 sería la fecha y hora de inicio, los campos están separados por el separador de campos que en este caso es => 
	{
		$guardado="guardado";

		
		$fechaEntrada=$dato[1];
		$fechaSalida=date("Y-m-d H:i");
		$minutos=DiferenciaDeFechas($fechaEntrada, $fechaSalida);
		$vehiculo=$dato[3];
		$gas=$dato[2];

		$precio=cobrar($vehiculo, $minutos);

		//mostrar ($fechaEntrada , $fechaSalida , $salida, $precio, $minutos);

		ticket($fechaEntrada , $fechaSalida , $salida, $precio, $minutos);
		
		guardar("\n".$salida."=>".$fechaEntrada."=>".$fechaSalida."=>". $precio."=>".$gas."=>".$vehiculo,"cobrados.txt");
		break;

	}	

}


if ($guardado=="no guardado") 
{
	echo "NO REGISTRADO";
} 
else
{
	crearArchivo("patentes.txt"); // crea un archivo en blanco sobre el archivo patentes.txt 

	foreach ($patenteLista as $dato ) 
	{
		if ($dato[0]!=$salida) 
		{
						
			//guardar("\n".$dato[0]."=>".quitarCaracter($dato[1]),"patentes.txt");
			guardar("\n".$dato[0]."=>".$dato[1]."=>".$dato[2]."=>".$dato[3]."=>x","patentes.txt");

		}	

	}
	estacionamiento::CrearTablaEstacionamiento();
	estacionamiento::CrearTablaCobrados();

}





























?>