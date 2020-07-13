<?php

use Dotenv\Dotenv;

class ENV extends Dotenv {
    /**
     * load the env file
     * @return void
     */
    public static function loadENV(): void
    {
        $root = __DIR__ . '/../';
        $dotenv = self::createImmutable($root);
        $dotenv->load();
    }

    /**
     * static method to return env var
     * @return string
     */
    public static function GET($prop)
    {
        return self::_g($prop);
    }


    private static function _g($prop)
    {
        return $_ENV[$prop];
    }
}


