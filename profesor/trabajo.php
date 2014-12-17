<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');


//$_SESSION['idioma']='ESP';

$textos = idioma(16,$_SESSION['idioma']);
?>

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
                <a class="navbar-brand" href="index.php"><?php echo $textos[2];//ESEIXesti&oacute;n - Profesor?></a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> John Smith <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="perfil.php"><i class="fa fa-fw fa-user"></i> <?php echo $textos[3]; //Perfil?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[4];//Cerrar sesi&oacute;n?></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="perfil.php"><i class="fa fa-fw fa-dashboard"></i> <?php echo $textos[3]; //Perfil?></a>
                    </li>
                    <li>
                        <a href="listaAsignaturas.php"><i class="fa fa-fw fa-bar-chart-o"></i> <?php echo $textos[5]; //Asignaturas?></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[4];//Cerrar sesi&oacute;n?></a>
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
                        <h1 class="page-header ex-title"> Trabajo X </h1>
                        
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos del trabajo?></div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form">
										
								  <div class="form-group">
									 <label for="title" class="col-lg-2 control-label"><?php echo $textos[7];//T&iacute;tulo?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" id="title" placeholder="<?php echo $textos[7];//T&iacute;tulo?>">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="desc" class="col-lg-2 control-label"><?php echo $textos[8];//Descripci&oacute;n?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" id="desc" placeholder="<?php echo $textos[8];//Descripci&oacute;n?>">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="limit" class="col-lg-2 control-label"><?php echo $textos[9];//Fecha l&iacute;mite?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" id="limit" placeholder="<?php echo $textos[9];//Fecha l&iacute;mite?>">
										</div>
								  </div>

							   </form>
							   
							  <p class="pull-right"> 
								<button type="button" class="btn ex-button"><?php echo $textos[10];//Modificar?></button>
							  </p>
						  </div>
					    </div>
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[11];//Entregables subidos?></div>
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th><?php echo $textos[7];//T&iacute;tulo?></th>
											<th><?php echo $textos[12];//Usuario?></th>
											<th><?php echo $textos[13];//Entrega?></th>
											<th><?php echo $textos[14];//Nota?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
										   <td><a href="entrega.php">Entrega 1</a></td>
										   <td>11223344A</td>
										   <td>Descripci&oacute;n de la entrega 1</td>
										   <td>10</td>
										</tr>
										
										<tr>
										   <td><a href="entrega.php">Entrega 2</a></td>
										   <td>33223344A</td>
										   <td>Descripci&oacute;n de la entrega 2</td>
										   <td>10</td>		
										</tr>
										
										<tr>
										   <td><a href="entrega.php">Entrega 3</a></td>
										   <td>22223344A</td>
										   <td>Descripci&oacute;n de la entrega 3</td>
										   <td>10</td>
										   </tr>
									<tbody>
								</table>
						</div>
					</div>
                    </div>
					
					<div class="pull-right">
						<a href="asignatura.php" class="btn ex-button"><?php echo $textos[15];//Volver?></a>
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