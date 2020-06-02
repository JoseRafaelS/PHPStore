
<?php
require_once 'config/db.php';
class EntidadUsuario_model
{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $image;
    private $db;

    function __construct()
    {
        $this->db = Conection::Conectar();
    }

    function setId($id)
    {
        $this->id = $id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    function setEmail($email)
    {
        $this->email = $email;
    }
    function setPassword($password)
    {
        $this->password = $password;
    }
    function setRol($rol)
    {
        $this->rol = $rol;
    }
    function setImagen($imagen)
    {
        $this->image = $imagen;
    }

    function getId()
    {
        return $this->id;
    }
    function getNombre()
    {
        return $this->nombre;
    }

    function getApellido()
    {
        return $this->apellido;
    }
    function getPassword()
    {
        return $this->password;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getRol()
    {
        return $this->rol;
    }
    function getImagen()
    {
        return $this->image;
    }
    /* Guardar el usuario */
    public function Save()
    {
        $sql = "INSERT INTO usuarios(nombre, apellido, email, passwor, rol, imagen)
                    VALUES (:nombre, :apellido, :email, :passwor, :rol, :imagen)";

        $resultado = $this->db->prepare($sql);

        $resultado->execute(array(
            ":nombre" => "{$this->getNombre()}", ":apellido" => "{$this->getApellido()}",
            ":email" => "{$this->getEmail()}", ":passwor" => "{$this->getPassword()}",
            ":rol" => "{$this->getRol()}", ":imagen" => "{$this->getImagen()}"
        ));

        $result = false;

        if ($resultado) {
            $result = true;
        }
        $resultado->closeCursor();
        return $result;
    }
    /* Iniocio de session */
    public function session()
    {
        $result = false;

        $sql = "SELECT * FROM USUARIOS WHERE email = :s_sesion";
        $loging = $this->db->prepare($sql);
        $loging->execute(array(":s_sesion" => "{$this->getEmail()}"));

        if ($loging && $loging->rowCount() == 1) {

            $usuario = $loging->fetch(PDO::FETCH_OBJ);
            $verify = password_verify($this->getPassword(), $usuario->passwor);

            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
    }
    /* Metodo para cuando el usuario se registre inicie la session automaticamente */
    public function Registro_session()
    {
        $sql = "SELECT * FROM USUARIOS WHERE EMAIL = :r_session";
        $registro = $this->db->prepare($sql);
        $registro->execute(array(":r_session" => "{$this->getEmail()}"));

        if ($registro && $registro->rowCount() == 1) {

            $usuario = $registro->fetch(PDO::FETCH_OBJ);
        }
        return $usuario;
    }
}
