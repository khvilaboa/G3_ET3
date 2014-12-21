<?php
session_start();
include_once('../conexion.php');
include_once('../clases/Trabajo_class.php');
include('../MultiLanguage/FuncionIdioma.php');
include('../nav.php');
Conectarse();
//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
//$_SESSION['idioma']='ESP';
$textos = idioma(16,$_SESSION['idioma']);

$codTrab = $_GET['ct'];
$codAsig = $_GET['ca'];
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
	<script language="javascript" src="calendar/calendar.js"></script>
	
	
	<script>
	
		function showMsg() {
			msg = "<?php echo (isset($_GET['msg'])?$_GET['msg']:''); ?>";
			
			if(msg == "creado") {
				$.notify("La entrega se ha creado correctamente", "success");
			} else if(msg == "modificado"){
				$.notify("La entrega se ha modificado correctamente", "success");
			} 
		}
	</script>	
	
</head>
<body onload="showMsg();">

    <div id="wrapper">

        <?php showNav($textos); ?>

        <div id="page-wrapper">

            <div class="container-fluid">


                <!-- Page Heading -->
				<?php 
					if(isset($_GET['ct'])){
						$trabajo = new trabajo ($codTrab,$codAsig,'','','');
						$trabajo->Rellenar();
				?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> <?php echo $trabajo->getTitulo();?> </h1>
                        
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos del trabajo?></div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form" METHOD="GET" action="../controller/controladorTrabajo.php">
										
								  <div class="form-group">
									 <label for="title" class="col-lg-2 control-label"><?php echo $textos[7];//T&iacute;tulo?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="title" value="<?php echo $trabajo->getTitulo();?>">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="desc" class="col-lg-2 control-label"><?php echo $textos[8];//Descripci&oacute;n?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="desc" value="<?php echo $trabajo->getDescripcion();?>">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="limit" class="col-lg-2 control-label"><?php echo $textos[9];//Fecha l&iacute;mite?></label>
										<div class="col-lg-10">
										   <input type="hidden" class="form-control" name="limit" placeholder="
										   <?php											
												require_once('calendar/classes/tc_calendar.php');

												$myCalendar = new tc_calendar("date5", true, false);
												$myCalendar->setIcon("calendar/images/iconCalendar.gif");
												$myCalendar->setDate(date('d'), date('m'), date('Y'));
												$myCalendar->setPath("calendar/");
												$myCalendar->setYearInterval(2000, 2100);
												$myCalendar->dateAllow('2000-01-01', '2100-01-01');
												$myCalendar->setDateFormat('j F Y');
												$myCalendar->setAlignment('left', 'bottom');
												$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
												$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
												$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
												$myCalendar->writeScript();
													
											?>
										</div>
								  </div>

							  
							   
							  <p class="pull-right"> 
								<input type="hidden" name="ct" value="<?php echo $codTrab;?>">
								<input type="hidden" name="ca" value="<?php echo $codAsig;?>">
								<button type="submit" class="btn ex-button"><?php echo $textos[10];//Modificar?></button>
							  </p>
							   </form>
						  </div>
					    </div>
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[11];//Entregables subidos?></div>
								<table class="table table-striped table-bordered table-hover">
									<thead>
										<tr>
											<th>Nombre</th>   <!-- [!MUL] -->
											<th>Usuario</th>   <!-- [!MUL] -->
											<th>Observaciones</th>   <!-- [!MUL] -->
											<th>Calificaci&oacute;n</th>   <!-- [!MUL] -->
										</tr>
									</thead>
									<tbody>
									<?php
										$resultado = trabajo::verEntregas($_GET['ca'], $_GET['ct']);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td><a href='entrega.php?ca=".$row['codAsignatura']."&ct=".$row['codTrabajo']."
													&mail=".$row['emailUsuario']."'>".$row['titulo']."</a></td>";
											echo "<td>".$row['emailUsuario']."</td>";
											echo "<td>".(empty($row['observaciones'])?"-":$row['observaciones'])."</td>";
											echo "<td>".(empty($row['calificacion'])?"-":$row['calificacion'])."</td></tr>";
										}
									?>	
										
									<tbody>
								</table>
						</div>
					</div>
                    </div>
					
					<?php
					} else {
					?>
					
					<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> <?php echo $textos[16];//Crear trabajo?> </h1>
                        
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6];//Datos del trabajo?></div>
							<div class="panel-body">
							   <form class="form-horizontal" role="form" METHOD="GET" action="../controller/controladorTrabajo.php">
										
								  <div class="form-group">
									 <label for="title" class="col-lg-2 control-label"><?php echo $textos[7];//T&iacute;tulo?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="title" placeholder="Introduce t&iacute;tulo">
										</div>
								  </div>
							   
								  <div class="form-group">
									 <label for="desc" class="col-lg-2 control-label"><?php echo $textos[8];//Descripci&oacute;n?></label>
										<div class="col-lg-10">
										   <input type="text" class="form-control" name="desc" placeholder="Introduce descripci&oacute;n">
										</div>
								  </div>
								  
								  <div class="form-group">
									 <label for="limit" class="col-lg-2 control-label"><?php echo $textos[9];//Fecha l&iacute;mite?></label>
										<div class="col-lg-10">
										
										   <input type="hidden" class="form-control" name="limit" placeholder="
										   <?php											
												require_once('calendar/classes/tc_calendar.php');

												$myCalendar = new tc_calendar("date5", true, false);
												$myCalendar->setIcon("calendar/images/iconCalendar.gif");
												$myCalendar->setDate(date('d'), date('m'), date('Y'));
												$myCalendar->setPath("calendar/");
												$myCalendar->setYearInterval(2000, 2100);
												$myCalendar->dateAllow('2000-01-01', '2100-01-01');
												$myCalendar->setDateFormat('j F Y');
												$myCalendar->setAlignment('left', 'bottom');
												$myCalendar->setSpecificDate(array("2011-04-01", "2011-04-04", "2011-12-25"), 0, 'year');
												$myCalendar->setSpecificDate(array("2011-04-10", "2011-04-14"), 0, 'month');
												$myCalendar->setSpecificDate(array("2011-06-01"), 0, '');
												$myCalendar->writeScript();
													
											?>
										   
										</div>
								  </div>

							  
							   
							  <p class="pull-right"> 
							  <input type="hidden" name="ca" value="<?php echo $codAsig;?>">
							  <input type="hidden" name="ct" value="<?php echo "Crear";?>"><!-- Modificar crear? -->

								<button type="submit" class="btn ex-button"><?php echo $textos[17];//Crear?></button>
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
						<a href="asignatura.php?ca=<?php echo $codAsig;?>" class="btn ex-button"><?php echo $textos[15];//Volver?></a>
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