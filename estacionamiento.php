<?php
include_once "funciones.php";
class estacionamiento//metodo estático porque de la clase tengo una funcionalidad, no es necesario crear un objeto
{
	public static function saludar()
	{
		echo "Hola";
	}

	public static function leer()//va a devolver un array
	{
		//creamos lista y la retornamos

		//$listaDeAutosLeida=array();
		$listaDeAutosLeida=leerArchivo("patentes.txt");
		return $listaDeAutosLeida;

	}
	public static function retornarListadoAutocompletar(){
		$arrayPatente=estacionamiento::leer ();
		$listadoRetorno="";
		foreach ($arrayPatente as $datos ) {
			$listadoRetorno.="\"$datos[0]\",";
		}
		return $listadoRetorno;
	}

	public static function CrearTablaEstacionamiento ($usuario)
	{
		$listado=estacionamiento::leer();
		$tablaHTML="<h4>Estacionados</h4><table border=1>";
		$tablaHTML.="<th>";
		$tablaHTML.="Patente";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Ingreso";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" GNC";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Tipo";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Usuario";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Imagen";
		$tablaHTML.="</th>";
		foreach ($listado as $auto) {
			if($usuario=="todo")
			{
				$tablaHTML.="<tr><td>$auto[0]</td><td>$auto[1]</td><td>$auto[2]</td><td>$auto[3]</td><td>$auto[4]</td><td><img src='upload/$auto[0].jpg'  width='85'></td></tr>";
			}
			else{
				if($usuario==$auto[4]){

					$tablaHTML.="<tr><td>$auto[0]</td><td>$auto[1]</td><td>$auto[2]</td><td>$auto[3]</td><td>$auto[4]</td><td><img src='upload/$auto[0].jpg'  width='85'></td></tr>";

				}
			}
			
		}


		$tablaHTML.="</table>";
		$archivo=fopen("tablaEstacionados.php", "w");
		fwrite($archivo, $tablaHTML);
		fclose($archivo);




	}	

	public static function GuardarListado($arrayListado)//con esto si agrego o saco un auto, lo saco del array 
	{
		$archivo=fopen("estacionados.txt", "w");
		foreach ($arrayListado as $auto) 
		{
			if(isset($auto[1])){

				fwrite($archivo, $auto[0]."=>".$auto[1]."\n");	
			}
			
		}
		fclose($archivo);

	}

	public static function leer2()//va a devolver un array
	{
		
		$listaDeAutosCobrados=leerArchivo("cobrados.txt"); //le traigo un array
		return $listaDeAutosCobrados;

	}
	public static function CrearTablaCobrados ()
	{
		$listado=estacionamiento::leer2();
		$tablaHTML="<h4>Cobrados</h4><table border=1>";
		$tablaHTML.="<th>";
		$tablaHTML.="Patente";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Ingreso";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Egreso";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Precio";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" GNC";
		$tablaHTML.="</th>";
		$tablaHTML.="<th>";
		$tablaHTML.=" Tipo";
		$tablaHTML.="</th>";
		foreach ($listado as $auto) {
			$tablaHTML.="<tr><td>$auto[0]</td><td>$auto[1]</td><td>$auto[2]</td><td>$auto[3]</td><td>$auto[4]</td><td>$auto[5]</td></tr>";

		}


		$tablaHTML.="</table>";
		$archivo=fopen("tablaCobrados.php", "w");
		fwrite($archivo, $tablaHTML);
		fclose($archivo);




	}	




}











?>