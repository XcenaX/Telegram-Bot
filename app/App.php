<?php

class App{
    public function __construct(){
        print_r(\Core\Telegram::getUpdates());
    }
}