
<?php

include_once "../clases/Usuario_class.php";
include_once "../clases/Asignatura_class.php";

if (isset($_POST['accion'])) {
    switch ($_POST['accion']) {
        //acciones de borrado de elementos
        case 'Borrar':
            switch ($_POST['elemento']) {
                //borrado de usuario
                case "usuario":
                    $usuario = new usuario('', '', '', '', '', '');
                    $sql = "select * from Usuario where dniUsuario='" . $_POST['usuario'] . "'";
                    $resultado = mysql_query($sql);
                    while ($row = mysql_fetch_array($resultado)) {

                        $usuario->setEmail($row['emailUsuario']);
                        $usuario->setNombre($row['nombreUsuario']);
                        $usuario->setPassword($row['passwordUsuario']);
                        $usuario->setApellido($row['apellidoUsuario']);
                        $usuario->setDni($row['dniUsuario']);
                        $usuario->setTipo($row['tipoUsuario']);
                    }
                    $usuario->borrar($usuario->getEmail());
                    header("Location: ../admin/listaUsuarios.php");
                    break;


                default:
                    header("Location: ../admin/listaAsignaturas.php");
                    break;
            }
            break;


        case 'Modificar':
            //Acciones de modificacion
            switch ($_POST['elemento']) {
                //modificado de usuario
                case "usuario":
                    $usuario = new usuario($_POST['email'], $_POST['nombre'], $_POST['pass'], $_POST['apellidos'], $_POST['dni'], $_POST['tipo']);
                    $usuario->modificar();
                    $usuario->modificarTipoUsuario($_POST['tipo']);
                    header("Location: ../admin/listaUsuarios.php");
                    break;

                //modificado de asignatura
                case "asignatura":

                    $asignatura = new asignatura("", "", "", "");
                    $sql = "select * from asignatura where codAsignatura='" . $_POST['asignatura'] . "'";
                    $resultado = mysql_query($sql);
                    while ($row = mysql_fetch_array($resultado)) {

                        $asignatura->setCodigo($row['codAsignatura']);
                        $asignatura->setNombre($row['nomAsignatura']);
                        $asignatura->setGrado($row['gradoAsignatura']);
                        $asignatura->setCurso($row['cursoAsignatura']);
                    }
                    $asignaturaM = new asignatura($_POST['nombreA'], $_POST['gradoA'], $_POST['cursoA'], $asignatura->getCodigo());
                    $asignaturaM->modificar();
                    header("Location: ../admin/asignatura.php?codAsig=" . $asignaturaM->getCodigo() . "");

                    break;
            }

        default:
            //header("Location: ../admin/listaAsignaturas.php");

            break;

            break;

        case 'Crear':
            switch ($_POST['elemento']) {
                //creacion de usuario
                case "usuario":
                    $usuario = new usuario($_POST['email'], $_POST['nombre'], $_POST['pass'], $_POST['apellidos'], $_POST['dni'], $_POST['tipo']);
                    $usuario->insertar();
                    $usuario->modificarTipoUsuario($_POST['tipo']);
                    header("Location: ../admin/listaUsuarios.php");
                    break;

                //creacion de asignatura
                case "asignatura":
                    $sql = "select ifnull(MAX(codAsignatura+1),0) FROM Asignatura";
                    $resultado = mysql_query($sql);
                    $codigo = mysql_fetch_array($resultado);
                    if ($_POST['nombreA'] <> '' && $_POST['gradoA'] <> '') {
                        $asignatura = new asignatura($_POST['nombreA'], $_POST['gradoA'], $_POST['cursoA'], $codigo[0]);
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

            $contP = $_POST['contP'];

            for ($i = 0; $i < $contP; $i++) {
                if (isset($_POST['emailU' . $i])) {
                    $emailU = $_POST['emailU' . $i];
                    $anho = "" . $_POST['anho'] . "-01-01";
                    $sql = "INSERT INTO Proimparteasi (emailUsuario,codAsignatura,anhoImparte) VALUES ('" . $emailU . "','" . $_POST['asignatura'] . "','" . $anho . "')";
                    $resultado = mysql_query($sql);
                }
            }

            header("Location: ../admin/asignatura.php?codAsig=" . $_POST['asignatura'] . "");
            break;

        case '<':

            $contPS = $_POST['contPS'];
            for ($i = 0; $i < $contPS; $i++) {
                if (isset($_POST['emailU' . $i])) {
                    $emailU = $_POST['emailU' . $i];
                    $sql = "DELETE FROM Proimparteasi WHERE emailUsuario='" . $emailU . "' and codAsignatura='" . $_POST['asignatura'] . "'";
                    $resultado = mysql_query($sql);
                    echo "j";
                }
            }

            header("Location: ../admin/asignatura.php?codAsig=" . $_POST['asignatura'] . "");
            break;

        default:
            header("Location: ../admin/listaAsignaturas.php");
            break;
    }
} else {

    header("Location: ../admin/listaAsignaturas.php");
}
?>
