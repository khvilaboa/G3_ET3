<!DOCTYPE html>
<? session_start()?>
<?php
include('./MultiLanguage/FuncionIdioma.php');

$_SESSION['idioma'] = 'ENG';

$textos = idioma(0, $_SESSION['idioma']);
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

        <!-- Custom Fonts -->
        <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <script type="text/javascript">

        function rememberPassword() {
            //Comprobaciones de "email", no se puede registrar nadie sin email, ademas el formato del email debe ser valido
            if (document.getElementById("login-remember").checked == true) {
                $.notify("<?php echo $textos[8]; //¿Está seguro de que desea recordar su contraseña? ?>", "warn");
            }
        }

        function validar() {

            var regexp = /[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            var email = document.getElementById("login-username").value;
            var password = document.getElementById("login-password").value;
            var boton_aceptar = document.getElementById("btn-login");

            //Comprobaciones de "email", no se puede registrar nadie sin email, ademas el formato del email debe ser valido
            if ((regexp.test(email) != 0) && (password.length >= 6) && (password.length < 15)) {
                boton_aceptar.removeAttribute("disabled", "disabled");
            }
            else {
                boton_aceptar.setAttribute("disabled", "disabled");
            }

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
                                <h3 class="panel-title"><strong>ESEIXesti&oacute;n</strong></h3>
                            </div>

                            <div class="panel-body">
                                <form id="loginform" METHOD="POST" ACTION="controller/controllerLogin.php" class="form-horizontal" role="form">

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" onKeyUp="validar()" name="username" value="" placeholder="<?php echo $textos[1]; //usuario@ejemplo.com ?>">                                        
                                    </div>

                                    <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" onKeyUp="validar()" name="password" placeholder="<?php echo $textos[2]; //Contrase&ntilde;a ?>">
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

                                            <input id="login-remember" type="checkbox" name="remember" value="1" onclick="rememberPassword()"> <?php echo $textos[3]; //Recordar ?>

                                            <div class="pull-right" id="div-login">
                                                <a id="btn-login" onclick="document.forms['loginform'].submit()" disabled='disabled' class="btn btn-success"><?php echo $textos[4]; //Entrar ?>  </a>
                                            </div>
                                        </div>
                                    </div>

                                    <br><br>	

                                    <div class="form-group">
                                        <div class="col-md-12 control">
                                            <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                                <?php echo $textos[5]; //¿No tienes cuenta??>  
                                                <a href="registro.php" onClick="$('#loginbox').hide();
                                                        $('#signupbox').show()">
                                                       <?php echo $textos[6]; //Reg&iacute;strate aqu&iacute;?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>    
                                </form>
                                <!-- Se utilizará en el futuro una vez seleccionado la manera de inicializar la variable idioma en el index
                                <form action="./MultiLanguage/CambioIdioma.php" method="post"> 
                                                                                </form>	
                                                                        <form action="./MultiLanguage/CambioIdioma.php" method="post"> 				
                                    <select name="idioma" onChange='this.form.submit()'>
                                            <option value=""><_?php echo $textos[7];//Seleccione su idioma?></option>
                                            <option value="ENG">English</option>
                                            <option value="ESP">Español</option>
                                            <option value="GAL">Galego</option>
                                                        <option value="DEU">Deutsch</option>
                                    </select>
                                        </form> -->
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
