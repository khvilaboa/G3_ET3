<?php
	include_once("../../conexion.php"); 
	Conectarse();

	$count = $_GET['count'];
	for($i=0; $i<$count; $i++){
		if(isset($_GET['dniUsuario'.$i])){
			$dni = $_GET['dniUsuario'.$i];
			$sql = "UPDATE `aluinscritoasi` SET `aceptado` = 'F'
			WHERE `aluinscritoasi`.`emailUsuario` = (SELECT usuario.emailUsuario FROM usuario WHERE usuario.dniUsuario = '".$dni."') 
			AND `aluinscritoasi`.`codAsignatura` = (SELECT `asignatura`.`codAsignatura` FROM asignatura WHERE asignatura.nomAsignatura='".$_GET['nombreAsig']."');";
			
			$resultado = mysql_query($sql);
			echo mysql_error();
		}
	}

	
	
?>
<script type="text/javascript">
	function redireccionar(){
	  window.location="../../profesor/asignatura.php?nombreAsig=<?php echo $_GET['nombreAsig']; ?>";
	} 
	setTimeout ("redireccionar()", 1); //tiempo expresado en milisegundos
</script>