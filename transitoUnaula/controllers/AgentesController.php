<?php

namespace Controller;

use Model\ConsultaMulta;
use Model\consultaUser;
use MVC\Router;

class AgentesController {
    public static function principalAgente(Router $router) {
        $router->renderP('agentes/index', []);
    }

    public static function multas(Router $router) {
        session_start();
        
        $router->renderP('agentes/multa', [
            'nombre' => $_SESSION['nombre'],
            'idAgente' => $_SESSION['id']
        ]);
    }

    public static function multaMetodo(Router $router) {
        session_start();

        $placa = $_GET['placa'] ?? '';
        
        
        //consulatr la base de datos
        $consulta = " SELECT multa.id, multa.documento, multa.descripcion, multa.fecha, multa.idAgente, multa.direccion, multa.placa, tipomulta.tipo, tipomulta.precio ";
        $consulta .= " FROM multa  ";
        $consulta .= " LEFT OUTER JOIN tipomulta ";
        $consulta .= " ON multa.idTipoMulta=tipomulta.idTipoMulta  ";
        $consulta .= " WHERE placa = CONCAT('${placa}', ' ');";

        $multas = consultaUser::SQL($consulta);

        $router->renderP('agentes/multaMetodo', [
            'multas'=> $multas,
            'placa' => $placa
        ]);
    }

    public static function picoPlaca(Router $router) {
        $router->renderP('agentes/picoPlaca', []);
    }

}