<?php
namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = 'citasservicos';
    protected static $columnasDB = ['id', 'citaid', 'servicioid'];

    public $id;
    public $citaid;
    public $servicoid;

    public function __construct($args = [])
    {   
        $this->id = $args['id'] ?? null;
        $this->citaid = $args['citaid'] ?? '';
        $this->servicioid = $args['servicioid'] ?? '';
    }
}