 <?php
// CambioIdioma.php
// Esta pagina es invocada por los enlaces de cambio de idioma
// Trae el idioma nuevo a poner en la aplicacion en la variable $idioma

// iniciamos la sesiÃ³n
session_start();

// Recogemos la variable de idioma Y Sustituimos la variable de sesion de idioma por el nuevo valor
$_SESSION['idioma'] = $_REQUEST['idioma'];

// invocamos la pagina desde donde se llamo a esta
header("location: ".$_SERVER['HTTP_REFERER']); 
?> 
