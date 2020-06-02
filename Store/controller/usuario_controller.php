<?Php
require_once 'model/EntidadUsuario_model.php';
class Usuario_controller
{
    /* Cargar vista de Registro de Usuario */
    public function Registro()
    {
        require_once 'view/User/save_user.php';
    }
    /* Guarda Usuario */
    public function Usuario()
    {
        if (isset($_POST) && !empty($_POST)) {

            $nombre =  $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $error = array();

            /*Validando los datos */

            if (!empty($nombre) && !is_numeric($nombre) && !preg_match('/[1-9]/', $nombre)) {
                $nombre_validado = true;
            } else {
                $error['nombre'] = "<p class='er'>El nombre esta incorrecto</p>";
            }

            if (!empty($apellido) && !is_numeric($apellido) && !preg_match('/[1-9]/', $apellido)) {
                $apellido_valido = true;
            } else {
                $error['apellido'] = "<p class='er'>El apellido esta incorrecto</p>";
            }

            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validate = true;
            } else {
                $error['email'] = "<p class='er'>El email esta incorrecto</p>";
            }

            if (!empty($password)) {
                $password_validate = true;
            } else {
                $error['password'] = "<p class='er'>La password esta incorrecto</p>";
            }
            /* Si no hay error en lo datos instroducido por el usuario */

            if (count($error) == 0) {
                /* Encriptar contraseña */
                $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 8]);
                /* insertar datos */
                $usuario = new EntidadUsuario_model();
                $usuario->setNombre($nombre);
                $usuario->setEmail($email);
                $usuario->setApellido($apellido);
                $usuario->setPassword($password_segura);
                $usuario->setRol('null');
                $usuario->setImagen('null');
                /* Llama el metodo para guardar el registro en la base de datos*/
                $result = $usuario->Save();

                if ($result) {
                    $resultado = $usuario->Registro_session();

                    if ($resultado) {
                        $_SESSION['login'] = $resultado;
                    }
                    header("location:" . base_url);
                }
            } else {
                $_SESSION['error'] = $error;

                header("location:" . base_url . 'usuario_controller/Registro');
            }
        } else {
            header("location:" . base_url . 'usuario_controller/Registro');
        }
    }
    /* Iniciar sesion */
    public function loging()
    {
        if (isset($_POST) && !empty($_POST)) {

            $session = new EntidadUsuario_model();
            $session->setEmail($_POST['email']);
            $session->setPassword($_POST['contra']);
            $resultados = $session->session();

            if ($resultados && is_object($resultados)) {
                $_SESSION['login'] = $resultados;

                if ($resultados->rol == "admin") {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = "<p class='er'>Su email o clave son incorrectos</p>";
            }
        }
        header('location:' . base_url);
    }
    /*  cerrar sesion */
    public function Logaut()
    {
        if (isset($_SESSION['login'])) {
            session_unset($_SESSION['login']);
            session_destroy();
        }
        header("location:" . base_url);
    }
}/* Fin clase */
