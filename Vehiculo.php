<?php
class Vehiculo
{
	public $id;
 	public $Patente;  
  	public $Color;    
  	public $Foto;
  	public $Tipo;
  	public $GNC;

  	public static function DameIdDeEstaPatente($pPatente){
		$existeVehiculo=Vehiculo::ExistePatente($pPatente);  		
  		switch ($existeVehiculo) {
			case 0: //Sino Existe
				// Si no encontro ningun registro en la tabla Vehiculos que cumpla la condicion...
			    // tengo que ir a dar de Alta el Vehiculo
				echo "Creo el vehiculos.";
				//Alta Vehiculo

				$unVehiculo=Vehiculo::DameUnVehiculo($pPatente, "color-undefine", "imagen-undefine", "tipo-undefine", "no");
				$idVehiculo=$unVehiculo->InsertarUnoParametros();
				print("Ultimo ID: $idVehiculo");	

				break;
			case 1: //Si existe
				// Si encontro un registro en tabla Vehiculo...
				echo "Traigo el vehiculos.<br>";
				$idVehiculo = Vehiculo::DameElID($pPatente);
				echo "El Id de esta Patente es:". $idVehiculo;

				break;
		}
		return $idVehiculo;
  	}
  	
  	public static function ExistePatente($pPatente) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT count(patente) as cantidad from vehiculos where Patente='$pPatente'");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 
			//var_dump($ArraysResultante[0]);
			
			//Cuento la cantidad de registros
			//echo "cantidad de filas: ".$ArraysResultante[0]["cantidad"]."<br>";

			return $ArraysResultante[0]["cantidad"];		
	}
  	public static function DameUnVehiculo($pPatente, $pColor, $pFoto, $pTipo, $pGNC)
  	{
	  	$unVehiculo =new Vehiculo();
		$unVehiculo->Patente=$pPatente;
		$unVehiculo->Color=$pColor;
		$unVehiculo->Foto=$pFoto;
		$unVehiculo->Tipo=$pTipo;
		$unVehiculo->GNC=$pGNC;

		return $unVehiculo;
  	}

  	public function InsertarUnoParametros()
	{
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Vehiculos (Patente, Color, Foto, tipo,  GNC ) values (:patente,:color,:foto, :tipo, :GNC)");//parametro

				
				$consulta->bindValue(':patente',$this->Patente, PDO::PARAM_STR);
				$consulta->bindValue(':color', $this->Color, PDO::PARAM_STR);
				$consulta->bindValue(':foto', $this->Foto, PDO::PARAM_STR);
				$consulta->bindValue(':tipo',$this->Tipo, PDO::PARAM_STR);
				$consulta->bindValue(':GNC', $this->GNC, PDO::PARAM_STR); //this tipo dato, arriba


				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}

 	public static function DameElID($pPatente) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id from vehiculos where Patente='$pPatente'");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 

			return $ArraysResultante[0]["id"];		
	}
    /*******************************************************************************/

  	public static function EncontrarUnVehiculo($pPatente) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT id, Patente, Color, Foto from vehiculos where Patente='$pPatente'");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Cuento la cantidad de registros
			//echo "cantidad de filas: ".$consulta->rowCount()."<br>";

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 


			//var_dump($ArraysResultante);

			//echo "cantidad de filas: ".$ArraysResultante."<br>";

			//Si la cantidad de filas es mayor a 0 
			/*if ($catidadFilas>0) 
			{
				foreach($ArraysResultante as $fila) {
					echo "<br>------- Id: ".$fila["id"];
					echo "<br>-- Patente: ".$fila["Patente"];
					echo "<br>---- Color: ".$fila['Color'];
					echo "<br>----- Foto: ".$fila['Foto'];									
				}
			}*/
				
			return $ArraysResultante;		
	}
 
  	
  	public function BorrarVehiculo()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete from vehiculos WHERE id=:id");	
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

	public function ModificarCd()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				update Vehiculos set 
				nombre='$this->nombre',
				email='$this->email',
				password='$this->password',
				fechaInscrip='$this->fechaInscrip'				
				WHERE id='$this->id'");
			return $consulta->execute();



	 }
	 public function ModificarCdParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update Vehiculos set 
				nombre=:nombre,
				email=:email,
				password=:password,
				fechaInscrip=:fechaInscrip				
				WHERE id=:id");

			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
			$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_INT);
			$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
			$consulta->bindValue(':password', $this->password, PDO::PARAM_STR);
			$consulta->bindValue(':fechaInscrip', $this->fechaInscrip, PDO::PARAM_STR);			
			return $consulta->execute();


	 }

  	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->email."  ".$this->password."  ".$this->fechaInscrip;
	}
	 public function InsertarUno()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into Vehiculos (nombre, email, password, fechaInscrip) values ('$this->nombre','$this->email','$this->password','$this->FechaInscrip')");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

	 }

	 /*----------------- HASTA ACA LLEGUE A CAMBIAR -------------------/


	 


  	public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT Id, nombre, email, password,fechaInscrip from Vehiculos");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}



	/*public static function TraerUnCdAnio($id,$anio) 
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