<?php
class trabajo{
	
	//atributo codigoTrabajo: guarda el codigo de trabajo
	var $codTrab;
	//atributo codigoTrabajo: guarda el codigo de asignatura
	var $codAsig;
	//atributo titulo : guarda el titulo del trabajo
	var $titulo;
	//atributo descripcion: guarda la descripcion del trabajo
	var $descripcion;
	//atributo fechaFinal: guarda la fecha limite
	var $fechaFinal;
	
	
	//Constructor de la clase
	function __construct ($codTrab,$codAsig,$titulo,$descripcion,$fechaFinal)
	{
		$this->codTrab = $codTrab;
		$this->codAsig = $codAsig;
		$this->titulo = $titulo;
		$this->descripcion = $descripcion;
		$this->fechaFinal = $fechaFinal;
 	
	}
	
	//funcion de destrucción del objeto
	function __destruct()
	{
	
	}
	
	//gets y sets
	function getCodTrab()
	{
		return $this->codTrab;
	}
	function setCodTrab($codTrab)
	{
		$this->codTrab=$codTrab;
	}
	
	function getCodAsig()
	{
		return $this->codAsig;
	}
	function setCodAsig($codAsig)
	{
		$this->codAsig=$codAsig;
	}
	
	function getTitulo()
	{
		return $this->titulo;
	}
	function setTitulo($titulo)
	{
		$this->titulo=$titulo;
	}
	
	function getDescripcion()
	{
		return $this->descripcion;
	}
	function setDescripcion($descripcion)
	{
		$this->descripcion=$descripcion;
	}
	
	function getFechaFinal()
	{
		return $this->fechaFinal;
	}
	function setFechaFinal($fechaFinal)
	{
		$this->fechaFinal = $fechaFinal;
	}
	
	//metodo insertar
	//inserta en la tabla trabajo
	function Insertar()
	{
		echo "CA:".$this->codAsig;
		echo "CT:".$this->codTrab;
		if ($this->codTrab <> '' && $this->codAsig <> '')
		{
			$sql= "select * from Trabajo where codTrabajo= '".$this->codTrab."' and codAsignatura= '".$this->codAsig."';";
			
			$resultado = mysql_query($sql);
			if (mysql_num_rows($resultado) == 0)
			{
				$sql = "INSERT INTO Trabajo (codTrabajo,codAsignatura,nombreTrabajo,fechaLimiteTrabajo,descripcionTrabajo) VALUES ('".$this->codTrab."','".$this->codAsig."','".$this->titulo."','".$this->fechaFinal."','".$this->descripcion."');";
				mysql_query($sql);
			}
			else
			{
			echo "<br> El trabajo con código: ".$this->codTrab." ya existe <br>";
			}	
			echo mysql_error();
		}
		else
		{
			echo "Introduzca un trabajo valido";
		}		
	}
	
	// rellenar
	function Rellenar() {
		Conectarse();
		$sql = "select * from Trabajo where codAsignatura=\"" . $this->codAsig . "\" and codTrabajo=" . $this->codTrab;
		$resultado = mysql_query($sql);
		
		if ($row = mysql_fetch_array($resultado)) {
			$this->titulo = $row['nombreTrabajo'];
			$this->descripcion = $row['descripcionTrabajo'];
			$this->fechaFinal = $row['fechaLimiteTrabajo'];
		} 
	}
	
	//funcion Consultar: hace una búsqueda en la tabla trabajos con
	//el titulo del trabajo. Si no se indica devuelve todos
	function Consultar($titulo)
	{
		$sql = "select * from Trabajo where (nombreTrabajo LIKE '%".$titulo."%')";
		$resultado = mysql_query($sql);
		return $resultado;
	}
	
	//funcion Borrar: borra el trabajo en la tabla Trabajo de la base de datos
	
	function Borrar()
	{
		$sql= "select * from Trabajo where codTrabajo= '".$this->codTrab."' and codAsignatura= '".$this->codAsig."';";
		$resultado = mysql_query($sql);
		if(mysql_num_rows($resultado) == 1)
		{
			$sql= "delete from Trabajo where codTrabajo='".$this->codTrab."' and codAsignatura='".$this->codAsig."';";
			mysql_query($sql);
			echo "<br> El trabajo con código ".$this->codTrab." fue borrado correctamente<br>";
		}
		else
		{
			echo "<br> El trabajo con código ".$this->codTrab." no existe<br>";
		}
	}
	
	//funcion Modificar
	
	function Modificar()
	{
		$sql= "select * from Trabajo where codTrabajo= '".$this->codTrab."' and codAsignatura= '".$this->codAsig."';";
		$resultado = mysql_query($sql);
		if (mysql_num_rows($resultado) == 1)
		{
			$sql= "update Trabajo set nombreTrabajo='".$this->titulo."',fechaLimiteTrabajo='".$this->fechaFinal."',descripcionTrabajo='".$this->descripcion."' where codTrabajo='".$this->codTrab."' and codAsignatura='".$this->codAsig."';";
			mysql_query($sql);
		}
		else
		{
			echo "<br> El trabajo con código ".$this->codTrab." no existe<br>";
		}
	}
	
	//funcion get_Entregas, devuelve la lista de entregas para ese trabajo	
	function getEntregas()
	{
		$sql ="select * from AluEntregaTra where codTrabajo='".$this->codTrab."' and codAsignatura='".$this->codAsignatura."';";
		$resultado = mysql_query($sql);
		return $resultado;
	}

}

?>