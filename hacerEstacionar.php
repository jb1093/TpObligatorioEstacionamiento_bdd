 <?php
 //https://www.jose-aguilar.com/blog/upload-de-imagenes-con-php/
/* include "estacionamiento.php";
if (isset($_POST['subir'])) 
{
	$archivo=$_FILES['archivo']['name']; //pasarle un argumento para que funcione
	//var_dump($_FILES);
	if(isset($archivo) && $archivo!="") // se recolectan datos de la imagen
	{
		$tipo=$_FILES['archivo']['type'];
		$tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name']; //nombre temporal
		
		/*if(!(strpos($tipo, "jepg") || strpos($tipo, "jpg") || strpos($tipo, "png") || strpos($tipo, "JEPG") || strpos($tipo, "JPG") || strpos($tipo, "PNG") )) //valido que sean esos formatos
		{
			echo"ERROR FORMATO NO DESEADO";
		}else //si es correcta 
		{/
			move_uploaded_file($temp, 'upload/'.$archivo);
			echo"Imagen subida exitosamente"; 
		//}

	}*/

	//subirImagen($archivo);
	include "estacionamiento.php";
	if(isset($_POST['punto9'])){
		$mostrar=$_POST['punto9'];

	}else
	{
		//die();
	}


	
		estacionamiento::CrearTablaEstacionamiento($mostrar);
		include "tablaEstacionados.php";
	


?>