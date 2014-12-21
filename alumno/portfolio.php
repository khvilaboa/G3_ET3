<!DOCTYPE html>
<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');
include('../nav.php');
include ('../conexion.php');
include('../clases/Trabajo_class.php');
include('../clases/Usuario_class.php');
//$_SESSION['idioma']='ENG';

$textos = idioma(10, $_SESSION['idioma']);
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
        <!--<script type="text/javascript">
            function save() {
                var primaryKey = document.getElementsByName("publico");
                var text = '';

                //Para cada elemento en la tabla del formulario,se guarda la PK de la entrega
                for (var i = 0; i < primaryKey.length; i += 1) {
                    text += primaryKey[i].id + ";";

                }
                //Se elimina el último ;
                text = text.substring(0, text.length - 1);
                document.forms['portfolio-form'].action += "?" + text;
                alert(document.forms['portfolio-form'].action);
                //document.getElementById("portfolio-form").submit();
            }
        </script>-->
    </head>

    <body>

        <div id="wrapper">

            <?php showNav($textos); ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header ex-title"> Portfolio </h1>
                            <div class="panel panel-default">

                                <div class="panel-heading ex-panel-header" style="background:rgba(1,0,0,1);color:#999"><?php echo $textos[7]; ?></div> <!--Lista de trabajos-->
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th><?php echo $textos[8]; ?></th> <!--P&uacute;blico-->
                                                <th><?php echo $textos[9]; ?></th> <!--T&iacute;tulo-->
                                                <th><?php echo $textos[10]; ?></th> <!--Entrega-->
                                                <th><?php echo $textos[12]; ?></th> <!--Nota-->
                                                <th><?php echo $textos[13]; ?></th> <!--Comentarios-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <form id="portfolio-form"class="form-horizontal" method="post" action="../controller/controllerPortfolio.php" role="form">
                                            <?php
                                            $link = Conectarse();
                                            $login = $_SESSION['userLogin'];



                                            $resultado = trabajo::ConsultarUsuario($login);

                                            while ($row = mysql_fetch_array($resultado)) {
                                                $resultado2 = trabajo::Consultar($row['codTrabajo'], $row['codAsignatura']);
                                                $descripcion = mysql_fetch_array($resultado2);
                                                echo "<tr>";
                                                echo "<td><input " . (($row['portfolio'] == 'F') ? '' : 'checked') . " type=\"checkbox\" name=\"publico[]\" value='" . $row['codAsignatura'] . " " . $row['codTrabajo'] . "'></td>";
                                                echo "<td><a href= ../" . $row['codAsignatura'] . "/" . $row['codTrabajo'] . "/" . $login . '~' . $row['titulo'] . ">" . $row['titulo'] . "</a></td>";
                                                echo "<td>" . $descripcion['descripcionTrabajo'] . "</td>";
                                                echo "<td>" . $row['calificacion'] . "</td>";
                                                echo "<td>" . $row['observaciones'] . "</td>";
                                                echo "</tr>";
                                            }

                                            echo "<tbody>";
                                            echo "</table>";
                                            echo "</div>";
                                            echo "</div>";

                                            $resultado = usuario::consultarP($login);
                                            $row = mysql_fetch_array($resultado);
                                            echo "<input " . (($row['correccionesUsuario'] == 'F') ? '' : 'checked') . " name = \"notas\" type=\"checkbox\" name=\"notas\"> " . $textos[14] . "<br><br>"; //Mostrar notas;
                                            echo "<input " . (($row['publicoUsuario'] == 'F') ? '' : 'checked') . " name=\"publicarUrl\" type=\"checkbox\" name=\"notas\"> " . $textos[15] . "<br><br>"; //Publicar;
                                            ?>
                                            <p>URL: <?php echo "<a id=\"cosaPaCopiar\" href=\"../portfolio.php?" . $login . "\">Enlace</a>"; ?></p><br>
                                            <div class="pull-left">
                                                <a id="copy-button" class="btn ex-button" href="#" data-clipboard-text="<?php echo $_SERVER['SERVER_ADDR'].$_SERVER['PHP_SELF']."/portfolio.php?" . $login; ?>">Copiame</a><!-- Guardar -->

                                            </div>

                                            <div class="pull-right" id="btn-save">
                                                <a onclick="document.forms['portfolio-form'].submit()" class="btn ex-button"><?php echo $textos[16]; ?></a>  <!-- Guardar -->
                                            </div>
                                        </form>
                                        <br><br>
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
                    <script src="../js/zeroClipBoard/ZeroClipboard.js"></script>
                    <script>
                            var client = new ZeroClipboard(document.getElementById("copy-button"));

                    </script>
                    </body>

                    </html>
