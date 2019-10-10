<?php

namespace Core;

use Core\Commands\HelpCommand;
use Core\Commands\StartCommand;
use Illuminate\Support\Collection;
use Medoo\Medoo;
use Models\Tables\Updates;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Update;

class Telegram
{

    private static $instance;

    private function __construct($cfg)
    {
        self::$instance
            = new Api($cfg["token"]);

        if (isset($cfg["commands"]))
            self::$instance
                ->addCommands($cfg["commands"]);
    }

    static function init($cfg)
    {
        if (!self::$instance instanceof Api)
            new self($cfg);
    }

    static function getUpdates(array $params = [], $shouldEmitEvents = true)
    {
        return self::$instance->getUpdates($params, $shouldEmitEvents);
    }

    static function sendMessage($chat_id, $message) {
        return self::$instance
            ->sendMessage([
                "chat_id" => $chat_id,
                "text" => $message
            ]);
    }

    static function eachUpdate(callable $callback) {

        $update_id = Updates::max("id");

        foreach (self::getUpdates([
            "offset" => $update_id + 1
        ]) as $update) {

            self::$instance
                ->commandsHandler(false);

            Updates::insert([
                "id" => $update["update_id"]
            ]);

            if ($update->getMessage()["text"][0] != "/")
                call_user_func($callback, $update);

        }

    }

}