<?php
	include_once("../../conexion.php"); 
	Conectarse();
	
	$sql = "UPDATE `aluentregatra` SET `observaciones` = '".$_GET['observaciones']."', `calificacion` = '".$_GET['nota']."' 
	WHERE `aluentregatra`.`emailUsuario` = '".$_GET['emailUs']."' AND `aluentregatra`.`codAsignatura` = '".$_GET['codAsig']."' 
	AND `aluentregatra`.`codTrabajo` = '".$_GET['codTrab']."';";
	
	$resultado = mysql_query($sql);
	echo mysql_error();
?>
<script type="text/javascript">
	function redireccionar(){
	  window.location="../../profesor/trabajo.php?codTrabajo=<?php echo $_GET['codTrab']; ?>&codAsig=<?php echo $_GET['codAsig']; ?>&nomAsig=<?php echo $_GET['nomAsig']; ?>";
	} 
	setTimeout ("redireccionar()", 1); //tiempo expresado en milisegundos
</script>