<?php

namespace Model;

class Usuario extends ActiveRecord{
    //Base de datos
    protected static $tabla='usuarios';
    protected static $columnasDB=['id', 'nombre', 'apellidos',
    'email', 'telefono', 'password', 'agente', 'token', 'confirmado'];
    public $id;
    public $nombre;
    public $apellidos;
    public $email;
    public $telefono;
    public $password;
    public $agente;
    public $token;
    public $confirmado;

    public function __construct($args=[])
    {
        $this->id=$args['id'] ?? null;
        $this->nombre=$args['nombre'] ?? '';
        $this->apellidos=$args['apellidos'] ?? '';
        $this->email=$args['email'] ?? '';
        $this->telefono=$args['telefono'] ?? '';
        $this->password=$args['password'] ?? '';
        $this->agente=$args['agente'] ?? 0;
        $this->token=$args['token'] ?? '';
        $this->confirmado=$args['confirmado'] ?? 0;
    }

    //Mensajes de validacion para creacion de cuentas
    public function validarNuevaCuenta(){
        if(!$this->id){
            self::$alertas['error'][]='El documento es obligatorio';
        }

        if(!$this->nombre){
            self::$alertas['error'][]='El nombre es obligatorio';
        }

        if(!$this->apellidos){
            self::$alertas['error'][]='Los apellidos son obligatorios';
        }

        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }

        if(!$this->telefono){
            self::$alertas['error'][]='El telefono es obligatorio';
        }

        if(!$this->password){
            self::$alertas['error'][]='La contraseña es obligatoria';
        }
        if(strlen($this->password)<6){
            self::$alertas['error'][]='La contraseña debe contener al menos 6 caracteres';
        }

        return self::$alertas;
    }

    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        
        }
        if(strlen($this->password)<6){
            self::$alertas['error'][]='El password debe tener 6 o más caracteres';
        }

        return self::$alertas;
    }


    //revisa si el usuario existe
    public function existeUsuario(){
        $query = "SELECT * FROM ". self::$tabla. " WHERE email = '" . $this->email. "' LIMIT 1";

       $resultado =  self::$db->query($query);

       if($resultado->num_rows){
        self::$alertas['error'][]='El usuario ya esta registrado';
       }

       return $resultado;
    }

    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][]='El password es obligatorio';
        }

        return self::$alertas;
    }

    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][]='El email es obligatorio';
        }
        return self::$alertas;
    }

    public function hashPassword(){
        $this->password=password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken(){
        $this->token=uniqid();
    }

    public function comprobarPasswordAndVerify($password){
        $resultado=password_verify($password, $this->password);

        if(!$resultado || !$this->confirmado){
            self::$alertas['error'][] = 'Password incorrecto o cuenta no confirmada';
        }else{
            return true;
        }
    }
}