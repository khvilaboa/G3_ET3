<?php
	include_once("../conexion.php"); 
	include_once "../clases/Asignatura_class.php";
	Conectarse();
	
	$ca = $_REQUEST['ca'];
	$campo = $_REQUEST['campo'];
	$text = $_REQUEST['text'];
	
	echo asignatura::verProf($ca, $text, $campo);
	
?>
