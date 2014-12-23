<!DOCTYPE html>
<script language="JavaScript" src="../md5.js" type="text/javascript"></script> 
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

<script type="text/javascript">

        function validateMail() {
            var regexp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            var email = document.getElementById("register-username").value;

            //Comprobaciones de "email", no se puede registrar nadie sin email, ademas el formato del email debe ser valido
            if (regexp.test(email) == 0) {
                $("#div-username").removeClass("has-success");
                $("#div-username").addClass("has-error");
                $.notify("<?php echo $textos[16];//El email no es válido?>", "error");
				
				return false;
            }
            else {
                $("#div-username").removeClass("has-error");
                $("#div-username").addClass("has-success");
				
				return true;
            }
        } 

        function validateName() {
            var name = document.getElementById("register-name").value;

            //Comprobaciones de "nombre", no se puede registrar nadie sin nombre.
            if (name.length == 0) {
                $("#div-name").removeClass("has-success");
                $("#div-name").addClass("has-error");
                $.notify("<?php echo $textos[17];//El campo nombre no puede estar vacío?>", "error");
				
				return false;
            }
            else {
                $("#div-name").removeClass("has-error");
                $("#div-name").addClass("has-success");
				
				return true;
            }
        }

        function validateSurName() {
            var surName = document.getElementById("register-surname").value;

            //Comprobaciones de "apellido", no se puede registrar nadie sin nombre.
            if (surName.length == 0) {
                $("#div-surname").removeClass("has-success");
                $("#div-surname").addClass("has-error");
                $.notify("<?php echo $textos[18];//El campo apellido no puede estar vacío?>", "error");
				
				return false;
            }
            else {
                $("#div-surname").removeClass("has-error");
                $("#div-surname").addClass("has-success");
				
				return true;
            }
        }

        function validateDNI() {
            valor = document.getElementById("register-dni").value;
            var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

            if ((!(/^\d{8}[A-Z]$/.test(valor))) || (valor.charAt(8) != letras[(valor.substring(0, 8)) % 23])) {
                $("#div-DNI").removeClass("has-success");
                $("#div-DNI").addClass("has-error");
                $.notify("<?php echo $textos[19];//Introduzca un DNI válido?>", "error");
				
				return false;
            }
            else {
                $("#div-DNI").removeClass("has-error");
                $("#div-DNI").addClass("has-success");
				
				return true;
            }
        }

        function validatePassword() {
            //var cont = /(?!^[0-9]*$)(?!^[a-zA-Z]*$)^([a-zA-Z0-9]{6,15})$/;
			var cont = /(?=.*\d)(?=.*[a-z]){6,15}/;
            var password = document.getElementById("register-password").value;
           
			
			if(password.length == 0 ) return false;
			
            if ((cont.test(password) == 0) || (password.length < 6) || (password.length > 15) ) {

                $("#div-password").removeClass("has-success");
                $("#div-password").addClass("has-error");
            
                $.notify("<?php echo $textos[20];//La contraseña debe tener un número ,una letra y entre 6 y 15 caracteres?>", "error");
				
				return false;
            }
            else {
                $("#div-password").removeClass("has-error");
                $("#div-password").addClass("has-success");
               
				
							
				return true;
            }
        }

		function validate() {
			if(validateMail() && validateName() && validateSurName() && validateDNI() && validatePassword()) {
				document.forms["registerform"].elements["register-password"].value = (hex_md5(document.forms["registerform"].elements["register-password"].value));
			
				document.forms['registerform'].submit();
			}
		}
		
       
		
		

    </script>
