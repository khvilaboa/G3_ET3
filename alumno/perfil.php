<!DOCTYPE html>

<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');
include('../nav.php');

//$_SESSION['idioma']='ENG';

$textos = idioma(9,$_SESSION['idioma']);
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

        function validar() {

            var oldPassword = document.getElementById("passwdAct").value;
            var newPassword = document.getElementById("passwdNew").value;
            var passwordRepeat = document.getElementById("passwdRep").value;
            var boton_aceptar = document.getElementById("btn-aceptar");


            //Comprobaciones de "email", no se puede registrar nadie sin email, ademas el formato del email debe ser valido
            if (((oldPassword.length >= 6) && (oldPassword.length < 15)) && ((newPassword.length >= 6) && (newPassword.length < 15)) && ((passwordRepeat.length >= 6) && (passwordRepeat.length < 15)) && (newPassword == passwordRepeat)) {
                boton_aceptar.removeAttribute("disabled", "disabled");
            }
            else {
                boton_aceptar.setAttribute("disabled", "disabled");
            }

        }
    </script>
    <body>

        <div id="wrapper">

            <?php showNav($textos); ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">

                            <h1 class="page-header ex-title"> <?php echo $textos[7];//Perfil?> </h1>
                            <div class="panel panel-default">
                                <div class="panel-heading ex-panel-header"><?php echo $textos[8]; //Gesti&oacute;n de perfil?></div>
                                <div class="panel-body">
                                    <form id="perfilform" METHOD="POST" ACTION="../controller/controllerPerfil.php" class="form-horizontal" role="form">
                                        <?php
                                        include "../conexion.php";

                                        $link = Conectarse();

                                        $login = $_SESSION['userLogin'];

                                        $sql = "Select * from Usuario where emailUsuario='" . $login . "'";
                                        $resultado = mysql_query($sql);
                                        $row = mysql_fetch_array($resultado);
                                        ?>
                                        <div class="form-group">
                                            <label for="passwdAct" class="col-lg-2 control-label"><?php echo $textos[9];//Contrase&ntilde;a actual?></label>
                                            <div class="col-lg-10">
                                                <input type="password" name="actualPassword" onKeyUp="validar()" class="form-control" id="passwdAct" value="" placeholder="<?php echo $textos[9];//Contrase&ntilde;a actual?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdNew" class="col-lg-2 control-label"><?php echo $textos[10];//Nueva contrase&ntilde;a?></label>
                                            <div class="col-lg-10">
                                                <input type = "password" name = "newPassword" onKeyUp="validar()" class = "form-control" id = "passwdNew" value="" placeholder = "<?php echo $textos[10];//Nueva contrase&ntilde;a?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label"><?php echo $textos[12];//Repetir contrase&ntilde;a?></label>
                                            <div class="col-lg-10">
                                                <input type="password" name="repeatPassword" onKeyUp="validar()" class="form-control" id="passwdRep" value="" placeholder="<?php echo $textos[12];//Repetir contrase&ntilde;a?>">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label"><?php echo $textos[15]; //Nombre actual?></label>
                                            <div class="col-lg-10">
                                                <?php
                                                echo "<input name=\"name\" class=\"form-control\" id=\"oldName\" value=\"{$row['nombreUsuario']}\" placeholder=\"Nuevo Nombre\">";
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label"><?php echo $textos[16]; //Apellidos actuales?></label>
                                            <div class="col-lg-10">
                                                <?php
                                                echo "<input name=\"surname\" class=\"form-control\" id=\"oldSurName\" value=\"{$row['apellidoUsuario']}\" placeholder=\"Nuevos Apellidos\">";
                                                ?>
                                            </div>
                                        </div>

                                        <div class="pull-right"> 
                                            <button type="button" onclick="document.forms['perfilform'].submit()" class="btn ex-button" id="btn-aceptar" disabled='disabled'><?php echo $textos[14];//Modificar Perfil?></button>
                                        </div>
                                    </form>


                                </div>
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
