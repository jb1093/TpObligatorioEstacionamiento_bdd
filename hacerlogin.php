<?php
include_once ("AccesoDatos.php");	
include_once ("Usuario.php");
	
if (isset($_POST['correo']) && isset($_POST['password']))
{
	$mail=$_POST['correo'];
	
	$clave=$_POST['password'];
}
else
{
	//die();
	echo "<script>alert('Parametros erroneos')</script>";
}

$existeUsuario=Usuario::ExisteusuarioLogueado($mail, $clave);
if($existeUsuario==1){
	setcookie("usuarioCookie",$mail ,time()+60*60*24*30);
	header("location: estacionar.php?usuarioCookie=$mail");
}else {
 	echo "<script>alert('Datos erroneos')</script>";
	header("location: login.php"); 	

 }

?> 