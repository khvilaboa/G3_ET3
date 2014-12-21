<?php
	include_once("../conexion.php"); 
	include_once "../clases/Asignatura_class.php";
	Conectarse();
	
	/*$aluPreIns = isset($_REQUEST['aluPreIns'])?$_REQUEST['aluPreIns']:array();
	$aluIns = isset($_REQUEST['aluIns'])?$_REQUEST['aluIns']:array();
	
	echo "Preins:<br>";
	foreach ($aluPreIns as $i) {
		echo $i . "<br>";
	}
	
	echo "<br>Ins:<br>";
	foreach ($aluIns as $i) {
		echo $i . "<br>";
	}*/
	
	$ca = $_REQUEST['ca'];
	$campo = $_REQUEST['campo'];
	$text = $_REQUEST['text'];
	
	echo asignatura::verAluPreIns($ca, $text, $campo);
	
	/*$count = $_GET['count'];
	echo $count;
	for($i=0; $i<$count; $i++){
		if(isset($_GET['dniUsuario'.$i])){
			$dni = $_GET['dniUsuario'.$i];
			$sql = "UPDATE `aluinscritoasi` SET `aceptado` = 'T'
			WHERE `aluinscritoasi`.`emailUsuario` = (SELECT usuario.emailUsuario FROM usuario WHERE usuario.dniUsuario = '".$dni."') 
			AND `aluinscritoasi`.`codAsignatura` = (SELECT `asignatura`.`codAsignatura` FROM asignatura WHERE asignatura.nomAsignatura='".$_GET['nombreAsig']."');";
			
			$resultado = mysql_query($sql);
			echo mysql_error();
		}
	}*/
	
?>
