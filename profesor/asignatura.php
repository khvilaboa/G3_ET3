<?php
	session_start();
	include_once("../conexion.php"); 
	include('../MultiLanguage/FuncionIdioma.php');
	include_once "../clases/Asignatura_class.php";
	include('../nav.php');
	
	$link=Conectarse();   
	
	$codAsig=$_GET['ca'];
	$asig = new asignatura('','',-1,$codAsig);
	$asig->Rellenar();
	
	$fil=$_GET['filt'];
	
	//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
	//$_SESSION['idioma']='ENG';
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

        <?php showNav($textos); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> <?php echo $textos[18]; //Asignatura?>
							<?php
								echo $asig->getNombre();
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
										if($fil=='filtro'){
											
											
											$result = asignatura::verAluPreinsFil($_GET['nombreAsig'],$_GET['texto'],$_GET['campo']);
											$count2 = 0;
										while ($row = mysql_fetch_array($result))
										{
											echo "<tr><td>".$row['dniUsuario']."</td>";
											echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
											echo " <td><input type='checkbox' name='dniUsuario".$count2."' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
											$count2++;
										}
										}
										else{
										
										$resultado = asignatura::verAluPreins($codAsig);
										$count2 = 0;
											while ($row = mysql_fetch_array($resultado))
											{
												echo "<tr><td>".$row['dniUsuario']."</td>";
												echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
												echo " <td><input type='checkbox' name='dniUsuario".$count2."' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
												$count2++;
											}
										}
									?>	
								<tbody>
							</table>
							</div>
							</div>
							
							<div class="col-md-1 text-center">
								<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE=">">
								<INPUT TYPE="hidden" NAME="nombreAsig" VALUE="<?php echo $_GET['nombreAsig']; ?>">
								<INPUT TYPE="hidden" NAME="count" VALUE="<?php echo $count2; ?>">


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
									
									if($fil=='filtro'){
											
											
											$result = asignatura::verAluInsFil($_GET['nombreAsig'],$_GET['texto'],$_GET['campo']);
											$count2 = 0;
										while ($row = mysql_fetch_array($result))
										{
											echo "<tr><td>".$row['dniUsuario']."</td>";
											echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
											echo " <td><input type='checkbox' name='dniUsuario".$count2."' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
											$count2++;
										}
										}
										else{
										$resultado = asignatura::verAluIns($codAsig);
										$count = 0;
											while ($row = mysql_fetch_array($resultado))
											{
												echo "<tr><td>".$row['dniUsuario']."</td>";
												echo "<td>".$row['apellidoUsuario'].", ".$row['nombreUsuario']."</td>";
												echo " <td><input type='checkbox' name='dniUsuario".$count."' value='".$row['dniUsuario']."'>  <br><br></td></tr>";
												$count++;
											}
										}
									?>		
									<INPUT TYPE="hidden" NAME="count" VALUE="<?php echo $count; ?>">


									<tbody>
								</table>
								</div>
								</div>
							</li>
						</FORM>
							<FORM method="GET" ACTION="asignatura.php">
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label"><?php echo $textos[8]; //Filtro:?> </label>
									<div class="col-md-5">
										<input type="text" class="form-control" name="texto" placeholder="<?php echo $textos[8]; //Filtro:?>">
									</div>
								
								<div class="col-md-3">
								<select id="campo" name="campo" class="form-control">
									<option  selected value="nombreUsuario"><?php echo $textos[7]; //Nombre?></option>
									<option value="dniUsuario">Dni</option>
									<option value="apellidoUsuario"><?php echo $textos[10]; //Apellidos?></option>
								</select>
								
								</div>
								<div class="col-md-2">
								<INPUT TYPE="hidden" NAME="filt" VALUE="filtro">
								<INPUT TYPE="hidden" NAME="nombreAsig" VALUE="<?php echo $_GET['nombreAsig'];?>">
                                  <button class='btn btn-default btn-lg' type="submit"><span class="glyphicon glyphicon-search"></span></button>
								</div>
								
								</div>
								<br>
							</li>
							</FORM>
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
										$resultado = asignatura::verTrabajos($codAsig);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td><a href='trabajo.php?ca=".$codAsig."&ct=".$row['codTrabajo']."'>".$row['nombreTrabajo']."</a></td>";
											echo "<td>".$row['fechaLimiteTrabajo']."</td></tr>";
										}
									?>	
									
								<tbody>
							</table>
							
							<div class="pull-right">
								<a href="trabajo.php?ca=<?php echo $codAsig; ?>" class="btn ex-button"><?php echo $textos[14]; //Crear trabajo?></a>
							</div><br><br>
							</li>
						</div>
						
						<div class="pull-right">
							<a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[15]; //Volver?></a>
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