<?php

/*var_dump($_GET);

echo "<br>";

var_dump($_POST);*/
if (isset($_POST['correo']) )
{
	$mail=$_POST['correo'];
}
else
{
	die();
}


$clave=$_POST['password'];
$listadoDeUsuarios=array();

$archivo=fopen("usuarios1.txt", "r");
//DE LA 14 A LA 30 TRANSFIERO INFORMACION FISICA A MEMORIA 
while ( !feof($archivo)) {
	//echo "renglon: ".fgets($archivo)."<br>";
	$renglon=fgets($archivo);
	$datosDeUnUsuario=explode("=>", $renglon);
	if(isset($datosDeUnUsuario[1]))//$datosDeUnUsuario[0]!=" ")
	{
		$listadoDeUsuarios[]=$datosDeUnUsuario;
	}
	/*var_dump($datosDeUnUsuario);
	echo "<br>";*/
	/*if($datosDeUnUsuario[0]==$mail){
		if($datosDeUnUsuario[1]==$clave){
			echo "Bienvenido";
		}
	}*/
}

fclose($archivo);

//var_dump($listadoDeUsuarios);
$ingreso="No ingreso";
foreach ($listadoDeUsuarios as $datos)
 {
	if($datos[0]==$mail)
	{
		if ($datos[1]==$clave) 
		{
			echo "Bienvenido";
			$ingreso="Ingreso";
			break;
		}
	}	
 }

 if($ingreso=="No ingreso")
 {
 	echo "ERROR-- datos erroneos";
 }






?>