<?php
/*
var_dump($_GET);

echo "<br>";

var_dump($_POST);*/

/*var_dump($_POST);*/
$mail=$_POST['correo'];


$clave=$_POST['password'];
$copiaClave=$_POST['copiapassword'];

//echo "su mail es ".$mail." su clave es ". $clave . " copiaclave " .$copiaClave;

if($clave==$copiaClave)
{
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	$ahora=date("Y-m-d H:i:s");
	$renglon="\n".$mail."=>".$clave. "=> ".$ahora ;

	$archivo=fopen("usuarios1.txt", "a");
	fwrite($archivo, $renglon);
	fclose($archivo);

} 
else{
	echo "ERROR en clave";
}










?>