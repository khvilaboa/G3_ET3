<?php
include_once('../conexion.php');

include ('../clases/Trabajo_class.php');
session_start();

$codA = $_GET['ca'];
$codT = $_GET['ct'];
$titulo = $_GET['title'];
$desc = $_GET['desc'];
$fecha = $_GET['limit'];

Conectarse();


if($_GET['ct'] == 'Crear'){ 
	$sql = "select ifnull(max(codTrabajo+1),0) from trabajo where codAsignatura='".$codA."'";
	$resultado = mysql_query($sql);
	$codTrab = mysql_fetch_array($resultado);

	$trabajo = new trabajo ($codT,$codA,$titulo,$desc,$fecha);
	$trabajo->insertar();
	echo mysql_error();
	
	header("Location: ../profesor/asignatura.php?ca=" . $codA . "&msg=creado");
}else{
	$codT = $_GET['ct'];
	$trabajo = new trabajo ($codT,$codA,$titulo,$desc,$fecha);
	$trabajo->modificar();
	
	header("Location: ../profesor/asignatura.php?ca=" . $codA . "&msg=modificado");
}
?>