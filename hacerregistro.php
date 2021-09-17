<?php
include "funciones.php";
include_once ("AccesoDatos.php");
include_once ("Usuario.php");

if(isset($_POST['correo']) && isset($_POST['password']) && isset($_POST['nombre']) && isset($_POST['copiapassword']))
{
	$mail=$_POST['correo'];
	$clave=$_POST['password'];
	$copiaClave=$_POST['copiapassword'];
	$nombre=$_POST['nombre'];	
}
else
{
	die();
}

if($clave==$copiaClave)
{
	
	//$ahora=date("Y-m-d H:i:s");
	//$renglon="\n".$mail."=>".$clave. "=> ".$ahora ;

	//guardar($renglon, "usuariosLogin.txt");

	$unUsuario=Usuario::DameUnUsuario($nombre,$mail,$clave);
	$UltimoId=$unUsuario->InsertarUnoParametros();
	print("Ultimo ID: $UltimoId");

	header("location: login.php");

} 
else{
	echo "ERROR en clave";
}

?>