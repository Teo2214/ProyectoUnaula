<?php

namespace Model;

class consultaVehiculo extends ActiveRecord{
    protected static $tabla='vehiculo';
    protected static $columnasDB=['placa', 'marca', 'modelo',
    'pais', 'estado', 'documentoPropietario', 'cilindraje', 'idTipoVehiculo', 'tipoServicio', 'color', 'numeroMultas'];

    public $placa;
    public $marca;
    public $modelo;
    public $pais;
    public $estado;
    public $documentoPropietario;
    public $cilindraje;
    public $idTipoVehiculo;
    public $tipoServicio;
    public $color;
    public $numeroMultas;

    public function __construct($args = []){
        $this->placa = $args['placa'] ?? null;
        $this->marca = $args['marca'] ?? '';
        $this->modelo = $args['modelo'] ?? 0;
        $this->pais = $args['pais'] ?? '';
        $this->estado = $args['estado'] ??'';
        $this->documentoPropietario = $args['documentoPropietario'] ?? '';
        $this->cilindraje = $args['cilindraje'] ??'';
        $this->idTipoVehiculo = $args['idTipoVehiculo'] ?? '';
        $this->tipoServicio = $args['tipoServicio'] ??'';
        $this->color = $args['color'] ??'';
        $this->numeroMultas = $args['numeroMultas'] ?? 0;
    }


}