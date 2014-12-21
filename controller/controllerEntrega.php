<?php

include_once('../conexion.php');
include ('../clases/Trabajo_class.php');
include ('../clases/Entrega_class.php');
session_start();

$email = $_SESSION['userLogin'];
$codAsig = $_REQUEST['ca'];
$codTrab = $_REQUEST['ct'];
$fechaEntrega = $_REQUEST['fe'];
// En versiones de PHP anteriores a 4.1.0, $HTTP_POST_FILES debe utilizarse en lugar
// de $_FILES.

$uploaddir = '../uploads/' . $codAsig . '/' . $codTrab . '/'; //.$email.'~'.$_FILES['userfile']['name']
$uploadfile = $uploaddir . $email . '~' . basename($_FILES['uploadFile']['name']);

echo $uploaddir;
echo "<br>";
echo $uploadfile;
echo "<br>";
echo '<pre>';

if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadfile)) {
    $ent = new entrega($codAsig, $codTrab, $email, date("Y-m-d"), null, basename($_FILES['uploadFile']['name']), NULL, 'F');
    $ent->Insertar();
    header("Location:../alumno/listaAsignaturas.php");
}
?>