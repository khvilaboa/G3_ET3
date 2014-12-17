<!DOCTYPE html>
<?php
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
				if(isset($_GET['emailU'])){
					$usuario = new usuario('','','','','','');
					$sql = "select * from Usuario where emailUsuario='".$_GET['emailU']."'";
					$resultado=mysql_query($sql);
					while($row = mysql_fetch_array($resultado)){
		
						$usuario->setEmail($row['emailUsuario']);
						$usuario->setNombre($row['nombreUsuario']);
						$usuario->setPassword($row['passwordUsuario']);
						$usuario->setApellido($row['apellidoUsuario']);
						$usuario->setDni($row['dniUsuario']);
						$usuario->setTipo($row['tipoUsuario']);
									
					}				
				?>
				
				
					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"> Crear/Modificar Usuario </h1>							
									<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
										<div class="form-group">
											<label class="col-sm-2 control-label ">Nombre:</label>
											<div class="col-sm-10">
												<input type="text" name="nombre" value="<?php echo $usuario->getNombre();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Apellidos:</label>
											<div class="col-sm-10">
												<input type="text" name="apellidos" value="<?php echo $usuario->getApellido();?>"class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Dni:</label>
											<div class="col-sm-10">
												<input type="text" name="dni" value="<?php echo $usuario->getDni();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Email:</label>
											<div class="col-sm-10">
												<input readonly type="text" name="email" value="<?php echo $usuario->getEmail();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Nueva Contrase&nacute;a:</label>
											<div class="col-sm-10">
												<input type="password" name="pass" value="<?php echo $usuario->getPassword();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label">Tipo:</label>
											<div class="col-sm-10">
												<select class="form-control" name="tipo" >
												<option value="Alumno" <?php if($usuario->getTipo()=="Alumno") echo " selected";?>>Alumno</option>
												<option value="Profesor" <?php if($usuario->getTipo()=="Profesor") echo " selected";?>>Profesor</option>
												</select>
											</div>
										</div>
									
									<div class="pull-right">
										
										
										<input type="hidden" name="elemento" value="usuario"/>
										<input type="hidden" name="usuario" value="<?php echo $usuario->getDni() ?>"/>
										<input type="submit" name="accion" class="btn ex-button" value="Borrar"/>
										<input type="submit" name="accion" class="btn ex-button" value="Modificar"/>
										

									</div>
									
									</form>
								
								
							
							<br><br><br><br><br><br><br><br><br><br>
						</div>
					</div>
					<!-- /.row -->
				<?php
				}
				?>
			
			<?php 
			if(!isset($_GET['emailU'])){
				$usuario = new usuario('','','','','','');
						
			?>
				<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"> Crear/Modificar Usuario </h1>							
								<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
									<div class="form-group">
										<label class="col-sm-2 control-label ">Nombre:</label>
										<div class="col-sm-10">
											<input type="text" name="nombre" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Apellidos:</label>
										<div class="col-sm-10">
											<input type="text" name="apellidos" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Dni:</label>
										<div class="col-sm-10">
											<input type="text" name="dni" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Email:</label>
										<div class="col-sm-10">
											<input type="text" name="email" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nueva Contrase&nacute;a:</label>
										<div class="col-sm-10">
											<input type="password" name="pass" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Tipo:</label>
										<div class="col-sm-10">
											<select class="form-control" name="tipo" >
											<option value="Alumno">Alumno</option>
											<option value="Profesor">Profesor</option>
											</select>
										</div>
									</div>
								
								<div class="pull-right">
									
									
									<input type="hidden" name="elemento" value="usuario"/>
									<input type="submit" name="accion" class="btn ex-button" value="Crear"/>
									

								</div>
								
								</form>

							<br><br><br><br><br><br><br><br><br><br>
						</div>
					</div>
					<!-- /.row -->
				
                
			
			<?php
			}
			?>
			
			
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
