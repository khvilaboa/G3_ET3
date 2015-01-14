<!DOCTYPE html>
<?php
	session_start();
	
	include('../seg.php');
	comprobarUsuario('Administrador');

	include_once "../clases/Usuario_class.php";
	include('../MultiLanguage/FuncionIdioma.php');
	include('../nav.php');
	// La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez
	//$_SESSION['idioma']='ENG';
	$textos = idioma(3,$_SESSION['idioma']);
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

		
		<?php
			$usuario = new usuario('','','','','','');
			$listado=$usuario->consultar("","");
				
		?>
		
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo $textos[6];//Lista de usuarios?></h1>
						
						<div class="panel panel-default">
						 <div class="panel-heading ex-panel-header"><?php echo $textos[5];//Usuarios?></div>
						 
						 <div class="table-responsive">
							<table class="table table-hover">
							<thead>
								<tr>
									<th width="110px">DNI</th>
									<th width="110px"><?php echo $textos[7];//Nombre?></th>
									<th width="110px"><?php echo $textos[8];//Apellidos?></th>
									<TH width="110px">E-mail</TH>				
								</tr>
							</thead>
							
							<?php
							echo mysql_error();
							while($row=mysql_fetch_array($listado)){
	
								echo "<tbody>";
									echo "<tr>";
									echo "<td><a href=usuario.php?emailU=".$row['emailUsuario'].">".$row['dniUsuario']."</a></td>";
									echo "<td>".$row['nombreUsuario']."</td>";
									echo "<td>".$row['apellidoUsuario']."</td>";
									echo "<td>".$row['emailUsuario']."</td>";
									echo "<td> </td>";
									echo "</tr>";
								echo "</tbody>";
								
							}	
							?>
						</table>
						</div>
					</div>
					
                      
						
						
	
						
						
						<div class="pull-right">
							<a href="usuario.php" class="btn ex-button"><?php echo $textos[9];//Crear Usuario?></a>  							
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
