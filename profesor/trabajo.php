<?php
session_start();
include_once('../conexion.php');
include_once('../clases/Trabajo_class.php');
Conectarse();
?>

<!DOCTYPE html>

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
                <a class="navbar-brand" href="index.html">ESEIXesti&oacute;n - Profesor</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['userName'] ?>  <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.html"><i class="fa fa-fw fa-user"></i> Perfil</a>
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
                        <a href="perfil.html"><i class="fa fa-fw fa-dashboard"></i> Perfil</a>
                    </li>
                    <li>
                        <a href="listaAsignaturas.html"><i class="fa fa-fw fa-bar-chart-o"></i> Asignaturas</a>
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
				<?php 
					if(isset($_GET['codTrabajo'])){
						$trabajo = new trabajo ('','','','','');
						$sql = "select * from trabajo where codTrabajo=".$_GET['codTrabajo']." and codAsignatura ='".$_GET['codAsig']."'";
						
						$resultado=mysql_query($sql);
						$row = mysql_fetch_array($resultado);
							$trabajo->setCodTrab($row['codTrabajo']);
							$trabajo->setCodAsig($row['codAsignatura']);
							$trabajo->setTitulo($row['nombreTrabajo']);
							$trabajo->setDescripcion($row['descripcionTrabajo']);
							$trabajo->setFechaFinal($row['fechaLimiteTrabajo']);
					echo mysql_error();
				?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> <?php echo $trabajo->getTitulo();?> </h1>
                        
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header">Datos del trabajo</div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form" METHOD="GET" action="..\controller\profesor\controladorTrabajo.php">
										
								  <div class="form-group">
									 <label for="title" class="col-lg-2 control-label">T&iacute;tulo</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="title" value="<?php echo $trabajo->getTitulo();?>">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="desc" class="col-lg-2 control-label">Descripci&oacute;n</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="desc" value="<?php echo $trabajo->getDescripcion();?>">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="limit" class="col-lg-2 control-label">Fecha l&iacute;mite</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="limit" value="<?php echo $trabajo->getFechaFinal();?>">
										</div>
								  </div>

							  
							   
							  <p class="pull-right"> 
								<input type="hidden" name="codT" value="<?php echo $_GET['codTrabajo'];?>">
								<!--<input type="hidden" name="codA" value="<?php echo $_GET['codAsig'];?>"> -->
								<input type="hidden" name="nomA" value="<?php echo $_GET['nomAsig'];?>">
								<button type="submit" class="btn ex-button">Modificar</button>
							  </p>
							   </form>
						  </div>
					    </div>
						
					</div>
                    </div>
					<?php
					}
					else{
					?>
					<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> Crear trabajo </h1>
                        
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header">Datos del trabajo</div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form" METHOD="GET" action="..\controller\profesor\controladorTrabajo.php">
										
								  <div class="form-group">
									 <label for="title" class="col-lg-2 control-label">T&iacute;tulo</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="title" placeholder="Introduce t&iacute;tulo">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="desc" class="col-lg-2 control-label">Descripci&oacute;n</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="desc" placeholder="Introduce descripci&oacute;n">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="limit" class="col-lg-2 control-label">Fecha l&iacute;mite</label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="limit" placeholder="Introduce fecha l&iacute;mite">
										</div>
								  </div>

							  
							   
							  <p class="pull-right"> 
							  <input type="hidden" name="nomA" value="<?php echo $_GET['nomAsig'];?>">
							  <input type="hidden" name="codT" value="<?php echo "Crear";?>">

								<button type="submit" class="btn ex-button">Crear</button>
							  </p>
							  
							  </form>
						  </div>
					    </div>
						
					</div>
                    </div>
					<?php
					}
					?>
					
					
					
					
					<div class="pull-right">
						<a href="asignatura.html" class="btn ex-button">Volver</a>
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