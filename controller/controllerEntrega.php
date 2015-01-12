<?php

include_once('../conexion.php');
include ('../clases/Trabajo_class.php');
include ('../clases/Entrega_class.php');
session_start();

function stripAccents($string){
	return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
}

echo $_FILES['uploadFile']['name'] . "<br>";
echo mb_convert_encoding($_FILES['uploadFile']['name'], "UTF-8", "auto");
echo utf8_encode($_FILES['uploadFile']['name']);

$email = $_SESSION['userLogin'];
$codAsig = $_REQUEST['ca'];
$codTrab = $_REQUEST['ct'];
$fechaEntrega = $_REQUEST['fe'];
// En versiones de PHP anteriores a 4.1.0, $HTTP_POST_FILES debe utilizarse en lugar
// de $_FILES.

$uploaddir = '../uploads/' . $codAsig . '/' . $codTrab . '/'; //.$email.'~'.$_FILES['userfile']['name']
$uploadname= $email . '~' . str_replace(" ", "_", basename($_FILES['uploadFile']['name']));
$uploadfile = $uploaddir . $uploadname;

echo $uploaddir;
echo "<br>";
echo $uploadfile;
echo "<br>";
echo '<pre>';

if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $uploadfile)) {
    $ent = new entrega($codAsig, $codTrab, $email, date("Y-m-d"), null, $uploadname, NULL, 'F');
    $ent->Insertar();
    //header("Location:../alumno/listaAsignaturas.php");
}
?>