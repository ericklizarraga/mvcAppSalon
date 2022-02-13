<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router){
        if(empty($_SESSION)){
            session_start();
        }

        isAdmin();

            $fecha = $_GET['fecha'] ?? date('Y-m-d');
 
           $fechas = explode('-',$fecha);

           if( !checkdate($fechas[1], $fechas[2], $fechas[0]) ){
                header('location: /404');
           }
          // debuguear($fecha);
    
         
        
        // $consulta = "SELECT citas.id, CONCAT(usuarios.nombre,' ',usuarios.apellido) as cliente,usuarios.email,citas.hora,usuarios.telefono,servicios.nombre as servicio,servicios.precio FROM citas LEFT JOIN usuarios ON citas.usuarioid = usuarios.id LEFT JOIN citasservicos ON citasservicos.citaid = citas.id LEFT JOIN servicios ON servicios.id = citasservicos.servicioid WHERE  usuarios.nombre != '' and servicios.nombre != ''; ";
        $consulta = "SELECT citas.id, CONCAT(usuarios.nombre,' ',usuarios.apellido) as cliente,usuarios.email,citas.hora,usuarios.telefono,servicios.nombre as servicio,servicios.precio FROM citas LEFT JOIN usuarios ON citas.usuarioid = usuarios.id LEFT JOIN citasservicos ON citasservicos.citaid = citas.id LEFT JOIN servicios ON servicios.id = citasservicos.servicioid WHERE citas.fecha = '${fecha}' and usuarios.nombre != '' and servicios.nombre != ''; ";

        $citas = AdminCita::SQL($consulta);

        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha'=> $fecha
        ]);
    }
}