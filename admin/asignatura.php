<!DOCTYPE html>
<?php
session_start();
include('../MultiLanguage/FuncionIdioma.php');


//$_SESSION['idioma']='ENG';

$textos = idioma(1,$_SESSION['idioma']);
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
                <a class="navbar-brand" href="index.php">ESEIXesti&oacute;n</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> <?php echo $textos[2]; //Perfil?></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[3];//Cerrar sesi&oacute;n?></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="listaAsignaturas.php"><i class="fa fa-fw fa-folder-open"></i> <?php echo $textos[4];//Crear/Modificar asignaturas?></a>
                    </li>
                    <li>
                        <a href="listaUsuarios.php"><i class="fa fa-fw fa-users"></i> <?php echo $textos[5];//Usuarios?></a>
                    </li>
                    <li>
                        <a href="../index.php"><i class="fa fa-fw fa-power-off"></i> <?php echo $textos[3];//Cerrar sesi&oacute;n?></a>
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
                        <h1 class="page-header"> <?php echo $textos[4];//Asignaturas?>  </h1>
						
                        
						<div class="panel panel-default">
						<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos de la asignatura?></div>
						<div class="panel panel-body">
								<form class="form-horizontal" role="form">
								
									<div class="form-group">
										<label for="name" class="col-sm-2 control-label"><?php echo $textos[7];//Nombre:?></label>
										<div class="col-sm-10">
											<input id="name" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="grade" class="col-sm-2 control-label"><?php echo $textos[8];//Grado:?></label>
										<div class="col-sm-10">
											<input id="grade" type="text" class="form-control">
										</div>
									</div>
									<div class="form-group">
										<label for="course" class="col-sm-2 control-label"><?php echo $textos[9];//Curso:?></label>
										<div class="col-sm-10">
											<input id="course" type="text" class="form-control">
										</div>
									</div>
									<div class="pull-right">
										<a href="#" class="btn ex-button"><?php echo $textos[10];//Modificar?></a>  							
									</div>
							</div></div>		
									
									<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[11];//Profesores de la asignatura?></div>
														
							<li class="list-group-item">
							<div class="row">
							<div class="col-md-5">
							<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<tr>
									<th>DNI</th>
										<th><?php echo $textos[12];//Nombre?></th>
										<th>	</th>
									</tr>
								</thead>
								<tbody>
									<tr>
									   <td>11223344A</td>
									   <td>Paris Lois, Mario</td>
									   <td><input type="checkbox" name="selection" value="selection">  <br><br></td>
									</tr>
									
									
									<tr>
									   <td>22334455B</td>
									   <td>Tifan Peril, Lola</td>
									   <td><input type="checkbox" name="selection" value="selection">  <br><br></td>								   
									   </tr>
								<tbody>
							</table>
							</div>
							</div>
							
							
							
							
							<div class="col-md-1 text-center">
								<a href="#" class="btn ex-button"> > </a> 
								<a href="#" class="btn ex-button"> < </a><br>
							</div>
							
								
							
							
							<div class="col-md-5">
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-condensed">
									<thead>
										<tr>
											<th>DNI</th>
											<th><?php echo $textos[12];//Nombre?></th>
											<th>	</th>
										</tr>
									</thead>
									<tbody>
										<tr>
										   <td>33445566C</td>
										   <td>Hierro Pozo, Marta</td>
										   <td><input type="checkbox" name="selection" value="selection">  <br><br></td>								   
										</tr>
										
										<tr>
										   <td>44556677D</td>
										   <td>Dorado Fardo, Lana</td>
										   <td><input type="checkbox" name="selection" value="selection">  <br><br></td>		
										</tr>
										
									<tbody>
								</table>
								</div>
								</div>
							</li>
							
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label"><?php echo $textos[13];//Filtro:?> </label>
									<div class="col-md-7">
										<input type="name" class="form-control" id="filterText" placeholder="<?php echo $textos[14];//Filtro de b&uacute;squeda?>">
									</div>
								
								<div class="col-md-3">
								<select name="ad" class="form-control">
									<option selected> ---</option>
									<option value="1.htm"><?php echo $textos[12];//Nombre?></option>
									<option value="2.htm">Dni</option>
									<option value="3.htm"><?php echo $textos[15];//Apellidos?></option>
								</select>
								
								</div>
								</div>
								<br>
							</li>
							
						</div>
						
						
						
					</div>
																			
					<div class="pull-right">
						<a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[16];//Volver?></a>  							
					</div> 
						


							
					

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
