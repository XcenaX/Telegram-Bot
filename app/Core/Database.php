<?php

namespace Core;

use Medoo\Medoo;

class Database extends Medoo{
    private static $instance;

    public function __construct(array $options)
    {
        parent::__construct([
            'database_type' => 'mysql',
            'database_name' => 'name',
            'server' => 'localhost',
            'username' => 'root',
            'password' => ''
        ]);
    }

    static function instance(){
        if (!self::instance instanceof self){
            self::$instance = new self;
        }
        return self::$instance;
    }
}