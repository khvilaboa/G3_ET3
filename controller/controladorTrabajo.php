<?php
include_once('../conexion.php');

include ('../clases/Trabajo_class.php');
include ('../clases/Asignatura_class.php');
session_start();

$codA = $_GET['ca'];
$codT = $_GET['ct'];
$titulo = $_GET['title'];
$desc = $_GET['desc'];
$fecha = $_GET['limit'];

Conectarse();


if($_GET['ct'] == 'Crear'){ 
	$asig = new asignatura('','','',$codA);
	$asig->Rellenar();
	$codTrab = str_replace(" ", "_", $asig->getNombre()) . substr($asig->getGrado(),0,3) . $asig->getCurso() . str_replace(" ", "_", $titulo);

	$trabajo = new trabajo ($codTrab,$codA,$titulo,$desc,$fecha);
	$trabajo->insertar();
	echo mysql_error();
	
	//header("Location: ../profesor/asignatura.php?ca=" . $codA . "&msg=creado");
}else{
	$codT = $_GET['ct'];
	$trabajo = new trabajo ($codT,$codA,$titulo,$desc,$fecha);
	$trabajo->modificar();
	
	header("Location: ../profesor/asignatura.php?ca=" . $codA . "&msg=modificado");
}
?>