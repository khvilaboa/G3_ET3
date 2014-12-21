<?php
session_start();
include_once('../conexion.php');
include('../nav.php');
Conectarse();
include('../MultiLanguage/FuncionIdioma.php');
//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
//$_SESSION['idioma']='ESP';

$textos = idioma(15,$_SESSION['idioma']);
?>

<!DOCTYPE html>
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

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
					
                        <h1 class="page-header ex-title"> <?php echo $textos[6];//Perfil?> </h1>
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[7];//Gesti&oacute;n de perfil?></div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form" METHOD="GET" action="controladorPerfil.php">
										
								  <div class="form-group">
									 <label for="passwdAct" class="col-lg-2 control-label"><?php echo $textos[8];//Contrase&ntilde;a actual?></label>
										<div class="col-lg-10">
										   <input type="password" class="form-control" name="passwdAct" placeholder="<?php echo $textos[8];//Contrase&ntilde;a actual?>">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="passwdNew" class="col-lg-2 control-label"><?php echo $textos[9];//Nueva contrase&ntilde;a?></label>
										<div class="col-lg-10">
										   <input type="password" class="form-control" name="passwdNew" placeholder="<?php echo $textos[9];//Nueva contrase&ntilde;a?>">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="passwdRep" class="col-lg-2 control-label"><?php echo $textos[10];//Repetir contrase&ntilde;a?></label>
										<div class="col-lg-10">
										   <input type="password" class="form-control" name="passwdRep" placeholder="<?php echo $textos[10];//Repetir contrase&ntilde;a?>">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label class="col-lg-2 control-label">E-mail</label>
										<div class="col-lg-10">
											<input type="email" class="form-control" id="inputEmail" value="<?php echo $textos[12];//Introduce tu email?>">
										</div>
								  </div>
								  
								  <div class="pull-right"> 
									<button class="btn ex-button" type="submit"><?php echo $textos[11];//Modificar Perfil?></button>
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
