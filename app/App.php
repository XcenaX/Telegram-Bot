<?php

use Core\Config;
use Core\Telegram;
use Telegram\Bot\Objects\Update;

class App {

    public function __construct()
    {

        Telegram::init(Config::telegram());

        Telegram::eachUpdate(function (Update $update) {

            $chat_id = $update->getMessage()["chat"]["id"];
            $text = $update->getMessage()["text"];

            Telegram::sendMessage($chat_id, $text);

        });

    }

}