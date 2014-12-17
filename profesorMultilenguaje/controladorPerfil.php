<?php
echo $_SESSION['userPass'];

include_once('../conexion.php');


include ('../clases/Usuario_class.php');
session_start();

$passAct=$_GET['passwdAct'];
$passNew=$_GET['passwdNew'];
$passRep=$_GET['passwdRep'];

echo($passNew);

Conectarse();

if($_SESSION['userPass'] == $passAct && $_SESSION['userPass'] !='' ){
	if($passNew == $passRep){
		$usuario = new usuario('','','','','','');
        $sql = "select * from Usuario where emailUsuario='".$_SESSION['userLogin']."'";
                    $resultado=mysql_query($sql);
                    $row = mysql_fetch_array($resultado);
					$usuario->setEmail($row['emailUsuario']);
					$usuario->setNombre($row['nombreUsuario']);
					$usuario->setPassword($passNew);
					$usuario->setApellido($row['apellidoUsuario']);
                    $usuario->setDni($row['dniUsuario']);
                    $usuario->setTipo($row['tipoUsuario']);
			$usuario->modificar();
                    }
	}


header("location:../index.php");

?>
