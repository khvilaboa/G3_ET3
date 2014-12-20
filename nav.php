<?php	
function showNav($textos) {
	switch($_SESSION['userTipo']) {
	case "Alumno":
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
					<a class=\"navbar-brand\" href=\"#\">ESEIXesti&oacute;n -" . $textos[11] /* Alumno */ . "</a>
				</div>
				<!-- Top Menu Items -->
				<ul class=\"nav navbar-right top-nav\">
					<li class=\"dropdown\">
						<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i>" . $_SESSION['userName'] . "<b class=\"caret\"></b></a>
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
                <a class=\"navbar-brand\" href=\"index.html\">" . $textos[2] . /*ESEIXesti&oacute . n - Profesor*/ "</a>
            </div>
            <!-- Top Menu Items -->
            <ul class=\"nav navbar-right top-nav\">
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> John Smith <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"perfil.html\"><i class=\"fa fa-fw fa-user\"></i> " . $textos[3] .  /*Perfil*/ "</a>
                        </li>
                        <li class=\"divider\"></li>
                        <li>
                            <a href=\"#\"><i class=\"fa fa-fw fa-power-off\"></i> " . $textos[4] . /*Cerrar sesi&oacute . n*/ "</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
                <ul class=\"nav navbar-nav side-nav\">
                    <li>
                        <a href=\"perfil.html\"><i class=\"fa fa-fw fa-dashboard\"></i> " . $textos[3] .  /*Perfil*/ "</a>
                    </li>
                    <li>
                        <a href=\"listaAsignaturas.html\"><i class=\"fa fa-fw fa-bar-chart-o\"></i> " . $textos[5] .  /*Asignaturas*/ "</a>
                    </li>
                    <li>
                        <a href=\"#\"><i class=\"fa fa-fw fa-power-off\"></i> " . $textos[4] . /*Cerrar sesi&oacute . n*/ "</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>";
		break;
	case "Administrador":
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
                <a class=\"navbar-brand\" href=\"index.html\">ESEIXesti&oacute;n</a>
            </div>
            <!-- Top Menu Items -->
            <ul class=\"nav navbar-right top-nav\">
                <li class=\"dropdown\">
                    <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><i class=\"fa fa-user\"></i> Admin <b class=\"caret\"></b></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"#\"><i class=\"fa fa-fw fa-user\"></i>" . $textos[2] . /*Perfil*/ "</a>
                        </li>
                        <li class=\"divider\"></li>
                        <li>
                            <a href=\"../index.php\"><i class=\"fa fa-fw fa-power-off\"></i>" . $textos[3] . /*Cerrar sesi&oacute;n*/ "</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class=\"collapse navbar-collapse navbar-ex1-collapse\">
                <ul class=\"nav navbar-nav side-nav\">
                    <li>
                        <a href=\"listaAsignaturas.php\"><i class=\"fa fa-fw fa-folder-open\"></i>" . $textos[4]; /*Asignaturas*/ "</a>
                    </li>
                    <li>
                        <a href=\"listaUsuarios.php\"><i class=\"fa fa-fw fa-users\"></i>" . $textos[5]; /*Usuarios*/ "</a>
                    </li>
                    <li>
                        <a href=\"../index.php\"><i class=\"fa fa-fw fa-power-off\"></i>" . $textos[3]; /*Cerrar sesi&oacute;n*/" </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>";
		break;
	}
}
?>