<?php
session_start();
include_once('../conexion.php');
include_once('../clases/Entrega_class.php');
include('../nav.php');
Conectarse();
include('../MultiLanguage/FuncionIdioma.php');
//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
//$_SESSION['idioma']='ESP';

$textos = idioma(13,$_SESSION['idioma']);

$codTrab = $_GET['ct'];
$codAsig = $_GET['ca'];
$email = $_GET['mail'];

$ent = new entrega($codAsig, $codTrab, $email, '', '', '', '', '');
$ent->Rellenar();
?>
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
                        <h1 class="page-header ex-title"> Entrega <?php echo $ent->getTitulo(); ?> 
						</h1>
                        <form method="get" action="../controller/evaluarEntrega.php">
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos de la entrega?></div>
											
							<ul class="list-group">
								<li class="list-group-item"><b><?php echo $textos[7];//T&iacute;tulo:?></b> <?php 
																					echo $ent->getTitulo(); 
																				  ?> </li>
								<li class="list-group-item"><b><?php echo $textos[8];//Usuario:?></b> <?php 
																				echo $ent->getEmailUsuario(); 
																			  ?></li>
							</ul>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[9];//Correci&oacute;n?></div>
											
							<div class="panel-body">
								<div class="form-group">
									 <label for="selNosta" class="col-lg-2 control-label"><?php echo $textos[10];//Nota?></label>
										<div class="col-lg-10">
										   <select class="form-control" id="selNota" NAME="nota" value=""> <!--Modificar nota? -->
												<?php
													for($i=0; $i<=10; $i+=0.5) {
														echo "<option " . (($ent->getCalificacion()==$i)?"selected":"") . ">" . $i . "</option>";
													}
												?>
										   <select>
										</div>
								</div><br>
								
								<div class="form-group">
									 <label for="observ" class="col-lg-2 control-label"><?php echo $textos[11];//Observaciones?></label>
										<div class="col-lg-10">
										   <textarea class="form-control" rows="5" id="observ" NAME="observaciones"><?php 
													echo $ent->getObservacion();
												?></textarea>
										  
										</div>
								</div>

							</div>
						</div>
								
						<div class="pull-right">
							<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE="Guardar">
							<INPUT TYPE="hidden" NAME="ca" VALUE="<?php echo $codAsig; ?>">
							<INPUT TYPE="hidden" NAME="ct" VALUE="<?php echo $codTrab; ?>">
							<INPUT TYPE="hidden" NAME="email" VALUE="<?php echo $email; ?>">
						</FORM>
							<a href="trabajo.php?ca=<?php echo $codAsig;?>&ct=<?php echo $codTrab;?>" class="btn ex-button"><?php echo $textos[12]; //Volver?></a>
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
