<?php

session_start();
include_once "../clases/Trabajo_class.php";
include_once "../conexion.php";

$email = $_SESSION['userLogin'];

$publicarUrl = isset($_POST['publicarUrl']) ? 'on' : '';
$correcciones = isset($_POST['notas']) ? 'on' : '';

$link = Conectarse();
$sql = "UPDATE `Usuario` SET `publicoUsuario`='" . (($publicarUrl == 'on') ? 'T' : 'F') . "',`correccionesUsuario`='" . (($correcciones == 'on') ? 'T' : 'F') . "' WHERE `emailUsuario`='" . $email . "'";
$resultado = mysql_query($sql);

$sql = "UPDATE `AluEntregaTra` SET `portfolio`='F' WHERE emailUsuario = '" . $email . "'";
$resultado = mysql_query($sql);

if (isset($_POST['publico'])) {
    foreach ($_POST['publico'] as $publico) {
        $PK = explode(" ", $publico); //$PK[0]=codAsignatura, $PK[1]=codTrabajo
        $sql = "UPDATE `AluEntregaTra` SET `portfolio`='T' WHERE emailUsuario = '" . $email . "' AND codAsignatura='" . $PK[0] . "' AND codTrabajo='" . $PK[1] . "'";
        $resultado = mysql_query($sql);
    }
}
header("Location:../alumno/portfolio.php");

?>