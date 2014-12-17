<!DOCTYPE html>
<? session_start()?>
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
                    <a class="navbar-brand" href="index.php">ESEIXesti&oacute;n - Alumno</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['userName']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="perfil.php"><i class="fa fa-fw fa-user"></i> Perfil</a>
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
                            <a href="listaAsignaturas.php"><i class="fa fa-fw fa-dashboard"></i> Asignaturas</a>
                        </li>
                        <li>
                            <a href="preinscripcion.php"><i class="fa fa-fw fa-dashboard"></i> Preinscripci&oacute;n</a>
                        </li>
                        <li>
                            <a href="portfolio.php"><i class="fa fa-fw fa-bar-chart-o"></i> Portfolio</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> Cerrar sesi&oacute;n</a>
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

                            <h1 class="page-header ex-title"> Gesti&oacute;n de perfil </h1>
                            <div class="panel panel-default">
                                <div class="panel-heading ex-panel-header">Gesti&oacute;n de perfil</div>
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
                                            <label for="passwdAct" class="col-lg-2 control-label">Contrase&ntilde;a actual</label>
                                            <div class="col-lg-10">
                                                <input type="password" name="actualPassword" onKeyUp="validar()" class="form-control" id="passwdAct" value="" placeholder="Contrase&ntilde;a actual">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdNew" class="col-lg-2 control-label">Nueva contrase&ntilde;a</label>
                                            <div class="col-lg-10">
                                                <input type = "password" name = "newPassword" onKeyUp="validar()" class = "form-control" id = "passwdNew" value="" placeholder = "Nueva contrase&ntilde;a">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label">Repetir contrase&ntilde;a</label>
                                            <div class="col-lg-10">
                                                <input type="password" name="repeatPassword" onKeyUp="validar()" class="form-control" id="passwdRep" value="" placeholder="Repetir contrase&ntilde;a">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label">Nombre actual</label>
                                            <div class="col-lg-10">
                                                <?php
                                                echo "<input name=\"name\" class=\"form-control\" id=\"oldName\" value=\"{$row['nombreUsuario']}\" placeholder=\"Nuevo Nombre\">";
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="passwdRep" class="col-lg-2 control-label">Apellidos actuales</label>
                                            <div class="col-lg-10">
                                                <?php
                                                echo "<input name=\"surname\" class=\"form-control\" id=\"oldSurName\" value=\"{$row['apellidoUsuario']}\" placeholder=\"Nuevos Apellidos\">";
                                                ?>
                                            </div>
                                        </div>

                                        <div class="pull-right"> 
                                            <button type="button" onclick="document.forms['perfilform'].submit()" class="btn ex-button" id="btn-aceptar" disabled='disabled'>Modificar Perfil</button>
                                        </div>
                                    </form>


                                </div>
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
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
