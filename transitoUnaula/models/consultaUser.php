<?php

namespace Model;

class consultaUser extends ActiveRecord{
    protected static $tabla='multa';
    protected static $columnasDB= ['id', 'documento', 'descripcion', 'fecha', 'idAgente', 'direccion', 'placa', 'tipo', 'precio'];

    public $id;
    public $documento;
    public $descripcion;
    public $fecha;
    public $idAgente;
    public $direccion;
    public $placa;
    public $tipo;
    public $precio;

    public function __construct($args = []){
        $this->id=$args['id'] ?? null;
        $this->documento=$args['documento'] ?? '';
        $this->descripcion=$args['descripcion'] ??'';
        $this->fecha=$args['fecha'] ??'';
        $this->idAgente=$args['idAgente'] ?? null;
        $this->direccion=$args['direccion'] ?? '';
        $this->placa=$args['placa'] ??'';
        $this->tipo=$args['tipo'] ??'';
        $this->precio=$args['precio'] ?? 0;

    }
}