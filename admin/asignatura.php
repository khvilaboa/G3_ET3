<!DOCTYPE html>
<?php
session_start();
include_once "../clases/Asignatura_class.php";
include_once "../clases/Usuario_class.php";
include('../MultiLanguage/FuncionIdioma.php');
include('../nav.php');
// La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez
//$_SESSION['idioma']='ENG';
$textos = idioma(1, $_SESSION['idioma']);
$codAsig = $_REQUEST['codAsig'];
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
		
		<!-- jQuery -->
		<script src="../js/jquery.js"></script>
		
		<script>
			$(document).ready(function(){
				$("#buscar").click(function(){
					con = document.getElementById("prof");
					ca = "<?php echo $codAsig;?>";
					text = document.getElementById("filtro").value;
					campo = document.getElementById("campo");
					campo = campo.options[campo.selectedIndex].value;
					
					$.get("../controller/mostrarProfesor.php?text=" + text + "&campo=" + campo + "&ca=" + ca,function(data){
						con.innerHTML = data;
					});
				}); 
			});
		</script>

    </head>

    <body>

        <div id="wrapper">

            <?php showNav($textos); ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <?php
                    if (isset($_GET['codAsig'])) {
                        $asignatura = new Asignatura('', '', '', '');
                        $sql = "select * from Asignatura where codAsignatura='" . $_GET['codAsig'] . "'";
                        $resultado = mysql_query($sql);
                        while ($row = mysql_fetch_array($resultado)) {

                            $asignatura->setNombre($row['nomAsignatura']);
                            $asignatura->setGrado($row['gradoAsignatura']);
                            $asignatura->setCurso($row['cursoAsignatura']);
                            $asignatura->setCodigo($row['codAsignatura']);
                        }
						
                        $sqlUN = "SELECT * FROM usuario U where U.tipoUsuario='profesor' and U.emailUsuario not in (select emailUsuario from proimparteasi P where P.codAsignatura='" . $asignatura->getCodigo() . "') group by U.emailUsuario";
                        $usuarioN = mysql_query($sqlUN);

                        $sqlUS = "SELECT * FROM usuario U, proimparteasi P where U.emailUsuario=P.emailUsuario and P.codAsignatura='" . $asignatura->getCodigo() . "'";
                        $usuarioS = mysql_query($sqlUS);
                        ?>


                        <!-- Page Heading -->
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header"> <?php echo $textos[4]; //Crear/Modificar asignaturas ?> </h1>

                                <div class="panel panel-default">
                                    <div class="panel-heading ex-panel-header"><?php echo $textos[6]; //Datos de la asignatura ?></div>
                                    <div class="panel panel-body">
                                        <form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label"><?php echo $textos[7]; //Nombre: ?></label>
                                                <div class="col-sm-10">
                                                    <input id="name" name="nombreA" type="text" value="<?php echo $asignatura->getNombre() ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="grade" class="col-sm-2 control-label"><?php echo $textos[8]; //Grado: ?></label>
                                                <div class="col-sm-10">
                                                    <input id="grade" name="gradoA" type="text" value="<?php echo $asignatura->getGrado() ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="course" class="col-sm-2 control-label"><?php echo $textos[9]; //Curso: ?></label>
                                                <div class="col-sm-10">
                                                    <input id="course" name="cursoA" type="text" value="<?php echo $asignatura->getCurso() ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="pull-right">

                                                <input type="hidden" name="elemento" value="asignatura"/>
                                                <input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo() ?>"/>
												<a href="../controller/controladorAdmin.php?accion=Borrar&elemento=asignatura&asignatura=<?php echo $asignatura->getCodigo();?>" name="acciona" class="btn ex-button"><?php echo $textos[20]; //Borrar?></a>
                                                <input type="submit" class="btn ex-button" value="<?php echo $textos[10]; //Modificar ?>"/>
                                                <input type="hidden" name="accion" class="btn ex-button" value="Modificar"/>

                                            </div>
                                        </form>
                                    </div></div>		

                                <div class="panel panel-default">
                                    <div class="panel-heading ex-panel-header"><?php echo $textos[11]; //Profesores de la asignatura ?></div>

                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="table-responsive">
                                                    <form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">	
                                                        <table class="table table-striped table-bordered table-hover table-condensed ">
                                                            <thead>
                                                                <tr>
                                                                    <th class="panel-heading ex-panel-header"><?php echo $textos[17]; //Sin asignar ?></th>
                                                                    <th class="panel-heading ex-panel-header"></th>
                                                                    <th class="panel-heading ex-panel-header"></th>
                                                                </tr><tr>
                                                                    <th>DNI</th>
                                                                    <th><?php echo $textos[12]; //Nombre ?></th>
                                                                    <th>	</th>
                                                                </tr>
                                                            </thead>
															<tbody id="prof">

														<?php asignatura::verProfNoImp($codAsig); ?>
														</tbody>
                                                        </table>
                                                </div>
                                            </div>
                                            <div class="col-md-1 text-center">

                                                <input type="hidden" name="elemento" value="asignatura"/>
                                                <input type="hidden" name="anho" value="<?php echo $asignatura->getCurso(); ?>"/>
                                                <input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo(); ?>"/>
                                                <input type="submit" name="accion" class="btn ex-button" value=">"/>


                                                </form>


                                                    <form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">		
                                                    <input type="submit" name="accion" class="btn ex-button" value="<"/>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-condensed ">
                                                        <thead>
                                                            <tr>
                                                                <th class="panel-heading ex-panel-header"><?php echo $textos[18]; //Asignados ?></th>
                                                                <th class="panel-heading ex-panel-header"></th>
                                                                <th class="panel-heading ex-panel-header"></th>
                                                            </tr><tr>
                                                                <th>DNI</th>
                                                                <th><?php echo $textos[12]; //Nombre ?></th>
                                                                <th>	</th>
                                                            </tr>
                                                        </thead>
														<tbody id="profimp">
													<?php asignatura::verProfImp($codAsig); ?>
													</tbody>
                                                    </table>

                                                    <input type="hidden" name="elemento" value="asignatura"/>
                                                    <input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo(); ?>"/>


                                                </div>
                                            </div>
                                            </form>
                                    </li>

                                    <li class="list-group-item">

										<div class="form-group">
										<label for="filterText" class="col-md-1 control-label"><?php echo $textos[13]; //Filtro:?> </label>
											<div class="col-md-5">
												<input type="text" id="filtro" class="form-control" name="texto" placeholder="<?php echo $textos[13]; //Filtro:?>">
											</div>

										<div class="col-md-3">
										<select id="campo" name="campo" class="form-control">
											<option  selected value="nombreUsuario"><?php echo $textos[12]; //Nombre?></option>
											<option value="dniUsuario">Dni</option>
											<option value="apellidoUsuario"><?php echo $textos[15]; //Apellidos?></option>
										</select>

										</div>
										<div class="col-md-2">
										  <button class='btn btn-default btn-lg' id="buscar"><span class="glyphicon glyphicon-search"></span></button>
										</div>
										
										</div>
										<br>
									</li>

                                </div>



                            </div>

                            <div class="pull-right">
                                <a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[16]; //Volver ?></a>  							
                            </div> 

    <?php
}
?>


