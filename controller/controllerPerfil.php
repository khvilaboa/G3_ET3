<? session_start()?>
<?php

include_once "../clases/Usuario_class.php";

$link = Conectarse();
$email = $_SESSION['userLogin'];

$sql = "Select * from Usuario where emailUsuario='" . $email . "'";
$resultado = mysql_query($sql);
$row = mysql_fetch_array($resultado);

$nombre = $_POST["name"];
$apellidos = $_POST["surname"];
$dni = $row['dniUsuario'];
$password = $_POST["newPassword"];
$tipo = $row['tipoUsuario'];

$user = new usuario($email, $nombre, $password, $apellidos, $dni, $tipo);
$user->modificar();
?>