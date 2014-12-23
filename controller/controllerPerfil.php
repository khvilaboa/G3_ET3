<?php
session_start();
include_once "../clases/Usuario_class.php";

$link = Conectarse();
$email = $_SESSION['userLogin'];
$tipo = $_SESSION['userTipo'];

$user = new usuario($email, '', '', '', '', '');
$user->Rellenar();

if($_POST["actualPassword"] == $user->getPassword()) {
	$user->setNombre($_POST["name"]);
	$user->setApellido($_POST["surname"]);
	if($_POST["newPassword"]!=md5('')) $user->setPassword($_POST["newPassword"]);
	$user->modificar();
	
	if($tipo == 'Alumno') {
		header("Location:../alumno/perfil.php?msg=mod");
	} else {
		header("Location:../profesor/perfil.php?msg=mod");
	}
} else {
	if($tipo == 'Alumno') {
		header("Location:../alumno/perfil.php?msg=bpass");
	} else {
		header("Location:../profesor/perfil.php?msg=bpass");
	}
}

?>