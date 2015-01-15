<!DOCTYPE html>
<script language="JavaScript" src="./md5.js" type="text/javascript"></script> 

<?php
session_start();
include('./MultiLanguage/FuncionIdioma.php');


//$_SESSION['idioma']='ENG';

$textos = idioma(5,$_SESSION['idioma']);
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
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

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
                $.notify("<?php echo $textos[10];//El email no es válido?>", "error");
				
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
                $.notify("<?php echo $textos[11];//El campo nombre no puede estar vacío?>", "error");
				
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
                $.notify("<?php echo $textos[12];//El campo apellido no puede estar vacío?>", "error");
				
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
                $.notify("<?php echo $textos[13];//Introduzca un DNI válido?>", "error");
				
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
            var pass2 = document.getElementById("register-repeatPassword").value
			
			if(password.length == 0 || pass2.length == 0) return false;
			
            if ((cont.test(password) == 0) || (password.length < 6) || (password.length > 15) || (password != pass2)) {

                $("#div-password").removeClass("has-success");
                $("#div-password").addClass("has-error");
                $("#div-repeatPassword").removeClass("has-success");
                $("#div-repeatPassword").addClass("has-error");
                $.notify("<?php echo $textos[14];//Las contraseñas no coinciden ,deben tener un número ,una letra y entre 6 y 15 caracteres?>", "error");
				
				return false;
            }
            else {
                $("#div-password").removeClass("has-error");
                $("#div-password").addClass("has-success");
                $("#div-repeatPassword").removeClass("has-error");
                $("#div-repeatPassword").addClass("has-success");
				
							
				return true;
            }
        }

		function validate() {
			if(validateMail() && validateName() && validateSurName() && validateDNI() && validatePassword()) {
				document.forms["registerform"].elements["register-password"].value = (hex_md5(document.forms["registerform"].elements["register-password"].value));
			
				document.forms['registerform'].submit();
			}
		}
		
        function ayudaPass() {

            $.notify("<?php echo $textos[15];//Las contraseñas deben tener un número ,una letra y entre 6 y 15 caracteres?>", "info");
        }
		
		

    </script>
    <body>

        <div id="page-wrapper" style="background-color:#222">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row centered-form">
                    <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong><?php echo $textos[2];//Registro?></strong></h3>
                            </div>

                            <div class="panel-body">
                                <form id="registerform"  method="post" action="controller/controllerRegister.php"   class="form-horizontal" role="form">

                                    <div style="margin-bottom: 25px" class="input-group" id="div-username">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                        <input id="register-username" type="text" class="form-control" name="username" value="" placeholder="<?php echo $textos[5];//Correo electr&oacute;nico?>" onblur="validateMail()">                                        
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group" id="div-name">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="register-name" type="text" class="form-control" name="name" placeholder="<?php echo $textos[6];//Nombre?>" onblur="validateName()">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group" id="div-surname">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="register-surname" type="text" class="form-control" name="surname" placeholder="<?php echo $textos[7];//Apellidos?>" onblur="validateSurName()">
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group" id="div-DNI">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-credit-card"></i></span>
                                        <input id="register-dni" type="text" class="form-control" name="dni" value="" placeholder="DNI" onblur="validateDNI()">                                        
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group" id="div-password">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="register-password" type="password" class="form-control" name="password" placeholder="<?php echo $textos[8];//Contrase&ntilde;a?>" onblur="validatePassword()">
                                        <span class="input-group-addon" onClick="ayudaPass()" style="CURSOR: pointer"><i class="glyphicon glyphicon-info-sign"></i></span>
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group" id="div-repeatPassword">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="register-repeatPassword" type="password" class="form-control" name="repeatPassword" placeholder="<?php echo $textos[9];//Repita la contrase&ntilde;a?>" onblur="validatePassword()">
                                    </div>											
                                    <!--<div class="input-group">
                                            <div class="checkbox">
                                                    <label>
                                                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                                                    </label>
                                            </div>
                                    </div>-->

                                    <div class="form-actions">

                                        <div class="col-md-12">

                                            <div class="pull-left">
												<a href="MultiLanguage/CambioIdioma.php?idioma=ESP"><img src="icons/Spain.png"></a>
												<a href="MultiLanguage/CambioIdioma.php?idioma=GAL"><img src="icons/Galicia.png"></a>
												<a href="MultiLanguage/CambioIdioma.php?idioma=ENG"><img src="icons/EEUU.png"></a>
												<a href="MultiLanguage/CambioIdioma.php?idioma=DEU"><img src="icons/Germany.png"></a>
                                            </div>

                                            <div class="pull-right">
												<a id="btn-login" href="index.php" class="btn btn-success"><?php echo $textos[3];//Cancelar?> </a>
                                                <a id="btn-login" onclick="validate()" class="btn btn-success"><?php echo $textos[4];//Registrarse?>  </a>
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>	

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                        </div>
                                    </div>    
                                </form>
                            </div>
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
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- notify -->
    <script src="js/notify.js"></script>

</body>

</html>
