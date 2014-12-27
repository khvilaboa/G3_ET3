
<?php

include_once "../clases/Usuario_class.php";
include_once "../clases/Asignatura_class.php";

if (isset($_REQUEST['accion'])) {
    switch ($_REQUEST['accion']) {
        //acciones de borrado de elementos
        case 'Borrar': // http://localhost/g3_et3/controller/controladorAdmin.php?accion=Borrar&elemento=asignatura&asignatura=CDAIng3
            switch ($_REQUEST['elemento']) {
                //borrado de usuario
                case "usuario":
                    $usuario = new usuario($_REQUEST['usuario'], '', '', '', '', '');
                    $usuario->Rellenar();
                    $usuario->borrar($_REQUEST['usuario']);
                    header("Location: ../admin/listaUsuarios.php");
                    break;

                case "asignatura":
                    $asig = new asignatura('', '', '', $_REQUEST['asignatura']);
                    $asig->Borrar($_REQUEST['asignatura']);
					
					header("Location: ../admin/listaAsignaturas.php");
                    break;
                default:
                    header("Location: ../admin/listaAsignaturas.php");
                    break;
                
            }
            break;


        case 'Modificar':
            //Acciones de modificacion
            switch ($_REQUEST['elemento']) {
                //modificado de usuario
                case "usuario":
                    $usuario = new usuario($_REQUEST['email'], $_REQUEST['nombre'], $_REQUEST['pass'], $_REQUEST['apellidos'], $_REQUEST['dni'], $_REQUEST['tipo']);
                    $usuario->modificar();
                    
                    header("Location: ../admin/listaUsuarios.php");
                    break;

                //modificado de asignatura
                case "asignatura":

                    $asignatura = new asignatura("", "", "", "");
                    $sql = "select * from Asignatura where codAsignatura='" . $_REQUEST['asignatura'] . "'";
                    $resultado = mysql_query($sql);
                    while ($row = mysql_fetch_array($resultado)) {

                        $asignatura->setCodigo($row['codAsignatura']);
                        $asignatura->setNombre($row['nomAsignatura']);
                        $asignatura->setGrado($row['gradoAsignatura']);
                        $asignatura->setCurso($row['cursoAsignatura']);
                    }
                    $asignaturaM = new asignatura($_REQUEST['nombreA'], $_REQUEST['gradoA'], $_REQUEST['cursoA'], $asignatura->getCodigo());
                    $asignaturaM->modificar();
                    header("Location: ../admin/asignatura.php?codAsig=" . $_REQUEST['asignatura'] . "");

                    break;
            

					default:
					header("Location: ../admin/listaAsignaturas.php");

					break;
			}
            break;

        case 'Crear':
            switch ($_REQUEST['elemento']) {
                //creacion de usuario
                case "usuario":
                    $usuario = new usuario($_REQUEST['email'], $_REQUEST['nombre'], $_REQUEST['pass'], $_REQUEST['apellidos'], $_REQUEST['dni'], $_REQUEST['tipo']);
                    $usuario->insertar();
                    $usuario->modificarTipoUsuario($_REQUEST['tipo']);
                    header("Location: ../admin/listaUsuarios.php");
                    break;

                //creacion de asignatura
                case "asignatura":
                    $sql = "select ifnull(MAX(codAsignatura+1),0) FROM Asignatura";
                    $resultado = mysql_query($sql);
                    $codigo = mysql_fetch_array($resultado);
                    if ($_REQUEST['nombreA'] <> '' && $_REQUEST['gradoA'] <> '') {
                        $asignatura = new asignatura($_REQUEST['nombreA'], $_REQUEST['gradoA'], $_REQUEST['cursoA'], $codigo[0]);
                        $asignatura->insertar();
                        header("Location: ../admin/asignatura.php?codAsig=" . $asignatura->getCodigo() . "");
                    } else
                        header("Location: ../admin/listaAsignaturas.php");
                    break;

                default:
                    header("Location: ../admin/listaAsignaturas.php");
                    break;
            }
            break;

        case '>':

            $contP = $_REQUEST['contP'];

            for ($i = 0; $i < $contP; $i++) {
                if (isset($_REQUEST['emailU' . $i])) {
                    $emailU = $_REQUEST['emailU' . $i];
                    $anho = "" . $_REQUEST['anho'] . "-01-01";
                    $sql = "INSERT INTO ProImparteAsi (emailUsuario,codAsignatura,anhoImparte) VALUES ('" . $emailU . "','" . $_REQUEST['asignatura'] . "','" . $anho . "')";
                    $resultado = mysql_query($sql);
                }
            }

            header("Location: ../admin/asignatura.php?codAsig=" . $_REQUEST['asignatura'] . "");
            break;

        case '<':

            $contPS = $_REQUEST['contPS'];
            for ($i = 0; $i < $contPS; $i++) {
                if (isset($_REQUEST['emailU' . $i])) {
                    $emailU = $_REQUEST['emailU' . $i];
                    $sql = "DELETE FROM ProImparteAsi WHERE emailUsuario='" . $emailU . "' and codAsignatura='" . $_REQUEST['asignatura'] . "'";
                    $resultado = mysql_query($sql);
                    echo "j";
                }
            }

            header("Location: ../admin/asignatura.php?codAsig=" . $_REQUEST['asignatura'] . "");
            break;

        default:
            header("Location: ../admin/listaAsignaturas.php");
            break;
    }
} else {

    header("Location: ../admin/listaAsignaturas.php");
}
?>
