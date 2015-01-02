<?php
	include_once("../conexion.php"); 
	Conectarse();
	
	include ('../clases/Entrega_class.php');
	
	$codAsig = $_GET['ca'];
	$codTrab = $_GET['ct'];
	$email = $_GET['email'];

	$ent = new entrega($codAsig, $codTrab, $email, '', '', '', '', '');
	$ent->Rellenar();
	
	$sql = "UPDATE `AluEntregaTra` SET `observaciones` = '".$_GET['observaciones']."', `calificacion` = '".$_GET['nota']."' 
	WHERE `AluEntregaTra`.`emailUsuario` = '".$email."' AND `AluEntregaTra`.`codAsignatura` = '".$codAsig."' 
	AND `AluEntregaTra`.`codTrabajo` = '".$codTrab."';";
	
	$resultado = mysql_query($sql);
	echo mysql_error();
	
	header("Location: ../profesor/trabajo.php?ca=" . $codAsig . "&ct=" . $codTrab . "&mail=" . $email . "&msg=creado");
?>
