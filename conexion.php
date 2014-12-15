<?php
function Conectarse()
{
	if (!($link=mysql_connect("localhost","Administrador","Administrador")))
	{
		echo "Error conectando a la base de datos.";
		exit();
	}
	if (!mysql_select_db("ET3",$link))
	{
		echo "Error seleccionando la base de datos.";
		exit();
	}
	return $link;
}
?>