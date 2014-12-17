<?php

	session_start();
	include_once "../clases/Usuario_class.php";
	
	$link = Conectarse();
	$email =  $_SESSION['userLogin'];
	$codAsig = $_SESSION['codAsignatura'];
	$sql = "select * from Usuario where emailUsuario = '".$email."'";
	$resultado = mysql_query($sql);
	$row = mysql_fetch_array($resultado);

   
	$nombre = $row['nombreUsuario'];
	$tipo = $row['tipoUsuario'];
	$dni = $row['dniUsuario'];
	$apellidos = $row['apellidoUsuario'];
	$password = $row['passwordUsuario'];
	$anho= date("Y-m-d");
	 

	$user = new usuario($email, $nombre, $password, $apellidos, $dni, $tipo);
	
	$user->preinscribirse($codAsig, $anho);
	
	header("Location:../alumno/listaAsignaturas.php");
									
?>