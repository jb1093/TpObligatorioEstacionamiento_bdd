<?php
class Estacionado
{
	public $id;
 	public $Id_usuario;  
  	public $Id_vehiculo;    
  	public $FechaIngreso;
  	public $FechaSalida;    
  	public $importe;

  	
  	public static function ValidarVehiculoYaEstacionado($pId_vehiculo) 
	{
			//Creo un objeto de acceso a datos, si existe uso el que ya tengo
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 

			//Genero la consulta sql
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT count(*) as cantidad from estacionados where Id_vehiculo='$pId_vehiculo' and fechaSalida is NULL and importe is NULL");

			//Ejecuto la consulta
			$consulta->execute(); 

			//Obtengo un arrays con todos los registros q cumplen la condicion e la consulta
			$ArraysResultante= $consulta->fetchall(); 

			//retornamos 0 sino encuentra el estacionado / 1 si lo encuentra.
			return $ArraysResultante[0]["cantidad"];
			
	}



  	public static function DameUnEstacionado($pId_usuario, $pId_vehiculo, $pFechaIngreso, $pFechaSalida, $pimporte){
	  	$unEstacionado =new Estacionado();
		$unEstacionado->Id_usuario=$pId_usuario;
		$unEstacionado->Id_vehiculo=$pId_vehiculo;
		$unEstacionado->FechaIngreso=$pFechaIngreso;
		$unEstacionado->FechaSalida=$pFechaSalida;
		$unEstacionado->importe=$pimporte;

		return $unEstacionado;
  	}




	 public function InsertarUnoParametros()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into estacionados (Id_usuario, Id_vehiculo,FechaIngreso) values (:Id_usuario,:Id_vehiculo,:FechaIngreso)");

				$consulta->bindValue(':Id_usuario',$this->Id_usuario, PDO::PARAM_INT);
				$consulta->bindValue(':Id_vehiculo', $this->Id_vehiculo, PDO::PARAM_STR);
				$consulta->bindValue(':FechaIngreso', $this->FechaIngreso, PDO::PARAM_STR);
				//$consulta->bindValue(':FechaSalida', $this->FechaSalida, PDO::PARAM_STR);
				//$consulta->bindValue(':importe', $this->importe, PDO::PARAM_STR);

				$consulta->execute();		
				return $objetoAccesoDato->RetornarUltimoIdInsertado();
	 }
  	public function BorrarEstacionado()
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete from estacionados WHERE id=:id");	
				$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	   	public function mostrarDatos()
	{
	  	return "Metodo mostar:".$this->nombre."  ".$this->email."  ".$this->password."  ".$this->fechaInscrip;
	}
	 /*

	 	 public function InsertarUno()
	 {
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("INSERT into usuarios (id_usuario, id_vehiculo, fechaingreso, fechasalida,importe) values ('$this->Id_usuario','$this->Id_vehiculo','$this->FechaIngreso','',0)");
				$consulta->execute();
				return $objetoAccesoDato->RetornarUltimoIdInsertado();

	 }
	 public static function BorrarCdPorAnio($año)
	 {

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("
				delete from cds WHERE jahr=:anio");	
				$consulta->bindValue(':anio',$año, PDO::PARAM_INT);		
				$consulta->execute();
				return $consulta->rowCount();

	 }
	 */
	public function ModificarCd()
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
	 public function ModificarCdParametros()
	 {
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("update usuarios set 
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

	 


  	public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT Id, nombre, email, password,fechaInscrip from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}

	public static function TraerUnEstacionado($id) 
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("SELECT Id, patente, color, foto from vehicuo where id = $id");
			$consulta->execute();
			$cdBuscado= $consulta->fetchObject('Vehiculo');
			return $cdBuscado;				

			
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