<?php
include_once "../conexion.php";
Conectarse();

class usuario {

    var $email;
    var $nombre;
    var $pass;
    var $apellidos;
    var $dni;
    //Define el tipo de usuario (Profesor, etc)
    var $TipoUser;

    //Constructor de la clase
    //parametros: el dni, el nombre y los apellidos

    function __construct($email, $nombre, $pass, $apellidos, $dni, $tipo) {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->pass = $pass;
        $this->apellidos = $apellidos;
        $this->dni = $dni;
        $this->TipoUser = $tipo;
    }

    //funcion de destrucción del objeto
    function __destruct() {
        
    }

    //Get's
    function getEmail() {
        return $this->email;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getPassword() {
        return $this->pass;
    }

    function getApellido() {
        return $this->apellidos;
    }

    function getDni() {
        return $this->dni;
    }

    function getTipo() {
        return $this->TipoUser;
    }

    //setters

    function setEmail($email) {
        $this->email = $email;
    }

    function setNombre($nom) {
        $this->nombre = $nom;
    }

    function setPassword($p) {
        $this->pass = $p;
    }

    function setApellido($ap) {
        $this->apellidos = $ap;
    }

    function setDni($d) {
        $this->dni = $d;
    }

    function setTipo($tipo) {
        $this->TipoUser = $tipo;
    }

    //Metodo Insertar

    function insertar() {
        if ($this->email <> '') { // if (!esVacio())
            $link = Conectarse();
            $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
            $resultado = mysql_query($sql);

            if (mysql_num_rows($resultado) == 0) {
                $link = Conectarse();
                $sql = "INSERT INTO Usuario (emailUsuario,nombreUsuario,apellidoUsuario,passwordUsuario,tipoUsuario,dniUsuario) VALUES ('" . $this->email . "','" . $this->nombre . "','" . $this->apellidos . "','" . $this->pass . "','Alumno','" . $this->dni . "')";
                $resultado = mysql_query($sql);
                echo "<br> El usuario de nombre " . $this->nombre . " se ha insertado<br>";
                header("Location:../index.php");
            } else {
                echo "<br> El email no es válido, ya existe un usuario con el email " . $this->email . "<br>";
            }
        } else {

            echo "Introduzca un valor para el email<br>";
        }
    }
	
	function Rellenar() {
        Conectarse();
        $sql = "select * from Usuario where emailUsuario='" . $this->email . "'";
        $resultado = mysql_query($sql);

        if ($row = mysql_fetch_array($resultado)) {
			$this->nombre = $row['nombreUsuario'];
			$this->pass = $row['passwordUsuario'];
			$this->apellidos = $row['apellidoUsuario'];
			$this->dni = $row['dniUsuario'];
			$this->TipoUser = $row['tipoUsuario'];
        }
    }

    //funcion Consultar: hace una búsqueda en la tabla usuario con
    //los datos del nombre y email. Si van vacios devuelve todos
    public static function consultarP($email){
        $link = Conectarse();
        $sql = "SELECT * FROM Usuario WHERE emailUsuario='".$email."'";
        $resultado = mysql_query($sql);
        return $resultado;
    }
    
    
    function consultar($nombre, $email) {
        $sql = "select * from Usuario where (nombreUsuario LIKE '%" . $nombre . "%') AND (emailUsuario LIKE '%" . $email . "%')";
        $resultado = mysql_query($sql);
        return $resultado;
    }

    public static function validar($email, $pass) {
	    session_start();
        $link = Conectarse();
        $sql = "select * from Usuario where emailUsuario = '" . $email . "'";
        $resultado = mysql_query($sql);

        $row = mysql_fetch_array($resultado);
        if ($row["passwordUsuario"] == $pass) {
            $_SESSION['userLogin'] = $email;
            $_SESSION['userName'] = $row['nombreUsuario'];
            $_SESSION['userTipo'] = $row['tipoUsuario'];
		    $_SESSION['userDni'] = $row['dniUsuario'];
			$_SESSION['userPass'] = $row['passwordUsuario'];

            if ($row["tipoUsuario"] == 'Alumno') {
                header("Location:../alumno/listaAsignaturas.php");
            }
            if ($row["tipoUsuario"] == 'Profesor') {
                header("Location:../profesor/listaAsignaturas.php");
            }
            if ($row["tipoUsuario"] == 'Administrador') {
                header("Location:../admin/listaAsignaturas.php");
            }
        } else {
            header("Location:../index.php");
        }


        echo "Usuario no existente en la base de datos";


        return $resultado;
    }

    //Presenta en pantalla los datos que se le pasan en un recordset

    function presentarUsuarios($result) {
        echo "Email" . "------" . "Nombre" . "------" . "Apellidos" . "------" . "Dni" . "<br>";
        while ($usuarios = mysql_fetch_array($result)) {
            echo $usuarios['emailUsuario'];
            echo "------" . $jugador['nombreUsuario'];
            echo "------" . $jugador['apellidoUsuario'];
            echo "------" . $jugador['emailUsuario'];
            echo "<br>";
        }
    }

    //Borra un usuario indicado por un email en el parámetro
    function borrar($email) {
        $sql = "select * from Usuario where emailUsuario = '" . $email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = "delete from Usuario where emailUsuario = '" . $email . "'";
            mysql_query($sql);
            echo "<br>El usuario de email " . $email . " fue borrado correctamente<br>";
        } else
            echo "<br>El usuario de email " . $email . " no existe<br>";
    }