<?php
if (!isset($_GET['codAsig'])) {
    $asignatura = new Asignatura('', '', '', '');
    $sql = "select * from usuario U, proimparteasi P where U.emailUsuario=P.emailUsuario";
    $usuario = mysql_query($sql);
    ?>


                            <!-- Page Heading -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="page-header"> <?php echo $textos[4]; //Crear/Modificar asignaturas ?> </h1>

                                    <div class="panel panel-default">
                                        <div class="panel-heading ex-panel-header"><?php echo $textos[6]; //Datos de la asignatura ?></div>
                                        <div class="panel panel-body">
                                            <form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">

                                                <div class="form-group">
                                                    <label for="name" class="col-sm-2 control-label"><?php echo $textos[7]; //Nombre: ?></label>
                                                    <div class="col-sm-10">
                                                        <input id="name" name="nombreA" type="text" value="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="grade" class="col-sm-2 control-label"><?php echo $textos[8]; //Grado: ?></label>
                                                    <div class="col-sm-10">
                                                        <input id="grade" name="gradoA" type="text" value="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="course" class="col-sm-2 control-label"><?php echo $textos[9]; //Curso: ?></label>
                                                    <div class="col-sm-10">
                                                        <input id="course" name="cursoA" type="text" value="" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="pull-right">

                                                    <input type="hidden" name="elemento" value="asignatura"/> <!--Cambiar asignatura?-->
                                                    <input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo() ?>"/>
                                                    <input type="submit" class="btn ex-button" value="<?php echo $textos[19]; //Crear ?>"/>
                                                    <input type="hidden" name="accion" class="btn ex-button" value="Crear"/>

                                                </div>
                                            </form>
                                        </div></div>		


                                            <div class="pull-right">
                                                <a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[16]; //Volver ?></a>  							
                                            </div>    
    <?php
}
?>


                                </div>

                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->

                <!-- Bootstrap Core JavaScript -->
                <script src="../js/bootstrap.min.js"></script>

                </body>

                </html>
