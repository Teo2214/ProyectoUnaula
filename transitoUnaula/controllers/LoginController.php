<?php

namespace Controller;
use Clases\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    

    public static function login(Router $router){

        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                //comprobar que exista el usuario
                $usuario=Usuario::where('email', $auth->email);

                if($usuario){
                    //verificar password
                    if($usuario->comprobarPasswordAndVerify($auth->password)){
                        //Autenticar usuario
                        session_start();

                        $_SESSION['id']=$usuario->id;
                        $_SESSION['nombre']=$usuario->nombre . " " . $usuario->apellidos;
                        $_SESSION['email']=$usuario->email;
                        $_SESSION['login']=true;

                        //redireccionamiento
                        if($usuario->agente === "1"){
                            $_SESSION['agente'] = $usuario->agente ?? null;

                            header('Location: /principalAgente');
                        }else{
                            header('Location: /principal');
                        }
                    }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/login', [
            'alertas' => $alertas
        ]);
        
    }

    public static function logout(){
        session_start();

        $_SESSION=[];
        header('Location: /');
    }

    public static function olvide(Router $router){

        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();

            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario && $usuario->confirmado == "1"){
                    //generar un token

                    $usuario->crearToken();
                    $usuario->guardar();

                    //ENVIAR EMAIL
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    //alerta
                    Usuario::setAlerta('exito', 'revisa tu email');
                }else{
                    Usuario::setAlerta('error', 'Usuario no existe o no esta confirmado');
                    
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/olvide-password', [
            'alertas' => $alertas
        ]);
    }

    public static function recuperar(Router $router){

        $alertas=[];

        $token = s($_GET['token']);
        $error=false;

        //buscar usuario por su token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'TOKEN NO VALIDO');
            $error=true;
        }

        if($_SERVER['REQUEST_METHOD']==='POST'){
            //leer nuevo password y guardar
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if(empty($alertas)){
                $usuario->password=null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token=null;

                $resultado=$usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
            }

        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password', [
            'alertas' => $alertas,
            'error'=>$error
        ]);
    }

    public static function crear(Router $router){
        $usuario = new Usuario;

        //alertas vacias
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']=='POST'){
            
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //revisar que alertas este vacio
            if(empty($alertas)){
                //Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows){
                    $alertas=Usuario::getAlertas();
                } else {
                    //hashear password
                    $usuario->hashPassword();

                    //Generar un toke
                    $usuario->crearToken();

                    //enviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    
                    $email->enviarConfirmacion();

                    
                    //crear el usuario
                    $resultado=$usuario->crear();

                    if($resultado){
                        header('Location: /mensaje');
                    }

                }
            }
           
        }
        $router->render('auth/crear-cuenta', [
            'usuario'=>$usuario,
            'alertas'=>$alertas
        ]);
    }

    public static function mensaje(Router $router){

        $router->render('auth/mensaje');
    }

    public static function confirmar(Router $router){
        
        $alertas=[];


        $token=s($_GET['token']);

        $usuario=Usuario::where('token', $token);
        
        if(empty($usuario)){
            //mostrar mensaje de error
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            //modificar el confirmado
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta confirmada correctamente');
           
        }

        //obtener alertas
        $alertas=Usuario::getAlertas();
        //renderizar vista
        $router->render('auth/confirmar-cuenta', [
            'alertas'=>$alertas
        ]);
    }
}