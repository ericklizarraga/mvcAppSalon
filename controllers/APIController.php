<?php
namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController{
    public static function index(){
        $servicios = Servicio::all();
        echo json_encode( $servicios );
    }

    public static function guardar(){

        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            //almacena la cita y debuelve el id
            $cita = new Cita($_POST);
            $respuesta = $cita->guardar();

            //almacena la cita y el servicio
            $id = $respuesta['id'];

            $idServicios = explode(",",  $_POST['servicios']);

            foreach($idServicios as $idServicio){
              $args = [
                'citaid' => $id,
                'servicioid' => $idServicio
              ];
              $citaServicio = new CitaServicio($args);
              $citaServicio->guardar();
            }
        }
       
        echo json_encode($respuesta);
    }


    public static function eliminar(){
       if($_SERVER['REQUEST_METHOD'] === 'POST'){
          $id = $_POST['id'];
         
          $cita = Cita::find($id);
          $cita->eliminar();
          header('location:'.$_SERVER['HTTP_REFERER']);
       }
    }
}