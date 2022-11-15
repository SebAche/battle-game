<?php

namespace App;

class Autoloader
{
    public static function autoload(string $class): void
    {
        if (strpos($class, __NAMESPACE__.'\\') === 0) {
            $class= str_replace(__NAMESPACE__ . '\\', '', $class);
            $class= str_replace('\\', '/', $class);

            require 'src/' . $class . '.php';
        }
    }

    public static function register(): void
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }
}
