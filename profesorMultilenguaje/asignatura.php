<?php
	session_start();
	include_once("../conexion.php"); 
	include_once "../clases/Asignatura_class.php";

	$link=Conectarse();  

	include('../MultiLanguage/FuncionIdioma.php');
	$textos = idioma(12,$_SESSION['idioma']);		
?>

<html>
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
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[4];//Cerrar sesi&oacute;n?></a>
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
                        <h1 class="page-header ex-title"> Asignatura
							<?php
								echo $_GET['nombreAsig'];
;							?>
						</h1>
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6]; //Alumnos de la asignatura?></div>
														
							<li class="list-group-item">
							<div class="row">
							<div class="col-md-5">
							<div class="table-responsive">
						<FORM method="GET" ACTION="..\controller\profesor\inscribirAlumno.php">
							<table class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<tr> 
										<th colspan=3> <?php echo $textos[16];//Alumnos pre-inscritos?> </th> 
									</tr>
									<tr>
									<th>DNI</th>
										<th><?php echo $textos[7]; //Nombre?></th>
										<th>	</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$resultado = asignatura::verAluPreins($_GET['nombreAsig']);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td>".$row['dniUsuario']."</td>";
											echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
											echo " <td><input type='checkbox' name='dniUsuario' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
										}
									?>	
								<tbody>
							</table>
							</div>
							</div>
							
							<div class="col-md-1 text-center">
								<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE=">">
								<INPUT TYPE="hidden" NAME="nombreAsig" VALUE="<?php echo $_GET['nombreAsig']; ?>">

						</FORM>
						<FORM method="GET" ACTION="..\controller\profesor\expulsarAlumno.php">
								<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE="<">
								<INPUT TYPE="hidden" NAME="nombreAsig" VALUE="<?php echo $_GET['nombreAsig']; ?>">
							</div>
							
							<div class="col-md-5">
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-condensed">
									<thead>
										<tr> 
											<th colspan=3> <?php echo $textos[17];//Alumnos inscritos?> </th> 
										</tr>
										<tr>
											<th>DNI</th>
											<th><?php echo $textos[7]; //Nombre?></th>
											<th>	</th>
										</tr>
									</thead>
									<tbody>
									<?php
										$resultado = asignatura::verAluIns($_GET['nombreAsig']);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td>".$row['dniUsuario']."</td>";
											echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
											echo " <td><input type='checkbox' name='dniUsuario' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
										}
									?>									

									<tbody>
								</table>
								</div>
								</div>
							</li>
							
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label"><?php echo $textos[8]; //Filtro:?> </label>
									<div class="col-md-7">
										<input type="name" class="form-control" id="filterText" placeholder="<?php echo $textos[8]; //Filtro:?>">
									</div>
								
								<div class="col-md-3">
								<select name="ad" class="form-control">
									<option selected> ---</option>
									<option value="1.htm"><?php echo $textos[7]; //Nombre?></option>
									<option value="2.htm">Dni</option>
									<option value="3.htm"><?php echo $textos[10]; //Apellidos?></option>
								</select>
								
								</div>
								</div>
								<br>
							</li>
							
						</div>
						
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[11]; //Trabajos de la asignatura?></div>

							<li class="list-group-item">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><?php echo $textos[12]; //Trabajo?></th>
										<th><?php echo $textos[13]; //Fecha l&iacute;mite?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$resultado = asignatura::verTrabajos($_GET['nombreAsig']);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td><a href='trabajo.php?codTrabajo=".$row['codTrabajo']."&codAsig=".$row['codAsignatura']."'>".$row['nombreTrabajo']."</a></td>";
											echo "<td>".$row['fechaLimiteTrabajo']."</td></tr>";
										}
									?>	
									
								<tbody>
							</table>
							
							<div class="pull-right">
								<a href="trabajo.html" class="btn ex-button"><?php echo $textos[14]; //Crear trabajo?></a>
							</div><br><br>
							</li>
						</div>
						
						<div class="pull-right">
							<a href="listaAsignaturas.html" class="btn ex-button"><?php echo $textos[15]; //Volver?></a>
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