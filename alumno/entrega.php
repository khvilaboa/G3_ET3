<!DOCTYPE html>
<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');
include('../clases/Trabajo_class.php');
include('../clases/Asignatura_class.php');
include('../nav.php');

//$_SESSION['idioma']='ENG';

$textos = idioma(6, $_SESSION['idioma']);

$codAsig = $_REQUEST['ca'];
$codTrab = $_REQUEST['ct'];

$ent = new trabajo($codTrab, $codAsig, '', '', '');
$ent->Rellenar();

$asig = new asignatura('', '', -1, $codAsig);
$asig->Rellenar();
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin - Bootstrap Admin Template</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/sb-admin.css" rel="stylesheet">

        <!-- EseiXestion Style -->
        <link href="../css/ex.css" rel="stylesheet" type="text/css">

        <!-- Custom Fonts -->
        <link href="../font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <?php showNav($textos); ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"> <?php echo $asig->getNombre(); ?> </h1>
                            <div class="panel panel-default">
                                <div class="panel-heading ex-panel-header"><?php echo $textos[7]; //Datos del trabajo ?></div>

                                <ul class="list-group">
                                    <li class="list-group-item"><b><?php echo $textos[8]; //T&iacute;tulo: ?></b> <?php echo $ent->getTitulo(); ?></li>
                                    <li class="list-group-item"><b><?php echo $textos[9]; //Descripci&oacute;n: ?></b> <?php echo $ent->getDescripcion(); ?></li>
                                    <li class="list-group-item"><b><?php echo $textos[10]; //Fecha l&iacute;mite: ?></b> <?php echo $ent->getFechaFinal(); ?></li>
                                </ul>

                            </div>

                            <?php if ($ent->getFechaFinal() >= date("Y-m-d")) { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading ex-panel-header"><?php echo $textos[11]; //Subir Entrega ?></div>

                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <!-- subir archivo-->
                                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                                <label for="ejemplo_archivo_1"><?php echo $textos[12]; //Adjuntar un archivo ?></label>
                                                <input type="file"  name="uploadFile"><br>
                                                <button type="submit" class="btn btn-default" value="Upload File"><?php echo $textos[13]; //Enviar ?></button>
                                            </form>

                                        </li>
                                    </ul>

                                </div>

                            <?php } else { ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading ex-panel-header"><?php echo $textos[14]; //Correcci&oacute;n ?></div>

                                    <ul class="list-group">
                                        <li class="list-group-item"><b><?php echo $textos[15]; //Nota: ?></b> 9</li>
                                        <li class="list-group-item"><b><?php echo $textos[16]; //Observaci&oacute;n: ?></b> Comentarios del profesor que corrige la entrega</li>
                                    </ul>

                                </div>

                            <?php } ?>

                            <div class="pull-right">
                                <a href="listaTrabajos.php" class="btn ex-button"><b><?php echo $textos[17]; //Volver ?></a>
                            </div>

                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

    </body>

</html>
