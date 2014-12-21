<?php	
function showNav($textos) {

		echo "<!-- Navigation -->
			<nav class=\"navbar navbar-inverse navbar-fixed-top\" role=\"navigation\">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class=\"navbar-header\">
					<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-ex1-collapse\">
						<span class=\"sr-only\">Toggle navigation</span>
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span>
						<span class=\"icon-bar\"></span>
					</button> 
					<a class=\"navbar-brand\" href=\"listaAsignaturas.php\">ESEIXesti&oacute;n - " . (($_SESSION['userTipo']=="Alumno")?$textos[11]:(($_SESSION['userTipo']=="Profesor")?$textos[2]:"Admin")) /* Alumno/Profesor/Administrador */ . "</a>
				</div>
				<!-- Top Menu Items -->
				<ul class=\"nav navbar-right top-nav\">
					<li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-flag-o\"></i>";
						
				/*switch($_SESSION['idioma']) {
				case 'ESP': echo "<img src=\"../icons/Spain.png\">"; break;
				case 'GAL': echo "<img src=\"../icons/Galicia.png\">"; break;
				case 'ENG': echo "<img src=\"../icons/EEUU.png\">"; break;
				case 'DEU': echo "<img src=\"../icons/Germany.png\">"; break;
				}*/		
					
						echo " <b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu alert-dropdown\">
							<li>
								<a href=\"../MultiLanguage/CambioIdioma.php?idioma=ESP\"><img src=\"../icons/Spain.png\"> Espa&ntilde;ol</a>
							</li>
							<li>
								<a href=\"../MultiLanguage/CambioIdioma.php?idioma=GAL\"><img src=\"../icons/Galicia.png\"> Gallego</a>
							</li>
							<li>
								<a href=\"../MultiLanguage/CambioIdioma.php?idioma=ENG\"><img src=\"../icons/EEUU.png\"> Ing&eacute;s</a>
							</li>
							<li>
								<a href=\"../MultiLanguage/CambioIdioma.php?idioma=DEU\"><img src=\"../icons/Germany.png\"> Alem&aacute;n</a>
							</li>
						</ul>
					</li>";
					
	switch($_SESSION['userTipo']) {
		case "Alumno":
					echo "<li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> " . $_SESSION['userName'] . "<b class=\"caret\"></b></a>
						<ul class=\"dropdown-menu\">
							<li>
								<a href=\"perfil.php\"><i class=\"fa fa-fw fa-user\"></i>" . $textos[2] /* Perfil */ . "</a>
							</li>
							<li class=\"divider\"></li>
							<li>
								<a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i>" . $textos[3] /* Cerrar sesi&oacute;n */ . "</a>
							</li>
						</ul>
					</li>
				</ul>
				<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
				<div class=\"collapse navbar-collapse navbar-ex1-collapse\">
					<ul class=\"nav navbar-nav side-nav\">
						<li>
							<a href=\"listaAsignaturas.php\"><i class=\"fa fa-fw fa-dashboard\"></i>" . $textos[4] /*Asignaturas */ . "</a>
						</li>
						<li>
							<a href=\"preinscripcion.php\"><i class=\"fa fa-fw fa-dashboard\"></i>" . $textos[5] /*Preinscripci&oacute;n */ . "</a>
						</li>
						<li>
							<a href=\"portfolio.php\"><i class=\"fa fa-fw fa-bar-chart-o\"></i>" . $textos[6] /*Portfolio */ . "</a>
						</li>
						<li>
							<a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i>" . $textos[3] /*Cerrar sesi&oacute;n */ . "</a>
						</li>
					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</nav>";
			break;	
	case "Profesor":
		echo "<li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> " . $_SESSION['userName'] . "<b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"perfil.php\"><i class=\"fa fa-fw fa-user\"></i> " . $textos[3] .  /*Perfil*/ "</a>
                        </li>
                        <li class=\"divider\"></li>
                        <li>
                            <a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i> " . $textos[4] . /*Cerrar sesi&oacute . n*/ "</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
                <ul class=\"nav navbar-nav side-nav\">
                    <li>
                        <a href=\"perfil.php\"><i class=\"fa fa-fw fa-dashboard\"></i> " . $textos[3] .  /*Perfil*/ "</a>
                    </li>
                    <li>
                        <a href=\"listaAsignaturas.php\"><i class=\"fa fa-fw fa-bar-chart-o\"></i> " . $textos[5] .  /*Asignaturas*/ "</a>
                    </li>
                    <li>
                        <a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i> " . $textos[4] . /*Cerrar sesi&oacute . n*/ "</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>";
		break;
	case "Administrador":
		echo "<li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> "  . $_SESSION['userName'] . "<b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i> " . $textos[3] ./*Cerrar sesi&oacute .n*/"</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
                <ul class=\"nav navbar-nav side-nav\">
                    <li>
                        <a href=\"listaAsignaturas.php\"><i class=\"fa fa-fw fa-folder-open\"></i> " . $textos[4] ./*Asignaturas*/"</a>
                    </li>
                    <li>
                        <a href=\"listaUsuarios.php\"><i class=\"fa fa-fw fa-users\"></i> " . $textos[5] ./*Usuarios*/"</a>
                    </li>
                    <li>
                        <a href=\"../logout.php\"><i class=\"fa fa-fw fa-power-off\"></i>" . $textos[3] ./*Cerrar sesi&oacute .n*/"</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>";
		break;
	}
}
?>