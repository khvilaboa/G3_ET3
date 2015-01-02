<?php
	session_start();
	include_once("../conexion.php"); 
	include('../MultiLanguage/FuncionIdioma.php');
	include_once "../clases/Asignatura_class.php";
	include('../nav.php');
	
	$link=Conectarse();   
	
	$codAsig=$_GET['ca'];
	$asig = new asignatura('','',-1,$codAsig);
	$asig->Rellenar();
	
	$fil=isset($_GET['filt'])?$_GET['filt']:'';
	
	//La siguiente linea se descomenta para hacer prueba sin pasar por login, una vez que este inicializada debe comentarse otra vez.
	//$_SESSION['idioma']='ENG';
	$textos = idioma(12,$_SESSION['idioma']);
?>

<html>
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
	
	<!-- jQuery -->
    <script src="../js/jquery.js"></script>
	
	
	
	<script>
		$(document).ready(function(){
			$("#buscar").click(function(){
				con = document.getElementById("alupreins");
				ca = "<?php echo $codAsig;?>";
				text = document.getElementById("filtro").value;
				campo = document.getElementById("campo");
				campo = campo.options[campo.selectedIndex].value;
				
				$.get("../controller/mostrarAlumnos.php?text=" + text + "&campo=" + campo + "&ca=" + ca,function(data){
					con.innerHTML = data;
				});
			}); 
		});
		
		function showMsg() {
			msg = "<?php echo (isset($_GET['msg'])?$_GET['msg']:''); ?>";
			
			if(msg == "creado") {
				$.notify("El trabajo se ha creado correctamente", "success");
			} else if(msg == "modificado"){
				$.notify("El trabajo se ha modificado correctamente", "success");
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
                <div class="row">
				
					
					
                    <div class="col-lg-12">
                        <h1 class="page-header ex-title"> <?php echo $textos[18]; //Asignatura?>
							<?php
								echo $asig->getNombre();
;							?>
						</h1>
						
						
						
						<input type="hidden" name="ca" id="ca" value="<?php echo $codAsig; ?>">
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[6]; //Alumnos de la asignatura?></div>
							
							<li class="list-group-item">
							<div class="row">
							<div class="col-md-5">
							<div class="table-responsive">
							<FORM method="GET" ACTION="../controller/inscribirAlumno.php">
							<table class="table table-striped table-bordered table-hover table-condensed">
								<thead>
									<tr> 
										<th colspan=3> <?php echo $textos[16];//Alumnos pre-inscritos?> </th> 
									</tr>
									<tr>
									<th>DNI</th>
										<th><?php echo $textos[7]; //Nombre?></th>
										<th>	</th>
									</tr>
								</thead>
								<tbody id="alupreins">
									
									<?php asignatura::verAluPreins($codAsig); ?>
								</tbody>
							</table>
							</div>
							</div>
							
							<div class="col-md-1 text-center">
								<input type="hidden" name="ca" value="<?php echo $codAsig; ?>">
								<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE=">">
								</FORM>
								<FORM method="GET" ACTION="../controller/expulsarAlumno.php">
								<input type="hidden" name="ca" value="<?php echo $codAsig; ?>">
								<INPUT class="btn ex-button" TYPE="submit" NAME="accion" VALUE="<">
							</div>
							
							<div class="col-md-5">
								<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover table-condensed">
									<thead>
										<tr> 
											<th colspan=3> <?php echo $textos[17];//Alumnos inscritos?> </th> 
										</tr>
										<tr>
											<th>DNI</th>
											<th><?php echo $textos[7]; //Nombre?></th>
											<th>	</th>
										</tr>
									</thead>
									<tbody id="aluins">
										<?php asignatura::verAluIns($codAsig); ?>
									</tbody>
								</table>
								</div>
								</div>
							</li>
							</FORM>
							
							<li class="list-group-item">
								
								<div class="form-group">
								<label for="filterText" class="col-md-1 control-label"><?php echo $textos[8]; //Filtro:?> </label>
									<div class="col-md-5">
										<input type="text" id="filtro" class="form-control" name="texto" placeholder="<?php echo $textos[8]; //Filtro:?>">
									</div>
								
								<div class="col-md-3">
								<select id="campo" name="campo" class="form-control">
									<option  selected value="nombreUsuario"><?php echo $textos[7]; //Nombre?></option>
									<option value="dniUsuario">Dni</option>
									<option value="apellidoUsuario"><?php echo $textos[10]; //Apellidos?></option>
								</select>
								
								</div>
								<div class="col-md-2">
                                  <button class='btn btn-default btn-lg' id="buscar"><span class="glyphicon glyphicon-search"></span></button>
								</div>
								
								</div>
								<br>
							</li>
							
						</div>
						
						
						<div class="panel panel-default">
							<div class="panel-heading ex-panel-header"><?php echo $textos[11]; //Trabajos de la asignatura?></div>

							<li class="list-group-item">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr>
										<th><?php echo $textos[12]; //Trabajo?></th>
										<th><?php echo $textos[13]; //Fecha l&iacute;mite?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										$resultado = asignatura::verTrabajos($codAsig);
										while ($row = mysql_fetch_array($resultado))
										{
											echo "<tr><td><a href='trabajo.php?ca=".$codAsig."&ct=".$row['codTrabajo']."'>".$row['nombreTrabajo']."</a></td>";
											echo "<td>".$row['fechaLimiteTrabajo']."</td></tr>";
										}
									?>	
									
								<tbody>
							</table>
							
							<div class="pull-right">
								<a href="trabajo.php?ca=<?php echo $codAsig; ?>" class="btn ex-button"><?php echo $textos[14]; //Crear trabajo?></a>
							</div><br><br>
							</li>
						</div>
						
						<div class="pull-right">
							<a href="listaAsignaturas.php" class="btn ex-button"><?php echo $textos[15]; //Volver?></a>
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

    

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
	
	<!-- notify -->
    <script src="../js/notify.js"></script>

</body>

</html>