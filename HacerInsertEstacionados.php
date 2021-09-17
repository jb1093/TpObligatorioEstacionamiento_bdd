<?php
	//utilización del método de instancia
	include_once ("AccesoDatos.php");	

	//if (isset($_POST['patente']) && isset($_COOKIE["usuario"]))) {
	
		include_once ("Vehiculo.php");
		include_once ("Usuario.php");
		include_once("Estacionado.php");

		$patente='abc126';
		$mail="muracecilia@gmail.com";


		$idVehiculo=Vehiculo::DameIdDeEstaPatente($patente);
		$idUsuario=Usuario::DameIdDeEsteMail($mail);
		
		$fechaIngreso= date("Y-m-d H:i");
		$unEstacionado=Estacionado::DameUnEstacionado($idUsuario,$idVehiculo, $fechaIngreso, "", 0);
		$UltimoId=$unEstacionado->InsertarUnoParametros();
		
		

	//}else{
	//	die();
	//}

?>