<body>

    <div id="wrapper">

        <?php showNav($textos); ?>

        <div id="page-wrapper">

            <div class="container-fluid">
				
				<?php 
				if(isset($_GET['emailU'])){
					$usuario = new usuario($_GET['emailU'],'','','','','');
					$usuario->Rellenar();
				?>
				
				
					<!-- Page Heading -->
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header"> <?php echo $textos[21];//Modificar Usuario?> </h1>							
									<form id="registerform" method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
										<div class="form-group" id="div-name">
											<label class="col-sm-2 control-label "><?php echo $textos[7];//Nombre:?></label>
											<div class="col-sm-10">
												<input type="text" id="register-name" name="nombre" value="<?php echo $usuario->getNombre();?>" class="form-control" onblur="validateName()">
											</div>
										</div>
										<div class="form-group" id="div-surname">
											<label class="col-sm-2 control-label"><?php echo $textos[8];//Apellidos:?></label>
											<div class="col-sm-10">
												<input type="text" id="register-surname" name="apellidos" value="<?php echo $usuario->getApellido();?>"class="form-control" onblur="validateSurName()">
											</div>
										</div>
										<div class="form-group" id="div-DNI">
											<label class="col-sm-2 control-label">Dni:</label>
											<div class="col-sm-10">
												<input type="text" id="register-dni" name="dni" value="<?php echo $usuario->getDni();?>" class="form-control" onblur="validateDNI()">
											</div>
										</div>
										<div class="form-group" id="div-username">
											<label class="col-sm-2 control-label">E-mail:</label>
											<div class="col-sm-10">
												<input readonly type="text" id="register-username" name="email" value="<?php echo $usuario->getEmail();?>" class="form-control">
											</div>
										</div>
										<div class="form-group" id="div-password">
											<label class="col-sm-2 control-label"><?php echo $textos[9];//Nueva Contrase&nacute;a:?></label>
											<div class="col-sm-10">
												<input type="password" id="register-password" name="pass" onblur="validatePassword()" value="" class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label class="col-sm-2 control-label"><?php echo $textos[10];//Tipo:?></label>
											<div class="col-sm-10">
												<select class="form-control" name="tipo" disabled>
												<?php if($usuario->getTipo()=="Administrador") echo '<option value="Administrador">Administrador</option>'?>
												<option value="Alumno" <?php if($usuario->getTipo()=="Alumno") echo " selected";?>><?php echo $textos[11];//Alumno?></option>
												<option value="Profesor" <?php if($usuario->getTipo()=="Profesor") echo " selected";?>><?php echo $textos[12];//Profesor?></option>
												</select>
											</div>
										</div>
									
									<div class="pull-right">
										
										
										<input type="hidden" name="elemento" value="usuario"/>
										<input type="hidden" name="usuario" value="<?php echo $usuario->getDni()?>"/>
										<?php if($usuario->getTipo()!="Administrador") echo '<a href="../controller/controladorAdmin.php?accion=Borrar&elemento=usuario&usuario=' . $usuario->getEmail() . '" name="acciona" class="btn ex-button">' . $textos[13] /*Borrar*/ . '</a>';?>
										<input onclick="validate()" class="btn ex-button" value="<?php echo $textos[14];//Modificar?>"/>
										<input type="hidden" name="accion" class="btn ex-button" value="Modificar"/>
										

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
							<h1 class="page-header"> <?php echo $textos[6];//Crear usuario?> </h1>							
								<form id="registerform" method="post" class="form-horizontal" role="form" action="../controller/controladorAdmin.php">
									<div class="form-group" id="div-name">
										<label class="col-sm-2 control-label "><?php echo $textos[7];//Nombre:?></label>
										<div class="col-sm-10">
											<input type="text" id="register-name" name="nombre" class="form-control" onblur="validateName()">
										</div>
									</div>
									<div class="form-group" id="div-surname">
										<label class="col-sm-2 control-label"><?php echo $textos[8];//Apellidos:?></label>
										<div class="col-sm-10">
											<input type="text" name="apellidos" id="register-surname" class="form-control" onblur="validateSurName()">
										</div>
									</div>
									<div class="form-group" id="div-DNI">
										<label class="col-sm-2 control-label">Dni:</label>
										<div class="col-sm-10">
											<input type="text" id="register-dni" name="dni" class="form-control" onblur="validateDNI()">
										</div>
									</div>
									<div class="form-group" id="div-username">
										<label class="col-sm-2 control-label">E-mail:</label>
										<div class="col-sm-10">
											<input type="text" id="register-username" name="email" class="form-control" onblur="validateMail()">
										</div>
									</div>
									<div class="form-group" id="div-password">
										<label class="col-sm-2 control-label"><?php echo $textos[9];//Nueva Contrase&nacute;a:?></label>
										<div class="col-sm-10">
											<input type="password" id="register-password"  name="pass" class="form-control" onblur="validatePassword()">
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
									<input onclick="validate()" class="btn ex-button" value="<?php echo $textos[15];//Crear?>"/>
									<input type="hidden" name="accion" class="btn ex-button" value="Crear"/>
									

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
	<!-- notify -->
    <script src="../js/notify.js"></script>

</body>

</html>
