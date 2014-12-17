<!DOCTYPE html>


<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');

//$_SESSION['idioma']='ENG';
$textos = idioma(7,$_SESSION['idioma']);
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
                <a class="navbar-brand" href="#">ESEIXesti&oacute;n - <?php echo $textos[11]; //Alumno?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['userName'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> <?php echo $textos[2]; //Perfil?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[3]; //Cerrar sesi&oacute;n?></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
					<li>
                        <a href="listaAsignaturas.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $textos[4]; //Asignaturas?></a>
                    </li>
                    <li>
                        <a href="preinscripcion.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $textos[5]; //Preinscripci&oacute;n?></a>
                    </li>
                    <li>
                        <a href="portfolio.php"><i class="fa fa-fw fa-bar-chart-o"></i> <?php echo $textos[6]; //Portfolio?></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[3]; //Cerrar sesi&oacute;n?></a>
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
                        <h1 class="page-header ex-title"> <?php echo $textos[7]; //Asignaturas?> </h1>
                        <div class="panel panel-default">
						 <div class="panel-heading ex-panel-header"><?php echo $textos[8]; //Lista de asignaturas?></div>
						 <div class="table-responsive">
						 <table class="table table-striped table-bordered table-hover">
							
								<tr>
									<th><?php echo $textos[9]; //Nombre?></th>
									
								</tr>
							
								
							
								
								   <?php							   
									include "../conexion.php";
									
									
									$link = Conectarse();
									
									$login =  $_SESSION['userLogin'];
									
									
									$sql= "Select A.nomAsignatura from AluInscritoAsi Ai, Asignatura A where Ai.codAsignatura=A.codAsignatura AND Ai.emailUsuario='".$login."'";
								   
								   
								   
									$resultado = mysql_query($sql);
								
									while ($row = mysql_fetch_array($resultado))
										{
											echo "<TR>";
											echo "<TD>".$row['nomAsignatura']."</TD>";
											echo "</TR>";
										}
									
								   
								   ?>
								
								
								
							
						</table>
					</div>	
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
