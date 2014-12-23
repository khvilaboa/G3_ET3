<?php

include_once "../conexion.php";
Conectarse();

class asignatura {

    var $codAsig;
    var $nombre;
    var $grado;
    var $curso;

    //Constructor de la clase
    //parametros: el nombre, grado, curso y el código de la asignatura.

    

    function __construct($nombre, $grado, $curso, $cod) {
        $this->nombre = $nombre;
        $this->grado = $grado;
        $this->curso = $curso;
        $this->codAsig = $cod;
    }

    //funcion de destrucción del objeto
    function __destruct() {
        
    }

    //Get's
    function getCodigo() {
        return $this->codAsig;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getGrado() {
        return $this->grado;
    }

    function getCurso() {
        return $this->curso;
    }

    //setters

    function setCodigo($cod) {
        $this->codAsig = $cod;
    }

    function setNombre($nom) {
        $this->nombre = $nom;
    }

    function setGrado($grado) {
        $this->grado = $grado;
    }

    function setCurso($curso) {
        $this->curso = $curso;
    }

    public static function delTree($dir) {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? asignatura::delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }
    
    //Metodo Insertar

    function Insertar() {
        if ($this->codAsig <> '') { // if (!esVacio())
            //Buscamos en la BD una asignatura con este código
            $sql = "select * from Asignatura where codAsignatura = '" . $this->codAsig . "'";
            $resultado = mysql_query($sql);

            //Si no existe una asignatura con nuestro código, insertamos.
            if (mysql_num_rows($resultado) == 0) {

                $sql = "INSERT INTO Asignatura (codAsignatura, nomAsignatura, gradoAsignatura, cursoAsignatura) VALUES ('" . $this->nombre . substr($this->getGrado(), 0, 3) . $this->getCurso() . "','" . $this->nombre . "','" . $this->grado . "','" . $this->curso . "')";
                mysql_query($sql);
                echo "<br> El " . $this->codAsig . " se ha insertado<br>";
                mkdir("../uploads/" . $this->nombre . substr($this->getGrado(), 0, 3) . $this->getCurso());
                $this->setCodigo($this->nombre . substr($this->getGrado(), 0, 3) . $this->getCurso());
            } else {
                echo "<br> El código de asignatura " . $this->codAsig . " no es válido: <br>";
            }
        } else {

            echo "Introduzca un valor para el código<br>";
        }
    }

    //funcion Consultar: hace una búsqueda en la tabla Asignatura con
    //el nombre de la asignatura. Si no se indica devuelve todos
    function Consultar($nombre) {
        //Buscamos las asignaturas cuyo nombre de parezca a $nombre
        $sql = "select * from Asignatura where (nomAsignatura LIKE '%" . $nombre . "%')";
        $resultado = mysql_query($sql);
        //podria llamarse a this->PresentarAsignatura($resultado);
        return $resultado;
    }

    function Rellenar() {
        Conectarse();
        $sql = "select * from Asignatura where codAsignatura=\"" . $this->codAsig . "\"";
        $resultado = mysql_query($sql);

        if ($row = mysql_fetch_array($resultado)) {
            $this->nombre = $row['nomAsignatura'];
            $this->grado = $row['gradoAsignatura'];
            $this->curso = $row['cursoAsignatura'];
        }
    }

    //Presenta en pantalla los datos que se le pasan en un recordset, en este caso de consultar asignaturas

    function PresentarAsignatura($result) {
        echo "Código" . "------" . "Nombre" . "------" . "Grado" . "------" . "Curso" . "<br>";
        while ($Asignatura = mysql_fetch_array($result)) {
            echo $Asignatura['codAsignatura'];
            echo "------" . $Asignatura['nomAsignatura'];
            echo "------" . $Asignatura['gradoAsignatura'];
            echo "------" . $Asignatura['cursoAsignatura'];
            echo "<br>";
        }
    }

    //Esta función borra una asignatura a partir de un código que se le pase por parámetros.
    function Borrar($cod) {
        //Buscamos una asignatura cuyo codigo sea $cod.
        $sql = "select * from Asignatura where codAsignatura = '" . $cod . "'";
        $resultado = mysql_query($sql);
		
		

        //Si encontro una asignatura con ese código, borramos.
        if (mysql_num_rows($resultado) == 1) {
            $sql = "delete from Asignatura where codAsignatura='" . $cod . "'";
            mysql_query($sql);
			
			echo $sql;
            asignatura::deltree("../uploads/" . $cod);
            rmdir("../uploads/". $cod);
            echo "<br>La asignatura de código " . $cod . " fue borrada correctamente<br>";
            
        } else
            echo "<br>la asignatura de código " . $cod . " no existe<br>";
    }

    //Modifica en la BD los valores de la asignatura.
    function modificar() {
        //Buscamos una asignatura con el código de nuestro objeto
        $sql = "select * from Asignatura where codAsignatura = '" . $this->codAsig . "'";
        $resultado = mysql_query($sql);

        //Si encuentra una asignatura, la modificamos
        if (mysql_num_rows($resultado) == 1) {
            $sql = "UPDATE Asignatura SET nomAsignatura = '" . $this->nombre . "',gradoAsignatura = '" . $this->grado . "',cursoAsignatura = '" . $this->curso . "' WHERE codAsignatura = '" . $this->codAsig . "'";
            mysql_query($sql);
            echo "La Asignatura fue modificada con éxito";
        } else
            echo "<br>No existe esa Asignatura<br>";
    }

    //Buscamos en la Bd los trabajos de esta asignatura
    function Get_Trabajos() {
        $sql = "select * from Trabajo where codAsignatura= '" . $this->codAsig . "'";
        $resultado = mysql_query($sql);
        return $resultado;
    }

    //Presenta los datos de los trabajos buscados anteriormente, método opcional
    function VisualizarTrabajo($result) {
        if (mysql_num_rows($result) > 0) {

            while ($trabajos = mysql_fetch_array($result)) {
                echo $Asignatura['codTrabajo'];

                echo $Asignatura['nombreTrabajo'];
            }
        }
    }

    public static function verAsigProf($email) {
        $sql = "SELECT DISTINCT Asignatura.`codAsignatura`, `nomAsignatura` FROM `Asignatura`, ProImparteAsi, Usuario WHERE ProImparteAsi.codAsignatura = Asignatura.codAsignatura 
			AND ProImparteAsi.emailUsuario = \"" . $email . "\"";
        $resultado = mysql_query($sql);
        echo mysql_error();
        while ($row = mysql_fetch_array($resultado)) {
            echo "<a class='list-group-item' href=asignatura.php?ca=" . $row['codAsignatura'] . ">" . $row['nomAsignatura'] . "</a>";
        }
    }

    public static function verAluPreins($codAsig, $text = '', $campo = '') {
        $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario, usuario.emailUsuario FROM usuario, asignatura, aluinscritoasi  
			WHERE usuario.emailUsuario=aluinscritoasi.emailUsuario AND asignatura.codAsignatura=aluinscritoasi.codAsignatura 
			AND aluinscritoasi.aceptado='F' AND asignatura.codAsignatura='" . $codAsig . "'";

        if ($text != '' && $campo != '')
            $sql .= " and " . $campo . " LIKE '%" . $text . "%'";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado)) {
            echo "<tr><td>" . $row['dniUsuario'] . "</td>";
            echo "<td>" . $row['apellidoUsuario'] . ", " . $row['nombreUsuario'] . "</td>";
            echo "<td><input type='checkbox' name='aluPreIns[]' value='" . $row['emailUsuario'] . "'></td></tr>";
        }
    }
	
	public static function verProfNoImp($codAsig, $text = '', $campo = '') {
        $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario, emailUsuario FROM Usuario WHERE tipoUsuario = 'Profesor' 
		AND NOT emailUsuario IN (SELECT u.emailUsuario FROM Usuario u, ProImparteAsi p, Asignatura a WHERE u.emailUsuario=p.emailUsuario 
		AND p.codAsignatura=a.codAsignatura AND a.codAsignatura = \"" . $codAsig . "\")";

        if ($text != '' && $campo != '')
            $sql .= " and " . $campo . " LIKE '%" . $text . "%'";

        $resultado = mysql_query($sql);
		
		$contPS = 0;
        while ($row = mysql_fetch_array($resultado)) {
            echo "<tr><td>" . $row['dniUsuario'] . "</td>";
            echo "<td>" . $row['apellidoUsuario'] . ", " . $row['nombreUsuario'] . "</td>";
            echo "<td><input type='checkbox' name='emailU" . $contPS . "' value='" . $row['emailUsuario'] . "'></td></tr>";
			$contPS+=1;
        }
		
		echo "<input type=\"hidden\" name=\"contP\" value=\"" . $contPS . "\"/>";
    }
	
	public static function verProfImp($codAsig, $text = '', $campo = '') {
        $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario, emailUsuario FROM Usuario WHERE tipoUsuario = 'Profesor' 
		AND emailUsuario IN (SELECT u.emailUsuario FROM Usuario u, ProImparteAsi p, Asignatura a WHERE u.emailUsuario=p.emailUsuario 
		AND p.codAsignatura=a.codAsignatura AND a.codAsignatura = \"" . $codAsig . "\")";

        if ($text != '' && $campo != '')
            $sql .= " and " . $campo . " LIKE '%" . $text . "%'";

        $resultado = mysql_query($sql);
		
		$contPS = 0;
        while ($row = mysql_fetch_array($resultado)) {
            echo "<tr><td>" . $row['dniUsuario'] . "</td>";
            echo "<td>" . $row['apellidoUsuario'] . ", " . $row['nombreUsuario'] . "</td>";
            echo "<td><input type='checkbox' name='emailU" . $contPS . "' value='" . $row['emailUsuario'] . "'></td></tr>";
			$contPS+=1;
        }
		
		echo "<input type=\"hidden\" name=\"contPS\" value=\"" . $contPS . "\"/>";
    }

    /* public static function verAluPreinsFil($asig,$text,$campo) {
      $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario FROM usuario, asignatura, aluinscritoasi
      WHERE usuario.emailUsuario=aluinscritoasi.emailUsuario AND asignatura.codAsignatura=aluinscritoasi.codAsignatura
      AND aluinscritoasi.aceptado='F' AND asignatura.nomAsignatura='".$asig."' and ".$campo." LIKE '%".$text."%'";
      $resultado = mysql_query($sql);

      while ($row = mysql_fetch_array($resultado))
      {
      echo "<tr><td>".$row['dniUsuario']."</td>";
      echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
      echo "<td><input type='checkbox' name='dniUsuario[]' value='".$row['dniUsuario']."'></td></tr>";
      }
      }

      public static function verAluInsFil($asig,$text,$campo) {
      $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario FROM usuario, asignatura, aluinscritoasi
      WHERE usuario.emailUsuario=aluinscritoasi.emailUsuario AND asignatura.codAsignatura=aluinscritoasi.codAsignatura
      AND aluinscritoasi.aceptado='T' AND asignatura.nomAsignatura='".$asig."' and ".$campo." LIKE '%".$text."%'";
      $resultado = mysql_query($sql);
      return $resultado;
      } */

    public static function verAluIns($codAsig, $text = '', $campo = '') {
        $sql = "SELECT dniUsuario, nombreUsuario, apellidoUsuario, usuario.emailUsuario FROM usuario, asignatura, aluinscritoasi  
				WHERE usuario.emailUsuario=aluinscritoasi.emailUsuario AND asignatura.codAsignatura=aluinscritoasi.codAsignatura 
				AND aluinscritoasi.aceptado='T' AND asignatura.codAsignatura='" . $codAsig . "'";

        if (!empty($text) && !empty($campo))
            $sql += " and " . $campo . " LIKE '%" . $text . "%'";

        $resultado = mysql_query($sql);

        while ($row = mysql_fetch_array($resultado)) {
            echo "<tr><td>" . $row['dniUsuario'] . "</td>";
            echo "<td>" . $row['apellidoUsuario'] . ", " . $row['nombreUsuario'] . "</td>";
            echo "<td><input type='checkbox' name='aluIns[]' value='" . $row['emailUsuario'] . "'></td></tr>";
        }
    }

    function consultarConProfesor() {
        $sql = "select distinct A.codAsignatura, nomAsignatura, gradoAsignatura, cursoAsignatura, GROUP_CONCAT(nombreUsuario) as profesores
		from Asignatura A, ProImparteAsi P ,Usuario U where P.codAsignatura=A.codAsignatura and P.emailUsuario=U.emailUsuario GROUP BY A.codAsignatura";
        $resultado = mysql_query($sql);
        return $resultado;
    }

    function consultarSinProfesor() {
        $sql = "select A.codAsignatura, nomAsignatura, gradoAsignatura, cursoAsignatura from Asignatura A where (A.codAsignatura not in (select codAsignatura from ProImparteAsi))";
        $resultado = mysql_query($sql);
        return $resultado;
    }

    public static function verTrabajos($codAsig) {
        echo mysql_error();
        $sql = "SELECT codTrabajo, codAsignatura, nombreTrabajo, fechaLimiteTrabajo FROM Trabajo 
		WHERE codAsignatura = (SELECT codAsignatura FROM Asignatura WHERE codAsignatura = '" . $codAsig . "')";
        $resultado = mysql_query($sql);
        echo mysql_error();
        return $resultado;
    }

}
