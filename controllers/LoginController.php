<?php
namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{

    public static function login(Router $router){
        $alertas = [];
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            echo 'post';
            $auth = new Usuario($_POST);
        
            $alertas = $auth->validarLogin();
        
            if( empty( $alertas ) ){
                $usuario = Usuario::where( 'email', $auth->email );
               
                if($usuario){
                    
                   if( $usuario->comprobarPasswordAndVerificado( $auth->password )  ){
                        if( !isset( $_SESSION )){
                            session_start();
                        }

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre." ".$usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        if( $usuario->admin === '1' ){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('location: /admin');
                        }else{
                            header('location: /cita');
                        }
                   }
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
           
        }
        $alertas = Usuario::getAlertas();

       $router->render('auth/login',[
           'alertas'=>$alertas
       ]);
    }

    public static function logout(){
        if(empty($_SESSION)){
            session_start();
        }
        $_SESSION = [];
        header('location: /');
    }

        //_-----------------------------------------------------
    
    public static function olvide(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if( empty($alertas) ){
                $usuario= Usuario::where('email', $auth->email );
                if( $usuario && $usuario->confirmado === '1'){
                    $usuario->crearToken();
                    $usuario->guardar();

                    //TODO : Eniviar el email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarIntruciones();

                    Usuario::setAlerta('exito', 'revisa tu email');
                }else{
                   Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide-password',[
            'alertas' => $alertas
        ]);
    }

    //_-----------------------------------------------------

    public static function recuperar(Router $router){

        $alertas = [];
        $error = false;

        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        if( empty( $usuario ) ){
            Usuario::setAlerta('error', 'token no valido');
            $error = true;
        }
       // debuguear($usuario);
       
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();

            if( empty( $alertas ) ){
                $usuario->password = null;

                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token =  null;
               $resultado = $usuario->guardar(); 
                if( $resultado ){
                    header('location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar-password',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    //_-----------------------------------------------------
    public static function crear(Router $router){
        
        $usuario = new Usuario();
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            echo 'post';
            $usuario = new Usuario($_POST);
            $alertas = $usuario->validarNuevaCuenta();//campos vacios
          
            //revisar que alertas este vacio
            if( empty($alertas) ){
                $resultado =   $usuario->existeUsuario();

                if($resultado->num_rows){
                    //si cai aqui ya esta registrado
                    $alertas = Usuario::getAlertas();
                }else{
                    //HASHER EL PASSWD
                    $usuario->hashPassword();
                    //crear token
                    $usuario->crearToken();

                    //enviar email
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('location: /mensaje');
                    }
                    debuguear($usuario);
                }
            }
        }

        $router->render('auth/crear-cuenta',[
            'usuario'=> $usuario,
            'alertas'=>$alertas
        ]);
    }

    
    //_-----------------------------------------------------
    
    public static function mensaje(Router $router){
        $router->render('auth/mensaje',[]);
    }
    //_-----------------------------------------------------

    public static function confirmar(Router $router){
        $alertas = [];

        $token = s($_GET['token']) ?? '123';
        $usuario = Usuario::where('token',$token);

       
        if( empty( $usuario ) ){
           Usuario::setAlerta('error', 'token no valido perro');
        }else{
            //echo 'token valido';
            $usuario->confirmado = '1';
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'cuenta confirmada correcta');
            // debuguear($usuario);
        }
      
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta',[
            'alertas'=> $alertas
        ]);
    }
}