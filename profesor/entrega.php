<?php
session_start();
include_once('../conexion.php');
Conectarse();
include('../MultiLanguage/FuncionIdioma.php');
//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
//$_SESSION['idioma']='ESP';

$textos = idioma(13,$_SESSION['idioma']);
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

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><?php echo $textos[2];//ESEIXesti&oacute;n - Profesor?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.html"><i class="fa fa-fw fa-user"></i> <?php echo $textos[3]; //Perfil?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i><?php echo $textos[4];//Cerrar sesi&oacute;n?></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="perfil.html"><i class="fa fa-fw fa-dashboard"></i> <?php echo $textos[3]; //Perfil?></a>
                    </li>
                    <li>
                        <a href="listaAsignaturas.html"><i class="fa fa-fw fa-bar-chart-o"></i> <?php echo $textos[5]; //Asignaturas?></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[4];//Cerrar sesi&oacute;n?></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> Entrega <?php 
																	echo $_GET['nombreAsig']; 
																  ?> 
						</h1>
                        <FORM method="GET" ACTION="..\controller\profesor\evaluarEntrega.php">
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos de la entrega?></div>
											
							<ul class="list-group">
								<li class="list-group-item"><b><?php echo $textos[7];//T&iacute;tulo:?></b> <?php 
																					echo $_GET['nombreEntrega']; 
																				  ?> </li>
								<li class="list-group-item"><b><?php echo $textos[8];//Usuario:?></b> <?php 
																				echo $_GET['emailUs']; 
																			  ?></li>
							</ul>
						</div>
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[9];//Correci&oacute;n?></div>
											
							<div class="panel-body">
								<div class="form-group">
									 <label for="selNosta" class="col-lg-2 control-label"><?php echo $textos[10];//Nota?></label>
										<div class="col-lg-10">
										   <select class="form-control" id="selNota" NAME="nota"> <!--Modificar nota? -->
												<option>1</option>
												<option>2</option>
												<option>3</option>
												<option>4</option>
												<option>5</option>
												<option>6</option>
												<option>7</option>
												<option>8</option>
												<option>9</option>
												<option>10</option>
										   <select>
										</div>
								</div><br>
								
								<div class="form-group">
									 <label for="observ" class="col-lg-2 control-label"><?php echo $textos[11];//Observaciones?></label>
										<div class="col-lg-10">
										   <textarea class="form-control" rows="5" id="observ" NAME="observaciones"><?php 
													$sql = "select observaciones from aluentregatra
													WHERE `codAsignatura`='".$_GET['codAsig']."' AND codTrabajo='".$_GET['codTrabajo']."' AND emailUsuario='".$_GET['emailUs']."'";													
													$resultado = mysql_query($sql);
													$observacion = mysql_fetch_array($resultado);
													echo $observacion['observaciones'];
												?></textarea>
										  
										</div>
								</div>

							</div>
						</div>
								
						<div class="pull-right">
							<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE="Guardar">
							<INPUT TYPE="hidden" NAME="codAsig" VALUE="<?php echo $_GET['codAsig']; ?>">
							<INPUT TYPE="hidden" NAME="codTrab" VALUE="<?php echo $_GET['codTrabajo']; ?>">
							<INPUT TYPE="hidden" NAME="emailUs" VALUE="<?php echo $_GET['emailUs']; ?>">
							<INPUT TYPE="hidden" NAME="nomAsig" VALUE="<?php echo $_GET['nombreAsig']; ?>">
						</FORM>
							<a href="trabajo.php" class="btn ex-button"><?php echo $textos[12]; //Volver?></a>
						</div>
						  
					</div>
					<form action="../MultiLanguage/CambioIdioma.php" method="post"> 
						</form>	
					<form action="../MultiLanguage/CambioIdioma.php" method="post"> 				
    <select name="idioma" onChange='this.form.submit()'>
            <option value=""><?php echo $textos[1];//Seleccione su idioma?></option>
            <option value="ENG">English</option>
            <option value="ESP">Español</option>
            <option value="GAL">Galego</option>
			<option value="DEU">Deutsch</option>
    </select>
	</form>
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
