<?php

class entrega
{
	//atributos 
	var $emailUs;
	var $codAsig;
	var $codTrab;
	var $fechaEnt;
	var $obser;
	var $tit;
	var $cal;
	var $portf;

	//Constructor 
	function __construct($codAsig, $codTrab, $emailUs, $fechaEnt, $obser, $tit, $cal, $portf)
	{
		$this->codAsig = $codAsig;
		$this->codTrab = $codTrab;
		$this->emailUs = $emailUs;
		$this->fechaEnt = $fechaEnt;
		$this->obser = $obser;
		$this->tit = $tit;
		$this->cal = $cal;
		$this->portf = $portf;
	}
	
	//Destructor
	function __destruct()
	{}
	
	//Get's
	function getEmailUsuario(){
		return $this->emailUs;
	}

	function getCodAsignatura(){
		return $this->codAsig;
	}

	function getCodTrabajo(){
		return $this->codTrab;
	}

	function getFechaEntrega(){
		return $this->fechaEnt;
	}

	function getObservacion(){
		return $this->obser;
	}

	function getCalificacion(){
		return $this->cal;
	}	
	
	function getTitulo(){
		return $this->tit;
	}
	
	function getPortfolio(){
		return $this->portf;
	}
	
	//Set's
	function setEmailUsuario($emailUs){
		$this->emailUs = $emailUs;
	}

	function setCodAsignatura($codAsig){
		$this->codAsig = $codAsig;
	}

	function setCodTrabajo($codTrab){
		$this->codTrab = $codTrab;
	}

	function setFechaEntrega($fechaEnt){
		$this->fechaEnt = $fechaEnt;
	}

	function setObservacion($obser){
		$this->obser = $obser;
	}

	function setCalificacion($cal){
		$this->cal = $cal;
	}	
	
	function setTitulo($tit){
		$this->tit = $tit;
	}
	
	function setPortfolio($portf){
		$this->portf = $portf;
	}

	//Metodo Insertar
	function Insertar()
	{
		if (tit <> '' )
		{
			$sql = "select * from AluEntregaTra where titulo = '".$this->tit."'";
			$resultado = mysql_query($sql);
			if(mysql_num_rows($resultado) == 0)
			{
				$sql = "INSERT INTO `aluentregatra` (`emailUsuario`, `codAsignatura`, `codTrabajo`, `fechaEntrega`, `observaciones`, `titulo`, `calificacion`, `portfolio`) 
						VALUES ('$this->emailUs', '$this->codAsig', '$this->codTrab', '$this->fechaEnt', '$this->obser', '$this->tit', '$this->cal', '$this->portf');";
				     		$this->codAsig = $codAsig;

				echo "Entrega creada correctamente";
				mysql_query($sql);
			}
			else
			echo "ERROR: La entrega <i>".$this->tit."</i> ya existe";
		}
		else
			echo "ERROR: No puede insertar la entrega";
	}
	
	function Rellenar() {
		Conectarse();
		$sql = "select * from AluEntregaTra where codAsignatura=\"" . $this->codAsig . "\" and codTrabajo=" . $this->codTrab . " and emailUsuario=\"" . $this->emailUs . "\"";
		echo $sql;
		$resultado = mysql_query($sql);
		
		if ($row = mysql_fetch_array($resultado)) {
			$this->fechaEnt = $row['fechaEntrega'];
			$this->obser = $row['observaciones'];
			$this->tit = $row['titulo'];
			$this->cal = $row['calificacion'];
			$this->portf = $row['portfolio'];
		} 
	}

	//Metodo Consultar
	function Consultar($titulo)
	{
		$sql = "SELECT * FROM `aluentregatra` WHERE (titulo LIKE '%".$titulo."%')";
		$resultado = mysql_query($sql);
		return $resultado;
	}

	//Metodo Modificar
	function Modificar()
	{
		if (tit <> '' )
		{
			$sql = "select * from AluEntregaTra where titulo = '".$this->tit."'";
			$resultado = mysql_query($sql);
			if(mysql_num_rows($resultado) == 1)
			{
				$sql =  "UPDATE `aluentregatra` SET `fechaEntrega` = '$this->fechaEnt', `observaciones` = '$this->obser', `titulo` = '$this->tit', `calificacion` = '$this->cal', `portfolio` = '$this->portf' 
						WHERE `aluentregatra`.`emailUsuario` = '$this->emailUs' AND `aluentregatra`.`codAsignatura` = '$this->codAsig' AND `aluentregatra`.`codTrabajo` = '$this->codTrab';";
				echo "Entrega actualizada correctamente";
				mysql_query($sql);
			}
			else
			echo "ERROR: La entrega <i>".$this->tit."</i> no existe";
		}
		else
			echo "ERROR: No puede actualizar la entrega";
	}

	//Metodo Borrar
	function Borrar() 
	{
		$sql = "SELECT * FROM `aluentregatra` WHERE titulo = '".$this->tit."'";
		$resultado = mysql_query($sql);
		if (mysql_num_rows($resultado) == 1)
		{
			$sql = "DELETE FROM `aluentregatra` WHERE titulo = '".$this->tit."'";
			mysql_query($sql);
			echo "La entrega ".$this->tit." fue borrada correctamente.";
		}
		else{
			echo "ERROR: La entrega ".$this->tit." no existe.";
		}		
	}

}
?>