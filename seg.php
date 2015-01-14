<?php

function comprobarUsuario($tipo) {

	if(!(isset($_SESSION['userTipo']) and $_SESSION['userTipo']==$tipo)) {
		header("Location:../index.php");
	}
}

?>