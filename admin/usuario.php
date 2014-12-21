<!DOCTYPE html>
<?php
	session_start();
	include_once "../clases/Usuario_class.php";
	include('../MultiLanguage/FuncionIdioma.php');
	include('../nav.php');
	// La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez
	//$_SESSION['idioma']='ENG';
	$textos = idioma(4,$_SESSION['idioma']);
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

        <?php showNav($textos); ?>

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
							<h1 class="page-header"> <?php echo $textos[6];//Crear/Modificar Usuario?> </h1>							
									<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
										<div class="form-group">
											<label class="col-sm-2 control-label "><?php echo $textos[7];//Nombre:?></label>
											<div class="col-sm-10">
												<input type="text" name="nombre" value="<?php echo $usuario->getNombre();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"><?php echo $textos[8];//Apellidos:?></label>
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
											<label class="col-sm-2 control-label">E-mail:</label>
											<div class="col-sm-10">
												<input readonly type="text" name="email" value="<?php echo $usuario->getEmail();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"><?php echo $textos[9];//Nueva Contrase&nacute;a:?></label>
											<div class="col-sm-10">
												<input type="password" name="pass" value="<?php echo $usuario->getPassword();?>" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"><?php echo $textos[10];//Tipo:?></label>
											<div class="col-sm-10">
												<select class="form-control" name="tipo"  <?php if($usuario->getTipo()=="Administrador") echo "disabled"?>>
												<?php if($usuario->getTipo()=="Administrador") echo '<option value="Administrador">Administrador</option>'?>
												<option value="Alumno" <?php if($usuario->getTipo()=="Alumno") echo " selected";?>><?php echo $textos[11];//Alumno?></option>
												<option value="Profesor" <?php if($usuario->getTipo()=="Profesor") echo " selected";?>><?php echo $textos[12];//Profesor?></option>
												</select>
											</div>
										</div>
									
									<div class="pull-right">
										
										
										<input type="hidden" name="elemento" value="usuario"/>
										<input type="hidden" name="usuario" value="<?php echo $usuario->getDni()?>"/>
										<?php if($usuario->getTipo()!="Administrador") echo '<input type="submit" name="accion" class="btn ex-button"  value="echo $textos[13];/*Borrar*/"';?>
										<input type="submit" name="accion" class="btn ex-button" value="<?php echo $textos[14];//Modificar?>"/>
										

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
							<h1 class="page-header"> <?php echo $textos[6];//Crear/Modificar Usuario?> </h1>							
								<form method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
									<div class="form-group">
										<label class="col-sm-2 control-label "><?php echo $textos[7];//Nombre:?></label>
										<div class="col-sm-10">
											<input type="text" name="nombre" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $textos[8];//Apellidos:?></label>
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
										<label class="col-sm-2 control-label">E-mail:</label>
										<div class="col-sm-10">
											<input type="text" name="email" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $textos[9];//Nueva Contrase&nacute;a:?></label>
										<div class="col-sm-10">
											<input type="password" name="pass" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-2 control-label"><?php echo $textos[10];//Tipo:?></label>
										<div class="col-sm-10">
											<select class="form-control" name="tipo" >
											<option value="Alumno"><?php echo $textos[11];//Alumno?></option>
											<option value="Profesor"><?php echo $textos[12];//Profesor?></option>
											</select>
										</div>
									</div>
								
								<div class="pull-right">
									
									
									<input type="hidden" name="elemento" value="usuario"/>
									<input type="submit" name="accion" class="btn ex-button" value="<?php echo $textos[15];//Crear?>"/>
									

								</div>
								
								</form>

							<br><br><br><br><br><br><br><br><br><br>
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
