<?php

namespace Model;

class ConsultaMulta extends ActiveRecord{
    protected static $tabla='multa';
    protected static $columnasDB=['idMulta', 'monto', 'estado',
    'idTipoMulta', 'documento', 'descripcion', 'fecha', 'idAgente', 'direccion'];

    public $idMulta;
    public $monto;
    public $estado;
    public $idTipoMulta;
    public $documento;
    public $descripcion;
    public $fecha;
    public $idAgente;
    public $direccion;

    public function __construct($args = []){
        $this->idMulta = $args['idMulta'] ?? null;
        $this->monto = $args['monto'] ?? '';
        $this->estado = $args['estado'] ?? 0;
        $this->idTipoMulta = $args['idTipoMulta'] ?? '';
        $this->documento = $args['documento'] ??'';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->fecha = $args['fecha'] ??'';
        $this->idAgente = $args['idAgente'] ?? '';
        $this->direccion = $args['direccion'] ??'';
    }


}