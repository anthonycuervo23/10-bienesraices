<?php

namespace App;

class Propiedad {

    // DataBase
    protected static $db;
    protected static $columnasDB = [
        'id', 
        'titulo', 
        'precio', 
        'imagen', 
        'descripcion', 
        'habitaciones', 
        'wc', 
        'estacionamiento', 
        'creado', 
        'vendedorId',
    ];

    // Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? 1;
    
    }

    // Definir la conexion a la base de datos
    public static function setDB($database){
        self::$db = $database;
    }

    //guardar registro en base de datos
    public function guardarDB() {
        if(!is_null($this->id)){
            //actualizar
            $this->actualizar();
        } else {
            //crear nuevo registro
            $this->crear();
        }
    }

    // Crear nuevo registro
    public function crear(){
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        // Insertar en la base de datos
        $query = "INSERT INTO  propiedades ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";
        
        $resultado = self::$db->query($query);
        if($resultado){
            // Redericcionar al usuario
            header('Location: /admin?resultado=1');
        } 
    }

    //Actualizar registro existente
    public function actualizar() {
        //Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key ='$value'";
        }
        $query = "UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado){
            $this->borrarImagen();
            // Redericcionar al usuario
            header('Location: /admin?resultado=2');
        } 
    }

    // Eliminar un registro
    public function eliminar() {
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1 ";
        $resultado = self::$db->query($query);

        if($resultado){
            // Redericcionar al usuario
            header('Location: /admin?resultado=3');
        } 
    }

    // Identificsar y unir los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach (self::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $atributos[$columna] =  $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen){
        //Elimina la imagen previa
        if(!is_null($this->id)){
            $this->borrarImagen();
        }
        //asignar al atributo imagen el nombre de la imagen
        if($imagen){
            $this->imagen = $imagen;
        }
    }

    // Elimina el archivo
    public function borrarImagen() {
            //comprobar si existe archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }   
    }

    //Validaciones
    public static function getErrores() {
        return self::$errores;
    }

    public function validar() {
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
        }
        if(!$this->precio){
            self::$errores[] = 'Debes añadir un precio';
        }
        if(strlen($this->descripcion) < 50){
            self::$errores[] = 'La descripcion es obligatoria y debe tener al menos 50 caracteres';
        }
        if(!$this->habitaciones){
            self::$errores[] = 'Debes añadir el numero de habitaciones';
        }
        if(!$this->wc){
            self::$errores[] = 'Debes añadir el numero de baños';
        }
        if(!$this->estacionamiento){
            self::$errores[] = 'Debes añadir el numero de estacionamientos';
        }
        if(!$this->vendedorId){
            self::$errores[] = 'Debes elegir el vendedor';
        }
        if(!$this->imagen){
            self::$errores[] = 'La imagen de la publicacion es obligatoria';
        }
        
        return self::$errores;
    }

    //Listar todos los registros
    public static function getAll() {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Buscar un registro por ID
    public static function getByID($id) {
        $query = "SELECT * FROM propiedades WHERE id = $id";
        $resultado = self::consultarSQL($query);
        return array_shift($resultado);

    }

    public static function consultarSQL($query) {
        //Consultar la base de datos
        $resultado = self::$db->query($query);

        //Iterar la base de datos
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();
        
        //Retornar los resultados
        return $array; //aqui tenemos una lista de objetos(Propiedad)
    }

    protected static function crearObjeto($registro) {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if(property_exists($objeto, $key)){
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = []) {
        foreach ($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}