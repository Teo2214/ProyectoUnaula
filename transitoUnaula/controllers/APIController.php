<?php

namespace Controller;

use Model\Servicio;
use Model\Multa;

class APIController{
    public static function index(){
        $servicios=Servicio::all();

        echo json_encode($servicios);
    }

    public static function guardar(){
        $multa = new Multa($_POST);

        $resultado = $multa->crearAuto();


        echo json_encode($resultado);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD']==='POST'){
            $id= $_POST['id'];

            $multa = Multa::find($id);
            $multa->eliminar();
            
            header('Location:' . $_SERVER['HTTP_REFERER']);
        }
    }


}