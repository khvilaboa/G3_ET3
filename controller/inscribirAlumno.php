<?php
	include_once("../conexion.php"); 
	Conectarse();
	
	include_once "../clases/Usuario_class.php";
	
	$codAsig=$_GET['ca'];
	
	$aluPreIns = isset($_REQUEST['aluPreIns'])?$_REQUEST['aluPreIns']:array();
	
	foreach ($aluPreIns as $email) {
		$us = new usuario($email,'','','','','');
		$us->inscribirAlumno($codAsig);
	}
	
	header("Location: " . $_SERVER['HTTP_REFERER']);
?>