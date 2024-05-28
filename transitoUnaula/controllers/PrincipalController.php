<?php

namespace Controller;


use Model\consultaUser;
use Model\consultaVehiculo;
use MVC\Router;

class PrincipalController{
    public static function index(Router $router){
        $router->renderP('principal/index', [

        ]);
    }

    public static function vehiculo(Router $router){
        $router->renderP('principal/vehiculo', [
            
        ]);
    }

    public static function vehiculoUser(Router $router){
        
        session_start();

        $placa = $_GET['placa'] ?? '';
        
        
        //consulatr la base de datos
        $consulta = " SELECT vehiculo.placa, vehiculo.marca, vehiculo.modelo, vehiculo.pais, vehiculo.documentoPropietario, vehiculo.cilindraje, vehiculo.idTipoVehiculo, vehiculo.tipoServicio, vehiculo.color, vehiculo.numeroMultas, tipovehiculo.tipo ";
        $consulta .= " FROM vehiculo  ";
        $consulta .= " LEFT OUTER JOIN tipovehiculo ";
        $consulta .= " ON vehiculo.idTipoVehiculo=tipovehiculo.idTipoVehiculo  ";
        $consulta .= " WHERE placa = CONCAT('${placa}', ' ');";

        $vehiculos = consultaVehiculo::SQL($consulta);

        $router->renderP('principal/vehiculoUser', [
            'vehiculos'=> $vehiculos,
            'placa' => $placa
        ]);
        
    }

    public static function multaUser(Router $router){
        session_start();

        $placa = $_GET['placa'] ?? '';
        
        
        //consulatr la base de datos
        $consulta = " SELECT multa.id, multa.documento, multa.descripcion, multa.fecha, multa.idAgente, multa.direccion, multa.placa, tipomulta.tipo, tipomulta.precio ";
        $consulta .= " FROM multa  ";
        $consulta .= " LEFT OUTER JOIN tipomulta ";
        $consulta .= " ON multa.idTipoMulta=tipomulta.idTipoMulta  ";
        $consulta .= " WHERE placa = CONCAT('${placa}', ' ');";

        $multas = consultaUser::SQL($consulta);
        
        $router->renderP('principal/multaUser', [
            'multas'=> $multas,
            'placa' => $placa
        ]);
    }
}