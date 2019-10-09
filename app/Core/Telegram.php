<?php

namespace Core;

use Models\Tables\Updates;
use Telegram\Bot\Api;

class Telegram{
    private static $instance;

    private function __construct()
    {
        if(!self::$instance instanceof Api){
            self::$instance = new Api("926650888:AAFnD11iitqeREH1g5FZdwC4wq2GPUPHspE");
        }
    }

    private static function init(){
        if(!self::$instance instanceof Api){
            new self();
        }
    }

    static function getUpdates(array $params =[], $s = true){
        self::init();
        return self::$instance->getUpdates($params,$s);
    }

    static function eachUpdates(callback $callback){



        foreach (self::getUpdates() as $update){
            Updates::insert([
                "id" -> $update["update_id"]
            ]);
            call_user_func($callback,$update);
        }
    }


}