<?php
include("estacionamiento.php");
include_once ("AccesoDatos.php");	
include_once ("Vehiculo.php");

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
if(isset($_POST['color']))
{
	$color=$_POST['color'];
}
else
{
	$color="";
	
}
if(isset($_POST['subir']))
{
	$archivo=$_FILES['archivo']['name'];
	$tipo=$_FILES['archivo']['type'];
	$tamano = $_FILES['archivo']['size'];
    $temp = $_FILES['archivo']['tmp_name']; //nombre temporal
	
	$imagen='upload/'.$entrada.".jpg";
	move_uploaded_file($temp, $imagen);
}
$usuario=$_COOKIE['usuarioCookie'];
//--------------------------------------------------------------------
if ($entrada!="" && !($vehiculo=="moto" && $valorgnc=="gnc")) 
{
	if($valorgnc=="gnc")
	{
		$guardaDato="SI";
	}
	else
	{
		$guardaDato="NO";
	}

	
$unVehiculo=Vehiculo::DameUnVehiculo($entrada, $color, $imagen, $vehiculo, $guardaDato);
$UltimoId=$unVehiculo->InsertarUnoParametros();


	echo "Registro guardado exitosamente!";
	estacionamiento::CrearTablaEstacionamiento("todo");
	estacionamiento::CrearTablaCobrados();
//	include "generarautocompletar.php";
	
}
else
{
	echo "ERROR AL CARGAR";

}




























?>