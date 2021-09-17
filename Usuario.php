<?php
class Usuario
{
	public $id;
 	public $nombre;   
  	public $email;    
  	public $password; 
  	public $fechaInscrip;

 	public static function ExisteusuarioLogueado($pEmail, $pPassword) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT count(nombre) as cantidad from usuarios where email='$pEmail'and password='$pPassword'");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 

			//retornamos 0 sino encuentra el ususario / 1 si lo encuentra.
			return $ArraysResultante[0]["cantidad"];		
	}

	/*---------------------------------------------------------------------------------*/
public static function Existeusuario($pEmail) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT count(nombre) as cantidad from usuarios where email='$pEmail'");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 

			//retornamos 0 sino encuentra el ususario / 1 si lo encuentra.
			return $ArraysResultante[0]["cantidad"];		
	}

	/*---------------------------------------------------------------------------------*/
	public static function EncontrarUnUsuario($pEmail) 
	{
		//Creo un objeto de acceso a datos, si existe uso el que ya tengo
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

		//Genero la consulta sql
		$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id from usuarios where email='$pEmail'");

		//Ejecuto la consulta
		$consulta->execute(); 

		//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
		$ArraysResultante= $consulta->fetchall(); 
		
		return $ArraysResultante[0]["id"];		
	}

	/*---------------------------------------------------------------------------------*/
	public static function DameIdDeEsteMail($pEmail)
	{
		$existeUsuario=Usuario::Existeusuario($pEmail);  		
  		switch ($existeUsuario) {
			case 0: //Sino Existe
				// Si no encontro ningun registro en la tabla Usuarios que cumpla la condicion...
			    // tengo que ir a dar de Alta el Usuario
				echo "Creo el Usuarios.";
				//Alta Usuario

				$unUsuario=Usuario::DameUnUsuario("Cargar Nombre", $pEmail, "");
				$idUsuario=$unUsuario->InsertarUnoParametros();
				print("Ultimo ID: $idUsuario");	

				break;
			case 1: //Si existe
				// Si encontro un registro en tabla Usuario...
				echo "Traigo el Usuarios.<br>";
				$idUsuario = Usuario::EncontrarUnUsuario($pEmail);
				echo "El Id de este Email es:". $idUsuario;

				break;
		}
		return $idUsuario;
  	}

  	/*---------------------------------------------------------------------------------*/
  	public static function DameUnUsuario($pNombre, $pCorreo, $pClave)
  	{
	  	$unUsuario =new Usuario();
		$unUsuario->nombre=$pNombre;
		$unUsuario->email=$pCorreo;
		$unUsuario->password=$pClave;
		return $unUsuario;
  	}

  	/*---------------------------------------------------------------------------------*/
  	public function InsertarUnoParametros()
	{
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre, email, password) values (:nombre,:email,:password)");
		
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
		$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

	/*---------------------------------------------------------------------------------*/ 	
	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->email."  ".$this->password."  ".$this->fechaInscrip;
	}
  	public function BorrarUsuario()
	{

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete from usuarios WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	}
	 /*
	 public static function BorrarCdPorAnio($año)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete from cds WHERE jahr=:anio");	
				$consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	 
	public function ModificarUsuario()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update usuarios set 
				nombre='$this->nombre',
				email='$this->email',
				password='$this->password',
				fechaInscrip='$this->fechaInscrip'				
				WHERE id='$this->id'");
			return $consulta->execute();



	 }
	 public function ModificarUsuarioParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update usuarios set 
				nombre=:nombre,
				email=:email,
				password=:password,
				fechaInscrip=:fechaInscrip				
				WHERE id=:id");

			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
			$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
			$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
			$consulta->bindValue(':fechaInscrip', $this->fechaInscrip, PDO::PARAM_STR);			
			return $consulta->execute();


	 }

  	
	 public function InsertarUno()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (nombre, email, password, fechaInscrip) values ('$this->nombre','$this->email','$this->password','$this->FechaInscrip')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

	 }*/

	 /*----------------- HASTA ACA LLEGUE A CAMBIAR -------------------*/


	 

	/*
  	public static function TraerTodoLosUsuarios()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT Id, nombre, email, password,fechaInscrip from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Usuario");		
	}



	public static function TraerUnCdAnio($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=? AND jahr=?");
			$consulta->execute(array($id, $anio));
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}

	public static function TraerUnCdAnioParamNombre($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->bindValue(':id', $id, PDO::PARAM_INT);
			$consulta->bindValue(':anio', $anio, PDO::PARAM_STR);
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
	
	public static function TraerUnCdAnioParamNombreArray($id,$anio) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select  titel as titulo, interpret as cantante,jahr as año from cds  WHERE id=:id AND jahr=:anio");
			$consulta->execute(array(':id'=> $id,':anio'=> $anio));
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('cd');
      		return $cdBuscado;				

			
	}
	*/


}