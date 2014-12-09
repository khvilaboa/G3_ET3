
<?php

class asignatura
{
	var $codAsig;
	var $nombre;
	var $grado;
	var $curso;
	

	//Constructor de la clase
	//parametros: el nombre, grado, curso y el código de la asignatura.

	function __construct($nombre,$grado,$curso,$cod)
	{
		$this->nombre= $nombre;
		$this->grado = $grado;
		$this->curso = $curso;
		$this->codAsig = $cod;
	}

	//funcion de destrucción del objeto
	function __destruct()
	{

	}
	
	//Get's
	function getCodigo ()
	{
		return $this->codAsig;
	}
	
	function getNombre ()
	{
		return $this->nombre;
	}
	
	function getGrado ()
	{
		return $this->grado;
	}
	
	function getCurso ()
	{
		return $this->curso;
	}
	
	//setters
	
	function setCodigo ($cod)
	{
		$this->codAsig = $cod;
	}
	
	function setNombre ($nom)
	{
		$this->nombre = $nom;
	}
	
	function setGrado ($grado)
	{
		$this->grado = $grado;
	}
	
	function setCurso ($curso)
	{
		$this->curso = $curso;
	}
	
	
	//Metodo Insertar

	function Insertar()
	{
		if ($this->codAsig <> '' ) // if (!esVacio())
		{
			//Buscamos en la BD una asignatura con este código
			$sql = "select * from Asignatura where codAsignatura = '".$this->codAsig."'"; 
			$resultado = mysql_query($sql);
			
			//Si no existe una asignatura con nuestro código, insertamos.
			if (mysql_num_rows($resultado) == 0){ 

					$sql = "INSERT INTO Asignatura (codAsignatura, nomAsignatura, gradoAsignatura, cursoAsignatura) VALUES ('".$this->codAsig."','".$this->nombre."','".$this->grado."','".$this->curso."')";
					mysql_query($sql);
					echo "<br> El ".$this->codAsig." se ha insertado<br>";
			}
			else{
				echo "<br> El código de asignatura ".$this->codAsig." no es válido: <br>";
			}
		}
		else{
			
			echo "Introduzca un valor para el código<br>";
		}
	}

	//funcion Consultar: hace una búsqueda en la tabla Asignatura con
	//el nombre de la asignatura. Si no se indica devuelve todos
	function Consultar($nombre)
	{
		//Buscamos las asignaturas cuyo nombre de parezca a $nombre
		$sql = "select * from Asignatura where (nomAsignatura LIKE '%".$nombre."%')";
		$resultado = mysql_query($sql);
		//podria llamarse a this->PresentarAsignatura($resultado);
		return $resultado;
	}
	
	//Presenta en pantalla los datos que se le pasan en un recordset, en este caso de consultar asignaturas

	function PresentarAsignatura($result)
	{
		echo "Código"."------"."Nombre"."------"."Grado"."------"."Curso"."<br>";
		while ($Asignatura = mysql_fetch_array($result))
		{
			echo $Asignatura['codAsignatura'];
			echo "------".$Asignatura['nomAsignatura'];
			echo "------".$Asignatura['gradoAsignatura'];
			echo "------".$Asignatura['cursoAsignatura'];
			echo "<br>";
		}
	}

	//Esta función borra una asignatura a partir de un código que se le pase por parámetros.
	function Borrar($cod)
	{
		//Buscamos una asignatura cuyo codigo sea $cod.
		$sql = "select * from Asignatura where codAsignatura = '".$cod."'";
		$resultado = mysql_query($sql);
		
		//Si encontro una asignatura con ese código, borramos.
		if (mysql_num_rows($resultado) == 1)
		{
			$sql = "delete from Asignatura where  = '".$cod."'";
			mysql_query($sql);
			echo "<br>La asignatura de código ".$cod." fue borrada correctamente<br>";
		}
		else
		echo "<br>la asignatura de código ".$cod." no existe<br>";
	}

	//Modifica en la BD los valores de la asignatura.
	function Modificar()
	{
		//Buscamos una asignatura con el código de nuestro objeto
		$sql = "select * from Asignatura where codAsignatura = '".$this->codAsig."'";
		$resultado = mysql_query($sql);
		
		//Si encuentra una asignatura, la modificamos
		if (mysql_num_rows($resultado) == 1	)
		{
			$sql = "UPDATE Asignatura SET codAsignatura = '".$this->codAsig."',nomAsignatura = '".$this->nombre."',gradoAsignatura = '".$this->grado."',cursoAsignatura = '".$this->curso."' WHERE codAsignatura = '".$this->codAsig."'";
			mysql_query($sql);
			echo "La Asignatura fue modificada con éxito";
		}
		else
		echo "<br>No existe esa Asignatura<br>";
	}

	//Buscamos en la Bd los trabajos de esta asignatura
	function Get_Trabajos()
	{
		$sql = "select * from Trabajo where codAsignatura= '".$this->codAsig"'";
		$resultado = mysql_query($sql);
		return $resultado;
	}
		
	//Presenta los datos de los trabajos buscados anteriormente, método opcional
	function VisualizarTrabajo($result)
	{
		if (mysql_num_rows($result) > 0){
					
			while ($trabajos = mysql_fetch_array($result))
			{
				echo $Asignatura['codTrabajo'];
				echo "------".$Asignatura['nombreTrabajo'];";
			}
		}
	}
}