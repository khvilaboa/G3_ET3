<?php
include_once('../../conexion.php');


include ('../../clases/Trabajo_class.php');
session_start();

$nomA = $_GET['nomA'];
//$codA = $_GET['codA'];
$codT = $_GET['codT'];
$titulo = $_GET['title'];
$desc = $_GET['desc'];
$fecha = $_GET['limit'];

Conectarse();

$sql = "select codAsignatura from asignatura where nomAsignatura='".$nomA."'";
$resultado = mysql_query($sql);
$codAsig = mysql_fetch_array($resultado);


if($_GET['codT'] == 'Crear'){ 
	$sql = "select ifnull(max(codTrabajo+1),0) from trabajo where codAsignatura='".$codAsig['codAsignatura']."'";
	$resultado = mysql_query($sql);
	$codTrab = mysql_fetch_array($resultado);

	$trabajo = new trabajo ($codTrab[0], $codAsig['codAsignatura'],$titulo,$desc,$fecha);
	$trabajo->insertar();
	echo mysql_error();
?>
<script type="text/javascript">
	function redireccionar(){
		window.location="../../profesor/asignatura.php?nombreAsig=<?php echo $nomA ?>";
	} 
	setTimeout ("redireccionar()", 1); //tiempo expresado en milisegundos
</script>
<?php
	}else{
		$codT = $_GET['codT'];
		$trabajo = new trabajo ($codT,$codAsig['codAsignatura'],$titulo,$desc,$fecha);
		$trabajo->modificar();
?>
<script type="text/javascript">
	function redireccionar(){
		window.location="../../profesor/asignatura.php?nombreAsig=<?php echo $nomA ?>";
	} 
	setTimeout ("redireccionar()", 1); //tiempo expresado en milisegundos
</script>
<?php

}
?>
