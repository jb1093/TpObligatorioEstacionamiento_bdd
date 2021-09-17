<?php
include_once "estacionamiento.php";
include_once ("AccesoDatos.php");	
include_once ("Vehiculo.php");
include_once ("Usuario.php");
include_once("Estacionado.php");

//date_default_timezone_set("America/Argentina/Buenos_Aires");
if(isset($_POST['txtPatente']))
{
	$entrada=$_POST['txtPatente'];
	
}
else
{
	die();
}

if(isset($_POST['gnc']))
{
	$valorgnc=$_POST['gnc'];
}
else
{
	$valorgnc="no gnc";
	
}
if(isset($_POST['vehiculo']))
{
	$vehiculo=$_POST['vehiculo'];
}
else
{
	$vehiculo="";
	
}
if(isset($_POST['subir']))
{
	$archivo=$_FILES['archivo']['name'];
	$tipo=$_FILES['archivo']['type'];
	$tamano = $_FILES['archivo']['size'];
    $temp = $_FILES['archivo']['tmp_name']; //nombre temporal
	
	move_uploaded_file($temp, 'upload/'.$entrada.".jpg");
}
$usuario=$_COOKIE['usuarioCookie'];
//--------------------------------------------------------------------
if ($entrada!="" && !($vehiculo=="moto" && $valorgnc=="gnc")) 
{
	if($valorgnc=="gnc")
	{
		$guardaDato="CON GNC";
	}
	else
	{
		$guardaDato="SIN GNC";
	}

	$idVehiculo=Vehiculo::DameIdDeEstaPatente($entrada);
	$idUsuario=Usuario::DameIdDeEsteMail($usuario);

	if(Estacionado::ValidarVehiculoYaEstacionado($idVehiculo)==0 ){
		$fechaIngreso= date("Y-m-d H:i");
		$unEstacionado=Estacionado::DameUnEstacionado($idUsuario,$idVehiculo, $fechaIngreso, "", 0);
		$UltimoId=$unEstacionado->InsertarUnoParametros();
		echo "Registro guardado exitosamente!";
		estacionamiento::CrearTablaEstacionamiento("todo");
		estacionamiento::CrearTablaCobrados();
		include "generarautocompletar.php";

	}else{
		header("Location: entrada.php?error=El vehiculo $entrada ya se encuentra estacionado, no se puede volver a cargar!!!");

	}
	
}

?>