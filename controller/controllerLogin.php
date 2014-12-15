<?php
include_once "../clases/Usuario_class.php";
        
	$email = $_POST["username"];  
	$pass = $_POST["password"];
	usuario::validar($email,$pass);
?>