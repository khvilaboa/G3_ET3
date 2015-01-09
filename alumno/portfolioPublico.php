<!DOCTYPE html>
<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');
include ('../conexion.php');
include('../clases/Trabajo_class.php');
include('../clases/Usuario_class.php');
//$_SESSION['idioma']='ENG';

$textos = idioma(10, $_SESSION['idioma']);

$email = $_GET['u'];

$link = Conectarse();

$usuario = new usuario($email,'','','','','');
$usuario->Rellenar();

$resultado = trabajo::ConsultarUsuarioPublico($email);
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

    <body style="background-color:#222">

        <div id="wrapper">

            <div id="page-wrapper">

                <div class="container-fluid">
					<br><br>
                    <!-- Page Heading -->
                    <div class="row centered-form">
                    <div class="col-xs-12 col-sm-8 col-sm-offset-2">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Portfolio</strong></h3>
                            </div>

                            <div class="panel-body">
								<?php if($usuario->getPublico()=='T') {?>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                
                                                <th><?php echo $textos[9]; ?></th> <!--T&iacute;tulo-->
                                                <th><?php echo $textos[10]; ?></th> <!--Entrega-->
												<?php if($usuario->getCorreciones()=='T') {?>
                                                <th><?php echo $textos[12]; ?></th> <!--Nota-->
                                                <th><?php echo $textos[13]; ?></th> <!--Comentarios-->
												<?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                           
                                            while ($row = mysql_fetch_array($resultado)) {
                                                $resultado2 = trabajo::Consultar($row['codTrabajo'], $row['codAsignatura']);
                                                $descripcion = mysql_fetch_array($resultado2);
                                                echo "<tr>";
                                                
                                                echo "<td><a href= ../uploads/" . $row['codAsignatura'] . "/" . $row['codTrabajo'] . "/" . $row['titulo'] . ">" . str_replace("_"," ",substr($row['titulo'],strrpos($row['titulo'],"~")+1)) . "</a></td>";
                                                echo "<td>" . $descripcion['descripcionTrabajo'] . "</td>";
                                                if($usuario->getCorreciones()=='T') {
													echo "<td>" . $row['calificacion'] . "</td>";
													echo "<td>" . $row['observaciones'] . "</td>";
												}
                                                echo "</tr>";
                                            }

                                            echo "<tbody>";
                                            echo "</table>";
											?>
										</div>
										<?php } else { ?>
										<br>El portfolio de este usuario no está disponible
										<?php } ?>
										</div>
                                        <br><br>
                                        </div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.container-fluid -->

                        </div>
                        <!-- /#page-wrapper -->

                    </div></div></div>
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
