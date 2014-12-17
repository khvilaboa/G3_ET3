
<?php
include_once "../clases/Usuario_class.php";
include_once "../clases/Asignatura_class.php";

if(isset($_POST['accion'])){
		switch($_POST['accion']){
			//acciones de borrado de elementos
			case 'Borrar':
				switch($_POST['elemento']){
					//borrado de usuario
					case "usuario":
						$usuario = new usuario('','','','','','');
						$sql = "select * from Usuario where dniUsuario='".$_POST['usuario']."'";
						$resultado=mysql_query($sql);
						while($row = mysql_fetch_array($resultado)){
		
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
						header("Location: ../admin/listaUsuarios.php");
					break;
				}
			break;
			
			
			case 'Modificar':
				switch($_POST['elemento']){
					//modificado de usuario
					case "usuario":
						$usuario = new usuario($_POST['email'],$_POST['nombre'],$_POST['pass'],$_POST['apellidos'],$_POST['dni'],$_POST['tipo']);
						$usuario->modificar();
						$usuario->modificarTipoUsuario($_POST['tipo']);
						header("Location: ../admin/listaUsuarios.php");
					break;
					default:
						header("Location: ../admin/listaUsuarios.php");
					break;
				}
			break;
			
			case 'Crear':
				switch($_POST['elemento']){
					//creacion de usuario
					case "usuario":
						$usuario = new usuario($_POST['email'],$_POST['nombre'],$_POST['pass'],$_POST['apellidos'],$_POST['dni'],$_POST['tipo']);
						$usuario->insertar();
						$usuario->modificarTipoUsuario($_POST['tipo']);
						header("Location: ../admin/listaUsuarios.php");
					break;
					default:
					echo "usuario";
						header("Location: ../admin/listaUsuarios.php");
					break;
				}
			break;
			
			
			default:
				header("Location: ../admin/listaUsuarios.php");
			break;
		}
}else{

	header("Location: ../admin/listaUsuarios.php");
}

?>
