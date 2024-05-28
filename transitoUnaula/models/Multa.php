<?php

namespace Model;


class Multa extends ActiveRecord{
    //base de datos
    protected static $tabla = "multa";
    protected static $columnasDB = ['id','estado', 'idTipoMulta',
        'documento', 'descripcion', 'fecha', 'idAgente', 'direccion', 'placa'];

    public $id;
    public $estado;
    public $idTipoMulta;
    public $documento;
    public $descripcion;
    public $fecha;
    public $idAgente;
    public $direccion;
    public $placa;

    public function __construct($args = []){
        $this->id=$args['id'] ?? null;
        $this->estado=$args['estado'] ?? 0;
        $this->idTipoMulta=$args['idTipoMulta'] ?? '';
        $this->documento=$args['documento'] ?? '';
        $this->descripcion=$args['descripcion'] ??'';
        $this->fecha=$args['fecha'] ?? '';
        $this->idAgente=$args['idAgente'] ?? null;
        $this->direccion=$args['direccion'] ?? '';
        $this->placa=$args['placa'] ?? '';
    }
}