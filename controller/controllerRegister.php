<?php
include_once "../clases/Usuario_class.php";
        
	$email = $_POST["username"];  
	$nombre = $_POST["name"];
        $apellidos = $_POST["surname"];
        $dni = $_POST["dni"];
        $password = $_POST["password"];
        $tipo = "Alumno";
	
        $user = new usuario($email, $nombre, $password, $apellidos, $dni, $tipo);
        $user->insertar();
?>