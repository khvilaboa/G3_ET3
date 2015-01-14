<!DOCTYPE html>
<?php
session_start();

include('../seg.php');
comprobarUsuario('Alumno');

include('../MultiLanguage/FuncionIdioma.php');
include('../clases/Asignatura_class.php');
include('../nav.php');

//$_SESSION['idioma']='ENG';

$textos = idioma(8, $_SESSION['idioma']);

$codAsig = $_REQUEST['ca'];
echo $codAsig;
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
                            <h1 class="page-header ex-title"> <?php echo $textos[7]; //Listado de trabajos de ?> <?php echo $asig->getNombre(); ?> </h1>
                            <div class="panel panel-default">
                                <div class="panel-heading ex-panel-header"><?php echo $textos[8]; //Lista de trabajos ?></div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo $textos[9]; //T&iacute;tulo ?></th>
                                                <th><?php echo $textos[10]; //Fecha l&iacute;mite ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $res = $asig->Get_Trabajos();
                                            while ($row = mysql_fetch_array($res)) {
                                                echo "<tr>
													<td><a href=\"entrega.php?ca=" . $row['codAsignatura'] . "&ct=" . $row['codTrabajo'] . "\">" . $row['nombreTrabajo'] . "</td>
													<td>" . $row['fechaLimiteTrabajo'] . "</td>
											 </tr>";
                                            }
                                            ?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="pull-right">
                                <a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[12]; //Volver ?></a>
                            </div><br><br>

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
