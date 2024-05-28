<?php

namespace Model;

class Servicio extends ActiveRecord{
    //base de datos
    protected static $tabla = "tipomulta";
    protected static $columnasDB=['idTipoMulta', 'tipo', 'descripcion', 'precio'];

    public $idTipoMulta;
    public $tipo;
    public $descripcion;
    public $precio;

    public function __construct($args = []){
        $this->idTipoMulta = $args['idTipoMulta'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }
}