    //Modifica en la BD los valores del usuario, sin embargo, no cambia el tipo de usuario.
    function modificar() {
        $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = "UPDATE Usuario SET nombreUsuario= '" . $this->nombre . "',apellidoUsuario = '" . $this->apellidos . "',passwordUsuario = '" . $this->pass . "',dniUsuario = '" . $this->dni . "' WHERE emailUsuario = '" . $this->email . "'";
            mysql_query($sql);
			$_SESSION['userName'] = $this->nombre;
			$_SESSION['userPass'] = $this->pass;
            if ($this->TipoUser == 'Alumno') {
                header("Location:../alumno/listaAsignaturas.php");
            }
            if ($this->TipoUser == 'Profesor') {
                header("Location:../profesor/listaAsignaturas.php");
            }
        } else
            echo "<br>No existe un usuario con ese email<br>";
    }

    function modificarTipoUsuario($tipoUser) {
        $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = " UPDATE Usuario SET tipoUsuario='" . $tipoUser . "' WHERE emailUsuario = '" . $this->email . "'";
            mysql_query($sql);
            echo "<br>El usuario de email " . $this->email . " fue modificado correctamente<br>";
        } else
            echo "<br>No existe un usuario con ese email<br>";
    }

    function asignarProfesores($codAsig, $anho) {
        $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = "select * from Asignatura where codAsignatura = '" . $codAsig . "'";
            $resultado = mysql_query($sql);
            if (mysql_num_rows($resultado) == 1) {
                $sql = "INSERT INTO `proimparteasi` (`emailUsuario`, `codAsignatura`, `anhoImparte`) 
						VALUES ('" . $this->email . "', '" . $codAsig . "', '" . $anho . "');";
                mysql_query($sql);
            } else
                echo "<br>No existe la asignatura<br>";
        } else
            echo "<br>No existe un usuario con ese email<br>";
    }

    function preinscribirse($codAsig, $anho) {
        $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = "select * from Asignatura where codAsignatura = '" . $codAsig . "'";
            $resultado = mysql_query($sql);
            if (mysql_num_rows($resultado) == 1) {
                $sql = "INSERT INTO `AluInscritoAsi` (`emailUsuario`, `codAsignatura`, `anhoInscrito`, `aceptado`) 
						VALUES ('" . $this->email . "', '" . $codAsig . "', '" . $anho . "', 'F');";
                mysql_query($sql);
            } else
                echo "<br>No existe la asignatura<br>";
        } else
            echo "<br>No existe un usuario con ese email<br>";
    }

    function inscribirAlumno($codAsig) {
        $sql = "select * from Usuario where emailUsuario = '" . $this->email . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = "select * from Asignatura where codAsignatura = '" . $codAsig . "'";
            $resultado = mysql_query($sql);
            if (mysql_num_rows($resultado) == 1) {
                $sql = " UPDATE `aluinscritoasi` SET aceptado='T' WHERE emailUsuario = '" . $this->email . "' AND codAsignatura = '" . $codAsig . "'";
                mysql_query($sql);
            } else
                echo "<br>No existe la asignatura<br>";
        } else
            echo "<br>No existe un usuario con ese email<br>";
    }
	
	function expulsarAlumno($codAsig) {

        $sql = "select * from Asignatura where codAsignatura = '" . $codAsig . "'";
        $resultado = mysql_query($sql);
        if (mysql_num_rows($resultado) == 1) {
            $sql = " UPDATE `aluinscritoasi` SET aceptado='F' WHERE emailUsuario = '" . $this->email . "' AND codAsignatura = '" . $codAsig . "'";
            mysql_query($sql);
        } 
    }

}

?>