<?php

namespace Model;

class Admin extends ActiveRecord {
    // Base de datos

    protected static $tabla = 'usuarios';
    protected static $columnasDB = [
        'id',
        'email',
        'password',
    ];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {

        if (!$this->email){
            self::$errores[] = 'El email no es valido';
        }
        if (!$this->password){
            self::$errores[] = 'Contraseña no valida';
        }

        return self::$errores;
    }

    public function existeUsuario() {
        //Revisar si usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        if(!$resultado->num_rows) { //si num_rows = 1 quiere decir que hay resultado( es decir que hay un email que coincide)
            self::$errores[] = 'El usuario no existe';
            return; 
        }
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);
        if(!$autenticado) {
            self::$errores[] = 'El Password es Incorrecto';
        }

        return $autenticado;
    }

    public function autenticar() {
        session_start();

        // Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }

}

