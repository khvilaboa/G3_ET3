<!DOCTYPE html>
<?php 
	include_once "../clases/Asignatura_class.php";
	include_once "../clases/Usuario_class.php";
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
                <a class="navbar-brand" href="index.html">ESEIXesti&oacute;n</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Cerrar sesi&oacute;n</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="listaAsignaturas.php"><i class="fa fa-fw fa-folder-open"></i> Asignaturas</a>
                    </li>
                    <li>
                        <a href="listaUsuarios.php"><i class="fa fa-fw fa-users"></i> Usuarios</a>
                    </li>
                    <li>
                        <a href="../login.php"><i class="fa fa-fw fa-power-off"></i> Cerrar sesi&oacute;n</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
				
				<?php 
				if(isset($_GET['codAsig'])){
					$asignatura=new Asignatura('','','','');
					$sql = "select * from Asignatura where codAsignatura='".$_GET['codAsig']."'";
					$resultado=mysql_query($sql);
					while($row = mysql_fetch_array($resultado)){
		
						$asignatura->setNombre($row['nomAsignatura']);
						$asignatura->setGrado($row['gradoAsignatura']);
						$asignatura->setCurso($row['cursoAsignatura']);
						$asignatura->setCodigo($row['codAsignatura']);
									
					}
					$sqlUN = "SELECT * FROM usuario U where U.tipoUsuario='profesor' and U.emailUsuario not in (select emailUsuario from proimparteasi P where P.codAsignatura='".$asignatura->getCodigo()."') group by U.emailUsuario";
					$usuarioN=mysql_query($sqlUN);
					
					$sqlUS = "SELECT * FROM usuario U, proimparteasi P where U.emailUsuario=P.emailUsuario and P.codAsignatura='".$asignatura->getCodigo()."'";
					$usuarioS=mysql_query($sqlUS);
					
				?>
				
				
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Crear/Modificar Asignaturas </h1>
                        
						<div class="panel panel-default">
						<div class="panel-heading ex-panel-header">Datos de la asignatura</div>
						<div class="panel panel-body">
							<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
							
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Nombre:</label>
									<div class="col-sm-10">
										<input id="name" name="nombreA" type="text" value="<?php echo $asignatura->getNombre()?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="grade" class="col-sm-2 control-label">Grado:</label>
									<div class="col-sm-10">
										<input id="grade" name="gradoA" type="text" value="<?php echo $asignatura->getGrado()?>" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label for="course" class="col-sm-2 control-label">Curso:</label>
									<div class="col-sm-10">
										<input id="course" name="cursoA" type="text" value="<?php echo $asignatura->getCurso()?>" class="form-control">
									</div>
								</div>
								<div class="pull-right">
								
									<input type="hidden" name="elemento" value="asignatura"/>
									<input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo() ?>"/>
									<input type="submit" name="accion" class="btn ex-button" value="Modificar"/>

								</div>
							</form>
						</div></div>		
							
							<div class="panel panel-default">
							<div class="panel-heading ex-panel-header">Profesores de la asignatura</div>
														
							<li class="list-group-item">
							<div class="row">
							<div class="col-md-5">
								<div class="table-responsive">
									<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">	
										<table class="table table-striped table-bordered table-hover table-condensed ">
											<thead>
												<tr>
													<th class="panel-heading ex-panel-header">Sin asignar</th>
													<th class="panel-heading ex-panel-header"></th>
													<th class="panel-heading ex-panel-header"></th>
												</tr><tr>
													<th>DNI</th>
													<th>Nombre</th>
													<th>	</th>
												</tr>
											</thead>
											
											<?php
												$contP=0;
												while($row = mysql_fetch_array($usuarioN)){
													echo"<tbody";
													echo "<tr>";
														echo "<td>".$row['dniUsuario']."</td>";
														echo "<td>".$row['nombreUsuario']."</td>";
														echo "<td><input type='checkbox' name='emailU".$contP++."' value='".$row['emailUsuario']."'/><br><br></td>";
														echo "</tr>";
													
													echo"</tbody>";
												}
											?>
										</table>
								</div>
							</div>
								<div class="col-md-1 text-center">
									<input type="hidden" name="contP" value="<?php echo $contP; ?>"/>
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
												<th class="panel-heading ex-panel-header">Asignados</th>
												<th class="panel-heading ex-panel-header"></th>
												<th class="panel-heading ex-panel-header"></th>
											</tr><tr>
												<th>DNI</th>
												<th>Nombre</th>
												<th>	</th>
											</tr>
										</thead>
																		
										<?php
												$contPS=0;
												while($row = mysql_fetch_array($usuarioS)){
													echo"<tbody";
													echo "<tr>";
														echo "<td>".$row['dniUsuario']."</td>";
														echo "<td>".$row['nombreUsuario']."</td>";
														echo "<td><input type='checkbox' name='emailU".$contPS++."' value='".$row['emailUsuario']."'/><br><br></td>";
														echo "</tr>";
													
													echo"</tbody>";
												}
											?>
									</table>
								
								
									<input type="hidden" name="contPS" value="<?php echo $contPS; ?>"/>
									<input type="hidden" name="elemento" value="asignatura"/>
									<input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo(); ?>"/>
									
							
								</div>
							</div>
							</form>
							</li>
							
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label">Filtro: </label>
									<div class="col-md-7">
										<input type="name" class="form-control" id="filterText" placeholder="Filtro de b&uacute;squeda">
									</div>
								
								<div class="col-md-3">
								<select name="ad" class="form-control">
									<option selected> ---</option>
									<option value="1.htm">Nombre</option>
									<option value="2.htm">Dni</option>
									<option value="3.htm">Apellidos</option>
								</select>
								
								</div>
								</div>
								<br>
							</li>
							
						</div>
						
						
						
					</div>
																			
					<div class="pull-right">
						<a href="listaAsignaturas.php" class="btn ex-button">Volver</a>  							
					</div>    
					<?php
					}
					?>
					
					
				<?php 
				if(!isset($_GET['codAsig'])){
					$asignatura=new Asignatura('','','','');
					$sql="select * from usuario U, proimparteasi P where U.emailUsuario=P.emailUsuario";
					$usuario=mysql_query($sql);
				
				?>
				
				
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> Crear/Modificar Asignaturas </h1>
                        
						<div class="panel panel-default">
						<div class="panel-heading ex-panel-header">Datos de la asignatura</div>
						<div class="panel panel-body">
								<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
								
									<div class="form-group">
										<label for="name" class="col-sm-2 control-label">Nombre:</label>
										<div class="col-sm-10">
											<input id="name" name="nombreA" type="text" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="grade" class="col-sm-2 control-label">Grado:</label>
										<div class="col-sm-10">
											<input id="grade" name="gradoA" type="text" value="" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="course" class="col-sm-2 control-label">Curso:</label>
										<div class="col-sm-10">
											<input id="course" name="cursoA" type="text" value="" class="form-control">
										</div>
									</div>
									<div class="pull-right">
									
										<input type="hidden" name="elemento" value="asignatura"/>
										<input type="hidden" name="asignatura" value="<?php echo $asignatura->getCodigo() ?>"/>
										<input type="submit" name="accion" class="btn ex-button" value="Crear"/>
							
									</div>
								</form>
							</div></div>		
							
							<div class="panel panel-default">
							<div class="panel-heading ex-panel-header">Profesores de la asignatura</div>
														
							<li class="list-group-item">
							<div class="row">
							<div class="col-md-5">
							<div class="table-responsive">
							<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">	
										<table class="table table-striped table-bordered table-hover table-condensed ">
											<thead>
												<tr>
												<th>DNI</th>
													<th>Nombre</th>
													<th>	</th>
												</tr>
											</thead>
											
											<?php
												while($row = mysql_fetch_array($usuario)){
													echo "<tbody ";
													echo "<tr>";
														echo "<td>".$row['dniUsuario']."</td>";
														echo "<td>".$row['nombreUsuario']."</td>";
														echo "<td><input type='checkbox' name='selection' value='selection'>  <br><br></td>	";
													echo "</tr>";
													echo "</tbody>";
												}
											?>
												
										</table>
								</div>
							</div>
								<div class="col-md-1 text-center">
									<a href="#" class="btn ex-button"> > </a> 	
							</form>
							
							
							<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">	
									<a href="#" class="btn ex-button"> < </a><br>
								</div>
		
							<div class="col-md-5">
								<div class="table-responsive">
									<table class="table table-striped table-bordered table-hover table-condensed ">
										<thead>
											<tr>
											<th>DNI</th>
												<th>Nombre</th>
												<th>	</th>
											</tr>
										</thead>
										
										
											
									</table>
							</form>
								</div>
								</div>
							</li>
							
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label">Filtro: </label>
									<div class="col-md-7">
										<input type="name" class="form-control" id="filterText" placeholder="Filtro de b&uacute;squeda">
									</div>
								
								<div class="col-md-3">
								<select name="ad" class="form-control">
									<option selected> ---</option>
									<option value="1.htm">Nombre</option>
									<option value="2.htm">Dni</option>
									<option value="3.htm">Apellidos</option>
								</select>
								
								</div>
								</div>
								<br>
							</li>
							
						</div>
						
						
						
					</div>
																			
					<div class="pull-right">
						<a href="listaAsignaturas.php" class="btn ex-button">Volver</a>  							
					</div>    
					<?php
					}
					?>
					
					
<br><br><br><br><br><br><br><br><br><br>		
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
