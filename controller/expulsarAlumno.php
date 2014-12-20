<?php
	include_once("../conexion.php"); 
	Conectarse();
	
	include_once "../clases/Usuario_class.php";
	
	$codAsig=$_GET['ca'];
	
	$aluIns = isset($_REQUEST['aluIns'])?$_REQUEST['aluIns']:array();
	
	foreach ($aluIns as $email) {
		$us = new usuario($email,'','','','','');
		$us->expulsarAlumno($codAsig);
	}
	
	header("Location: " . $_SERVER['HTTP_REFERER']);
?>